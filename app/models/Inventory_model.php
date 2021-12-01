<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Inventory_model extends CI_Model
{
    public $_tableBranches = "branches";
    public $_tableCategories = "product_categories";
    public $_tableProducts = "products";
    public $_tableProductAdjustments = "product_adjustments";
    public $_tableSuppliers = "suppliers";
    public $_tableSuppPayments = "supplier_payments";
    public $_tableSuppSupplies = "supplier_supplies";
    public $_string = "0123456789";
    public $_exportFile = FCPATH."db/exports.sql";
    public function __construct()
    {
        parent::__construct();
        if (!file_exists($this->_exportFile)) {
            fopen($this->_exportFile,"w");
        }
    }
    public function transcode()
    {
        $id = $this->branchid().substr(time(),6,4).substr(str_shuffle($this->_string),0,4);
        return $id;
    }
    function branchid()
    {
        return 2;
        return $this->aauth->user()['branch_id'];
    }
    public function addwarehouse($data){
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableBranches,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }
    public function fetchwarehouses()
    {
        $query = $this->db->get($this->_tableBranches);
        return $query->result_array();
    }
    public function fetchonewarehouse($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_tableBranches);
        return $query->row_array();
    }
    public function deletewarehouse($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableBranches);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

    }
    public function editwarehouse($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableBranches,$data);

        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }

    public function addcategory($data){
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableCategories,$data);

        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }
    public function fetchcategories()
    {
        $this->db->where('branch_id',$this->branchid());
        $query = $this->db->get($this->_tableCategories);
        return $query->result_array();
    }
    public function fetchonecategory($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_tableCategories);
        return $query->row_array();
    }
    public function deletecategory($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableCategories);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

    }
    public function editcategory($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableCategories,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);


        return $this->db->affected_rows();
    }
    public function categoryproductstotal($catid)
    {
        $this->db->where('cat_id', $catid);
        $this->db->where('branch_id',$this->branchid());
        $query = $this->db->get($this->_tableProducts);

        return $query->num_rows();
    }
    public function addproduct($data){
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableProducts,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }
    public function fetchproducts()
    {
        $this->db->where('branch_id',$this->branchid());
        $query = $this->db->get($this->_tableProducts);
        return $query->result_array();
    }
    public function fetchoneproduct($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_tableProducts);
        return $query->row_array();
    }
    public function deleteproduct($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableProducts);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);
    }
    public function editproduct($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableProducts,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }
    public function branchproductstotal()
    {
        $this->db->where('branch_id',$this->branchid());
        $query = $this->db->get($this->_tableProducts);

        return $query->num_rows();
    }
    public function getstock($id)
    {
        $stock = 0;
        $this->db->where('product_id',$id);
        $this->db->where('effect','add');
        $this->db->select_sum('amount');
        $query = $this->db->get($this->_tableProductAdjustments);
        $added = $query->row_array()['amount'];

        $this->db->where('product_id',$id);
        $this->db->where('effect','reduce');
        $this->db->select_sum('amount');
        $query_2 = $this->db->get($this->_tableProductAdjustments);
        $reduced = $query_2->row_array()['amount'];

        $stock = ($added-$reduced);
        return $stock;
    }
    public function getdues($id)
    {
        $due = 0;
        $this->db->where('supplier_id',$id);
        $this->db->select_sum('total_price');
        $query = $this->db->get($this->_tableSuppSupplies);
        $added = $query->row_array()['total_price'];

        $this->db->where('supplier_id',$id);
        $this->db->select_sum('amount');
        $query_2 = $this->db->get($this->_tableSuppPayments);
        $reduced = $query_2->row_array()['amount'];

        $due = ($added-$reduced);
        return $due;
    }

    public function addsupplier($data){
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableSuppliers,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }
    public function fetchsuppliers()
    {
        $this->db->where('branch_id',$this->branchid());
        $query = $this->db->get($this->_tableSuppliers);
        return $query->result_array();
    }
    public function fetchonesupplier($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_tableSuppliers);
        return $query->row_array();
    }
    public function deletesupplier($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableSuppliers);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);
    }
    public function editsupplier($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableSuppliers,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }
    public function addstock($data)
    {
        $sql1 = "";
        $sql2 = "";

        $prodAds = array("product_id" => $data['product_id'], "amount" => $data['qty'], "effect" => "add", "type" => "stock_purchase");
        $supply = array("supplier_id" => $data['supplier_id'],"total_price" => $data['price']);

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well

        $prodAds['id'] = $this->transcode();
        $this->db->insert($this->_tableProductAdjustments, $prodAds); # Inserting data
        if($this->db->affected_rows() > 0)
            $sql1 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        $supply['adjustment_id'] = $this->db->insert_id();

        $supply['id'] = $this->transcode();
        $this->db->insert($this->_tableSuppSupplies,$supply);
        if($this->db->affected_rows() > 0)
            $sql2 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        if ($this->db->trans_status() == FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return 0;
        }
        else {
            $this->db->trans_complete();
            file_put_contents($this->_exportFile, $sql1, FILE_APPEND | LOCK_EX);
            file_put_contents($this->_exportFile, $sql2, FILE_APPEND | LOCK_EX);
            $this->db->trans_commit();
            return 1;
        }


    }
    public function deletepurchase($id)
    {
        $sql1 = "";
        $sql2 = "";
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well

        $this->db->where('adjustment_id',$id);
        $this->db->delete($this->_tableSuppSupplies);
        if($this->db->affected_rows() > 0)
            $sql1 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        $this->db->where('id',$id);
        $this->db->delete($this->_tableProductAdjustments);
        if($this->db->affected_rows() > 0)
            $sql2 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        if ($this->db->trans_status() == FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return 0;
        }
        else {
            $this->db->trans_complete();
            file_put_contents($this->_exportFile, $sql1, FILE_APPEND | LOCK_EX);
            file_put_contents($this->_exportFile, $sql2, FILE_APPEND | LOCK_EX);

            $this->db->trans_commit();
            return 1;
        }


    }
    public function paysupplier($data)
    {
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableSuppPayments,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }
    public function purchases()
    {
        $this->db->where($this->_tableSuppliers.".branch_id",$this->branchid());
        $this->db->select($this->_tableSuppSupplies.".*,".$this->_tableProductAdjustments.".amount,".$this->_tableSuppliers.".name,".$this->_tableProducts.".name as pname")->from($this->_tableSuppSupplies);
        $this->db->join($this->_tableProductAdjustments,$this->_tableProductAdjustments.".id=".$this->_tableSuppSupplies.".adjustment_id");
        $this->db->join($this->_tableProducts,$this->_tableProducts.".id=".$this->_tableProductAdjustments.".product_id");
        $this->db->join($this->_tableSuppliers,$this->_tableSuppliers.".id=".$this->_tableSuppSupplies.".supplier_id");
        $this->db->order_by($this->_tableSuppSupplies.".created_at","DESC");
        $query = $this->db->get();

        return $query->result_array();
    }
    public function supplierpmts()
    {
        $this->db->where($this->_tableSuppliers.".branch_id",$this->branchid());
        $this->db->select($this->_tableSuppPayments.".*,".$this->_tableSuppliers.".name")->from($this->_tableSuppPayments);
        $this->db->join($this->_tableSuppliers,$this->_tableSuppliers.".id=".$this->_tableSuppPayments.".supplier_id");
        $this->db->order_by($this->_tableSuppPayments.".created_at","DESC");
        $query = $this->db->get();

        return $query->result_array();
    }
    public function stockreturns()
    {
        $this->db->where($this->_tableProductAdjustments.".type","stock_return");
        $this->db->where($this->_tableProducts.".branch_id",$this->branchid());
        $this->db->select($this->_tableProducts.".name,".$this->_tableProductAdjustments.".*")->from($this->_tableProductAdjustments);
        $this->db->join($this->_tableProducts,$this->_tableProducts.".id=".$this->_tableProductAdjustments.".product_id");
        $this->db->order_by($this->_tableProductAdjustments.".created_at","DESC");
        $query = $this->db->get();

        return $query->result_array();
    }
    public function deletereturn($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableProductAdjustments);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }
    public function deletesupppmt($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableSuppPayments);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }
    public function addreturn($data)
    {
        $fdata = array("product_id" => $data['product'],"amount" => $data['qty'],"effect" => "reduce", "type" => "stock_return");
        $fdata['id'] = $this->transcode();
        $this->db->insert($this->_tableProductAdjustments,$fdata);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }

}
