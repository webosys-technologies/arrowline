<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Purchasereport extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->model('Purchase_report_model');	
		 $this->load->library(array('form_validation','ion_auth'));
	}


	/*
         this function used for get purchase data 
    */
	public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['item']=$this->Purchase_report_model->getItem();
		$data['supplier']=$this->Purchase_report_model->getSupplier();
		$data['location']=$this->Purchase_report_model->getLocation();
		$data['purchase']=$this->Purchase_report_model->getPurchase();
		$data['total']=$this->Purchase_report_model->total();
		$this->load->view('reports/purchase',$data);	
	}

	/*

         this function used for generate csv data 

    */
	public function create_csv()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->session->userdata('userId');

		ob_start();
		$this->load->helper('download');
		$this->load->dbutil();
      	 	 $delimiter = ",";
       		 $newline = "\r\n";
        	 $filename = "purchase.csv";

	        if($this->session->userdata('type')=='admin'){
	        	$query = "SELECT p.reference_no,p.date,s.name as Supplier_name,p.total_amount FROM purchase p INNER JOIN supplier s ON p.supplier_id=s.id
					WHERE p.delete_status='0'
					";
			}
	       	else
	       	{
	       		$query = "SELECT p.reference_no,p.date,s.name as Supplier_name,p.total_amount FROM purchase p INNER JOIN supplier s ON p.supplier_id=s.id
					WHERE p.delete_status='0' AND p.user_id = '".$user_id."'
					";	
	       	}
        	 $result = $this->db->query($query);
        	 $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
       		 force_download($filename, $data);

	}


	/*

         this function used for get purchasereport data 

     */
	public function getGraph()
	{
		$data=$this->Purchase_report_model->getData();
		//log_message('debug', print_r($data, true));
     	print_r(json_encode($data, true));
	}

	/*

         this function used for get date wise data 

     */
	public function date($date)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['date']=$this->Purchase_report_model->date($date);
        /*echo "<pre>";
        print_r($data);exit();*/
		$this->load->view('reports/purchase_by_date',$data);	
	}

	 /*

         this function used for generate pdf data of purchase_report 

     */
	 public function orderPrint()
  	 {
  	 	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

  		$data['orderdetails']=$this->Purchase_report_model->getPurchasePDF();
		/*echo "<pre>";
		print_r($data);exit();*/
		
	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    $table=
	    //$html=$this->load->view('report/list_vehicle','',TRUE);
	    $html=$this->load->view('reports/purchase_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}

	/*

         this function used for get date,month,year and custom data of purchase_report

     */
	public function myFunction()
    {   
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $item=$this->input->post('item1');
        $supplier=$this->input->post('supplier1');
        $location=$this->input->post('location1');
      

        $data=$this->Purchase_report_model->getFilter($item,$location,$supplier);
        /*echo "<pre>";
        print_r($data);*/
        //log_message('debug',print_r($data,true));
        echo json_encode($data);
        
    }


}



