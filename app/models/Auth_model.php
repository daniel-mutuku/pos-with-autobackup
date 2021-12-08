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

    function login($login)
    {
        return $this->aauth->login($login);
    }
}
