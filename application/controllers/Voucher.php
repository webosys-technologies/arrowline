<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
        $this->load->model(array('Voucher_model','Transfer_model','Customer_model'));
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
                $data['voch']=$this->Voucher_model->get();
                
//		$data['cat']=$this->Transfer_model->getCategory();
//		$data['pay']=$this->Transfer_model->getPayment();
//		$data['acc'] = $this->Transfer_model->getAccount();
//		$data['transfer'] = $this->Transfer_model->joinTransfer();
		/*echo "<pre>";
		print_r($data);
		exit();*/
//             print_r($data);
		$this->load->view('voucher/list',$data);
	}
        
        public function view()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['cust']=$this->Customer_model->customerData();
		$data['pay']=$this->Voucher_model->getPayment();
		$data['acc'] = $this->Voucher_model->getAccount();
		//$data['transfer'] = $this->Transfer_model->joinTransfer();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('voucher/add',$data);	
	}
        
        public function add()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->form_validation->set_rules('from','Customer Name','required');
		$this->form_validation->set_rules('to','Account Name','required');
		$this->form_validation->set_rules('date','Date','required');
		$this->form_validation->set_rules('amount','Amount','required');
		$this->form_validation->set_rules('payment','Payment Method','required');
		
			
			if($this->form_validation->run()==FALSE){

				$this->view();
			}
			else{
				
				$acc=array(
					'customer_id'=>$this->input->post('from'),
//                                        'voucher_type' =>$this->input->post('type'),
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
					'type' => "Voucher Transfer",
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

//                                die();
				if($this->Voucher_model->add($acc))
				{
					$this->Voucher_model->addTransaction($transaction);                                        
                                        $this->Voucher_model->updateacc($acc['to_ccount_id'],$acc['amount']);
					$this->session->set_flashdata('success', 'Amount transfer successfully');
					redirect('Voucher','refresh');
				}
				else
				{
					$this->session->set_flashdata('success', 'Amount transfer failed');
					redirect('Voucher','refresh');
				}
			}

	}
        
        public function edit($id){

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$data['transfer']=$this->Voucher_model->edit($id);
//		$data['cat']=$this->Transfer_model->getCategory();
		$data['pay']=$this->Voucher_model->getPayment();
		$data['acc'] = $this->Voucher_model->getAccount();
		
//		print_r($data);
                
		$this->load->view('transfer/edit',$data);	
	}
        
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

		if($this->Voucher_model->update($id,$acc))
		{
			$this->session->set_flashdata('success', 'Transfer Updated successfully.');
           	redirect('Voucher',"refresh");
		}
		else
		{
			$this->session->set_flashdata('success', 'Transfer Updated Failed.');
           	redirect('Voucher',"refresh");
		}	
		
	}
        
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
        
       if($this->Voucher_model->delete($del))
       {
           
           $this->session->set_flashdata('success', 'Transfer Deleted successfully.');
           redirect('Voucher',"refresh");
       }
       else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("Voucher",'refresh');	
		}
   }
   public function query()
   {
       $this->Voucher_model->query();
       redirect('Voucher');
   }

}