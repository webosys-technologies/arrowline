<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('Quotation_model','Invoice_model','Sales_model','Customer_model'));
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->library("cart");
	}

	public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data = $this->session->userdata('userRole');
		if(empty($data))
		{
		    redirect('auth','refresh');
		}
		
		$data['quotation']=$this->Quotation_model->getQuotation();
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('quotation/list',$data);
	}

	/*
		load New Quotation Form Page
	*/

	public function add_form(){

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['state1'] = $this->Customer_model->dataState();
		$data['customer']=$this->Quotation_model->getCustomer();
		$data['location']=$this->Quotation_model->getLocation();
		$data['lastid']=$this->Quotation_model->getLastId();
		$data['items']=$this->Quotation_model->getItems();
		$data['paymentmethod']=$this->Quotation_model->getPaymentMethod();
		$data['paymentTerm']=$this->Sales_model->getPaymentTerm();
		$data['country']  = $this->Customer_model->dataCountry();
                 $data['QN']=$this->Quotation_model->getlastquotation();
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('quotation/add',$data);	

	}

	/*
		This method load data in item dropdown in add quotation form
	*/

	public function add()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$id=$this->input->post('item_id');

		$data['items']=$this->Quotation_model->getItemById($id);
		$data['tax']=$this->Quotation_model->getTaxs();

		/*echo "<pre>";
		print_r($data);exit();*/
		/*log_message('debug', print_r($data, true));*/
		echo json_encode($data);
	}

	/* get items location wise */
	public function getItem($id){
        $data = $this->Quotation_model->getLocationItem($id);
        /*echo "<pre>";
        print_r($data);*/
        echo json_encode($data);
    }

    public function getBarcodeProducts($term,$warehouse)
    {
    	$data = $this->Quotation_model->getProductBarcode($term,$warehouse);
    	echo json_encode($data);	
    }

    public function getProductUseCode($id,$location_id)
    {
    	$data['items']=$this->Quotation_model->getItemById($id,$location_id);
		$data['tax']=$this->Quotation_model->getTaxs();
		/*echo "<pre>";
		print_r($data);*/
		//log_message('debug', print_r($data, true));
		echo json_encode($data);
    }

    public function getNameProducts($term,$warehouse)
    {
    	$data = $this->Quotation_model->getProductName($term,$warehouse);
    	echo json_encode($data);	
    }

    public function getProductUseName($id,$location_id)
    {
    	$data['items']=$this->Quotation_model->getItemById($id,$location_id);
		$data['tax']=$this->Quotation_model->getTaxs();
		/*echo "<pre>";
		print_r($data);*/
		//log_message('debug', print_r($data, true));
		echo json_encode($data);
    }



    public function getShippingData($id)
    {

    	$data['country'] = $this->Quotation_model->getCountryID($id);
        $country_id = $data['country']->country_id;
        
        $data['state'] = $this->Quotation_model->getStateID($id);
        $state_id = $data['state']->state_id;

        $data1['country1']  = $this->Customer_model->dataCountry();

        $data1['state1']    = $this->Quotation_model->getStateByCountryID($country_id);
        $data1['city1']     = $this->Quotation_model->getCityByStateID($state_id);
        $data1['shipping']  = $this->Quotation_model->getShippingIds($id);

        if($data1['state1'] == null AND $data1['city1'] == null)
        {
        	$com['data1'] = $this->Quotation_model->getCompanySettins();
        	$con_id = $com['data1']->country_id;
        	$st_id = $com['data1']->state_id;

        	$com['country1']  = $this->Customer_model->dataCountry();
        	$com['state1'] = $this->Quotation_model->getCompanyState($con_id);
        	$com['city1'] = $this->Quotation_model->getCompanyCity($st_id);
        	

	    	/*echo "<pre>";
	    	print_r($com);
*/
	    	echo json_encode($com);	

        }
        else{
        	echo json_encode($data1);	
        }

       /*echo "<pre>";
        print_r($data1);exit();*/
        
    }

	/*
		This method is call when end user submit new quotation
	*/

  
	function add_quotation()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('order_date','Order Date','required');
        $this->form_validation->set_rules('customer_id','Customer Name','required');
        $this->form_validation->set_rules('location_id','Location Name','required');
        $this->form_validation->set_rules('paymentmethod_id','Payment Method','required');
        $this->form_validation->set_rules('reference','Reference Number','required');
        $this->form_validation->set_rules('paymentterm','Payment Term','required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('state','State','required');

        /*$this->form_validation->set_rules('city','City','required');
        $this->form_validation->set_rules('shipping_address','Shipping Address','required');*/


        if($this->form_validation->run()== true)
        {
			$data['customer_id']=$this->input->post('customer_id');	
			$data['location_id']=$this->input->post('location_id');	
			$data['payment_method_id']=$this->input->post('paymentmethod_id');	
			$data['payment_term_id']=$this->input->post('paymentterm');	
			$data['date'] = $this->input->post('order_date');
			$data['reference_no']=$this->input->post('reference');	
			$data['total_tax']=$this->input->post('totalTax');	
			$data['shipping_charges']=$this->input->post('shipping');	
			$data['total_amount']=$this->input->post('grandTotal');	
			$data['notes']=$this->input->post('notes');	
			$data['country_id']=$this->input->post('country');	
			$data['state_id']=$this->input->post('state');	
			$data['city_id']=$this->input->post('city');	
			$data['shipping_address']=$this->input->post('shipping_address');	
			$data['status']=$this->input->post('status');	

			$data['sales_invoice']=$this->input->post('invoice_type');	
			$data['sales_type']=$this->input->post('sales_type');	
			$data['port_code']=$this->input->post('port_code');	
			$data['shipping_bill_no']=$this->input->post('shipping_bill_no');	
			$data['shipping_bill_date']=$this->input->post('shipping_bill_date');	
			$data['gst_payable']=$this->input->post('gst_payable');
			$data['user_id']		= $this->session->userdata("userId");

			$data['delivery_note']=$this->input->post('delivery_note');	
			$data['supplier_ref']=$this->input->post('supplier_reference');	
			$data['buyer_order']=$this->input->post('buyer_order_no');	
			$data['dispatch_doc_no']=$this->input->post('dispatch_doc_no');	
			$data['dilivery_note_date']=$this->input->post('del_note_date');	
			$data['dispatch_through']=$this->input->post('dispatch_through');

			

			$data1=json_decode($this->input->post('largeArea'));
			
//			echo "<pre>";
//			print_r($data);
//			print_r($data1);
//                        die;

			$quotation_id=$this->Quotation_model->addQuotation($data);

			$quotationItem=array();
			if(isset($quotation_id))
			{
				$i=0;
				foreach ($data1 as $key => $val) {
						$quotationItem[$i]=array(
							'quotation_id' => $quotation_id,
							'item_id' => $val->item_id,
							//'item_description' => $value->item_desc,
							'qty' => $val->qty,
							'rate' => $val->rate,
							'tax_id' => $val->tax_id,
							'tax' => $val->tax,
							'discount' => $val->discount,
							'amount' => $val->amount,
							'sub_invoice_no'=> $data['reference_no'].'-'.$val->tax_id
						);
			
					$i++;		
				}
					
				$this->Quotation_model->addQuotationItem($quotationItem);
		
				//$this->order_details($quotation_id);            		
				redirect('quotation/order_details/'.$quotation_id);			
			}
        }
        else
        {
        	//redirect('quotation/add_form');			
        	$this->add_form();
        }
	}

	/*
		This method load particular quotation details using quotation id
	*/

	public function order_details($quotation_id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['quotation']=$this->Quotation_model->getQuotaion($quotation_id);
		$data['quotation_items']=$this->Quotation_model->getQuotaionItems($quotation_id);
		/*echo "<pre>";
		print_r($data);
		exit();*/

		//$data['orderdetails']=$this->Quotation_model->orderDetails($quotation_id);
		$data['country']=$this->Quotation_model->companyDetails();

		if(!isset($data['country']))
		{
			$this->session->set_flashdata('success','Please Add Company Setting Details');
			redirect('quotation','refresh');
		}

		$data['invoice']=$this->Quotation_model->getInvoiceDetails($quotation_id);
		$data['s'] = $this->Quotation_model->quotationByID($quotation_id);

		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('quotation/order',$data);
	}


	/*
		This method load edit quotation page
	*/

	public function edit_data($id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }


        $data['address'] = $this->Quotation_model->getQuotationAddress($id);
        $country_id = $data['address']->country_id;
        $state_id = $data['address']->state_id;
        

        $data['country']  = $this->Customer_model->dataCountry();
        $data['state1'] = $this->Quotation_model->getStateByCountryID($country_id);
        $data['city1'] = $this->Quotation_model->getCityByStateID($state_id);

        $data['cust'] = $this->Quotation_model->getCustomerID($id);
        $customer_id = $data['cust']->customer_id;

        $location_id = $this->Quotation_model->getLocationID($id);

		$data['customer']=$this->Quotation_model->getCustomer();
		$data['location']=$this->Quotation_model->getLocation();
		$data['items']=$this->Quotation_model->getItemByLocation($location_id);
		$data['paymentmethod']=$this->Quotation_model->getPaymentMethod();
		$data['paymentTerm']=$this->Sales_model->getPaymentTerm();
		$data['quotations']=$this->Quotation_model->getQuotationData($id);
		$data['quotation']=$this->Quotation_model->getQuotationItems($id);
		$data['tax']=$this->Quotation_model->getTaxs();
		$data['ship']=$this->Quotation_model->getShippingIds($customer_id);

		/*echo "<pre>";
		print_r($data);
		exit();*/

		$this->load->view('quotation/edit',$data);
	}

	/*
		This method is call when end user submit updated quotation details
	*/
	public function edit()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $id = $this->input->post('quotation_id');
        $reference = $this->input->post('reference');

        $this->form_validation->set_rules('order_date','Order Date','required');
        $this->form_validation->set_rules('customer_id','Customer Name','required');
        $this->form_validation->set_rules('location_id','Location Name','required');
        $this->form_validation->set_rules('paymentmethod_id','Payment Method','required');
        $this->form_validation->set_rules('reference_no','Reference Number','required');
        $this->form_validation->set_rules('paymentterm','Payment Term','required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('country','Country','required');
        
        if($this->form_validation->run()== true)
        {
			
			$quotation['customer_id']=$this->input->post('customer_id');	
			$quotation['location_id']=$this->input->post('location_id');	
			$quotation['payment_method_id']=$this->input->post('paymentmethod_id');	
			$quotation['payment_term_id']=$this->input->post('paymentterm');	
			$quotation['date']=$this->input->post('order_date');	
			$quotation['total_tax']=$this->input->post('totalTax');	
			$quotation['shipping_charges']=$this->input->post('shipping');	
			$quotation['total_amount']=$this->input->post('grandTotal');		
			$quotation['notes']=$this->input->post('comments');		
			$quotation['country_id']=$this->input->post('country');	
			$quotation['state_id']=$this->input->post('state');	
			$quotation['city_id']=$this->input->post('city');	
			$quotation['shipping_address']=$this->input->post('shipping_address');
			$quotation['status']=$this->input->post('status');
			$quotation['sales_invoice']=$this->input->post('sales_invoice');	
			$quotation['sales_type']=$this->input->post('sales_type');	
			$quotation['port_code']=$this->input->post('port_code');	
			$quotation['shipping_bill_no']=$this->input->post('shipping_bill_no');	
			$quotation['shipping_bill_date']=$this->input->post('shipping_bill_date');	
			$quotation['gst_payable']=$this->input->post('gst_payable');	
			$quotation['user_id']=$this->session->userdata("userId");
			$quotation['delivery_note'] = $this->input->post('delivery_note');	
			$quotation['supplier_ref'] = $this->input->post('supplier_reference');	
			$quotation['buyer_order'] = $this->input->post('buyer_order_no');	
			$quotation['dispatch_doc_no'] = $this->input->post('dispatch_doc_no');	
			$quotation['dilivery_note_date'] = $this->input->post('del_note_date');	
			$quotation['dispatch_through'] = $this->input->post('dispatch_through');

			
			//$quotation['id']=$id;


			$data1=json_decode($this->input->post('temptext'));

			$quotationItem=array();
				
			$i=0;
			foreach ($data1 as $key => $val) {
					$quotationItem[$i]=array(
						'quotation_id' => $id,
						'item_id' => $val->item_id,
						'qty' => $val->qty,
						'rate' => $val->rate,
						'tax_id' => $val->tax_id,
						'tax' => $val->tax,
						'discount' => $val->discount,
						'amount' => $val->amount,
						'sub_invoice_no'=> $reference.'-'.$val->tax_id
					);
				$i++;		
			}
			
			/*echo "<pre>";
			print_r($quotation);
			print_r($data1);*/
			//exit();



			if($this->Quotation_model->updateQuotation($id,$quotation))
			{
				$status=$this->Quotation_model->deleteQuotationItem($id);

				if($status === true)
				{
					$this->Quotation_model->addQuotationItem($quotationItem);
				}
			}
			redirect('quotation/order_details/'.$id);
		}
		else
		{
			$this->edit_data($id);
		}	
	}

	/*
		This method generate print for quotation details
	*/
	public function order_print($quotation_id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['address'] = $this->Quotation_model->getShippingAddress($quotation_id);


  		$data['orderdetails']=$this->Quotation_model->orderDetails($quotation_id);
		$data['country']=$this->Quotation_model->companyDetails();
		$data['invoice']=$this->Quotation_model->getInvoiceDetails($quotation_id);
		$data['s'] = $this->Quotation_model->quotationByID($quotation_id);
		$data['shipping'] = $this->Quotation_model->SalesShippingAddress($quotation_id);
		
		/*echo "<pre>";
		print_r($data);exit();*/

	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    
	    //$html=$this->load->view('report/list_vehicle','',TRUE);
	    $html=$this->load->view('quotation/quotation_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}
    

	/*
		This method is call when quotation email send .
	*/

	function payment_email()
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
	        redirect('quotation','refresh');
		}
        if($data == "" && $data == null)
		{
			$this->session->set_flashdata('success','Please Enter data in email settings');
	        redirect('quotation','refresh');
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
        //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        
        if(!$mail->Send())
        {
            //echo "mail coundn't sent";
            $this->session->set_flashdata("success","Email couldn't send!!");
			redirect('quotation');
        }
        else
        {
           
           $this->session->set_flashdata("success","Email sent successfully please check your email !!");
				redirect('quotation');
           
        }
	}


	/*
		This method is call when quotation data is deleted.
	*/

	function delete($id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		
		$data=array(
			'delete_status' => 1,
			'delete_date' => date('Y-m-d'),
			'id' => $id
		);

		if($this->Quotation_model->deleteQuotation($data))
		{
			$this->session->set_flashdata('success', 'Quotation Deleted successfully.');
            redirect("quotation",'refresh');
		}
	}

	public function find_tax()
	{

		$id=$this->input->post('tax_id');

		$data['taxvalue']=$this->Quotation_model->getTaxsValue($id);
		
		/*echo "<pre>";
		print_r($data);*/
		
		//log_message('debug', print_r($data, true));
		echo json_encode($data);
	}

	public function add_warehouse()
	{
		$warehouse = $this->input->post('warehouse_name');
		//log_message('debug', print_r($warehouse, true));
		$data['warehouse_id']=$this->Quotation_model->addWarehouse($warehouse);
		$data['warehouse']=$this->Quotation_model->getWarehouse();
		//log_message('debug', print_r($data, true));
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
	}

	public function add_paymentmethod()
	{
		$paymentmethod = $this->input->post('payment_method');
		$data['paymentmethod']=$this->Quotation_model->addPaymentMethod($paymentmethod);
		$data['method']=$this->Quotation_model->getPayment();
		//log_message('debug', print_r($data, true));
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
		//exit();
	}

	public function add_paymentterm()
	{

		$payment = array(
			'term' => $this->input->post('payment_term'),
			'due_days' => $this->input->post('due_days')
		);

		$data['paymentterm']=$this->Quotation_model->addPaymentTerm($payment);
		$data['term']=$this->Quotation_model->getPaymentTerm();
		/*log_message('debug', print_r($data, true));
		echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
		//exit();
	}

	public function add_customer()
	{
		
		$customer = array(
	        'name'             => $this->input->post('name'),
	        'email'            => $this->input->post('email'),
	        'phone'            => $this->input->post('phone'),
	        'street'           => $this->input->post('street'),
	        'city_id'             => $this->input->post('city'),
	        'state_id'            => $this->input->post('state'),
	        'state_code'       => $this->input->post('state_code'),
	        'zip_code'         => $this->input->post('zip_code'),
	        'country_id'          => $this->input->post('country'),
	        'gstin'            => $this->input->post('gstin')
	     );

		$shipping=array(
            'street'             => $this->input->post('street'),
             'city_id'              => $this->input->post('city'),
             'state_id'             => $this->input->post('state'),
            'zip_code'           => $this->input->post('zip_code'),
            'country_id'          => $this->input->post('country')
        );


		//log_message('debug', print_r($customer, true));
		//log_message('debug', print_r($shipping, true));

		$data['customer']=$this->Quotation_model->addCustomer($customer,$shipping);
		$data['list']=$this->Quotation_model->getCustomer();
		//log_message('debug', print_r($data, true));
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
		//exit();
	}
        
        public function convert_invoice($id)
        {
         if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $data['country']  = $this->Customer_model->dataCountry();
		$data['state1'] = $this->Customer_model->dataState();
		$data['customer']=$this->Quotation_model->getCustomer();
		$data['location']=$this->Quotation_model->getLocation();
		$data['lastid']=$this->Sales_model->getLastSalesId();
		$data['items']=$this->Quotation_model->getItems();
		$data['paymentmethod']=$this->Quotation_model->getPaymentMethod();
		$data['paymentTerm']=$this->Sales_model->getPaymentTerm();
		$data['state']=$this->Sales_model->getCompanyState();
                $data['quotation']=$this->Quotation_model->get_quotation_detail($id);
		$this->load->view('quotation/convert_invoice',$data);	   
        }
        
        	function add_sales()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $this->form_validation->set_rules('location','Location','required');
        $this->form_validation->set_rules('customer','Customer Name','required');
        $this->form_validation->set_rules('sales_date','Sales Date','required');
        $this->form_validation->set_rules('paymentmethod','Payment Method','required');
        $this->form_validation->set_rules('paymentterm','Payment Term','required');
        $this->form_validation->set_rules('reference_no','Reference','required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('state','State','required');

        if($this->form_validation->run() == true)
        {

			$data['location_id']=$this->input->post('location');	
			$data['customer_id']=$this->input->post('customer');	
                        $data['contact_per1']=$this->input->post('contact_per1');	
                        $data['designation1']=$this->input->post('designation1');	
                        $data['contact_per2']=$this->input->post('contact_per2');	
                        $data['designation2']=$this->input->post('designation2');	
			$data['date'] =$this->input->post('sales_date');	;
			$data['payment_method_id']=$this->input->post('paymentmethod');	
			$data['payment_term_id']=$this->input->post('paymentterm');	
			$data['reference_no']=$this->input->post('reference');	
			$data['total_tax']=$this->input->post('totalTax');	
			$data['shipping_charges']=$this->input->post('shipping');	
			$data['total_amount']=$this->input->post('grandTotal');	
			$data['notes']=$this->input->post('comments');	
			$data['country_id']=$this->input->post('country');	
			$data['state_id']=$this->input->post('state');	
			$data['city_id']=$this->input->post('city');	
			$data['shipping_address']=$this->input->post('shipping_address');	
			$data['status']=$this->input->post('status');	
			$data['sales_invoice']=$this->input->post('invoice_type');	
			$data['sales_type']=$this->input->post('sales_type');	
			$data['port_code']=$this->input->post('port_code');	
			$data['shipping_bill_no']=$this->input->post('shipping_bill_no');	
			$data['shipping_bill_date']=$this->input->post('shipping_bill_date');	
			$data['gst_payable']=$this->input->post('gst_payable');	
			$data['user_id']=$this->session->userdata("userId");

			$data['delivery_note']=$this->input->post('delivery_note');	
			$data['supplier_ref']=$this->input->post('supplier_reference');	
			$data['buyer_order']=$this->input->post('buyer_order_no');	
			$data['dispatch_doc_no']=$this->input->post('dispatch_doc_no');	
			$data['dilivery_note_date']=$this->input->post('del_note_date');	
			$data['dispatch_through']=$this->input->post('dispatch_through');

			/*echo "<pre>";
			print_r($data);
			exit();*/

			$data1=json_decode($this->input->post('temptext'));

			$sales_id=$this->Sales_model->addSales($data);

			$SalesItem=array();
			if(isset($sales_id))
			{
				$i=0;
				foreach ($data1 as $val) {
					$SalesItem[$i]=array(
						'item_id'  	=> $val->item_id,
						'sales_id' 	=> $sales_id,
						'rate' 		=> $val->rate,
						'qty' 		=> $val->qty,
						'tax_amount' => $val->tax,
						'tax_id'	 => $val->tax_id,
						'discount' 	=> $val->discount,
						'amount' 	=> $val->amount,
						'location_id' =>$data['location_id'],
						'sub_invoice_no'=> $data['reference_no'].'-'.$val->tax_id
					);
					$i++;		
				}
				

				$last_invo=$this->Invoice_model->getLastInvoiceID();
				$addInvoice=array(
					'invoice_no'   =>   "INV-".sprintf('%04d',intval($last_invo)+1),
					'sales_id'     =>   $sales_id,
					'sales_amount' =>   $data['total_amount'],
					'invoice_date' =>   date('Y-m-d')
				);

				$this->Sales_model->addSalesItems($SalesItem);
				if($this->Sales_model->saveInvoice($addInvoice))
				{
                                    
                                       					redirect('invoice/sales_print/'.$sales_id);
                                                                       
				}		         		
			}
		}
		else
		{
			$this->add_form();
		}	
	}
        
        
        function send_email()
        {
          //Load email library
$this->load->library('email');

//SMTP & mail configuration
$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => '',
    'smtp_pass' => '',
    'mailtype'  => 'html',
   'smtp_timeout' => '4', //in seconds
     'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
$this->email->initialize($config);
$this->email->set_mailtype("html");
$this->email->set_newline("\r\n");

//Email content
$htmlContent = '<h1>Sending email via SMTP server</h1>';
$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

$this->email->to('suraj9195shinde@gmail.com');
$this->email->from('surajshinde@gmail.com','MyWebsite');
$this->email->subject('How to send email via SMTP server in CodeIgniter');
$this->email->message($htmlContent);

//Send email
$this->email->send();
 echo $this->email->print_debugger();
}
}