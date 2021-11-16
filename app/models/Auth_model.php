<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Auth_model extends CI_Model
{
    public $config;
    public $random = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890~!@#%^&*()";
    public function __construct()
    {
        parent::__construct();

    }

    function admin_login($login)
    {
        return $this->aauth->admin_login($login);
    }
    function student_login($login)
    {
        return $this->aauth->student_login($login);
    }
    function admin_register($data)
    {
        $pass = substr(str_shuffle($this->random),0,8);
        $data['password'] = $pass;

        $data['phone'] = $this->aauth->format_phone($data['phone']);
        
        $this->config =& get_config();
        $userkey = $this->config['smskey'];
        $password = $this->config['smspass'];

        $inserted = $this->aauth->admin_signup($data);
        if($inserted > 0){
            $msg = "Hello ". $data['fname'] ." ". $data['lname'] .",
Welcome to F-masomo portal. To login, proceed to ".base_url()." . Your email is ". $data['email'] ." and password is ". $data['password'] .". You are advised to change the password upon logging in.";

        $smsresponse = $this->fortsortgateway->send($msg,$data['phone'],$userkey,$password);
        } 

        return $inserted;  
    }

    function student_register($data)
    {
        $pass = substr(str_shuffle($this->random),0,8);
        $data['password'] = $data['adm'];
        
        $this->config =& get_config();
        $userkey = $this->config['smskey'];
        $password = $this->config['smspass'];

        $inserted = $this->aauth->student_signup($data);
        if($inserted > 0){
            $msg = "Hello ". $data['fname'] ." ". $data['lname'] .",
Welcome to F-masomo portal. To login, proceed to ".base_url()."auth/student . Your username is ". $data['adm'] ." and password is ". $data['password'] .". You are advised to change the password upon logging in.";

        $smsresponse = $this->fortsortgateway->send($msg,$data['phone'],$userkey,$password);
        } 

        return $inserted;  
    }

}
