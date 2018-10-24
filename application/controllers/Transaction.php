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
		$data['account']=$this->Transaction_model->getAccount();
		$data['data']=$this->Transaction_model->getTransaction();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('transaction/list',$data);
	}

	public function transaction_filter()
    {   
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $account=$this->input->post('account');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $data=$this->Transaction_model->transactionFilter($account,$from,$to);

        /*echo "<pre>";
        print_r($data);
        exit();*/

        log_message('debug',print_r($data,true));
        
        print_r(json_encode($data,true));
        
    }

}