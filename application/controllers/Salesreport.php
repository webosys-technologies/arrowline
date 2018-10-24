<?php defined('BASEPATH') OR exit('No direct script access allowed');

  class Salesreport extends CI_Controller
  {
  	public function __construct()
  	{
  		parent::__construct();
  		 $this->load->model(array('Sales_report_model','Sales_model'));	
       $this->load->library(array('form_validation','ion_auth'));
  	}


   /*

     this function used for display sales_report form

   */
	public function index()
	{
    if(!$this->ion_auth->logged_in())
    {
        redirect('auth/login', 'refresh');
    }

		$data['item']=$this->Sales_report_model->getItem();
		$data['customer']=$this->Sales_report_model->getCustomer();
		$data['location']=$this->Sales_report_model->getLocation();
		$data['sales']=$this->Sales_report_model->getSales();
		$data['total']=$this->Sales_report_model->total();

    /*echo "<pre>";
    print_r($data);exit();*/

		$this->load->view('reports/sales',$data);	
	}

   /*

     this function used for display sales_report graph

   */
  public function graph()
  {
    if(!$this->ion_auth->logged_in())
    {
        redirect('auth/login', 'refresh');
    }

    $data=$this->Sales_report_model->getGraph();
    $temp_array=array();
    foreach ($data as $value) {
        $temp['date'] = $value->date;
        $temp['sales_volume'] = $value->sales_volume;
        $temp['cost_volume'] = $value->cost_volume;
        $temp['profit'] = $value->profit;
        array_push($temp_array,$temp);
    }
     print_r(json_encode($temp_array,true));
  }
  /*

     this function used for create csv of sales_report data

   */
	public function createCsv()
  {
      if(!$this->ion_auth->logged_in())
      {
          redirect('auth/login', 'refresh');
      }


      $data['state']=$this->Sales_model->getCompanyState();
      /*echo "<pre>";
      print_r($data);
      exit();*/
      $user_id = $this->session->userdata('userId');
      $state_id = $data['state']->state_id;
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
            }else
            {
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

                  FROM sales s INNER JOIN sales_item si ON s.id = si.sales_id INNER JOIN item i ON i.id = si.item_id INNER JOIN customer c ON c.id = s.customer_id WHERE s.delete_status='0' AND s.user_id='".$user_id."' GROUP BY s.id";
            }

                $result = $this->db->query($query);

                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                
               force_download($filename, $data);

    }

     /*

       this function used for create csv of sales_report data date wise

     */
    public function createcsvdDate($date)
     {
      if(!$this->ion_auth->logged_in())
      {
          redirect('auth/login', 'refresh');
      }
        ob_start();
        $this->load->helper('download');
        $this->load->dbutil();  
        $this->load->helper('file');
                $delimiter = ",";
                $newline = "\r\n";
                $filename = "sales.csv";

                //$query = "SELECT * FROM item";
                $query='SELECT sd.reference_no,c.name, si.qty, 
                  ( i.sales_price * si.qty ) AS sales_volume, ( i.purchase_price * si.qty ) AS cost_volume, 
                  ( i.sales_price * si.qty ) - (i.purchase_price * si.qty) AS profit,(sd.total_tax) as tax, 
                  (( 100 * ( ( i.sales_price * si.qty ) - ( i.purchase_price * si.qty)) / ( ( i.sales_price * si.qty )))) AS main

                  FROM sales_item si INNER JOIN sales sd ON sd.id = si.sales_id 
                  INNER JOIN item i ON i.id = si.sales_id 
                  INNER JOIN customer c ON c.id=sd.customer_id 
                  WHERE sd.date="'.$date.'"';
                            
                $result = $this->db->query($query);
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                
               force_download($filename, $data);

    }


    /*

       this function used for create pdf of sales_report data

     */
	   public function orderPrint()
     {

        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['state']=$this->Sales_model->getCompanyState();
        $state_id = $data['state']->state_id;



        $data['orderdetails']=$this->Sales_report_model->salesReportData($state_id);
       /* $data['country']=$this->Sales_report_model->companyDetails();
        $data['sales']=$this->Sales_report_model->getSales();*/
      

       

        ob_start();
        $html=ob_get_clean();
        $html=utf8_encode($html);
        $table=
        //$html=$this->load->view('report/list_vehicle','',TRUE);
        $html=$this->load->view('reports/sales_print',$data,TRUE);
        require_once(APPPATH.'third_party/mpdf60/mpdf.php');
        
        $mpdf=new mPDF();
        $mpdf->allow_charset_conversion=true;
        $mpdf->charset_in='UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->output('meu-pdf','I');
    }


  

    /*

       this function used for create pdf of sales_report data

     */
     public function orderprintDate($date)
     {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }


        $data['orderdetails']=$this->Sales_report_model->orderDetailsDate($date);
        $data['country']=$this->Sales_report_model->companyDetails();
        $data['orderdetails']=$this->Sales_report_model->salesPdf($date);
       
        ob_start();
        $html=ob_get_clean();
        $html=utf8_encode($html);
        $table=
        //$html=$this->load->view('report/list_vehicle','',TRUE);
        $html=$this->load->view('reports/sales_print_date',$data,TRUE);
        require_once(APPPATH.'third_party/mpdf60/mpdf.php');
        
        $mpdf=new mPDF();
        $mpdf->allow_charset_conversion=true;
        $mpdf->charset_in='UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->output('meu-pdf','I');
    }


  /*
        this function used for fetch date wise sales data
  */
    public function date($date)
    {
      if(!$this->ion_auth->logged_in())
      {
          redirect('auth/login', 'refresh');
      }

      $data['data']=$this->Sales_report_model->salesDate($date);
      $data['total']=$this->Sales_report_model->salesTotal($date);
      /*echo "<pre>";
      print_r($data);
      exit();*/
      $this->load->view('reports/sales_date',$data);
  
    }

    /*
        this function used for fetch filter data
    */
    //function myFunction($item,$location,$customer,$type)
    function myFunction()
    {   
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $item=$this->input->post('item1');
        $customer=$this->input->post('customer1');
        $location=$this->input->post('location1');

        $data=$this->Sales_report_model->getFilter($item,$location,$customer);
        /*echo "<pre>";
        print_r($data);
        exit();*/
        //log_message('debug',print_r($data,true));
    
        echo json_encode($data);
        //print_r(json_encode($data,true));
        
    }

}


