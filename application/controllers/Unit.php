<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
        $this->load->model('Unit_model');
	}

	/*
		View list of unit
   	*/
	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['unit'] = $this->Unit_model->getUnits();
		/*print_r($data);
		exit();*/
		$this->load->view('unit/list',$data);
	}

	/*
		Add New Unit data
   	*/
	public function add()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->load->library("form_validation");	
		$this->form_validation->set_rules('name','Unit Name','required');
		$this->form_validation->set_rules('abbr','Abbrivation','required');

		if($this->form_validation->run()==FALSE){
			//redirect("product");			
			$data['unit'] = $this->Unit_model->getUnits();
			$this->load->view('unit/list',$data);
		}
		else
		{
			$unit=array(
				'unit_name'			=>$this->input->post('name'),
				'abbr'				=>$this->input->post('abbr'),
				'user_id'          	=> $this->session->userdata("userId")
			);
			if($this->Unit_model->addUnit($unit))
			{
				$this->session->set_flashdata('success','Unit Add successfully.');
       			redirect('unit',"refresh");
			}
			else
			{
				redirect('unit',"refresh");
			}	
		}	
	}

	/*
		Update Unit data
   	*/
	public function update($id)
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['unit']=$this->Unit_model->updateUnit($id);
		$this->load->view('unit/edit',$data);
	}

	/*
		View edit unit form with data
   	*/
	public function edit()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$id = $this->input->post('unit_id');
		$unit=array(
			'unit_name'=>$this->input->post('name'),
			'abbr'=>$this->input->post('abbr'),
			'user_id'          => $this->session->userdata("userId")
		);
		$this->Unit_model->editUnit($id,$unit);
		
		$this->session->set_flashdata('success','Unit Updated successfully.');
        redirect('unit',"refresh");
	}
	

	/*
		Delete Unit data
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

		if($this->Unit_model->deleteUnit($del))
		{				
			$this->session->set_flashdata('success', 'Unit Deleted successfully.');
           	redirect('unit',"refresh");
		}
		else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("unit",'refresh');	
		}
	}
}