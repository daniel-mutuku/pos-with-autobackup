<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['pg_title'] = "Dashboard";
		$this->data['page_content'] = 'main/dashboard';
		$this->load->view('layout/template', $this->data);
	}


}
