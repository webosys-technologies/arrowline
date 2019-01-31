<?php

class Ledger extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Sales_model','Reports_model','Ledger_model','Order_model','Customer_model','Supplier_model'));
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
        
        public function supplier_ledger()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
//		$data['profit']=$this->Reports_model->getProfit();
//		$data['sales']=$this->Reports_model->getSales();
		$data['supplier']=$this->Ledger_model->getSupplier();
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('ledger/supplier_ledger',$data);
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

        $data=$this->Ledger_model->ledgerFilter($customer,$from,$to);
//        $data1['ob']=$this->Ledger_model->opening_balance($customer,$from,$to);
//        $trans1=$this->Ledger_model->ledgerFilter1($customer,$from,$to);
//        $data= array_merge($trans,$trans1);
//                $result=((object)array_merge((array)$data,(array)$data1));

//        echo '<pre>';
//        print_r($result);
        
        
//        $data['ob']=$this->Ledger_model->opening_balance($customer,$from,$to);
//        print_r($data);

        //log_message('debug',print_r($data,true));
        
        echo(json_encode($data));
        
    }
    
    public function supplier_filter()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $supplier=$this->input->post('supplier');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $trans=$this->Ledger_model->supplierFilter($supplier,$from,$to);
     
        
        
//        $data['ob']=$this->Ledger_model->opening_balance($customer,$from,$to);
//        print_r($data);

        //log_message('debug',print_r($data,true));
        
        print_r(json_encode($trans));
        
        
    }
    
 public function cust_ledger_print()
	{
	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        $customer=$this->input->post('customer');
        $from=$this->input->post('from');
        $to=$this->input->post('to');
        
        $data['ledger_data']=$this->Ledger_model->ledgerFilter($customer,$from,$to);
          
        
        $data['from']=date('d-F-Y', strtotime($this->input->post('from')));
        $data['to']=date('d-F-Y', strtotime($this->input->post('to')));
        $data['customer']=$this->Customer_model->customer_name($customer)->name;
       
        
        
        

		$data['country']=$this->Order_model->companyDetails();
		
	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    
	    //$html=$this->load->view('report/list_vehicle','',TRUE);
	    $html=$this->load->view('ledger/cust_ledger_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}
        
        
     public function supp_ledger_print()
	{
	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        $supplier=$this->input->post('customer');
        $from=$this->input->post('from');
        $to=$this->input->post('to');
       
        
        $data['ledger_data']=$this->Ledger_model->supplierFilter($supplier,$from,$to);
          
        
        $data['from']=date('d-F-Y', strtotime($this->input->post('from')));
        $data['to']=date('d-F-Y', strtotime($this->input->post('to')));
         $data['customer']=$this->Supplier_model->supplier_name($supplier)->name;
       
         
         print_r($this->input->post());
         echo "<br>";
         print_r($data['ledger_data']);
         
       

		$data['country']=$this->Order_model->companyDetails();
		
	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    
	    //$html=$this->load->view('report/list_vehicle','',TRUE);
	    $html=$this->load->view('ledger/supp_ledger_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}
    
    public function query()
    {
       $this->Ledger_model->query();
       redirect('Ledger');
    }
}