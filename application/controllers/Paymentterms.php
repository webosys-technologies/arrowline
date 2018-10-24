<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentterms extends CI_Controller {

  	public function __construct()
  	{
  		parent::__construct();
  		$this->load->library(array('form_validation','ion_auth'));
  		$this->load->model('Payment_terms_model');
  	}

    /*
       this function used for display payment_terms data
    */
    public function index()
    {
       $data['data'] = $this->Payment_terms_model->payUserData();
       $this->load->view('payment_term/list',$data);
    }


	
  	/*

      this function used for display add payment_method form

    */	
  	public function add_payment_method()
  	{
  		  $this->load->view('payment_term/add');	
  	}

    /*
      this function used for add new payment_terms
    */
  	public function add()
    {
      $this->form_validation->set_rules('name', 'Name ', 'required');
      $this->form_validation->set_rules('due', 'select ', 'required');
      $this->form_validation->set_rules('default', 'select ', 'required');
        
        
      if ($this->form_validation->run() == true)
      {
        $terms = array(
          'term'          => $this->input->post('name'),
          'due_days'           => $this->input->post('due'),
          'default'       => $this->input->post('default'),
          'user_id'     => $this->session->userdata("userId")               
        );  
      }

       if(($this->form_validation->run() == true) && $this->Payment_terms_model->addpaymentTerms($terms))
        {
             /*$data['data'] = $this->Payment_terms_model->payUserData();
             $this->load->view('payment_term/list',$data);*/
            $this->session->set_flashdata('success', 'Payment terms add successfully.');
            redirect("paymentterms",'refresh');
        }   
        else
        {  
            $this->add_payment_method();
        }
    }

       
        /*

           this function used for delete payment_terms data

       */
        public function delete($id)
        {

          		   $del=array(
          			'delete_status'   => 1,
          			'delete_date'     => date('Y-m-d'),
          			'id'              => $id
          			);
    		
    	         if($this->Payment_terms_model->delete($del))
    	         {
    		          $this->session->set_flashdata('success', 'Payment_terms Deleted successfully.');
                   redirect("paymentterms",'refresh');
                }
        }

         /*

         this function used for fetch payment_terms data

       */     
        public function edit_data($id)
        {	  
            $data['data'] = $this->Payment_terms_model->getData($id);
        	  $this->load->view('payment_term/edit',$data);
        }


    /*
      this function used for edit payment_terms data
    */
    public function edit()
    {

  	    $id = $this->input->post('id');

        $this->form_validation->set_rules('name', 'Name ', 'required');
        $this->form_validation->set_rules('due', 'select ', 'required');
        $this->form_validation->set_rules('default', 'select ', 'required');
    
        if ($this->form_validation->run() == true)
        {             
            $terms = array(
              'term'       => $this->input->post('name'),
              'due_days'        => $this->input->post('due'),
              'default'    => $this->input->post('default'),  
              'user_id'     => $this->session->userdata("userId")               
            );   
            /*echo "<pre>";
            print_r($terms);exit();*/
        }
     
      if(($this->form_validation->run() == true) && $this->Payment_terms_model->editTerms($id,$terms))
        {
           $this->session->set_flashdata('success', 'Payment terms edit successfully.');
                   redirect("paymentterms",'refresh');
        }    
        else
        {  
            $this->edit_data($id);
        }
      }
  }