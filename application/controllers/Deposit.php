<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
        $this->load->model('Deposite_model');
	}

	/*
		View list of Deposit data
	*/
	public function index()
	{
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['cat']=$this->Deposite_model->getCategory();
		$data['pay']=$this->Deposite_model->getPayment();
		$data['acc'] = $this->Deposite_model->getAccount();
		$data['dep'] = $this->Deposite_model->joinDeposit();
		$this->load->view('deposit/list',$data);
	}

	/*
		View Add new deposit form
	*/
	public function view()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['cat']=$this->Deposite_model->getCategory();
		$data['pay']=$this->Deposite_model->getPayment();
		$data['acc'] = $this->Deposite_model->getAccount();
		/*echo "<pre>";
		print_r($data);exit();*/
		$this->load->view('deposit/add',$data);	
	}


	/*
		Add new deposit
	*/
	public function add()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->form_validation->set_rules('account','Account Name','required');
		$this->form_validation->set_rules('date','Date','required');
		$this->form_validation->set_rules('amount','Amount','required');
		$this->form_validation->set_rules('category','Category Name','required');
		$this->form_validation->set_rules('payment','Payment Method','required');
		
		if($this->form_validation->run()==FALSE)
		{
			//redirect("product");			
			$this->view();
		}
		else
		{
			
			$acc=array(
				'account_id'=>$this->input->post('account'),		
				'date'=>$this->input->post('date'),
				'description'=>$this->input->post('desc'),
				'amount'=>$this->input->post('amount'),
				'category_id'=>$this->input->post('category'),
				'payment_method_id'=>$this->input->post('payment'),
				'bank_name'=>$this->input->post('bank_name'),
				'cheque_no'=>$this->input->post('cheque_no'),
				'reference_no'=>$this->input->post('refer'),
				'user_id' =>$this->session->userdata("userId")
				);
			if($this->Deposite_model->addDeposite($acc))
			{

				$transaction = array(
					'amount' => $this->input->post('amount'),
					'type' => "income",
					'account_id' => $this->input->post('account'), 
					'date' => $this->input->post('date'), 
					'reference' => $this->input->post('refer'), 
					'description' => $this->input->post('desc'), 
					'category_id'=>$this->input->post('category'),
					'payment_method'=>$this->input->post('payment'),
					'user_id' =>$this->session->userdata("userId")
				);

				$this->Deposite_model->addTransaction($transaction);

				$this->session->set_flashdata('success', 'Deposit add successfully.');
				redirect('deposit','refresh');
			}else
			{
				$this->session->set_flashdata('success', 'Failed add Deposit.');
				redirect('deposit','refresh');
			}
			
			
			
		}

	}

	/*
		View edit form with data
	*/
	public function edit($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['dep']=$this->Deposite_model->updateDeposit($id);
		$data['cat']=$this->Deposite_model->getCategory();
		$data['pay']=$this->Deposite_model->getPayment();
		$data['acc'] = $this->Deposite_model->getAccount();
		/*echo "<pre>";
		print_r($data);
		exit();*/

		$this->load->view('deposit/edit',$data);	
	}

	/*
		Update Deposit data
	*/
	public function update()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$id = $this->input->post('id');

		$old_amount = $this->input->post('old_amount');
		$new_amount = $this->input->post('amount');
		$account_id = $this->input->post('account');
		
		$acc=array(
			'account_id'=>$this->input->post('account'),		
			'date'=>$this->input->post('date'),
			'description'=>$this->input->post('desc'),
			'amount'=>$this->input->post('amount'),
			'category_id'=>$this->input->post('category'),
			'payment_method_id'=>$this->input->post('payment'),
			'bank_name'=>$this->input->post('bank_name'),
			'cheque_no'=>$this->input->post('cheque_no'),
			'reference_no'=>$this->input->post('refer'),
			'user_id' =>$this->session->userdata("userId")
			//'id'=>$id
		);

		if($this->Deposite_model->edit($id,$acc))
		{
			if($new_amount > $old_amount)
			{
				$amount = $new_amount - $old_amount;
				$this->Deposite_model->updateBankAmountPlus($account_id,$amount);		
			}

			if($new_amount < $old_amount)
			{
				$amount = $old_amount - $new_amount;
				$this->Deposite_model->updateBankAmountMinus($account_id,$amount);		
			}

			$this->session->set_flashdata('success', 'Deposit Updated successfully.');
           	redirect('deposit',"refresh");
		}
		else
		{
			$this->session->set_flashdata('success', 'Deposit Updated Failed.');
           	redirect('deposit',"refresh");
		}
	}

	/*
		Delete deposit data delete_status=1
	*/
	public function delete($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		$del=array(
            'delete_status'   => 1,
            'delete_date'     => date('Y-m-d'),
            'id'              => $id
        );
        
		$this->Deposite_model->afterDeleteDeposit($id);
       	if($this->Deposite_model->delete($del))
       	{   	
           $this->session->set_flashdata('success', 'Deposit Deleted successfully.');
           redirect('deposit',"refresh");
		}
		else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("deposit",'refresh');	
		}
	}

	public function add_category()
	{		
		$cat = array(
			'name' => $this->input->post('category_name'),
			'type' => $this->input->post('type')
		);
		//log_message('debug', print_r($cat, true));
		$data['category_id']=$this->Deposite_model->addCategory($cat);
		$data['category']=$this->Deposite_model->getCategoryName();
		//log_message('debug', print_r($data, true));
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
	}

}