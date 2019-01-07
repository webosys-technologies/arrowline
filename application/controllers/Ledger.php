<?php

class Ledger extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Sales_model','Reports_model','Ledger_model'));
        $this->load->library(array('form_validation','ion_auth'));
    }
    
    public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
//		$data['profit']=$this->Reports_model->getProfit();
//		$data['sales']=$this->Reports_model->getSales();
		$data['customer']=$this->Reports_model->getCustomer();
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('ledger/cust_ledger',$data);
	}
        public function ledger_filter()
    {   
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $customer=$this->input->post('customer1');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $trans=$this->Ledger_model->ledgerFilter($customer,$from,$to);
//        $data['ob']=$this->Ledger_model->opening_balance($customer,$from,$to);
//        print_r($data);

        //log_message('debug',print_r($data,true));
        
        print_r(json_encode($trans);
        
    }
}