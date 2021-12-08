<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * 
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

	public function index()
	{
        if($this->aauth->islogged()){
            redirect('dashboard');
        }
		$this->data['pg_title'] = "Login";
        $this->data['page_content'] = 'auth/login';
        $this->load->view('layout/auth_template', $this->data);
	}
    //finish the session of a logged in user
    function logout()
    {
        delete_cookie("userdata");
        $this->session->set_flashdata('error-msg','You are logged out!');
        redirect('auth');
    }

    function login_post()
    {
        $formInput = $this->input->post();
        $email = $formInput['email'];
        $password = $formInput['password'];

        // define data to send
        $logindata = ['email' => $email, 'password' => $password];

        $loginresponse = json_decode($this->auth_model->login($logindata));
//         var_dump($loginresponse);die;
        // echo $loginresponse->message;die;
        if ($loginresponse->status == '1') {
            $this->session->set_userdata('user_aob', $loginresponse->userdata);
            redirect('dashboard');
        } else {

            $this->session->set_flashdata('error-msg', $loginresponse->message);
            redirect('auth/index');
        }

    }

	function register()
	{
		$this->load->view('register');
	}

	function forgot_password()
	{
		$this->load->view('forgot-password');
	}

}
