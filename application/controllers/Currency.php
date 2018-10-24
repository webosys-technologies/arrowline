<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
		$this->load->model('Currency_model');
	}

  /*

    this function used for display currency list form

  */
	public function index()
	{
		$data['data'] = $this->Currency_model->payUserData();
		$this->load->view('currency/list',$data);	
	}

	 /*

    this function used for display add new customer form

  */
	public function add_currency()
	{

		$this->load->view('currency/list');	
	}

   /*

    this function used for add new currency

    */
	public function add()
  {
        $this->form_validation->set_rules('name', 'Name ', 'required');
        $this->form_validation->set_rules('symbol', 'Enter Symbol ', 'required');
      
        if ($this->form_validation->run() == true)
        {
            $currency = array(
                 'name'            => $this->input->post('name'),
                 'symbol'          => $this->input->post('symbol'),
                 'user_id'         => $this->session->userdata("userId")
            );   
        }

        if (($this->form_validation->run() == true) && $this->Currency_model->addCurrency($currency))
        {
            /*$data['data'] = $this->Currency_model->currencyData();
            $this->load->view('currency/list',$data);*/
            $this->session->set_flashdata('success', 'Currency Add successfully.');
            redirect("currency",'refresh');
        }     
        else
        {  
            $this->add_currency();
        }
  }
      
        /*

        this function used for delete customer 

        */
        public function delete($id)
        {

          		$del=array(
          			'delete_status'   => 1,
          			'delete_date'     => date('Y-m-d'),
          			'id'              => $id
          			);
		
	         if($this->Currency_model->delete($del))
           {
		         $this->session->set_flashdata('success', 'Currency Deleted successfully.');
                 redirect("currency",'refresh');
            }

        }

         /*

         this function used for display record for update customer details

         */
    	  public function edit_data($id)
        {	  
           $data['data'] = $this->Currency_model->getData($id);
        	 $this->load->view('currency/edit',$data);
        } 

         /*

         this function used for display record for update customer details

         */
        public function edit()
        {

          $this->form_validation->set_rules('name', 'Name ', 'required');
          $this->form_validation->set_rules('symbol', 'enter symbol ', 'required');
          
          if ($this->form_validation->run() == true)
          {
             $id = $this->input->post('id');

              $currency = array(        
                  'name'          =>  $this->input->post('name'),
                  'symbol'        =>  $this->input->post('symbol'),
                  'user_id'         => $this->session->userdata("userId")
              ); 
          }

          if(($this->form_validation->run() == true) && $this->Currency_model->editcurrency($id,$currency))
          {
              $this->session->set_flashdata('success', 'Currency Update successfully.');
              redirect("currency",'refresh');
          }   
          else
          {  
             $this->edit_data($id);
          }
     }

   
}
