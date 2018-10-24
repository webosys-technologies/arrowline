<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventorystockhand extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inventory_stock_model');	
		$this->load->library(array('form_validation','ion_auth'));
	}

	/*
   		 this function used for display  inventory_stock_hand list form

    */
	public function index()
	{
		$data['item']=$this->Inventory_stock_model->getItem();
		$data['location']=$this->Inventory_stock_model->getLocation();
		$data['warehouse']=$this->Inventory_stock_model->getInventory();
		$data['total']=$this->Inventory_stock_model->total();

		$this->load->view('reports/inventory_stock_hand',$data);	
	}

	/*

    	this function used for create csv of income_vs_expense data

    */
	 public function create_csv()
      {
        ob_start();
        $this->load->helper('download');
        $this->load->dbutil();
        $this->load->helper('file');
	    $delimiter = ",";
	    $newline = "\r\n";
	    $filename = "warehouse.csv";

	    $user_id = $this->session->userdata('userId');
	    
	    if($this->session->userdata('type')=='admin'){
		    $query="SELECT l.location_name,i.item_name as product,
	             w.qty,i.sales_price,SUM(w.qty*i.purchase_price) as Retail_Price,SUM(w.qty*i.sales_price) as retail,
	             SUM( i.sales_price * w.qty ) - SUM( i.purchase_price * w.qty ) AS profit,((100*(SUM(i.sales_price*w.qty)-SUM(i.purchase_price * w.qty ))/(SUM(i.sales_price*w.qty)))) as main
	            FROM warehouse w 
	            INNER JOIN item i ON i.id = w.item_id
	            INNER JOIN location l ON l.id=w.location_id
	            GROUP BY w.id";
	    }
	    else
	    {
	    	$query="SELECT l.location_name,i.item_name as product,
	             w.qty,i.sales_price,SUM(w.qty*i.purchase_price) as Retail_Price,SUM(w.qty*i.sales_price) as retail,
	             SUM( i.sales_price * w.qty ) - SUM( i.purchase_price * w.qty ) AS profit,((100*(SUM(i.sales_price*w.qty)-SUM(i.purchase_price * w.qty ))/(SUM(i.sales_price*w.qty)))) as main
	            FROM warehouse w 
	            INNER JOIN item i ON i.id = w.item_id
	            INNER JOIN location l ON l.id=w.location_id
	            WHERE i.user_id = $user_id
	            GROUP BY w.id";
	    }
	    $result = $this->db->query($query);
	    $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
	    
	   force_download($filename, $data);

    }

    /*

    this function used for get filter data of income_vs_expense 

    */
	function myFunction()
	{

		$id=$this->input->post('item1');
		$location=$this->input->post('location1');

		$data=$this->Inventory_stock_model->getFilter($id,$location);
		
		echo json_encode($data);
	
	}

	/* 
		 this function used for generate pdf data of Inventory_stock_hand
	*/

	 public function orderPrint()
  	 {

		$data['country']=$this->Inventory_stock_model->companyDetails();
		$data['orderdetails']=$this->Inventory_stock_model->getInventory();
		
	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    //$html=$this->load->view('report/list_vehicle','',TRUE);
	    $html=$this->load->view('reports/inventory_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}
}
