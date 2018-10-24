<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class First_login extends CI_Controller
{	
	/*
		call first_view view
	*/
	public function index(){	
		$this->load->view('first_login');
	} 
}
?>