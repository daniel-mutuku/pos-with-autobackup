<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends BASE_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inventory_model');
		$this->load->model('crm_model');
        $this->load->model('sales_model');
	}

	public function pos()
	{
        $this->data['clients'] = $this->crm_model->fetchclients();

        // client dues
        $clientDues = array();
        foreach ($this->data['clients'] as $one){
            $totshopped = $this->crm_model->totalshopped($one['id']);
            $totpaid = $this->crm_model->totalpaid($one['id']);
            $due = $totshopped-$totpaid;
            $clientDues[] = array("client_id" => $one['id'],"due" => $due);
        }
        $this->data['dueArr'] = $clientDues;

        $prods = array();
        $this->data['products'] = $this->inventory_model->fetchproducts();
        foreach ($this->data['products'] as $one){
            $one['qty'] = $this->inventory_model->getstock($one['id']);
            $prods[] = $one;
        }
        $this->data['products'] = $prods;
        $this->data['is_pos'] = true;
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "pos";
        $this->data['pg_title'] = "POS";
        $this->data['page_content'] = 'sales/pos';
        $this->load->view('layout/template', $this->data);
	}
	public function deleteinvoice($id)
    {
        $this->sales_model->deleteinvoice($id);
        echo json_encode(array());
    }
	public function possell($id)
    {
        $data = $this->input->post();
        $inserted = $this->sales_model->postsale($data,$id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg','Sale posted successfully!');
        }else{
            $this->session->set_flashdata('error-msg','Failed, try again!');
        }
        redirect('sales/possales');

    }
    public function possellprint($id)
    {
        $data = $this->input->post();
        $inserted = $this->sales_model->postsale($data,$id);
        if ($inserted > 0) {
            $this->session->set_flashdata('success-msg','Sale posted successfully!');
        }else{
            $this->session->set_flashdata('error-msg','Failed, try again!');
        }
        redirect('sales/possales/'.$inserted);

    }
    public function possales($print = 0)
    {
        $this->data['print'] = $print;
        $this->data['sales'] = $this->sales_model->fetchpossales();
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "possales";
        $this->data['pg_title'] = "POS Sales";
        $this->data['page_content'] = 'sales/possales';
        $this->load->view('layout/template', $this->data);
    }
    public function cashsales()
    {
        $this->data['sales'] = $this->sales_model->fetchchashsales();
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "cashsales";
        $this->data['pg_title'] = "Cash Sales";
        $this->data['page_content'] = 'sales/cashsales';
        $this->load->view('layout/template', $this->data);
    }
    public function creditsales()
    {
        $this->data['sales'] = $this->sales_model->fetchcreditsales();
        $this->data['dtable'] = "present";
        $this->data['menu'] = "sales";
        $this->data['menuitem'] = "creditsales";
        $this->data['pg_title'] = "Credit Sales";
        $this->data['page_content'] = 'sales/creditsales';
        $this->load->view('layout/template', $this->data);
    }
    public function printinvoice($id)
    {
        $data['receipt'] = $this->sales_model->fetchonesale($id);
        ini_set('memory_limit', '64M');
        // load library
        $this->load->library('pdf');
        $this->pheight = 0;
        $this->load->library('pdf');
        $pdf = $this->pdf->load_thermal();
        // retrieve data from model or just static date
        $data['title'] = "items";
        $pdf->allow_charset_conversion = true;  // Set by default to TRUE
        $pdf->charset_in = 'UTF-8';
        //   $pdf->SetDirectionality('rtl'); // Set lang direction for rtl lang
        $pdf->autoLangToFont = true;
        $html = $this->load->view('printfiles/pos-invoice', $data, true);
        $h = 160 + $this->pheight;
        //  $pdf->_setPageSize(array(70, $h), $this->orientation);
        $pdf->_setPageSize(array(70, $h), $pdf->DefOrientation);
        $pdf->WriteHTML($html);
        // render the view into HTML
        // write the HTML into the PDF
        $file_name = preg_replace('/[^A-Za-z0-9]+/', '-', 'POS_Invoice_' . $tid);
        if ($this->input->get('d')) {
            $pdf->Output($file_name . '.pdf', 'D');
        } else {
            $pdf->Output($file_name . '.pdf', 'I');
        }

        unlink('userfiles/temp/' . $data['qrc']);
    }
}
