<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Management extends CI_Controller
    {
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('Customer_model','Quotation_model','Lead_model','Order_model','Sales_model'));
        $this->load->library(array('ion_auth','form_validation'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

     /*

    this function used for display customer list form

    */
	public function lead_customer()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
      

        $data['data'] = $this->Customer_model->custUserData();
        $data['statuses']=$this->Lead_model->get_status();
        $data['customer']=$this->Customer_model->getCustomer();
        $data['status']=$this->Customer_model->getStatus();
        $data['deactive']=$this->Customer_model->getDeactive();
        
        

        $this->load->view('management/lead_customer',$data);
	}
        

        
        
        
        public function add_customer_lead()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['country']  = $this->Customer_model->dataCountry();
        $data['state'] = $this->Customer_model->dataState();
        $data['city'] = $this->Customer_model->dataCity();
        $data['status']=$this->Lead_model->get_status();

        $this->load->view('management/add_customer_lead',$data);
	}
        
         public function add()
	{  
               if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_rules('name', 'Name ', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', '', 'required|numeric');
        
      
        
        
        if ($this->form_validation->run() == true)
        {
            	
            $customer = array(
                'name'             => $this->input->post('name'),
                'email'            => $this->input->post('email'),
                'phone'            => $this->input->post('phone'),
                'street'           => $this->input->post('street'),
                'city'             => $this->input->post('city'),
                'state'            => $this->input->post('state'),
                'state_code'       => $this->input->post('state_code'),
                'zip_code'         => $this->input->post('zip_code'),
                'country'          => $this->input->post('country'),
                'gstin'            => $this->input->post('gstin'),
                'gst_registration_type'=> $this->input->post('gst_reg_type'),
                'user_id'          => $this->session->userdata("userId"),
                'follow'            =>$this->input->post('followup'),
                'nextfollow'       =>$this->input->post('nextfollow'),
                'remark'            =>$this->input->post('remark'),
                'telecaller'        =>$this->session->userdata("userId"),
                'status'            =>'0',
                'lead_status'       =>$this->input->post('status')
             );
            /*echo "<pre>";
            print_r($customer);
            exit();*/
            $shipping=array(
            'street1'             => $this->input->post('street1'),
             'city1'              => $this->input->post('city1'),
             'state1'             => $this->input->post('state1'),
            'zip_code1'           => $this->input->post('zip_code1'),
            'country_id'          => $this->input->post('country1'),
            'user_id'             => $this->session->userdata("userId")
                );
                
        }


        if ( ($this->form_validation->run() == true) && $this->Lead_model->addCustomer($customer,$shipping))
        {
        	redirect("Management/lead_customer",'refresh');
        }    
		
        else
	{  
		$this->add_customer_lead();
	}
	}
        
        public function convert_customer($id)
        {
            $this->Customer_model->convert_customer($id);
            redirect("Management/lead_customer",'refresh');
        }
        
        
        public function edit($id)
        {
             if(!$this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }	

            $data1['country'] = $this->Customer_model->getCountryID($id);
            $country_id = $data1['country']->country_id;

            $data1['state'] = $this->Customer_model->getStateID($id);
            $temp_state_id = $data1['state']->state_id;

            $data1['country1'] = $this->Customer_model->getShippingCountryID($id);
            $country_id1 = $data1['country1']->country_id;

            $data1['state1'] = $this->Customer_model->getShippingStateID($id);
            $temp_state_id1 = $data1['state1']->state_id;

            //echo $temp_state_id1;exit();

            $data['data'] = $this->Customer_model->getData($id);
            

            $data['shipping'] = $this->Customer_model->getShipping($id);
            $data['country']  = $this->Customer_model->dataCountry();
            
            $data['state'] = $this->Quotation_model->getStateByCountryID($country_id);
            $data['city'] = $this->Quotation_model->getCityByStateID($temp_state_id);

            $data['state1'] = $this->Quotation_model->getStateByCountryID($country_id1);
            $data['city1'] = $this->Quotation_model->getCityByStateID($temp_state_id1);
//            print_r($data);
//            die;
             $this->load->view('management/edit_customer',$data);
        }
        
        public function delete($id)
        {
        
            $del=array(
    			'is_deleted'   => 1,
    			'delete_date'     => date('Y-m-d'),
    			'customer_id'              => $id
    			);
            if($this->Lead_model->delete($del))
            {
                $this->session->set_flashdata('success', 'Lead customer Deleted successfully.');
                redirect('Management/lead_customer');
            }else{
                redirect('Management/lead_customer');
            }
        }
        
        public function update()
        {
            
             if(!$this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name ', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            
            if ($this->form_validation->run() == true)
            {
            	$id = $this->input->post('id');
            	
                $customer = array(
                    'name'             =>$this->input->post('name'),
                    'email'            =>$this->input->post('email'),
                    'phone'            =>$this->input->post('phone'),
                    'street'           =>$this->input->post('street'),
                    'city_id'             =>$this->input->post('city'),
                    'state_id'            =>$this->input->post('state'),
                    'state_code'       =>$this->input->post('state_code'),
                    'zip code'         =>$this->input->post('zip_code'),
                    'country_id'          =>$this->input->post('country'),
                    'gstin'            =>$this->input->post('gstin'),
                    'gst_registration_type'  => $this->input->post('gst_reg_type'),
                    'user_id'          => $this->session->userdata("userId"),                   
                    'follow'            =>$this->input->post('followup'),
                    'nextfollow'       =>$this->input->post('nextfollow'),
                    'remark'            =>$this->input->post('remark'),
                    'telecaller'        =>$this->session->userdata("userId"),
                     'id'=>$id
                      );

               
                $shipping=array(
                    'customer_id'        => $this->input->post('id'),
                	'street'             => $this->input->post('street1'),
                    'city_id'               => $this->input->post('city1'),
                    'state_id'              => $this->input->post('state1'),
                    'zip_code'           => $this->input->post('zip_code1'),
                    'country_id'         => $this->input->post('country1'),
                    'user_id'          => $this->session->userdata("userId"),
                    'id'                 => $this->input->post('shippingid')
                );           
            /*echo "<pre>";
            print_r($customer);
            print_r($shipping);
            exit();*/

        }

        if ( ($this->form_validation->run() == true) && $this->Customer_model->customer_edit($customer,$shipping))
        {
             $this->session->set_flashdata('success', 'Lead customer Update successfully.');
                 redirect("Management/lead_customer",'refresh');
        }    
        else
	{  
            $this->session->set_flashdata('error', 'Lead customer is not updated.');
         redirect("Management/lead_customer",'refresh');
	}
            
            
//             $data=array('customer_id'=>$this->input->post('name'),
//                        'followup'=>$this->input->post('followup'),
//                        'nextfollow'=>$this->input->post('nextfollow'),   
//                        'remark'=>$this->input->post('remark'),
//                        'telecaller'=>$this->input->post('telecaller'),
//                        'id'=>$this->input->post('id'),
//                        );
//           if($this->Lead_model->update($data))
//           {
//                $this->session->set_flashdata('success', 'Lead customer Updated successfully.');
//               redirect('Management/lead_customer');
//           }else{
//                redirect('Management/lead_customer');
//              
//
//           }
        }
        
        
                public function lead_order($id)
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
		
                $data['customer_id']=$id;
		$data['orders']=$this->Order_model->getOrderByCustomer($id);
//		echo "<pre>";
//		print_r($data);exit();
		$this->load->view('management/lead_order',$data);
        }
        
        public function add_form($id){

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

       
		$data['customer']=$this->Order_model->getCustomer();
		$data['location']=$this->Order_model->getLocation();
		$data['lastid']=$this->Order_model->getLastId();
		$data['items']=$this->Order_model->getItems();
		$data['paymentmethod']=$this->Order_model->getPaymentMethod();
		$data['paymentTerm']=$this->Sales_model->getPaymentTerm();
		$data['country']  = $this->Customer_model->dataCountry();
                $data['SO']=$this->Order_model->getlastorder();
                $data['customer_info']=$this->Customer_model->shippingaddress($id);
               
                
                $data['state'] = $this->Customer_model->custstate($data['customer_info']->state_id);
                $data['city'] = $this->Customer_model->custcity($data['customer_info']->city_id);
                $data['shipping'] = $this->Customer_model->shippingaddress($id);
                $data['customer_id']=$id;
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('management/add',$data);	

	}
        
        	function add_order()
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

			$order_id=$this->Order_model->addOrder($data);

			$orderitem=array();
			if(isset($order_id))
			{
				$i=0;
				foreach ($data1 as $key => $val) {
						$orderitem[$i]=array(
							'order_id' => $order_id,
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
					
				$this->Order_model->addOrderItem($orderitem);
		
				//$this->order_details($quotation_id);            		
				redirect('Management/order_details/'.$order_id);			
			}
        }
        else
        {
        	//redirect('quotation/add_form');			
        	$this->add_form();
        }
	}
        
        
        public function get_quotation($id)
        {
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
                 $data['customer_info']=$this->Customer_model->shippingaddress($id);
                 $data['states']=$this->Customer_model->dataState();
                 $data['QN']=$this->Quotation_model->getlastquotation();
                 
                  $data['state'] = $this->Customer_model->custstate($data['customer_info']->state_id);
                $data['city'] = $this->Customer_model->custcity($data['customer_info']->city_id);
                $data['shipping'] = $this->Customer_model->shippingaddress($id);
                 
                 $data['customer_id']=$id;
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('management/quotation_form',$data);	
        }
        
        
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
				redirect('management/quotation_order_details/'.$quotation_id);			
			}
        }
        else
        {
        	//redirect('quotation/add_form');			
        	$this->get_quotation($this->input->post('customer_id'));
        }
	}
        
        
        public function quotation_order_details($quotation_id)
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
		$this->load->view('management/quotation_order',$data);  
        }
        
        
        	public function order_details($order_id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['quotation']=$this->Order_model->getOrders($order_id);
               
		$data['quotation_items']=$this->Order_model->getOrderItems($order_id);
		/*echo "<pre>";
		print_r($data);
		exit();*/

		//$data['orderdetails']=$this->Quotation_model->orderDetails($order_id);
		$data['country']=$this->Order_model->companyDetails();

		if(!isset($data['country']))
		{
			$this->session->set_flashdata('success','Please Add Company Setting Details');
			redirect('quotation','refresh');
		}

		$data['invoice']=$this->Order_model->getInvoiceDetails($order_id);
		$data['s'] = $this->Order_model->orderByID($order_id);
                
               
		/*echo "<pre>";
		print_r($data);
		exit();*/
            
                
		$this->load->view('management/order',$data);
	}
        
        	public function order_print($order_id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['address'] = $this->Order_model->getShippingAddress($order_id);


  		$data['orderdetails']=$this->Order_model->orderDetails($order_id);
		$data['country']=$this->Order_model->companyDetails();
		$data['invoice']=$this->Order_model->getInvoiceDetails($order_id);
		$data['s'] = $this->Order_model->orderByID($order_id);
		$data['shipping'] = $this->Order_model->SalesShippingAddress($order_id);
		
		/*echo "<pre>";
		print_r($data);exit();*/

	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    
	    //$html=$this->load->view('report/list_vehicle','',TRUE);
	    $html=$this->load->view('management/order_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}
    
        
             public function convert_invoice($id)
        {
                if(!$this->ion_auth->logged_in())
               {
                   redirect('auth/login', 'refresh');
               }
                $data['country']  = $this->Customer_model->dataCountry();
		$data['state1'] = $this->Customer_model->dataState();
		$data['customer']=$this->Order_model->getCustomer();
		$data['location']=$this->Order_model->getLocation();
		$data['lastid']=$this->Sales_model->getLastSalesId();
                $data['AL']=$this->Sales_model->getlastreference();
		$data['items']=$this->Order_model->getItems();
		$data['paymentmethod']=$this->Order_model->getPaymentMethod();
		$data['paymentTerm']=$this->Sales_model->getPaymentTerm();
		$data['state']=$this->Sales_model->getCompanyState();
                $data['quotation']=$this->Order_model->get_Order_detail($id);
                $data['order_id']=$id;
               
		$this->load->view('management/convert_invoice',$data);	   
        }
         function lead_status()
        {
               if(!$this->ion_auth->logged_in())
               {
                   redirect('auth/login', 'refresh');
               }
               
               $data['status']=$this->Lead_model->get_status();
               $this->load->view('management/lead_status',$data);	
        }
        
        function add_lead_status()
        {
             if(!$this->ion_auth->logged_in())
               {
                   redirect('auth/login', 'refresh');
               }
           
               $this->load->view('management/add_status');
        }
        
        function add_status()
        {
            $data=array('name'=>$this->input->post('name'),
                        'description'=>$this->input->post('description'),
                        'created_at'=>date('Y-m-d'));
            $this->Lead_model->add_status($data);
            
            if($id)
		{
			$this->session->set_flashdata('success','Status Added Successfully');
			redirect('Management/lead_status');
		}else{
                    $this->session->set_flashdata('success','Status Not Added....!');
			redirect('Management/lead_status');
                }
        }
        
        function edit_status($id)
        {
             if(!$this->ion_auth->logged_in())
               {
                   redirect('auth/login', 'refresh');
               }
               $data['status_id']=$id;
               $data['status']=$this->Lead_model->edit_status($id);
               $this->load->view('management/edit_status',$data);
        }
        
        function update_status()
        {
           
            $data=array('name'=>$this->input->post('name'),
                       'description'=>$this->input->post('description'));
            $where=array('id'=>$this->input->post('status_id'));
            
          
            if($this->Lead_model->update_status($data,$where))
            {
                 $this->session->set_flashdata('success','Status Updated Successfully.');
			redirect('Management/lead_status');
                
            }else{
                 $this->session->set_flashdata('success','Status Not Updated....!');
			redirect('Management/lead_status');
                
            }
        }
        
        function update_customer_status($val)
        {
           
            $data=explode("-",$val);
            
            $stat=str_replace("%20"," ",$data[1]);
           
            
            if($this->Lead_model->update_customer_status(array('lead_status'=>$stat),array('id'=>$data[0])))
            {
                $this->session->set_flashdata('success','Lead Status Updated....!');
                echo json_encode(array('success'=>true));
            }else{
                 $this->session->set_flashdata('success','Lead Status Not Updated....!');
                  echo json_encode(array('success'=>true));
                
            }
        }
        
        function delete_status($id)
        {
            if($this->Lead_model->update_status(array('is_deleted'=>1),array('id'=>$id)))
                 {
                 $this->session->set_flashdata('success','Status Deleted Successfully.');
			redirect('Management/lead_status');
                
            }else{
                 $this->session->set_flashdata('success','Status Not Deleted....!');
			redirect('Management/lead_status');
                
            }       
            
        }
        
        function query()
        {
            $this->Lead_model->query();
            redirect('Management/lead_customer');
        }
         function query1()
        {
            $this->Lead_model->query1();
            redirect('Management/lead_customer');
        }
        function query2()
        {
            $this->Lead_model->query2();
            redirect('Management/lead_customer');
        }
        function query3()
        {
            $this->Lead_model->query3();
            redirect('Management/lead_customer');
        }
         function query4()
        {
            $this->Lead_model->query4();
            redirect('Management/lead_customer');
        }
       
        
        
    }
