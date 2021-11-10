<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrm extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function employees()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "hrm";
        $this->data['menuitem'] = "employees";
        $this->data['pg_title'] = "Staff";
        $this->data['page_content'] = 'hrm/employees';
        $this->load->view('layout/template', $this->data);
    }
    public function payroll()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "hrm";
        $this->data['menuitem'] = "payroll";
        $this->data['pg_title'] = "Payroll";
        $this->data['page_content'] = 'hrm/payroll';
        $this->load->view('layout/template', $this->data);
    }
    public function departments()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "hrm";
        $this->data['menuitem'] = "departments";
        $this->data['pg_title'] = "Departments";
        $this->data['page_content'] = 'hrm/departments';
        $this->load->view('layout/template', $this->data);
    }
    public function roles()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "hrm";
        $this->data['menuitem'] = "roles";
        $this->data['pg_title'] = "Roles";
        $this->data['page_content'] = 'hrm/roles';
        $this->load->view('layout/template', $this->data);
    }

}
