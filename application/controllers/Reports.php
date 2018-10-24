<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->model(array('Reports_model','Sales_model'));
        $this->load->library(array('form_validation','ion_auth'));
	}

	/*
		View Income report
	*/
	public function index(){
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['income']=$this->Reports_model->getIncome();
		/*echo "<pre>";
		print_r($data);
		exit();*/

		$this->load->view('reports/income',$data);
	}
	

	public function receivable_payment()
	{

		$data['payment'] = $this->Reports_model->getReceivablePayment();

		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('reports/payable_payment',$data);

	}

	/*
		Get Income report data
	*/
	public function get_data()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data=$this->Reports_model->getData();
		//log_message('debug', print_r($data, true));
     	print_r(json_encode($data, true));
		

	}

	/*
		View Sales history  report
	*/
	public function sales_report()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['profit']=$this->Reports_model->getProfit();
		$data['sales']=$this->Reports_model->getSales();
		$data['customer']=$this->Reports_model->getCustomer();
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('reports/sales_history',$data);
	}

	/*
		View Team member report
	*/
	public function team_report()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['team']=$this->Reports_model->getTeam();
		$this->load->view('reports/team',$data);

	} 

	/*
		View Team member view page
	*/
	public function team_view()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['supplier']=$this->Reports_model->getSupplier();
		$data['supply']=$this->Reports_model->getSuppName();
		$data['location']=$this->Reports_model->getLocation();

		$this->load->view('reports/team_view',$data);
	}

	/*
		View Quotation detail page
	*/
	public function quotation()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['sales']=$this->Reports_model->getQuotation();
		$data['cust']=$this->Reports_model->getCustomer();
		$data['location']=$this->Reports_model->getLocation();
		$this->load->view('reports/quotation',$data);
	}

	/*
		View Invoice detail page
	*/
	public function invoice()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['invoice']=$this->Reports_model->getInvoice();
		$data['cust']=$this->Reports_model->getCustomer();
		$data['location']=$this->Reports_model->getLocation();
		$this->load->view('reports/invoice',$data);	
	}

	/*
		View Payment detail page
	*/
	public function payment()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['payment']=$this->Reports_model->getPayment();
		$data['cust']=$this->Reports_model->getCustomer();
		$this->load->view('reports/payment',$data);
	}

	/*
		Download file
	*/
	function download($filename = NULL) {
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
	    $this->load->helper('download');
	    // read file contents
	    $data = file_get_contents(base_url('/uploads/'.$filename));
	    force_download($filename,$data);
	}

	/*
		Download csv file
	*/
	public function create_csv()
	{
      if(!$this->ion_auth->logged_in())
      {
          redirect('auth/login', 'refresh');
      }


      $data['state']=$this->Sales_model->getCompanyState();
      /*echo "<pre>";
      print_r($data);
      exit();*/
      $state_id = $data['state']->state_id;
      $user_id = $this->session->userdata('userId');

      //echo $state_id;exit();
        ob_start();
        $this->load->helper('download');
        $this->load->dbutil();  
        $this->load->helper('file');
                $delimiter = ",";
                $newline = "\r\n";
                $filename = "sales.csv";
            if($this->session->userdata('type')=='admin'){     
                $query = "SELECT 
                  s.reference_no as InvoiceNo,
                  DATE_FORMAT(s.date,'%d/%m/%Y') as dates,
                  c.name as customer_Name,
                  c.gstin as Customer_GSTIN,
                  c.phone,
                  s.total_tax as TaxAmount,
                  s.total_amount*si.discount/100 as DiscountValue,
                  if(s.state_id = $state_id, s.total_tax/2, 0) as CGST,
                  if(s.state_id = $state_id, s.total_tax/2, 0) as SGST,
                  if(s.state_id = $state_id, 0, s.total_tax) as IGST,
                  s.total_amount as SalesAmount 

                  FROM sales s INNER JOIN sales_item si ON s.id = si.sales_id INNER JOIN item i ON i.id = si.item_id INNER JOIN customer c ON c.id = s.customer_id WHERE s.delete_status='0' GROUP BY s.id";
            }
            else{
                $query = "SELECT 
                  s.reference_no as InvoiceNo,
                  DATE_FORMAT(s.date,'%d/%m/%Y') as dates,
                  c.name as customer_Name,
                  c.gstin as Customer_GSTIN,
                  c.phone,
                  s.total_tax as TaxAmount,
                  s.total_amount*si.discount/100 as DiscountValue,
                  if(s.state_id = $state_id, s.total_tax/2, 0) as CGST,
                  if(s.state_id = $state_id, s.total_tax/2, 0) as SGST,
                  if(s.state_id = $state_id, 0, s.total_tax) as IGST,
                  s.total_amount as SalesAmount 

                  FROM sales s INNER JOIN sales_item si ON s.id = si.sales_id INNER JOIN item i ON i.id = si.item_id INNER JOIN customer c ON c.id = s.customer_id WHERE s.delete_status='0' AND s.user_id = $user_id GROUP BY s.id";   
            }
                $result = $this->db->query($query);

                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                
               force_download($filename, $data);

	}

	/*
		Sales history report filter data
	*/
	public function sales_filter()
    {   
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $customer=$this->input->post('customer1');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $data=$this->Reports_model->salesFilter($customer,$from,$to);

        //log_message('debug',print_r($data,true));
        
        print_r(json_encode($data,true));
        
    }

    /*
		Team Member report filter data in purchase orders tab
    */
    public function purchase_filter()
    {
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $supplier=$this->input->post('supplier1');
        $location=$this->input->post('location1');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $data=$this->Reports_model->purchaseFilter($supplier,$location,$from,$to);
        //log_message('debug',print_r($data,true));
    
       	//echo json_encode($data);
        print_r(json_encode($data,true));

    }

    /*
		Filter data Quotation tab
    */
    public function quotation_filter()
    {
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $customer=$this->input->post('customer1');
        $location=$this->input->post('location1');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $data=$this->Reports_model->quotationFilter($customer,$location,$from,$to);
        //log_message('debug',print_r($data,true));
    
       	//echo json_encode($data);
        print_r(json_encode($data,true));

    }

    /*
		Filter data Invoice tab
    */
    public function invoice_filter()
    {
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $customer=$this->input->post('customer1');
        $location=$this->input->post('location1');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $data=$this->Reports_model->invoiceFilter($customer,$location,$from,$to);
        //log_message('debug',print_r($data,true));
    
       	//echo json_encode($data);
        print_r(json_encode($data,true));

    }

    /*
		Filter data Payment tab
    */
    public function payment_filter()
    {
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    	$customer=$this->input->post('customer1');
        $from=$this->input->post('st_date');
        $to=$this->input->post('end_date');

        $data=$this->Reports_model->paymentFilter($customer,$from,$to);
        //log_message('debug',print_r($data,true));
    
       	//echo json_encode($data);
        print_r(json_encode($data,true));

    }

    /*
		Income Report data show month wise.
    */
    public function income_filter()
    {
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $year=$this->input->post('year1');     

        $sales=$this->Reports_model->incomeFilter($year);

        $data = array();

    		foreach ($sales as $key => $sub) {
    			
    			$mon = "";
    			if($sub->month == 1){ $mon ="jan";}
    			if($sub->month == 2){ $mon ="feb";}
    			if($sub->month == 3){ $mon ="mar";}
    			if($sub->month == 4){ $mon ="apl";}
    			if($sub->month == 5){ $mon ="may";}
    			if($sub->month == 6){ $mon ="jun";}
    			if($sub->month == 7){ $mon ="july";}
    			if($sub->month == 8){ $mon ="aug";}
    			if($sub->month == 9){ $mon ="sept";}
    			if($sub->month == 10){ $mon ="oct";}
    			if($sub->month == 11){ $mon ="nov";}
    			if($sub->month == 12){ $mon ="dec";}

    			$data[$mon]=$sub->amount;
    		}

       	echo json_encode($data);
        //print_r(json_encode($data,true));
    }


}
?>