<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Purchase_model','Quotation_model','Ledger_model'));
		$this->load->library(array('ion_auth','form_validation'));
	}

	/*
		Display All purchase Details
	*/

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['purchase']=$this->Purchase_model->getPurchase();
		$this->load->view('purchases/list',$data);
	}


	/*
		Load Add Purchase Form
	*/
	public function add_purchase()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['supplier']=$this->Purchase_model->getSupplier();
		$data['location']=$this->Quotation_model->getLocation();
		$data['lastid']=$this->Purchase_model->getLastPurchaseID();
		$data['items']=$this->Quotation_model->getItems();
		$this->load->view('purchases/add',$data);	
	}

	/*
		Add items into Dynamic tables in purchasse/add.php
	*/
	public function get_items()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$id=$this->input->post('item_id');


		$data['items']=$this->Purchase_model->getItemById($id);
		$data['tax']=$this->Quotation_model->getTaxs();
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);

	}

	public function getBarcodeProducts($term)
    {
    	$data = $this->Purchase_model->getProductBarcode($term);
    	//log_message('debug', print_r($data, true));
    	echo json_encode($data);	
    }

    public function getProductUseCode($id)
    {
    	$data['items']=$this->Purchase_model->getItemById($id);
		$data['tax']=$this->Purchase_model->getTaxs();
		/*echo "<pre>";
		print_r($data);
		log_message('debug', print_r($data, true));*/
		echo json_encode($data);
    }

    public function getNameProducts($term)
    {
    	$data = $this->Purchase_model->getProductName($term);
    	echo json_encode($data);	
    }

    public function getProductUseName($id)
    {
    	$data['items']=$this->Purchase_model->getItemById($id);
		$data['tax']=$this->Purchase_model->getTaxs();
		/*echo "<pre>";
		print_r($data);*/
		//log_message('debug', print_r($data, true));
		echo json_encode($data);
    }


	/*
		Add new purchase details
	*/
	public function add()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->form_validation->set_rules('supplier','Supplier Name','required');
        $this->form_validation->set_rules('location','Location Name','required');
        $this->form_validation->set_rules('purchase_date','Purchase Date','required');
        
        
        if($this->form_validation->run()== true)
        {
        	$location_id = $this->input->post('location');

			$data['supplier_id']=$this->input->post('supplier');	
			$data['location_id']=$this->input->post('location');
			$data['date'] = $this->input->post('purchase_date');	
			$data['reference_no']="PO-".$this->input->post('reference_no');	
			$data['total_tax']=$this->input->post('totalTax');	
			$data['total_amount']=$this->input->post('grandTotal');	
			$data['vendor_invoice']=$this->input->post('vender_invoice');	
			$data['received_in']=$this->input->post('received_in');	
			$data['delivery_date']=$this->input->post('delivery_date');	
			$data['notes']=$this->input->post('largeArea');	
			$data['user_id']=$this->session->userdata("userId");

			$data1=json_decode($this->input->post('allpurchase'));
                        
                  

			/*echo "<pre>";
			print_r($data);
			print_r($data1);
			exit();*/

			$purchase_id=$this->Purchase_model->addPurchase($data);
                        
                              $ledger=array('date'=>$this->input->post('purchase_date'),
                                      'supp_id'=>$this->input->post('supplier'),
                                      'purchase_no'=>"PO-".$this->input->post('reference_no'),
                                      'debit'=>'',
                                      'credit'=>$this->input->post('grandTotal'),
                                      'description'=>$this->input->post('largeArea'));
                              
                              $this->Ledger_model->add_suppledger($ledger);
                              
			$this->Purchase_model->AddPurchaseLog($purchase_id);
			$purchaseItem=array();

			if(isset($purchase_id))
			{
				$i=0;
				foreach ($data1 as $value) {
					$tax_id = $value->tax_id;
					$item_id = $value->item_id;
					$quantity = $value->qty;

					$i=0;
					foreach ($data1 as $key => $val) {
						if($tax_id == $val->tax_id){
							$purchaseItem[$i]=array(
								'item_id' => $val->item_id,
								'purchase_id' => $purchase_id,
								'qty' => $val->qty,
								'rate' => $val->rate,
								'tax_id' => $val->tax_id,
								'tax_amount' => $val->tax,
								'discount' => $val->discount,
								'amount' => $val->amount,
								'location_id' =>$location_id,
								'sub_invoice_no'=> $data['reference_no'].'-'.$tax_id
							);
						}
						$i++;		
					}
					$location = array(
							"item_id" => $value->item_id,
							"location_id" => $location_id,
							"qty" => $value->qty
							);

					$this->Purchase_model->addItemLocation($item_id,$quantity,$location_id,$location);
				}
				/*echo "<pre>";
				print_r($purchaseItem);exit();*/
				$this->Purchase_model->addPurchaseItem($purchaseItem);
				redirect('purchases/purchase_details/'.$purchase_id,'refresh');
			}
		}
		else{
			$this->add_purchase();
		}
	}

	/*
		Load purchase edit form page
	*/
	public function edit($id)
	{



		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['supplier']=$this->Purchase_model->getSupplier();
		$data['location']=$this->Quotation_model->getLocation();
		$data['items']=$this->Quotation_model->getItems();
		$data['purchase']=$this->Purchase_model->getPurchaseItems($id);
		$data['tax']=$this->Quotation_model->getTaxs();
		/*echo "<pre>";
		print_r($data['purchase']);exit();*/
		$this->load->view('purchases/edit',$data);
	}

	/*
		Update Purchase details .
	*/
	public function edit_purchase()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$id = $this->input->post('purchase_id');
		$location_id = $this->input->post('location');
		$reference = $this->input->post('reference');
		//echo "".$reference;exit();
        $this->form_validation->set_rules('purchase_date','Purchase Date','required');
        
        if($this->form_validation->run()== true)
        {
			$purchase['date']=$this->input->post('purchase_date');	
			$purchase['total_tax']=$this->input->post('totalTax');	
			$purchase['total_amount']=$this->input->post('grandTotal');
			$purchase['vendor_invoice']=$this->input->post('vender_invoice');
			$purchase['received_in']=$this->input->post('received_in');	
			$purchase['delivery_date']=$this->input->post('delivery_date');	
			$purchase['notes']=$this->input->post('largeArea');		
			$purchase['user_id']=$this->session->userdata("userId");
			//$purchase['id']=$id;
			
			$data1=json_decode($this->input->post('purchase_data'));

			/*echo "<pre>";
			print_r($data1);*/
			//exit();

			$purchaseItem=array();

			$i=0;
			
			foreach ($data1 as $value) {
				$tax_id = $value->tax_id;
				$i=0;
				foreach ($data1 as $key => $val) {
					if($tax_id == $val->tax_id){
							$purchaseItem[$i]=array(
								'item_id' => $val->item_id,
								'purchase_id' => $val->purchase_id,
								'qty' => $val->qty,
								'rate' => $val->rate,
								'tax_id' => $val->tax_id,
								'tax_amount' => $val->tax_amount,
								'discount' => $val->discount,
								'amount' => $val->amount,
								'location_id' => $val->location_id,
								'sub_invoice_no'=> $reference.'-'.$tax_id,
								'shipping_status' => $val->status,
								'remarks' => $val->remarks
							);
						}
						$i++;		
					}
			}
			/*echo "<pre>";
			print_r($purchaseItem);exit();*/

			if($this->Purchase_model->updatePurchase($id,$purchase)){
				$this->Purchase_model->UpdatePurchaseLog($id);	

				if($this->Purchase_model->deletePurchaseItem($id))
				{
					$this->Purchase_model->addPurchaseItem($purchaseItem);
					foreach ($data1 as $value) 
					{
						$item_id = $value->item_id;
						$quantity = $value->qty;				

						$location = array(
							"item_id" => $value->item_id,
							"location_id" => $location_id,
							"qty" => $value->qty
						);
						$this->Purchase_model->addItemLocation($item_id,$quantity,$location_id,$location);
					}
					redirect('purchases','refresh');
				}
			}
		}
		else{
			$this->edit($id);
		}	
	}

	/*
		Show perticular purchase details.
	*/
	function purchase_details($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['purchasedetail']=$this->Purchase_model->purchaseDetail($id);
		$data['country']=$this->Quotation_model->companyDetails();

		if(!isset($data['country']))
		{
			$this->session->set_flashdata('success','Please Add Company Setting Details');
			redirect('purchases','refresh');
		}

		$data['purchase']=$this->Purchase_model->getPurchaseItems($id);
		$this->load->view('purchases/purchase_detail',$data);
	}

	/*
		Print perchase details
	*/
	public function purchase_print($purchase_id)
  	{ 
  		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

  		$data['purchasedetail']=$this->Purchase_model->purchaseDetail($purchase_id);
		$data['country']=$this->Quotation_model->companyDetails();
		$data['purchase']=$this->Purchase_model->getPurchaseItems($purchase_id);

		/*echo "<pre>";
		print_r($data);
		exit();*/

	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    $html=$this->load->view('purchases/purchase_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('Purchase','I');
	}


	/*
		Delete purchase details method
	*/
    function delete($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data=array(
			'delete_status' => 1,
			'delete_date' => date('Y-m-d'),
			'id' => $id
		);

		if($this->Purchase_model->deletePurchase($data))
		{
			$this->session->set_flashdata('success', 'Purchase Deleted successfully.');
            redirect("purchases",'refresh');
		}
	}

}