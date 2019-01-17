<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('Sales_model','Quotation_model','Customer_model','Invoice_model','Ledger_model'));
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->library("cart");
		
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['sales']=$this->Sales_model->getSales();
		$this->load->view('sales/list',$data);
	}

	/*
		Load add new sales page
	*/
	public function add_form()
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
                $data['AL']=$this->Sales_model->getlastreference();
		$this->load->view('sales/add',$data);	

	}

	/*
		Bind item data in dropdown using ajax call in add sales and edit sales
	*/
	public function get_items($id,$location_id)
	{
		//$id=$this->input->post('item_id');

		$data['items']=$this->Quotation_model->getItemById($id,$location_id);
		$data['tax']=$this->Quotation_model->getTaxs();
		echo json_encode($data);
	}


	public function getBarcodeProducts($term,$warehouse)
    {
    	$data = $this->Sales_model->getProductBarcode($term,$warehouse);
    	echo json_encode($data);	
    }

    public function getProductUseCode($id,$location_id)
    {
    	$data['items']=$this->Sales_model->getItemById($id,$location_id);
		$data['tax']=$this->Sales_model->getTaxs();
//                print_r($data);
//                die;
		echo json_encode($data);
    }

    public function getNameProducts($term,$warehouse)
    {
    	$data = $this->Sales_model->getProductName($term,$warehouse);
    	echo json_encode($data);	
    }

    public function getProductUseName($id,$location_id)
    {
    	$data['items']=$this->Sales_model->getItemById($id,$location_id);
		$data['tax']=$this->Sales_model->getTaxs();
		echo json_encode($data);
    }


	/* get items location wise */
	public function get_location_item($id){
        $data = $this->Quotation_model->getLocationItem($id);
        echo json_encode($data);
    }

	public function getCity($id){
        $data = $this->Customer_model->getCity($id);
        print_r(json_encode($data,true));
    }

    public function getState($id){
        $data = $this->Customer_model->getState($id);
        print_r(json_encode($data,true));
    }
    

	public function get_custstate()
	{
		$id = $this->input->post('customer_id');

		$data = $this->Sales_model->getCustomerState($id);
		echo json_encode($data);
	}


	/*
		This method is call when end user add new sales
	*/
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
                        
                        $led=array( 'date' => $this->input->post('sales_date'),
                                    'cust_id' => $this->input->post('customer'),
                                    'invoice_no' => $this->input->post('reference'),
                                    'debit' => $this->input->post('grandTotal'),
                            );
                        
                        $led_id=$this->Ledger_model->add_custledger($led);

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
					'invoice_no'   =>   $this->input->post('reference'),
					'sales_id'     =>   $sales_id,
					'sales_amount' =>   $data['total_amount'],
					'invoice_date' =>   date('Y-m-d')
				);

				$this->Sales_model->addSalesItems($SalesItem);
				if($this->Sales_model->saveInvoice($addInvoice))
				{
					redirect('invoice/invoice_details/'.$sales_id);
				}		         		
			}
		}
		else
		{
			$this->add_form();
		}	
	}	

	/*
		Load Edit sales page with sales data
	*/
	public function edit_data($id)
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['address'] = $this->Sales_model->getSalesAddress($id);
        $country_id = $data['address']->country_id;
        $state_id = $data['address']->state_id;
        
        $data['state1'] = $this->Quotation_model->getStateByCountryID($country_id);
        $data['city1'] = $this->Quotation_model->getCityByStateID($state_id);

        $data['s'] = $this->Sales_model->SalesByID($id);
        $state_id = $data['s']->state_id;

        $location_id = $this->Sales_model->getLocationID($id);

        $data['country']  = $this->Customer_model->dataCountry();
        
		$data['customer']=$this->Quotation_model->getCustomer();
		$data['location']=$this->Quotation_model->getLocation();
		$data['items']=$this->Quotation_model->getItems();
		$data['paymentmethod']=$this->Quotation_model->getPaymentMethod();
		$data['paymentTerm']=$this->Sales_model->getPaymentTerm();
		$data['sale']=$this->Sales_model->getSalesData($id);
		$data['sales']=$this->Sales_model->getSalesItems($id);
		$data['tax']=$this->Quotation_model->getTaxs();
		$data['state']=$this->Sales_model->getCompanyState();
		/*echo "<pre>";
		print_r($data);exit();*/

		$this->load->view('sales/edit',$data);
	}

	/*
		This method is call when update sales data
	*/
	public function edit()
	{	
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $id = $this->input->post('sales_id');
        $reference = $this->input->post('reference');

        $this->form_validation->set_rules('location','Location','required');
        $this->form_validation->set_rules('customer','Customer Name','required');
        $this->form_validation->set_rules('sales_date','Sales Date','required');
        $this->form_validation->set_rules('paymentmethod','Payment Method','required');
        $this->form_validation->set_rules('paymentterm','Payment Term','required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('country','Country','required');
        $this->form_validation->set_rules('state','State','required');

        if($this->form_validation->run() == true)
        {

			$sales['location_id']=$this->input->post('location');	
			$sales['customer_id']=$this->input->post('customer');	
			$sales['date'] =$this->input->post('sales_date');	;
			$sales['payment_method_id']=$this->input->post('paymentmethod');	
			$sales['payment_term_id']=$this->input->post('paymentterm');	
			$sales['total_tax']=$this->input->post('totalTax');	
			$sales['shipping_charges']=$this->input->post('shipping');	
			$sales['total_amount']=$this->input->post('grandTotal');
			$sales['notes']=$this->input->post('comments');
			$sales['country_id']=$this->input->post('country');	
			$sales['state_id']=$this->input->post('state');	
			$sales['city_id']=$this->input->post('city');	
			$sales['shipping_address']=$this->input->post('shipping_address');	
			$sales['status']=$this->input->post('status');	

			$sales['sales_invoice']=$this->input->post('sales_invoice');	
			$sales['sales_type']=$this->input->post('sales_type');	
			$sales['port_code']=$this->input->post('port_code');	
			$sales['shipping_bill_no']=$this->input->post('shipping_bill_no');	
			$sales['shipping_bill_date']=$this->input->post('shipping_bill_date');	
			$sales['gst_payable']=$this->input->post('gst_payable');	

			$sales['delivery_note'] = $this->input->post('delivery_note');	
			$sales['supplier_ref'] = $this->input->post('supplier_reference');	
			$sales['buyer_order'] = $this->input->post('buyer_order_no');	
			$sales['dispatch_doc_no'] = $this->input->post('dispatch_doc_no');	
			$sales['dilivery_note_date'] = $this->input->post('del_note_date');	
			$sales['dispatch_through'] = $this->input->post('dispatch_through');

			$sales['user_id']=$this->session->userdata("userId");
			//$sales['id']=$id;
			
			$data1=json_decode($this->input->post('temptext'));

			$i=0;
			foreach ($data1 as $val) {
				
				$SalesItem[$i]=array(
					'item_id' => $val->item_id,
					'sales_id' => $id,
					'rate' => $val->rate,
					'qty' => $val->qty,
					'tax_amount' => $val->tax_amount,
					'tax_id' => $val->tax_id,
					'discount' => $val->discount,
					'amount' => $val->amount,
					'location_id' =>$sales['location_id'],
					'sub_invoice_no'=> $reference.'-'.$val->tax_id
                                                );
				$i++;	
			}

			/*echo "<pre>";
			print_r($data1);
			print_r($SalesItem);
			exit();
*/
			$inv['sales_amount']=$sales['total_amount'];
			$inv['sales_id']=$id;

			if($this->Sales_model->updateSales($sales,$id))
			{
				$this->Sales_model->updateInvoice($inv);

				$status=$this->Sales_model->deleteSalesItem($id);
				$this->Sales_model->deletePayment($id);

				if($status === true)
				{
					$this->Sales_model->addSalesItems($SalesItem);	
					redirect('sales','refresh');
				}
			}
		}
		else
		{
			$this->edit_data($id);
		}

	}

	/*
		This method is call when End user Delete sales data
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
		
		if($this->Sales_model->deleteSales($data))
		{
			$this->session->set_flashdata('success', 'Sales Deleted successfully.');
            redirect("sales",'refresh');
		}
		else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("sales",'refresh');	
		}
	}

}
                                        