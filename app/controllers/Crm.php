<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crm extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function clients()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "crm";
        $this->data['menuitem'] = "clients";
        $this->data['pg_title'] = "Clients";
        $this->data['page_content'] = 'crm/clients';
        $this->load->view('layout/template', $this->data);
    }
    public function topclients()
    {
        $this->data['dtable'] = "present";
        $this->data['menu'] = "crm";
        $this->data['menuitem'] = "topclients";
        $this->data['pg_title'] = "Top Clients";
        $this->data['page_content'] = 'crm/clients';
        $this->load->view('layout/template', $this->data);
    }


}
