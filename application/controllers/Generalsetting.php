<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Generalsetting extends CI_Controller {

  	public function __construct()
  	{
  		parent::__construct();
  		$this->load->library(array('form_validation','ion_auth'));
  		$this->load->model('General_setting_model');
  	}

    /*

    this function used for display General setting list form

    */
  	public function expense()
  	{
  		$this->load->view('settings/generalSettings');	
  	}

    /*

    this function used for display expense_category list form

    */
  	public function index()
  	{
      if (!$this->ion_auth->logged_in())
      {
        // redirect them to the login page
        redirect('auth/login', 'refresh');
      }
      $data['data'] = $this->General_setting_model->payUserData();
  		$this->load->view('settings/expense_category',$data);
  	}

    /*

    this function used for expense_category form

    */
  	public function add_expensecategory()
  	{
      if (!$this->ion_auth->logged_in())
      {
        // redirect them to the login page
        redirect('auth/login', 'refresh');
      }
  		$this->load->view('settings/expense_category');	
  	}

    /*

    this function used for add new expense data

    */
	  public function add()
    {
        if (!$this->ion_auth->logged_in())
        {
          // redirect them to the login page
          redirect('auth/login', 'refresh');
        }
         $this->form_validation->set_rules('name', 'Name ', 'required');
         $this->form_validation->set_rules('type', 'type ', 'required');
        
        if ($this->form_validation->run() == true)
        {

            $category = array(
                    'name'        =>  $this->input->post('name'),
                    'type'        =>  $this->input->post('type'),
                    'user_id'          => $this->session->userdata("userId")
                          
            );
        }
       
        if (($this->form_validation->run() == true) && $this->General_setting_model->addCategory($category))
        {
          $this->session->set_flashdata('success', 'Expense Add successfully.');
          redirect('generalsetting','refresh');
        }    
        else
        {  
            $this->add_category();
        }
    }

   
    /*

        this function used for delete expense_category data

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
		
	       if($this->General_setting_model->delete($del))
	        {
              $this->session->set_flashdata('success', 'Expense category Deleted successfully.');
              redirect('generalsetting','refresh');
          }
    }

    /*

        this function used for fetch expense_category data

    */
    public function edit_data($id)
    {	
        if (!$this->ion_auth->logged_in())
        {
          // redirect them to the login page
          redirect('auth/login', 'refresh');
        }

        $data['data'] = $this->General_setting_model->getData($id);
        /*echo "<pre>";
        print_r($data);exit();*/
    	   $this->load->view('settings/expense_category_edit',$data);
    }

     /*

        this function used for update expense_category data

    */
    function edit()
    {
        if (!$this->ion_auth->logged_in())
        {
          // redirect them to the login page
          redirect('auth/login', 'refresh');
        }

    	   $id = $this->input->post('id');

          $this->form_validation->set_rules('name', 'Name ', 'required');
          $this->form_validation->set_rules('type', 'type ', 'required');
         
          if ($this->form_validation->run() == true)
          {
              $this->load->model('General_setting_model');
              $id = $this->input->post('id');
              $category = array(
                    'name'          => $this->input->post('name'),
                    'type'          => $this->input->post('type'),
                    'user_id'          => $this->session->userdata("userId")
              );
          }

         if(($this->form_validation->run() == true) && $this->General_setting_model->editCategory($id,$category))
            {
               $this->session->set_flashdata('success', 'Expense category edit successfully.');
              redirect('generalsetting','refresh');
            }    
           else
            {  
               $this->edit_data($id);
            }
        }
    } 