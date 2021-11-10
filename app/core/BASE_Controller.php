<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @property CI_Controller $CI_Controller
 * @property CI_Session $session
 * @property CI_Input $input
 *
 *
 * This controller holds some common functionality. It needs to have the name 'BASE_' prefix for Codeigniter to load it automatically
 * as per the config file extension prefix
 * It is therefore extended by the other app controllers that want to benefit from that.
 ** */
class BASE_Controller extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
        // if(!$this->session->userdata('user_aob')){
        // 	$this->session->set_flashdata('error-msg','Please login to continue!');
        // 	redirect('auth');
        // }
        
        
    }
    
   
}