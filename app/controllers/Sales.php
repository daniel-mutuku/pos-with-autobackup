<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function possales()
	{
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "possales";
        $this->data['pg_title'] = "POS Sales";
        $this->data['page_content'] = 'sales/possales';
        $this->load->view('layout/template', $this->data);
	}
    public function cashsales()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "cashsales";
        $this->data['pg_title'] = "Cash Sales";
        $this->data['page_content'] = 'sales/cashsales';
        $this->load->view('layout/template', $this->data);
    }
    public function creditsales()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "cashsales";
        $this->data['pg_title'] = "Credit Sales";
        $this->data['page_content'] = 'sales/creditsales';
        $this->load->view('layout/template', $this->data);
    }
    public function returns()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "returns";
        $this->data['pg_title'] = "Returns";
        $this->data['page_content'] = 'sales/returns';
        $this->load->view('layout/template', $this->data);
    }
}
