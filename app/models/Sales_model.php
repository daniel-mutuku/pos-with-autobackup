<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Sales_model extends CI_Model
{

    public $_string = "0123456789";
    public $_exportFile = FCPATH . "db/exports.sql";
    public $_tableClients = "clients";
    public $_tableInvoices = "invoices";
    public $_tableInvoicePayments = "invoice_payments";
    public $_tabbleProductadjustments = "product_adjustments";

    public function __construct()
    {
        parent::__construct();
        if (!file_exists($this->_exportFile)) {
            fopen($this->_exportFile, "w");
        }
    }

    public function transcode()
    {
        $id = $this->branchid() . substr(time(), 6, 4) . substr(str_shuffle($this->_string), 0, 4);
        return $id;
    }

    function branchid()
    {
        return 2;
        return $this->aauth->user()['branch_id'];
    }

    function postsale($data, $type)
    {
        switch ($type) {
            case 1:
                $stype = "Cash";
                break;
            case 2:
                $stype = "Credit";
                break;
        }

        $sql1 = "";
        $sql2 = "";
        $sql3 = "";
        // data
        $cid = $data['cName'];
        $order = json_decode($data['ordDetails'], true);
        $amtPaid = $data['amtPaid'];
        $totAmt = $data['totAmt'];
        $prevDue = $data['prevDue'];
        $discount = $data['discount'];
        $pmtType = $data['pmtType'];

        $invoices = array("id" => $this->transcode(), "branch_id" => $this->branchid(), "client_id" => $cid, "invoice_amt" => ($totAmt - $discount), "discount" => $discount, "particulars" => json_encode($order), "type" => $stype);
        if ($amtPaid > 0)
            $invoicepmts = array("id" => $this->transcode(), "client_id" => $cid, "mode" => $pmtType, "amount" => $amtPaid);
        $prodadjustments = array();
        foreach ($order as $one) {
            $prodadjustments[] = array("id" => $this->transcode(), "product_id" => $one['prodId'], "amount" => $one['prodQty'], "effect" => "reduce", "type" => "sale");
        }


        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well

        $this->db->insert($this->_tableInvoices, $invoices); # Inserting data
        $invid = $this->db->insert_id();
        if ($invid > 0)
            $sql1 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        $this->db->insert_batch($this->_tabbleProductadjustments, $prodadjustments);
        if ($this->db->affected_rows() > 0)
            $sql2 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        if ($amtPaid > 0) {
            $this->db->insert($this->_tableInvoicePayments, $invoicepmts);

            if ($this->db->affected_rows() > 0)
                $sql3 = PHP_EOL . $this->db->last_query() . PHP_EOL;
        }

        if ($this->db->trans_status() == FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_complete();
            file_put_contents($this->_exportFile, $sql1, FILE_APPEND | LOCK_EX);
            file_put_contents($this->_exportFile, $sql2, FILE_APPEND | LOCK_EX);
            file_put_contents($this->_exportFile, $sql3, FILE_APPEND | LOCK_EX);
            $this->db->trans_commit();
            return $invid;
        }
    }

    public function deleteinvoice($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_tableInvoices);
        $data = $query->row_array();
        $prods = json_decode($data['particulars'], true);

        $returns = array();
        foreach ($prods as $one) {
            $returns[] = array("id" => $this->transcode(), "product_id" => $one['prodId'], "amount" => $one['prodQty'], "effect" => "add", "type" => "sale_return");
        }
        $sql1 = "";
        $sql2 = "";

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well

        $this->db->where('id', $id);
        $this->db->delete($this->_tableInvoices); # Inserting data
        $invid = $this->db->affected_rows();
        if ($invid > 0)
            $sql1 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        $this->db->insert_batch($this->_tabbleProductadjustments, $returns);
        if ($this->db->affected_rows() > 0)
            $sql2 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        if ($this->db->trans_status() == FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_complete();
            file_put_contents($this->_exportFile, $sql1, FILE_APPEND | LOCK_EX);
            file_put_contents($this->_exportFile, $sql2, FILE_APPEND | LOCK_EX);
            $this->db->trans_commit();
            return $invid;
        }
    }

    public function fetchpossales()
    {
        $this->db->select($this->_tableClients . ".name," . $this->_tableInvoices . ".*")->from($this->_tableInvoices);
        $this->db->join($this->_tableClients, $this->_tableClients . ".id=" . $this->_tableInvoices . ".client_id");
        $this->db->order_by($this->_tableInvoices . ".created_at", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetchchashsales()
    {
        $this->db->where($this->_tableInvoices . ".type", "Cash");
        $this->db->select($this->_tableClients . ".name," . $this->_tableInvoices . ".*")->from($this->_tableInvoices);
        $this->db->join($this->_tableClients, $this->_tableClients . ".id=" . $this->_tableInvoices . ".client_id");
        $this->db->order_by($this->_tableInvoices . ".created_at", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetchcreditsales()
    {
        $this->db->where($this->_tableInvoices . ".type", "Credit");
        $this->db->select($this->_tableClients . ".name," . $this->_tableInvoices . ".*")->from($this->_tableInvoices);
        $this->db->join($this->_tableClients, $this->_tableClients . ".id=" . $this->_tableInvoices . ".client_id");
        $this->db->order_by($this->_tableInvoices . ".created_at", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function fetchonesale($id)
    {
        $this->db->where($this->_tableInvoices . ".id", $id);
        $this->db->select($this->_tableClients . ".name," . $this->_tableInvoices . ".*")->from($this->_tableInvoices);
        $this->db->join($this->_tableClients, $this->_tableClients . ".id=" . $this->_tableInvoices . ".client_id");
        $this->db->order_by($this->_tableInvoices . ".created_at", "DESC");
        $query = $this->db->get();

        return $query->row_array();
    }

}
