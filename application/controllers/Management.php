<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Management extends CI_Controller
    {
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('Customer_model','Quotation_model','Lead_model'));
        $this->load->library(array('ion_auth','form_validation'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

     /*

    this function used for display customer list form

    */
	public function lead_customer()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

//        $data['data'] = $this->Customer_model->custUserData();
         $data['data'] = $this->Lead_model->getall();
        $data['customer']=$this->Customer_model->getCustomer();
        $data['status']=$this->Customer_model->getStatus();
        $data['deactive']=$this->Customer_model->getDeactive();
        
        

        $this->load->view('management/lead_customer',$data);
	}
        
        public function add_customer_lead()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['data'] = $this->Customer_model->custUserData();
       

        $this->load->view('management/add_customer_lead',$data);
	}
        
         public function add()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
         
     
        
            $data=array('customer_id'=>$this->input->post('name'),
                        'followup'=>$this->input->post('followup'),
                        'nextfollow'=>$this->input->post('nextfollow'),   
                        'remark'=>$this->input->post('remark'),
                        'telecaller'=>$this->input->post('telecaller'),
                        'created_at'=>date('Y-m-d'),
                        'status'=>'1',
                        'is_deleted'=>'0'
                        );
           if($this->Lead_model->insert($data))
           {
               redirect('Management/lead_customer');
           }else{
                redirect('Management/lead_customer');

           }
          
       
	}
        
        
        public function edit($id)
        {
             $data['data'] = $this->Customer_model->custUserData();
             $data['customer']=$this->Lead_model->getrow(array('customer_id'=>$id));
           
             $this->load->view('management/edit_customer',$data);
        }
        
        public function delete($id)
        {
        
            $del=array(
    			'is_deleted'   => 1,
    			'delete_date'     => date('Y-m-d'),
    			'customer_id'              => $id
    			);
            if($this->Lead_model->delete($del))
            {
                $this->session->set_flashdata('success', 'Lead customer Deleted successfully.');
                redirect('Management/lead_customer');
            }else{
                redirect('Management/lead_customer');
            }
        }
        
        public function update()
        {
             $data=array('customer_id'=>$this->input->post('name'),
                        'followup'=>$this->input->post('followup'),
                        'nextfollow'=>$this->input->post('nextfollow'),   
                        'remark'=>$this->input->post('remark'),
                        'telecaller'=>$this->input->post('telecaller'),
                        'id'=>$this->input->post('id'),
                        );
           if($this->Lead_model->update($data))
           {
                $this->session->set_flashdata('success', 'Lead customer Updated successfully.');
               redirect('Management/lead_customer');
           }else{
                redirect('Management/lead_customer');
              

           }
        }
    }
