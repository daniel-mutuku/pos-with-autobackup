<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH .'third_party'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class Dashboard extends BASE_Controller {

	/**
	 * 
	 */
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
