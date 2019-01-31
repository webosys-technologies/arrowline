<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('Quotation_model','Invoice_model','Sales_model','Deposite_model','Ledger_model'));
		$this->load->library(array('ion_auth','form_validation'));
	}

	public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['sales']=$this->Sales_model->getSales();
		$this->load->view('sales/list',$data);
	}

	/*
		This method generate sales invoice while add new sales data in database
	*/
	function generate_invoice($id)
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$last_sales=$this->Sales_model->getLastSalesId();

		
		$data = $this->Quotation_model->getQuotationDetails($id);
		
		/*echo "<pre>";
		print_r($data);exit();*/

		$sales['location_id']=$data->location_id;
		$sales['customer_id']=$data->customer_id;
		$sales['date']=date('Y-m-d');
		$sales['payment_method_id']=$data->payment_method_id;
		$sales['payment_term_id']=$data->payment_term_id;
		$sales['reference_no']="INV-".sprintf('%04d',intval($last_sales)+1);
		$sales['total_tax']=$data->total_tax;
		$sales['shipping_charges']=$data->shipping_charges;
		$sales['total_amount']=$data->total_amount;
		$sales['notes']=$data->notes;
		$sales['country_id']=$data->country_id;
		$sales['state_id']=$data->state_id;
		$sales['city_id']=$data->city_id;
		$sales['shipping_address']=$data->shipping_address;
		$sales['status']=$data->status;

		$sales['sales_invoice']=$data->sales_invoice;
		$sales['sales_type']=$data->sales_type;
		$sales['port_code']=$data->port_code;
		$sales['shipping_bill_no']=$data->shipping_bill_no;
		$sales['shipping_bill_date']=$data->shipping_bill_date;
		$sales['gst_payable']=$data->gst_payable;
		$sales['user_id']=$data->user_id;
		
		$sales['delivery_note']=$data->delivery_note;
		$sales['supplier_ref']=$data->supplier_ref;
		$sales['buyer_order']=$data->buyer_order;
		$sales['dispatch_doc_no']=$data->dispatch_doc_no;
		$sales['dilivery_note_date']=$data->dilivery_note_date;
		$sales['dispatch_through']=$data->dispatch_through;

		/*echo "<pre>";
		print_r($sales);exit();*/

		$sales_item=$this->Quotation_model->getQuotationItemDetails($id);
		/*echo "<pre>";
		print_r($sales_item);exit();*/

		$sales_id=$this->Sales_model->addSales($sales);

		//echo $sales_id;exit();
		//$sales_item=$this->Quotation_model->getQuotationItemDetails($id);
		$sub_invoice_no = "INV-".sprintf('%04d',intval($sales_id));

		if(isset($sales_id))
		{
			$i=0;
			foreach ($sales_item as $key => $val) {
				
					$SalesItem[$i]=array(
						'item_id' => $val->item_id,
						'sales_id' => $sales_id,
						'rate' => $val->rate,
						'qty' => $val->qty,
						'tax_amount' => $val->tax,
						'tax_id' => $val->tax_id,
						'discount' => $val->discount,
						'amount' => $val->amount,
						'location_id' => $sales['location_id'],
						'sub_invoice_no'=> $sub_invoice_no.'-'.$val->tax_id
					);
				
				$i++;		
			}
		}
		$this->Sales_model->addSalesItems($SalesItem);
		$last_invo=$this->Invoice_model->getLastInvoiceID();
		$data=$this->Quotation_model->orderDetails($id);
		$invoice['invoice_no']="INV-".sprintf('%04d',intval($last_invo)+1);
		$invoice['sales_id']=$sales_id;
		$invoice['quotation_id']=$id;
		//$total = $data[0]->total_amount + $data[0]->shipping_charges;

		$invoice['sales_amount']=$data[0]->total_amount;
		$invoice['invoice_date']=date('Y-m-d');
		$invoice_id=$this->Invoice_model->saveInvoice($invoice);
		$this->Quotation_model->updateInvoice($id);
	
		//$this->invoice_details($sales_id);
		redirect('invoice/invoice_details/'.$sales_id);
	}


	/*
		This method shows sales invoice details
	*/
	function invoice_details($id)
	{
           
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$invoice_data['country']=$this->Quotation_model->companyDetails();

		if(!isset($invoice_data['country']))
		{
			$this->session->set_flashdata('success','Please Add Company Setting Details');
			redirect('sales','refresh');
		}
		
		$invoice_data['sales']=$this->Invoice_model->salesOrder($id);		
		$invoice_data['sales_item']=$this->Invoice_model->salesOrderDetails($id);
		$invoice_data['payment']=$this->Invoice_model->getSalesPaymentData($id);
		$invoice_data['s'] = $this->Sales_model->SalesByID($id);
//                echo $id;
//                echo "<pre>";
//		print_r($invoice_data);
//		exit();
		
		$this->load->view('invoice/order',$invoice_data);
	}

	/*
		This method load add payment page
	*/
	public function payment_details($sales_id,$invoice_id){

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		/*$quotation_id=$this->input->post('quotation_id');
		$sales_id=$this->input->post('sales_id');
		$invoice_id=$this->input->post('invoice_id');*/

		//echo $sales_id;

		$payment['sales']=$this->Invoice_model->getSalesDetails($sales_id);
		$payment['invoice']=$this->Invoice_model->getInvoiceDetails($invoice_id);
		$payment['bankaccount']=$this->Invoice_model->getBankAccount();
		$payment['expansecategory']=$this->Invoice_model->getExpanseCategory();
		$payment['payment_method']=$this->Invoice_model->getPaymentMethod();

		/*echo "<pre>";
		print_r($payment);
		exit();*/

		$this->load->view('invoice/payment',$payment);
	}

	/*
		This method is call when add new payment 
	*/
	public function add_payment()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$sales_id=$this->input->post('sales_id');
		$payment_id=$this->Invoice_model->getLastPaymentID();
		$payment_no="P-".sprintf('%04d',intval($payment_id)+1);
		$originalDate=$this->input->post('payment_date');
		$payment_date=date("Y-m-d", strtotime($originalDate));
		$invoice_data['country']=$this->Quotation_model->companyDetails();
		
			$paymemtDetails = array(
	            'sales_id'	                   =>  $this->input->post('sales_id'),
	            'account_id'                   =>  $this->input->post('account'),
	            'payment_method_id'            =>  $this->input->post('payment_type'),
	            'income_exp_category_id'       =>  $this->input->post('category'),
	            'payment_no'                   =>  $payment_no,
	            'amount'         	           =>  $this->input->post('amount'),
	            'bank_name'         	   =>  $this->input->post('bank_name'),
	            'cheque_no'                    =>  $this->input->post('cheque_no'),
	            'payment_date'                 =>  $this->input->post('payment_date'),
	            'description'                  =>  $this->input->post('description'),
	            'reference'                    =>  $this->input->post('reference'),
	            'status'                       =>   1,
	            'user_id'			   =>$this->session->userdata("userId")
	        );

