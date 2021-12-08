<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aauth {

    public $hash_key = 'HHZASm9pZ7h!pDpDB3_X$a_4Ash+dNbVnuYy5S%-HUPdNUA2x?';
    public $CI;

    function __construct()
    {
        $this->CI = &get_instance();
    }

    function hash($password)
    {
        return md5($this->hash_key . $password);
    }

    function login($login)
    {
        $pass_h = $this->hash($login['password']);

        // echo $pass_h;die;

        // select the user
        $this->CI->db->select('login.password,staff.*,roles.name as rname,roles.is_super')->from('staff');
        $this->CI->db->where('email', $login['email']);
        $this->CI->db->join('login','login.staff_id=staff.id');
        $this->CI->db->join('roles','roles.id=staff.role_id');
        $query = $this->CI->db->get();
        $res = $query->result_array();

        // echo json_encode($login['email']);die;

        if (sizeof($res) > 0) {
            $result = $res[0];
            // select the saved password hash key
            $db_hash = $result['password'];
            $auth = $db_hash == $pass_h ? true : false;

            // check if authentication was successful
            if ($auth) {
                $cookie = array(
                      'name'   => 'userdata',
                      'value'  => json_encode($result),
                      'expire' => 31536000
                      );
                set_cookie($cookie);

                return json_encode(['status' => '1', "message" => 'login successful', 'userdata' => $result]);
            } else {
                return json_encode(['status' => "0", 'message' => 'Authentication failed!']);
            }

        } else {
            return json_encode(['status' => "0", 'message' => 'User does not exist!']);
        }

    }

    function format_phone($phone)
    {
        if(substr($phone,0,1) == "0"){
            return $phone;
        }elseif (substr($phone,0,1) == "+") {
            return "0".substr($phone,4);
        }else{
            return "0".$phone;
        }
    }

    function islogged()
    {
        if ($this->CI->input->cookie('userdata', TRUE)) {
            return true;
        }else{
            return false;
        }
    }

    function user()
    {
        $user = json_decode($this->CI->input->cookie('userdata', TRUE),TRUE);

        return $user;
    }

    
}

?>