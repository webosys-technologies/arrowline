<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
        $this->load->model('Category_model');
	}
	
	/*
		View category list in general settings menu
   	*/
	public function index()
	{
		
		if (!$this->ion_auth->logged_in())
	    {
	        // redirect them to the login page
	        redirect('auth/login', 'refresh');
	    }
		$data['cat']=$this->Category_model->getUnit();
		$data['unit']=$this->Category_model->getUnits();
		$this->load->view('category/list',$data);
	}

	/*
		Add new category
   	*/
	public function add()
	{
		
		if (!$this->ion_auth->logged_in())
	    {
	        // redirect them to the login page
	        redirect('auth/login', 'refresh');
	    }

		$this->form_validation->set_rules('category','Category Name','required');
		$this->form_validation->set_rules('units','Units','required');

		if($this->form_validation->run()==FALSE){
			$this->index();
		}
		else{
			$cat=array(
				'category_name'=>$this->input->post('category'),
				'unit'=>$this->input->post('units'),
				'user_id'          => $this->session->userdata("userId")
			);
			if($this->Category_model->addCategory($cat))
			{
				redirect('category','refresh');
			}
		}

	}

	/*
		Update Category data
   	*/
	public function update($id)
	{

		if (!$this->ion_auth->logged_in())
	    {
	        // redirect them to the login page
	        redirect('auth/login', 'refresh');
	    }
		$data['cat']=$this->Category_model->updateCategory($id);
		$data['unit']=$this->Category_model->getUnits();
		$this->load->view('category/edit',$data);
	}

	/*
		edit category data
   	*/
	public function edit()
	{
		
		if (!$this->ion_auth->logged_in())
	    {
	        // redirect them to the login page
	        redirect('auth/login', 'refresh');
	    }
		$id = $this->input->post('cat_id');
		/*echo $id;
		exit();*/
		$cat=array(
					'category_name'=>$this->input->post('category'),
					'unit'=>$this->input->post('units'),	
					'user_id'          => $this->session->userdata("userId")
		);

		$this->Category_model->editCategory($id,$cat);
		
		/*$data['cat']=$this->Category_model->getUnit();
		$this->load->view('category/list',$data);*/
		redirect('category','refresh');
	}

	/*
		Delete Category data
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
        
       if($this->Category_model->deleteCategory($del))
       {
       		$this->session->set_flashdata('success', 'Category Deleted successfully.');
       		redirect('category','refresh');
       }
       else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("category",'refresh');	
		}
   }

   /*
		Download csv file
   */
   public function create_csv()
   {
   		$id = $this->session->userdata('userId');

   		if($this->session->userdata('type')=='admin')
   		{
   			$query = $this->db->query("SELECT c.category_name,u.unit_name FROM category c INNER JOIN unit u ON u.id = c.unit WHERE c.delete_status = 0");
			$this->load->dbutil();
			$data = $this->dbutil->csv_from_result($query);
			$this->load->helper('download');
			force_download("Category.csv", $data);
   		}
   		else
   		{
   			$query = $this->db->query("SELECT c.category_name,u.unit_name FROM category c INNER JOIN unit u ON u.id = c.unit WHERE c.delete_status = 0 AND c.user_id = $id");
			$this->load->dbutil();
			$data = $this->dbutil->csv_from_result($query);
			$this->load->helper('download');
			force_download("Category.csv", $data);	
   		}

   		
	}
}