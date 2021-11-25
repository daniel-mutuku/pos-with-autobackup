<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrm extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('hrm_model');
        $this->load->model('inventory_model');
	}

    public function employees()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[staff.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[staff.username]');
        $this->form_validation->set_rules('id_no', 'ID no', 'required|is_unique[staff.id_no]');
        $this->form_validation->set_rules('phone_no', 'Phone no', 'required|is_unique[staff.phone_no]');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['roles'] = $this->hrm_model->fetchroles();
            $this->data['staff'] = $this->hrm_model->fetchstaff();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "hrm";
            $this->data['menuitem'] = "employees";
            $this->data['pg_title'] = "Staff";
            $this->data['page_content'] = 'hrm/employees';
            $this->load->view('layout/template', $this->data);
        }else
        {
            $data = $this->input->post();
            $inserted = $this->hrm_model->addstaff($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('hrm/employees');
        }

    }

    public function editstaff($id)
    {
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('id_no', 'ID no', 'required');
        $this->form_validation->set_rules('phone_no', 'Phone no', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['roles'] = $this->hrm_model->fetchroles();
            $this->data['staff'] = $this->hrm_model->fetchstaff();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "hrm";
            $this->data['menuitem'] = "employees";
            $this->data['pg_title'] = "Staff";
            $this->data['page_content'] = 'hrm/employees';
            $this->load->view('layout/template', $this->data);
        }else
        {
            $data = $this->input->post();
            $inserted = $this->hrm_model->editstaff($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('hrm/employees');
        }

    }
    public function resetpass($id)
    {
        $this->form_validation->set_rules('pass', 'Pasword', 'trim|required');
        $this->form_validation->set_rules('pconf', 'Pasword Confirm', 'trim|required|matches[pass]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['warehouses'] = $this->inventory_model->fetchwarehouses();
            $this->data['roles'] = $this->hrm_model->fetchroles();
            $this->data['staff'] = $this->hrm_model->fetchstaff();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "hrm";
            $this->data['menuitem'] = "employees";
            $this->data['pg_title'] = "Staff";
            $this->data['page_content'] = 'hrm/employees';
            $this->load->view('layout/template', $this->data);
        }else
        {
            $data = $this->input->post();
            $inserted = $this->hrm_model->resetpass($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('hrm/employees');
        }

    }

    public function deleterole($id){
        $data = array();
        $this->hrm_model->deleterole($id);
        echo json_encode($data);
    }
    public function viewrole($id){
        $data = array();
        $data = $this->hrm_model->onerole($id);
        echo json_encode($data);
    }
    public function deletestaff($id){
        $data = array();
        $this->hrm_model->deletestaff($id);
        echo json_encode($data);
    }
    public function viewstaff($id){
        $data = array();
        $data = $this->hrm_model->onestaff($id);
        echo json_encode($data);
    }

    public function roles()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['roles'] = $this->hrm_model->fetchroles();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "hrm";
            $this->data['menuitem'] = "roles";
            $this->data['pg_title'] = "Roles";
            $this->data['page_content'] = 'hrm/roles';
            $this->load->view('layout/template', $this->data);
        }else
        {
            $data = $this->input->post();
            $inserted = $this->hrm_model->addrole($data);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('hrm/roles');
        }

    }
    public function editrole($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['roles'] = $this->hrm_model->fetchroles();
            $this->data['dtable'] = "present";
            $this->data['menu'] = "hrm";
            $this->data['menuitem'] = "roles";
            $this->data['pg_title'] = "Roles";
            $this->data['page_content'] = 'hrm/roles';
            $this->load->view('layout/template', $this->data);
        }else
        {
            $data = $this->input->post();
            $inserted = $this->hrm_model->editrole($data,$id);
            if ($inserted > 0) {
                $this->session->set_flashdata('success-msg','Success!');
            }else{
                $this->session->set_flashdata('error-msg','Failed, try again!');
            }
            redirect('hrm/roles');
        }

    }

}
