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
    public function __construct()
    {
        parent::__construct();

    }
    public function addwarehouse($data){
        $this->db->insert($this->_tableBranches,$data);

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
    }
    public function editwarehouse($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableBranches,$data);

        return $this->db->affected_rows();
    }

    public function addcategory($data){
        $this->db->insert($this->_tableCategories,$data);

        return $this->db->insert_id();
    }
    public function fetchcategories()
    {
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
    }
    public function editcategory($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableCategories,$data);

        return $this->db->affected_rows();
    }
    public function categoryproductstotal($catid)
    {
//        $uid = $this->aauth->user()['id'];
        $bid = 2;
        $this->db->where('cat_id', $catid);
        $this->db->where('branch_id', $bid);
        $query = $this->db->get($this->_tableProducts);

        return $query->num_rows();
    }
    public function addproduct($data){
        $this->db->insert($this->_tableProducts,$data);

        return $this->db->insert_id();
    }
    public function fetchproducts()
    {
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
    }
    public function editproduct($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableProducts,$data);

        return $this->db->affected_rows();
    }
    public function branchproductstotal()
    {
//        $uid = $this->aauth->user()['id'];
        $bid = 0;
        $this->db->where('branch_id', $bid);
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
        $this->db->insert($this->_tableSuppliers,$data);

        return $this->db->insert_id();
    }
    public function fetchsuppliers()
    {
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
    }
    public function editsupplier($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableSuppliers,$data);

        return $this->db->affected_rows();
    }
    public function addstock($data)
    {
//
        $prodAds = array("product_id" => $data['product_id'], "amount" => $data['qty'], "effect" => "add", "type" => "stock_purchase");
        $supply = array("supplier_id" => $data['supplier_id'],"total_price" => $data['price']);

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well

        $this->db->insert($this->_tableProductAdjustments, $prodAds); # Inserting data
        $supply['adjustment_id'] = $this->db->insert_id();

        $this->db->insert($this->_tableSuppSupplies,$supply);
        if ($this->db->trans_status() == FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return 0;
        }
        else {
            $this->db->trans_complete();
            # Everything is Perfect.
            # Committing data to the database.
            $this->db->trans_commit();
            return 1;
        }


    }
    public function paysupplier($data)
    {
        $this->db->insert($this->_tableSuppPayments,$data);

        return $this->db->insert_id();
    }

}
