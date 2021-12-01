<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db   Database
 * @property CI_DB_forge $dbforge     Database
 * @property CI_DB_result $result    Database
 * @property CI_Session $session
 **/
class Hrm_model extends CI_Model
{
    public $_pass = "pass12345";

    public $_string = "0123456789";
    public $_exportFile = FCPATH."db/exports.sql";
    public $_tableStaff = "staff";
    public $_tableLogin = "login";
    public $_tableRoles = "roles";

    public function __construct()
    {
        parent::__construct();
        if (!file_exists($this->_exportFile)) {
            fopen($this->_exportFile,"w");
        }
    }
    public function transcode()
    {
        $id = $this->branchid().substr(time(),6,4).substr(str_shuffle($this->_string),0,4);
        return $id;
    }
    function branchid()
    {
        return 2;
        return $this->aauth->user()['branch_id'];
    }

    public function addrole($data){
        $data['id'] = $this->transcode();
        $this->db->insert($this->_tableRoles,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->insert_id();
    }
    public function fetchroles()
    {
        $query = $this->db->get($this->_tableRoles);

        return $query->result_array();
    }

    public function onerole($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_tableRoles);

        return $query->row_array();
    }
    public function deleterole($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableRoles);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);
    }
    public function editrole($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableRoles,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }

    public function rolestaff($cid)
    {
        $added = 0;
        $this->db->where('role_id',$cid);
        $query = $this->db->get($this->_tableStaff);
        $added = $query->num_rows();

        return $added;
    }

    public function addstaff($data){
        $sql1 = "";
        $sql2 = "";
        $staff = array("id" => $this->transcode(),"fname" => $data['fname'], "lname" => $data['lname'], "email" => $data['email'], "username" => $data['username'],
        "phone_no" => $data['phone_no'],"dob" => $data['dob'],"id_no" => $data['id_no'],"role_id" => $data['role_id'],"branch_id" => $data['branch_id']);
        $logins = array("password" => $this->aauth->hash($this->_pass));

        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        $this->db->insert($this->_tableStaff, $staff);
        if($this->db->affected_rows() > 0)
            $sql1 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        $logins['staff_id'] = $this->db->insert_id();

        $staff['id'] = $this->transcode();
        $this->db->insert($this->_tableLogin,$logins);
        if($this->db->affected_rows() > 0)
            $sql2 = PHP_EOL . $this->db->last_query() . PHP_EOL;

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return 0;
        }
        else {
            $this->db->trans_complete();

            file_put_contents($this->_exportFile, $sql1, FILE_APPEND | LOCK_EX);
            file_put_contents($this->_exportFile, $sql2, FILE_APPEND | LOCK_EX);

            $this->db->trans_commit();
            return 1;
        }
    }
    public function fetchstaff()
    {
        $query = $this->db->get($this->_tableStaff);

        return $query->result_array();
    }

    public function onestaff($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->_tableStaff);

        return $query->row_array();
    }
    public function deletestaff($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->_tableStaff);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);
    }
    public function editstaff($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update($this->_tableStaff,$data);
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }
    public function resetpass($data,$id)
    {
        $this->db->where('staff_id',$id);
        $this->db->update($this->_tableLogin,array("password" => $this->aauth->hash($data['pass'])));
        if($this->db->affected_rows() > 0)
            file_put_contents($this->_exportFile, PHP_EOL.$this->db->last_query().PHP_EOL , FILE_APPEND | LOCK_EX);

        return $this->db->affected_rows();
    }


}
