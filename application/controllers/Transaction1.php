<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaction_model');
		$this->load->library(array('form_validation','ion_auth'));
	}
	
	
	/*
	   this function used to view and display data of transaction
	*/
	public function index()
	{
		if (!$this->ion_auth->logged_in())
	    {
	        // redirect them to the login page
	        redirect('auth/login', 'refresh');
	    }
		$data['data']=$this->Transaction_model->getTransaction();
		
		$this->load->view('transaction/list',$data);
	}
}