<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Management extends CI_Controller
    {
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('Customer_model','Quotation_model'));
        $this->load->library(array('ion_auth','form_validation'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

     /*

    this function used for display customer list form

    */
	public function customer()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['data'] = $this->Customer_model->custUserData();
        $data['customer']=$this->Customer_model->getCustomer();
        $data['status']=$this->Customer_model->getStatus();
        $data['deactive']=$this->Customer_model->getDeactive();
       
        

        $this->load->view('management/customer',$data);
	}
    }
