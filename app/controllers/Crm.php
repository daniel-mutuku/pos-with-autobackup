<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crm extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('crm_model');
        $this->load->model('inventory_model');
	}

    public function clients()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['clients'] = $this->crm_model->fetchclients();
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "crm";
            $this->data['menuitem'] = "clients";
            $this->data['pg_title'] = "Clients";
            $this->data['page_content'] = 'crm/clients';
            $this->load->view('layout/template', $this->data);
        }else{
            $data = $this->input->post();
            $inserted = $this->crm_model->addclient($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('crm/clients');
        }
    }
    public function editclient($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['clients'] = $this->crm_model->fetchclients();
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "crm";
            $this->data['menuitem'] = "clients";
            $this->data['pg_title'] = "Clients";
            $this->data['page_content'] = 'crm/clients';
            $this->load->view('layout/template', $this->data);
        }else{
            $data = $this->input->post();
            $inserted = $this->crm_model->editclient($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('crm/clients');
        }
    }
    public function payclients()
    {
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('client_id', 'Client', 'required');
        $this->form_validation->set_rules('mode', 'Mode', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['clients'] = $this->crm_model->fetchclients();
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "crm";
            $this->data['menuitem'] = "clients";
            $this->data['pg_title'] = "Clients";
            $this->data['page_content'] = 'crm/clients';
            $this->load->view('layout/template', $this->data);
        }
        else
        {
            $data = $this->input->post();
            $inserted = $this->crm_model->payclients($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('crm/clients');
        }

    }
    public function deleteclient($id){
        $data = array();
        $this->crm_model->deleteclient($id);
        echo json_encode($data);
    }
    public function deletepmt($id){
        $data = array();
        $this->crm_model->deletepmt($id);
        echo json_encode($data);
    }
    public function viewclient($id){
        $data = array();
        $data = $this->crm_model->oneclient($id);
        echo json_encode($data);
    }
    public function topclients()
    {
        $this->data['clients'] = $this->crm_model->fetchtopclients();
        $this->data['dtable'] = "present";
        $this->data['menu'] = "reports";
        $this->data['menuitem'] = "topclients";
        $this->data['pg_title'] = "Top Clients";
        $this->data['page_content'] = 'crm/topclients';
        $this->load->view('layout/template', $this->data);
    }
    public function clientpmts()
    {
        $this->data['pmts'] = $this->crm_model->fetchpmts();
        $this->data['dtable'] = "present";
        $this->data['menu'] = "crm";
        $this->data['menuitem'] = "clientpmts";
        $this->data['pg_title'] = "Client Pmts";
        $this->data['page_content'] = 'crm/clientpmts';
        $this->load->view('layout/template', $this->data);
    }


}
