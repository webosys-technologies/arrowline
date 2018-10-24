<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
        $this->load->model('Location_model');
	}

	/*
		View List of Location 
   	*/
	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['location']=$this->Location_model->getLocation();
		/*print_r($data);
		exit();*/
		$this->load->view('location/list',$data);
	}

	/*
		View Add new location form
   	*/
	public function new_location()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$this->load->view('location/add');

	}


	/*
		Add new Location
   	*/
	public function add()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->form_validation->set_rules('location_name','Location Name','required');
		$this->form_validation->set_rules('delivery_address','Delivery Address','required');
		
		if($this->form_validation->run()==FALSE){
				//redirect("product");	
				//$data['location']=$this->Location_model->getLocation();		
				$this->new_location();
		}
		else{
			$location=array(			
				'location_name'		=>$this->input->post('location_name'),
				'location_code'		=>$this->input->post('loc_code'),
				'delivery_address'	=>$this->input->post('delivery_address'),
				'phone'				=>$this->input->post('phone'),
				'fax'				=>$this->input->post('fax'),
				'email'				=>$this->input->post('email'),
				'contact_person'	=>$this->input->post('contact'),
				'user_id'        	=>$this->session->userdata("userId")
			);
			/*echo "<pre>";
			print_r($location);
			exit();*/
			if($this->Location_model->addLocation($location))
			{
				redirect('location','refresh');	
			}	
		}
	}

	/*
		Delete Location data
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
       if($this->Location_model->deleteLocation($del)){

			$this->session->set_flashdata('success', 'Location Deleted successfully.');
           	redirect('location',"refresh");
		}
		else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("location",'refresh');	
		}
   }

   	/*
		Update location data
   	*/
   	public function update($id)
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['location']=$this->Location_model->updateLocation($id);
		$this->load->view('location/edit',$data);
	}


	/*
		View edit location form with data
   	*/
	public function edit()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$id = $this->input->post('id');
		/*echo $id;
		exit();*/
		$location=array(	
			'location_name'		=>$this->input->post('location_name'),
			'location_code'		=>$this->input->post('loc_code'),
			'delivery_address'	=>$this->input->post('delivery_address'),
			'phone'				=>$this->input->post('phone'),
			'fax'				=>$this->input->post('fax'),
			'email'				=>$this->input->post('email'),
			'contact_person'	=>$this->input->post('contact'),
			'user_id'        	=>$this->session->userdata("userId")
		);

		if($this->Location_model->editLocation($id,$location))
		{
			redirect('location', 'refresh');	
		}
		
		/*$data['location']=$this->Location_model->getLocation();	
		$this->load->view('location/list',$data);*/
	}

}
