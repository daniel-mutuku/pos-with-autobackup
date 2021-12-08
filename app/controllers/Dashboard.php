<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH .'third_party'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');

class Dashboard extends BASE_Controller {

	/**
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_model');
	}

	public function index()
	{
	    $this->data['dailyincome'] = $this->sales_model->dailyincome();
        $this->data['annualincome'] = $this->sales_model->annualincome();
        $this->data['monthlyincome'] = $this->sales_model->monthlyincome();
        $this->data['incomechart'] = $this->sales_model->incomechart();
        $this->data['pkgchart'] = $this->sales_model->packageschart();

        $this->data['pg_title'] = "Dashboard";
		$this->data['page_content'] = 'main/dashboard';
		$this->load->view('layout/template', $this->data);
	}

}
