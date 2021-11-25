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
        $this->CI->db->select()->from('users');
        $this->CI->db->where('email', $login['email']);
        $this->CI->db->or_where('username', $login['email']);
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

    function signup($data)
    {
        $data['password'] = $this->hash($data['password']);
        $dueat = date('Y-m-d H:i:s', time()+(86400*9));
        
        $users = array('email' => $data['email'], 'username' => $data['username'], 'password' => $data['password'], 'category' => $data['category'],"due_at" => $dueat);
        
        $this->CI->db->insert('users',$users);

        $userid = $this->CI->db->insert_id();
        
        
        $result = array('email' => $data['email'], 'username' => $data['username'], 'id' => $userid, 'category' => $data['category']);

        $umeta = array('user_id' => $userid, 'name' => $data['name'], 'phone' => $data['phone'], 'dob' => $data['dob']);

        $this->CI->db->insert('users_meta',$umeta);

        $cookie = array(
                      'name'   => 'userdata',
                      'value'  => json_encode($result),
                      'expire' => 31536000
                );
        set_cookie($cookie);

        return $userid;
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

        // select the user meta
        $this->CI->db->select()->from('users_meta');
        $this->CI->db->where('user_id', $user['id']);
        $query = $this->CI->db->get();
        $res = $query->row_array();
        
        // select the user meta
        $this->CI->db->select()->from('users');
        $this->CI->db->where('id', $user['id']);
        $query = $this->CI->db->get();
        $user = $query->row_array();

        $userdata =array('id' => $user['id'],'name' =>$res['name'], 'phone' =>$res['phone'], 'dob' =>$res['dob'], 'email' =>$user['email'], 'username' =>$user['username'], 'category' =>$user['category'],'subjects' => $res['subjects'],'profile_pic' => $res['profile_pic'],'about' => $res['about'],'verified' => $res['verified'],'parent_school' => $user['parent_school']);
        // print_r($userdata);die;
        return $userdata;
    }

    
}

?>