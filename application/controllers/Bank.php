<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
		$this->load->model('Account_model');
	}

	/*
		View list of Bank Account data
	*/
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$data['acc'] = $this->Account_model->getAccount();
		$this->load->view('bankaccount/list',$data);
	}

	/*
		View Add new account bank form
	*/
	public function view()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->load->view('bankaccount/add');	
	}

	/*
		Add new bank account
	*/
	public function add()
	{
			
		$this->form_validation->set_rules('accname','Account Name','required');
		$this->form_validation->set_rules('acctype','Account Type','required');
		$this->form_validation->set_rules('accnumber','Account Number','required');
		$this->form_validation->set_rules('bankname','Bank Name','required');
		$this->form_validation->set_rules('balance','Balance','required');
		
		if($this->form_validation->run()==FALSE){

			$data['acc'] = $this->Account_model->getAccount();
			$this->load->view('bankaccount/list',$data);
		}
		else
		{
			$acc=array(
				'account_name'=>$this->input->post('accname'),		
				'account_type'=>$this->input->post('acctype'),
				'account_no'=>$this->input->post('accnumber'),
				'bank_name'=>$this->input->post('bankname'),
				'bank_address'=>$this->input->post('address'),
				'opening_balance'=>$this->input->post('balance'),
				'default_account'=>$this->input->post('defacc'),
				'user_id'=>$this->session->userdata("userId")
				);


			if($this->Account_model->addAccount($acc)){
				$this->session->set_flashdata('success', 'Account Add successfully.');
	           	redirect("bank",'refresh');
			}
			else
			{
				$this->session->set_flashdata('success', 'Account Add Failed.');
	           	redirect("bank",'refresh');
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
		$data['acc']=$this->Account_model->updateAccount($id);
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('bankaccount/edit',$data);	
	}

	/*
		Update bank account data
	*/
	public function update()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$id = $this->input->post('id');
		/*echo $id;
		exit();*/
		$acc=array(
			'account_name' =>$this->input->post('accname'),				
			'account_type' =>$this->input->post('acctype'),
			'account_no'   =>$this->input->post('accnumber'),
			'bank_name'    =>$this->input->post('bankname'),
			'bank_address' =>$this->input->post('address'),
			'opening_balance' =>$this->input->post('balance'),
			'default_account' =>$this->input->post('defacc'),
			'user_id' =>$this->session->userdata("userId")
		);
		
		/*echo "<pre>";
		print_r($acc);
		exit();*/

		if($this->Account_model->editAccount($id,$acc)){
			$this->session->set_flashdata('success', 'Account Updated successfully.');
           	redirect("bank",'refresh');
		}
		else
		{
			$this->session->set_flashdata('success', 'Account Updated Failed.');
           	redirect("bank",'refresh');
		}
		
	}


	/*
		Delete bank account data delete_status=1
	*/
	public function delete($id)
	{
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
        
       if($this->Account_model->deleteAccount($del))
       {     	
           $this->session->set_flashdata('success', 'Account Deleted successfully.');
           redirect("Bank",'refresh');
	   }
	   else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("Bank",'refresh');	
		}	
	}

	public function show_transaction($id)
	{
		$data['transaction']=$this->Account_model->getAllTrasaction($id);
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('bankaccount/transaction',$data);
	}
	
}