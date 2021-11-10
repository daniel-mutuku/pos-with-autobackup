<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('session', 'form_validation', 'Rememberme', 'user_agent', 'PHPMailer', 'Excel','database','email');

$autoload['helper'] = array('cookie', 'url', 'file','date','form');

$autoload['config'] = array('rememberme');

$autoload['language'] = array();

$autoload['model'] = array('auth_model');

/* End of file autoload.php */
/* Location: ./application/config/autoload.php */