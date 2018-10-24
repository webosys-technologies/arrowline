<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
        $this->load->model('tax_model');
	}

	/*
		View list of tax
   	*/
	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['data'] = $this->tax_model->getTax();
		$this->load->view('tax/list',$data);
	}

	public function add(){
		$this->load->view('tax/add');
	} 


	/*
		Add new tax
   	*/
	public function addTax(){
		$this->form_validation->set_rules('tax_name', 'Tax Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('calculate_on', 'Calculate On', 'trim|required|numeric');
		$this->form_validation->set_rules('tax_value', 'Tax Value', 'trim|required|numeric');
		if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {

			$data = array(
				"tax_type"  => $this->input->post('tax_type'),
				"tax_name"  => $this->input->post('tax_name'),
				"start_from" => $this->input->post('start_from'),
				"registration_number" => $this->input->post('registration_number'),
				"filling_frequency" => $this->input->post('frequency'),
				"calculate_on" => $this->input->post('calculate_on'),
				"tax_value" => $this->input->post('tax_value'),
				"purchase_tax_value" => $this->input->post('purchase_tax_value'),
				"description" => $this->input->post('description'),
				"user_id"          => $this->session->userdata("userId")
			);

			/*echo "<pre>";
			print_r($data);exit();*/

			if($this->tax_model->addModel($data)){ 
				$this->session->set_flashdata('success', 'Tax Inserted Successfullt.');
				redirect("tax",'refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Failed to Inserted tax data.');
				redirect("tax",'refresh');
			}
		}
		
	}	

	function alpha_dash_space($str) {
		if (! preg_match("/^([a-zA-Z0-9@% ])+$/i", $str))
	    {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha, spaces and dashes.');
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}


	/* 
		call edit view to edit tax record 
	*/
	public function edit($id){
		$data['data'] = $this->tax_model->getRecord($id);
		$this->load->view('tax/edit',$data);
	}
	/* 
		This function is used to save edited tax record in database 
	*/
	public function editTax(){
		$id =$this->input->post('id');
		$this->form_validation->set_rules('tax_name', 'Tax Name', 'trim|required|min_length[3]|callback_alpha_dash_space');
		$this->form_validation->set_rules('calculate_on', 'Calculate On', 'trim|required|numeric');
		$this->form_validation->set_rules('tax_value', 'Tax Value', 'trim|required|numeric');
		if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
			$data = array(
				"tax_type"  			=> $this->input->post('tax_type'),
				"tax_name"  			=> $this->input->post('tax_name'),
				"start_from" 			=> $this->input->post('start_from'),
				"registration_number" 	=> $this->input->post('registration_number'),
				"filling_frequency" 	=> $this->input->post('frequency'),
				"calculate_on" 			=> $this->input->post('calculate_on'),
				"tax_value" 			=> $this->input->post('tax_value'),
				"purchase_tax_value" 	=> $this->input->post('purchase_tax_value'),
				"description" 			=> $this->input->post('description'),
				"user_id"     			=> $this->session->userdata("userId")
			);

			if($this->tax_model->editModel($id,$data)){
				$this->session->set_flashdata('success', 'Tax Updated successfully.');
				redirect("tax",'refresh');
			}
			else{
				$this->session->set_flashdata('fail', 'Tax can not be Updated.');
				redirect("tax",'refresh');
			}
		}
	}
	/* 
		this function is used to delete tax record from databse 
	*/
	public function delete($id){
		if($this->tax_model->deleteModel($id)){
			redirect('tax');
		}
		else{
			$this->session->set_flashdata('success', 'Tax can not be Deleted.');
			redirect("tax",'refresh');
		}
	}
	/*
		in active tax
	*/
	public function in_active($id){
		$date =  $this->input->post('date');
		if($date==null){
			$date = date('Y-m-d');
		}
		if($this->tax_model->in_active($id,$date)){
			redirect('tax','refresh');
		}
		else{
			redirect("tax",'refresh');
		}
	}
	/*
		active tax
	*/
	public function active($id){
		if($this->tax_model->active($id)){
			redirect('tax','refresh');
		}
		else{
			redirect("tax",'refresh');
		}
	}



	
}