//                print_r($paymemtDetails);
//                exit();

	        if($this->Invoice_model->addSalesPayment($paymemtDetails))
	        {
                        
	        	$transaction = array(
					'amount' => $this->input->post('amount'),
					'type' => "income",
					'account_id' => $this->input->post('account'), 
					'date' => $this->input->post('payment_date'), 
					'reference' => $this->input->post('reference'), 
					'description' => $this->input->post('description'), 
					'category_id'=>$this->input->post('category'),
					'payment_method'=>$this->input->post('payment_type'),
					'user_id'			=>$this->session->userdata("userId")
				);
	        	
				$this->Deposite_model->addTransaction($transaction);
                                
                        $led=array( 'date' => $this->input->post('payment_date'),
                                    'cust_id' => $this->input->post('cust_id'),
                                    'Invoice' => $this->input->post('description'),
                                    'credit' => $this->input->post('amount'),
                                    'account_id' => $this->input->post('account'),
                                );
                        
                        $led_id=$this->Ledger_model->add_custledger($led);
                        
	        	$this->session->set_flashdata('success', 'Payment Save Successfully.');
				redirect('sales','refresh');
	        }
	        else{
	        	$this->session->set_flashdata('success', 'Payment Failed.');
            	redirect("sales",'refresh');
	        }
	}

	/*
		Generate invoice print 
	*/
	public function sales_print($id)
  	{
  		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['address'] = $this->Sales_model->getShippingAddress($id);
		$data['sales']=$this->Invoice_model->salesOrder($id);
		$data['sales_print']=$this->Invoice_model->salesOrderDetails($id);
		$data['country']=$this->Quotation_model->companyDetails();		
		$data['payment']=$this->Invoice_model->getSalesPaymentData($id);
		$data['s'] = $this->Sales_model->SalesByID($id);
		$data['shipping'] = $this->Sales_model->SalesShippingAddress($id);
               $data['tax'] = $this->Sales_model->getTax($id);
                  
		/*echo "<pre>";
		print_r($data);exit();*/
		
	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	  
	    $html=$this->load->view('invoice/sales_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}

	/*
		Send sales details in email
	*/
	function sales_email()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$to=$this->input->post('email');
		$subject=$this->input->post('subject');
		$description=$this->input->post('message');
        require("class.phpmailer.php");
		$data = $this->Quotation_model->getEmailSetup();
        
        if($data == "" && $data == null)
		{
			$this->session->set_flashdata('success','Please Enter data in email settings');
	        redirect('sales','refresh');
		}
        if($data == "" && $data == null)
		{
			$this->session->set_flashdata('success','Please Enter data in email settings');
	        redirect('sales','refresh');
		}
		
	 	$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = $data->host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = $data->port;
        $mail->Username = $data->username;
        $mail->Password = $data->password;
        $mail->From = $data->email;
        $mail->FromName = $data->name;
        $mail->AddAddress($to);
        //$mail->AddReplyTo("mail@mail.com");
        //$this->mail->to('$email');
        $mail->IsHTML(true);
        
        $mail->Subject = $subject;
        $mail->Body =$description;
        if(!$mail->Send())
        {
            //echo "mail coundn't sent";
            $this->session->set_flashdata("success","Email couldn't send!!");
			redirect('sales');
        }
        else
        {
           $this->session->set_flashdata("success","Email sent successfully please check your email !!");
				redirect('sales');  
        }
	}
	
}