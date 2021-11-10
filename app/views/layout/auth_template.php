<?php
/*
	 * Template carries header, footer, and common navigation
	 * */
$this->load->view('layout/header');
$this->load->view($page_content);
$this->load->view('layout/auth_footer');