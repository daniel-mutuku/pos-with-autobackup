<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inventory_model');
	}

	public function listproducts()
	{
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('buying_price', 'Buying price', 'required');
        $this->form_validation->set_rules('selling_price', 'Selling price', 'required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required|is_unique[products.barcode]');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        $this->form_validation->set_rules('cat_id', 'Category', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['suppliers'] = $this->inventory_model->fetchsuppliers();
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['products'] = $this->inventory_model->fetchproducts();
            $this->data['categories'] = $this->inventory_model->fetchcategories();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "products";
            $this->data['pg_title'] = "Products";
            $this->data['page_content'] = 'inventory/listproducts';
            $this->load->view('layout/template', $this->data);
        }else{
            $data = $this->input->post();
            $inserted = $this->inventory_model->addproduct($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/listproducts');
        }

	}
    public function editproduct($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('buying_price', 'Buying price', 'required');
        $this->form_validation->set_rules('selling_price', 'Selling price', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        $this->form_validation->set_rules('cat_id', 'Category', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['suppliers'] = $this->inventory_model->fetchsuppliers();
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['products'] = $this->inventory_model->fetchproducts();
            $this->data['categories'] = $this->inventory_model->fetchcategories();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "products";
            $this->data['pg_title'] = "Products";
            $this->data['page_content'] = 'inventory/listproducts';
            $this->load->view('layout/template', $this->data);
        }else{
            $data = $this->input->post();
            $inserted = $this->inventory_model->editproduct($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/listproducts');
        }

    }
    public function addstock()
    {
        $this->form_validation->set_rules('qty', 'Name', 'required');
        $this->form_validation->set_rules('product_id', 'Product', 'required');
        $this->form_validation->set_rules('price', 'Total price', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['suppliers'] = $this->inventory_model->fetchsuppliers();
            $this->data['products'] = $this->inventory_model->fetchproducts();
            $this->data['categories'] = $this->inventory_model->fetchcategories();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "products";
            $this->data['pg_title'] = "Products";
            $this->data['page_content'] = 'inventory/listproducts';
            $this->load->view('layout/template', $this->data);
        }else{
            $data = $this->input->post();
            $inserted = $this->inventory_model->addstock($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/listproducts');
        }

    }
    public function categories()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['categories'] = $this->inventory_model->fetchcategories();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "categories";
            $this->data['pg_title'] = "Categories";
            $this->data['page_content'] = 'inventory/categories';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->addcategory($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/categories');
        }
    }
    public function editcategory($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['categories'] = $this->inventory_model->fetchcategories();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "categories";
            $this->data['pg_title'] = "Categories";
            $this->data['page_content'] = 'inventory/categories';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->editcategory($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/categories');
        }
    }
    public function warehouses()
    {
        $this->form_validation->set_rules('name', 'Store name', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('store_no', 'Store number', 'required|is_unique[branches.store_no]');
        $this->form_validation->set_rules('branch_phone', 'Phone', 'required|is_unique[branches.branch_phone]');
        $this->form_validation->set_rules('branch_email', 'Email', 'required|is_unique[branches.branch_email]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "warehouses";
            $this->data['pg_title'] = "Warehouses";
            $this->data['page_content'] = 'inventory/warehouses';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->addwarehouse($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/warehouses');
        }
    }
    public function editwarehouse($id)
    {
        $this->form_validation->set_rules('name', 'Store name', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('store_no', 'Store number', 'required');
        $this->form_validation->set_rules('branch_phone', 'Phone', 'required');
        $this->form_validation->set_rules('branch_email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "warehouses";
            $this->data['pg_title'] = "Warehouses";
            $this->data['page_content'] = 'inventory/warehouses';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->editwarehouse($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/warehouses');
        }
    }
    public function viewwarehouse($id){
	    $data = array();
	    $data = $this->inventory_model->fetchonewarehouse($id);
	    echo json_encode($data);
    }
    public function deletewarehouse($id){
        $data = array();
        $this->inventory_model->deletewarehouse($id);
        echo json_encode($data);
    }
    public function viewsupplier($id){
        $data = array();
        $data = $this->inventory_model->fetchonesupplier($id);
        echo json_encode($data);
    }
    public function deletesupplier($id){
        $data = array();
        $this->inventory_model->deletesupplier($id);
        echo json_encode($data);
    }
    public function viewproduct($id){
        $data = array();
        $data = $this->inventory_model->fetchoneproduct($id);
        echo json_encode($data);
    }
    public function deleteproduct($id){
        $data = array();
        $this->inventory_model->deleteproduct($id);
        echo json_encode($data);
    }
    public function viewcategory($id){
        $data = array();
        $data = $this->inventory_model->fetchonecategory($id);
        echo json_encode($data);
    }
    public function deletecategory($id){
        $data = array();
        $this->inventory_model->deletecategory($id);
        echo json_encode($data);
    }
    public function purchases()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "inventory";
        $this->data['menuitem'] = "purchases";
        $this->data['pg_title'] = "Purchases";
        $this->data['page_content'] = 'inventory/purchases';
        $this->load->view('layout/template', $this->data);
    }
    public function stockreturns()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "inventory";
        $this->data['menuitem'] = "stockreturns";
        $this->data['pg_title'] = "Stock Returns";
        $this->data['page_content'] = 'inventory/stockreturns';
        $this->load->view('layout/template', $this->data);
    }
    public function paysuppliers()
    {
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('method', 'Method', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['suppliers'] = $this->inventory_model->fetchsuppliers();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "suppliers";
            $this->data['pg_title'] = "Suppliers";
            $this->data['page_content'] = 'inventory/suppliers';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->paysupplier($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/suppliers');
        }

    }
    public function suppliers()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone number', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('id_no', 'ID No', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['suppliers'] = $this->inventory_model->fetchsuppliers();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "suppliers";
            $this->data['pg_title'] = "Suppliers";
            $this->data['page_content'] = 'inventory/suppliers';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->addsupplier($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/suppliers');
        }

    }
    public function editsupplier($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone number', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('id_no', 'ID No', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['suppliers'] = $this->inventory_model->fetchsuppliers();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "inventory";
            $this->data['menuitem'] = "suppliers";
            $this->data['pg_title'] = "Suppliers";
            $this->data['page_content'] = 'inventory/suppliers';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->inventory_model->editsupplier($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('inventory/suppliers');
        }

    }

}
