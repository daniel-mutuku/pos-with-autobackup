<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function listproducts()
	{
        $this->data['dtable'] = "present";
        $this->data['menu'] = "inventory";
        $this->data['menuitem'] = "products";
        $this->data['pg_title'] = "Products";
        $this->data['page_content'] = 'inventory/listproducts';
        $this->load->view('layout/template', $this->data);
	}
    public function categories()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "inventory";
        $this->data['menuitem'] = "categories";
        $this->data['pg_title'] = "Categories";
        $this->data['page_content'] = 'inventory/categories';
        $this->load->view('layout/template', $this->data);
    }
    public function warehouses()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "inventory";
        $this->data['menuitem'] = "warehouses";
        $this->data['pg_title'] = "Warehouses";
        $this->data['page_content'] = 'inventory/warehouses';
        $this->load->view('layout/template', $this->data);
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
    public function suppliers()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "inventory";
        $this->data['menuitem'] = "suppliers";
        $this->data['pg_title'] = "Suppliers";
        $this->data['page_content'] = 'inventory/suppliers';
        $this->load->view('layout/template', $this->data);
    }

}
