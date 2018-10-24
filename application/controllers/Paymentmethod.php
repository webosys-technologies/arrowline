<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmethod extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
		$this->load->model('Payment_method_model');
	}

    /*

       this function used for display paymentmethod data

    */
	public function index()
	{

		 $data['data'] = $this->Payment_method_model->payUserData();
		 $this->load->view('payment_method/list',$data);	
	}

    /*

       this function used for add new payment_method form

    */
	public function add_payment_method()
	{

		$this->load->view('payment_method/add');	
	}

    /*

       this function used for insert new paymentmethod data

    */
	public function add()
    {
        $this->form_validation->set_rules('name', 'Name ', 'required');
        $this->form_validation->set_rules('default', 'select ', 'required');
    
        if ($this->form_validation->run() == true)
        {
            $payment = array(                
                'name'        => $this->input->post('name'),
                'default'     => $this->input->post('default'),
                'user_id'     => $this->session->userdata("userId")       
            );   
        }
      
        if ( ($this->form_validation->run() == true) && $this->Payment_method_model->addPayment($payment))
        {
            $this->session->set_flashdata('success', 'Payment Method Add successfully.');
            redirect("paymentmethod",'refresh');
        }
        else
        {  
            $this->add_payment_method();
        }
     }

        /*

         this function used for delete paymentmethod data

    */
    public function delete($id)
    {
		$del=array(
			'delete_status'   => 1,
			'delete_date'     => date('Y-m-d'),
			'id'              => $id
		);
		
	    if($this->Payment_method_model->delete($del))
        {
	       $this->session->set_flashdata('success', 'Payment method Deleted successfully.');
             redirect("paymentmethod",'refresh');
        }
    }

	public function edit_data($id)
    {	  
        $data['data'] = $this->Payment_method_model->getData($id);
    	$this->load->view('payment_method/edit',$data);
    } 

    public function edit()
    {
        $this->form_validation->set_rules('name', 'Name ', 'required');
        $this->form_validation->set_rules('default', 'select ', 'required');

        if ($this->form_validation->run() == true)
        {
            $id = $this->input->post('id');
            $payment = array(  
                    'name'        =>  $this->input->post('name'),
                    'default'     =>  $this->input->post('default'),
                    'user_id'     => $this->session->userdata("userId")       
            );
        }

        if(($this->form_validation->run() == true) && $this->Payment_method_model->editPayment($id,$payment))
        {
            $this->session->set_flashdata('success', 'Payment method update successfully.');
             redirect("paymentmethod",'refresh');
        }    
        else
        {  
           $this->edit_data($id);
        }
     }

     
}