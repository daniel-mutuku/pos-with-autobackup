<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Crm_model extends CI_Model
{

    public $_string = "0123456789";
    public $_exportFile = FCPATH . "db/exports.sql";
    public $_tableClients = "clients";
    public $_tableInvoices = "invoices";
    public $_tableInvoicePayments = "invoice_payments";

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
        return $this->aauth->user()['branch_id'];
    }

    public function addclient($data)
    {
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableClients, $data);
        if ($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL . $this->db->last_query().";" . PHP_EOL, FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }

    public function fetchclients()
    {
        if ($this->aauth->user()['is_super'] == 0){
            $bid = $this->branchid();
            $this->db->where('branch_id', $bid);
        }
        $query = $this->db->get($this->_tableClients);

        return $query->result_array();
    }

    public function oneclient($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->_tableClients);

        return $query->row_array();
    }

    public function deleteclient($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_tableClients);
        if ($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL . $this->db->last_query().";" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function deletepmt($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_tableInvoicePayments);
        if ($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL . $this->db->last_query().";" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function fetchpmts()
    {
        if ($this->aauth->user()['is_super'] == 0){
            $this->db->where($this->_tableClients . ".branch_id", $this->branchid());
        }
        $this->db->select($this->_tableInvoicePayments . ".*," . $this->_tableClients . ".name")->from($this->_tableInvoicePayments);
        $this->db->join($this->_tableClients, $this->_tableClients . ".id=" . $this->_tableInvoicePayments . ".client_id");
        $this->db->order_by($this->_tableInvoicePayments . ".created_at", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function editclient($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->_tableClients, $data);
        if ($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL . $this->db->last_query().";" . PHP_EOL, FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }

    public function payclients($data)
    {
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableInvoicePayments, $data);
        if ($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL . $this->db->last_query().";" . PHP_EOL, FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }

    public function totalshopped($cid)
    {
        $added = 0;
        $this->db->where('client_id', $cid);
        $this->db->select_sum('invoice_amt');
        $query = $this->db->get($this->_tableInvoices);
        $added = $query->row_array()['invoice_amt'];

        return $added;
    }

    public function totalpaid($cid)
    {
        $added = 0;
        $this->db->where('client_id', $cid);
        $this->db->select_sum('amount');
        $query = $this->db->get($this->_tableInvoicePayments);
        $added = $query->row_array()['amount'];

        return $added;
    }
    public function fetchtopclients()
    {
        $this->db->select("sum(" . $this->_tableInvoices . ".invoice_amt) as tot,"  . $this->_tableClients . ".*," . $this->_tableInvoices . ".*")->from($this->_tableInvoices);
        $this->db->join($this->_tableClients, $this->_tableClients . ".id=" . $this->_tableInvoices . ".client_id");
        $this->db->group_by($this->_tableInvoices . ".client_id");
        $this->db->order_by("tot", 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }

}
