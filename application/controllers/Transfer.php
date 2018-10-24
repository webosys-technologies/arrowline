<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
        $this->load->model('Transfer_model');
	}


	/*
		View list of Bank Transfer data
	*/
	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['cat']=$this->Transfer_model->getCategory();
		$data['pay']=$this->Transfer_model->getPayment();
		$data['acc'] = $this->Transfer_model->getAccount();
		$data['transfer'] = $this->Transfer_model->joinTransfer();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('transfer/list',$data);
	}

	/*
		View Add New Transfer form
	*/
	public function view()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['cat']=$this->Transfer_model->getCategory();
		$data['pay']=$this->Transfer_model->getPayment();
		$data['acc'] = $this->Transfer_model->getAccount();
		//$data['transfer'] = $this->Transfer_model->joinTransfer();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('transfer/add',$data);	
	}


	/*
		Add Bank Transfer data
	*/
	public function add()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->form_validation->set_rules('from','Account Name','required');
		$this->form_validation->set_rules('to','Account Name','required');
		$this->form_validation->set_rules('date','Date','required');
		$this->form_validation->set_rules('amount','Amount','required');
		$this->form_validation->set_rules('payment','Payment Method','required');
		
			
			if($this->form_validation->run()==FALSE){

				$this->view();
			}
			else{
				
				$acc=array(
					'from_account_id'=>$this->input->post('from'),
					'to_account_id'=>$this->input->post('to'),		
					'date'=>$this->input->post('date'),
					'description'=>$this->input->post('desc'),
					'amount'=>$this->input->post('amount'),
					'payment_method_id'=>$this->input->post('payment'),
					'bank_name'=>$this->input->post('bank_name'),
					'cheque_no'=>$this->input->post('cheque_no'),
					'reference_no'=>$this->input->post('refer'),
					'user_id' =>$this->session->userdata("userId")
				);

				$transaction = array(
					'amount' => $this->input->post('amount'),
					'type' => "Transfer",
					'account_id' => $this->input->post('to'), 
					'date' => $this->input->post('date'), 
					'reference' => $this->input->post('refer'), 
					'description' => $this->input->post('desc'),
					'payment_method'=>$this->input->post('payment'),
					'user_id' =>$this->session->userdata("userId")
				);

				/*echo "<pre>";
				print_r($acc);
				print_r($transaction);
				exit();*/

				if($this->Transfer_model->add($acc))
				{
					$this->Transfer_model->addTransaction($transaction);
					$this->session->set_flashdata('success', 'Amount transfer successfully');
					redirect('transfer','refresh');
				}
				else
				{
					$this->session->set_flashdata('success', 'Amount transfer failed');
					redirect('transfer','refresh');
				}
			}

	}

	/*
		View edit form with data
	*/
	public function edit($id){

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$data['transfer']=$this->Transfer_model->update($id);
		$data['cat']=$this->Transfer_model->getCategory();
		$data['pay']=$this->Transfer_model->getPayment();
		$data['acc'] = $this->Transfer_model->getAccount();
		
		
		$this->load->view('transfer/edit',$data);	
	}

	/*
		Update Bank Transfer data
	*/
	public function update()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$id = $this->input->post('id');

		$acc=array(
			'from_account_id'=>$this->input->post('from'),
			'to_account_id'=>$this->input->post('to'),		
			'date'=>$this->input->post('date'),
			'description'=>$this->input->post('desc'),
			'amount'=>$this->input->post('amount'),
			'payment_method_id'=>$this->input->post('payment'),
			'bank_name'=>$this->input->post('bank_name'),
			'cheque_no'=>$this->input->post('cheque_no'),
			'reference_no'=>$this->input->post('refer'),
			'user_id' =>$this->session->userdata("userId")
			 //id'=>$id
			);

		/*echo "<pre>";
		print_r($acc);exit();*/

		if($this->Transfer_model->edit($id,$acc))
		{
			$this->session->set_flashdata('success', 'Transfer Updated successfully.');
           	redirect('transfer',"refresh");
		}
		else
		{
			$this->session->set_flashdata('success', 'Transfer Updated Failed.');
           	redirect('transfer',"refresh");
		}	
		
	}


	/*
		Delete Bank Transfer data delete_status=1
	*/
	public function delete($id){

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

        $del=array(
            'delete_status'   => 1,
            'delete_date'     => date('Y-m-d'),
            'id'              => $id
            );
        
       if($this->Transfer_model->delete($del))
       {
           
           $this->session->set_flashdata('success', 'Transfer Deleted successfully.');
           redirect('transfer',"refresh");
       }
       else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("transfer",'refresh');	
		}
   }


}