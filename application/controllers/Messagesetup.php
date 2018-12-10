<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Messagesetup extends CI_Controller {

    	public function __construct()
    	{
    		parent::__construct();
    		$this->load->library(array('form_validation','ion_auth'));
    		$this->load->model('Email_setup_model');
    	}

       /*

        this function used for display emailsetup list form

       */
      
    	public function index()
    	{
        //$email['id']=$id;
        $data['data']=$this->Email_setup_model->emailData();
      	$this->load->view('settings/message_setup',$data);
    	}

  
  
       /*

        this function used for add new emailsetup 

        */
  	  public function add()
      {
         //$this->form_validation->set_rules('email_protocol', 'protocol ', 'required');
         //$this->form_validation->set_rules('email_encryption', 'encryption ', 'required');
         $this->form_validation->set_rules('smtp_host', 'Enter smtp host ', 'required');
         $this->form_validation->set_rules('smtp_port', ' Enter smtp port ', 'required');
         $this->form_validation->set_rules('smtp_email', 'Enter smtp email ', 'required');
         $this->form_validation->set_rules('from_address', 'Enter address ', 'required');
         $this->form_validation->set_rules('from_name', 'Enter name ', 'required');
         $this->form_validation->set_rules('smtp_username', 'Enter username ', 'required');
         $this->form_validation->set_rules('smtp_password', 'Enter password ', 'required');

      
        if ($this->form_validation->run() == true)
        {


            $email = array(
                
               'protocol'   =>  $this->input->post('email_protocol'),
               'encription' =>  $this->input->post('email_encryption'),
               'host'        =>  $this->input->post('smtp_host'),
               'port'        =>  $this->input->post('smtp_port'),
               'email'       =>  $this->input->post('smtp_email'),
               'address'     =>  $this->input->post('from_address'),
               'name'        =>  $this->input->post('from_name'),
               'username'    =>  $this->input->post('smtp_username'),
               'password'    =>  $this->input->post('smtp_password')
                          
            );

            /*echo "<pre>";
            print_r($email);exit();*/
            

           if($this->Email_setup_model->add($email))
           {
          
              $this->session->set_flashdata('fail','Emailsetup  Successfully Updated.');
              redirect('emailsetup','refresh');
           }
         else
          {
             $this->session->set_flashdata('fail','Error in Update Emailsetup .');
             redirect('emailsetup','refresh');
          }
        
    
    }
}
}