<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Customer extends CI_Controller
    {
    public function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('Customer_model','Quotation_model'));
        $this->load->library(array('ion_auth','form_validation'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

     /*

    this function used for display customer list form

    */
	public function index()
	{  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['data'] = $this->Customer_model->custUserData();
        $data['customer']=$this->Customer_model->getCustomer();
        $data['status']=$this->Customer_model->getStatus();
        $data['deactive']=$this->Customer_model->getDeactive();
       
        

        $this->load->view('customer/list',$data);
	}


        
	public function add_customer(){
        if(!$this->ion_auth->logged_in())
        {
                redirect('auth/login', 'refresh');
        }
		$data['country']  = $this->Customer_model->dataCountry();
        $data['state'] = $this->Customer_model->dataState();
        $data['city'] = $this->Customer_model->dataCity();
		$this->load->view('customer/add',$data);	
	}

     /*

    this function used for add new customer record

    */
	public function add()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_rules('name', 'Name ', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', '', 'required|numeric');
        
        /*$this->form_validation->set_rules('street', 'Street Name', 'required');
        $this->form_validation->set_rules('city', 'City Name', 'required');
        $this->form_validation->set_rules('state', 'state name', 'required');
        $this->form_validation->set_rules('zip_code','Zip Code', 'required|numeric');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('gstin', 'GSTIN', 'required');

        $this->form_validation->set_rules('street1', 'Street Name', 'required');
        $this->form_validation->set_rules('city1', 'City Name', 'required');
        $this->form_validation->set_rules('state1', 'state name', 'required');
        $this->form_validation->set_rules('zip_code1','Zip Code', 'required');
        $this->form_validation->set_rules('country1', 'Country', 'required');*/
        
        
        
        if ($this->form_validation->run() == true)
        {
            	
            $customer = array(
                'name'             => $this->input->post('name'),
                'email'            => $this->input->post('email'),
                'phone'            => $this->input->post('phone'),
                'street'           => $this->input->post('street'),
                'city'             => $this->input->post('city'),
                'state'            => $this->input->post('state'),
                'state_code'       => $this->input->post('state_code'),
                'zip_code'         => $this->input->post('zip_code'),
                'country'          => $this->input->post('country'),
                'gstin'            => $this->input->post('gstin'),
                'gst_registration_type'  => $this->input->post('gst_reg_type'),
                'user_id'          => $this->session->userdata("userId")
             );
            /*echo "<pre>";
            print_r($customer);
            exit();*/
            $shipping=array(
            'street1'             => $this->input->post('street1'),
             'city1'              => $this->input->post('city1'),
             'state1'             => $this->input->post('state1'),
            'zip_code1'           => $this->input->post('zip_code1'),
            'country_id'          => $this->input->post('country1'),
            'user_id'             => $this->session->userdata("userId")
                );
                
        }


        if ( ($this->form_validation->run() == true) && $this->Customer_model->addCustomer($customer,$shipping))
        {
        	redirect("customer",'refresh');
        }    
		
		else
		{  
			$this->add_customer();
		}
    }
		/*
             this function used for download csv data of customer 
        */


         /*
            get all state of country
        */
        public function getState($id){
            $data = $this->Customer_model->getState($id);
            //echo json_encode($data);
            print_r(json_encode($data,true));
        }
        /*
            get all city of state
        */
        public function getCity($id){
            $data = $this->Customer_model->getCity($id);
            print_r(json_encode($data,true));
        }


         /*
            get all import data of customer
        */
        public function import()
        {
            if(!$this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }
            $data['data'] = $this->Customer_model->importData();
            $data['country']  = $this->Customer_model->dataCountry();
            /*$data['state'] = $this->Customer_model->dataState();
            $data['city'] = $this->Customer_model->dataCity();*/
            /*echo "<pre>";
            print_r($data);
            exit();*/
            $this->load->view('customer/import',$data);
        }

         /*
            delete  data of customer
        */
	    public function delete($id)
        {
            if(!$this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }
    		$del=array(
    			'delete_status'   => 1,
    			'delete_date'     => date('Y-m-d'),
    			'id'              => $id
    			);
    		
        	if($this->Customer_model->deleteCustomer($del))
            {
        		$this->session->set_flashdata('success', 'customer Deleted successfully.');
                 redirect("customer",'refresh');
            }   
        }

         /*

         this function used for display record for update customer details

         */

	    public function edit_data($id)
        {
            if(!$this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }	

            $data1['country'] = $this->Customer_model->getCountryID($id);
            $country_id = $data1['country']->country_id;

            $data1['state'] = $this->Customer_model->getStateID($id);
            $temp_state_id = $data1['state']->state_id;

            $data1['country1'] = $this->Customer_model->getShippingCountryID($id);
            $country_id1 = $data1['country1']->country_id;

            $data1['state1'] = $this->Customer_model->getShippingStateID($id);
            $temp_state_id1 = $data1['state1']->state_id;

            //echo $temp_state_id1;exit();

            $data['data'] = $this->Customer_model->getData($id);
            

            $data['shipping'] = $this->Customer_model->getShipping($id);
            $data['country']  = $this->Customer_model->dataCountry();
            
            $data['state'] = $this->Quotation_model->getStateByCountryID($country_id);
            $data['city'] = $this->Quotation_model->getCityByStateID($temp_state_id);

            $data['state1'] = $this->Quotation_model->getStateByCountryID($country_id1);
            $data['city1'] = $this->Quotation_model->getCityByStateID($temp_state_id1);

            /*echo "<pre>";
            print_r($data);
            exit();*/
            $this->load->view('customer/edit',$data);
         } 
         /*

          this function used for update cutomer details

        */
    	public function edit()
        {
            if(!$this->ion_auth->logged_in())
            {
                redirect('auth/login', 'refresh');
            }

            $id = $this->input->post('id');

            $this->form_validation->set_rules('name', 'Name ', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            
            if ($this->form_validation->run() == true)
            {
            	$id = $this->input->post('id');
            	
                $customer = array(
                    'name'             =>$this->input->post('name'),
                    'email'            =>$this->input->post('email'),
                    'phone'            =>$this->input->post('phone'),
                    'street'           =>$this->input->post('street'),
                    'city_id'             =>$this->input->post('city'),
                    'state_id'            =>$this->input->post('state'),
                    'state_code'       =>$this->input->post('state_code'),
                    'zip code'         =>$this->input->post('zip_code'),
                    'country_id'          =>$this->input->post('country'),
                    'gstin'            =>$this->input->post('gstin'),
                    'gst_registration_type'  => $this->input->post('gst_reg_type'),
                    'user_id'          => $this->session->userdata("userId"),
                    'id'=>$id
                );

               
                $shipping=array(
                    'customer_id'        => $this->input->post('id'),
                	'street'             => $this->input->post('street1'),
                    'city_id'               => $this->input->post('city1'),
                    'state_id'              => $this->input->post('state1'),
                    'zip_code'           => $this->input->post('zip_code1'),
                    'country_id'         => $this->input->post('country1'),
                    'user_id'          => $this->session->userdata("userId"),
                    'id'                 => $this->input->post('shippingid')
                );           
            /*echo "<pre>";
            print_r($customer);
            print_r($shipping);
            exit();*/

        }

        if ( ($this->form_validation->run() == true) && $this->Customer_model->editCustomer($customer,$shipping))
        {
             $this->session->set_flashdata('success', 'customer Update successfully.');
                 redirect("customer",'refresh');
        }    
		else
		{  
			$this->edit_data($id);
		}
     }

        /*

             this function used for download csv data of customer 

        */
      public function create_csv()
      {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        ob_start();
        $this->load->helper('download');
        $this->load->dbutil();
        $this->load->helper('file');
                $delimiter = ",";
                $newline = "\r\n";
                $filename = "customer.csv";

                //$query = "SELECT * FROM item";
                $query="SELECT c.name, c.email, c.phone, c.street, (ct.name) as city_name, (s.name) as state_name, c.zip_code, (a.name) as country_name
                        FROM customer AS c
                        INNER JOIN countries AS a ON  c.country_id = a.id
                        INNER JOIN cities AS ct ON  ct.id = c.city_id
                        INNER JOIN states AS s ON  s.id = c.state_id
                         WHERE delete_status=0";

                $result = $this->db->query($query);
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                
               force_download($filename, $data);

    }

        /*

             this function used for download csv data of customer 

        */
    public function downloadSample()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        ob_start();
        $this->load->helper('download');
        $this->load->dbutil();
        $this->load->helper('file');
                $delimiter = ",";
                $newline = "\r\n";
                $filename = "customer.csv";

                $query="SELECT c.name, c.email, c.phone, c.street, (ct.name) as city_name, (s.name) as state_name, c.zip_code, (a.name) as country_name
                        FROM customer AS c
                        INNER JOIN countries AS a ON  c.country_id = a.id
                        INNER JOIN cities AS ct ON  ct.id = c.city_id
                        INNER JOIN states AS s ON  s.id = c.state_id
                         WHERE delete_status=0";
                $result = $this->db->query($query);
                $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
                
               force_download($filename, $data);
    }


    public function update_csv()
    {
        $country_id=$this->input->post('country');
        $state_id=$this->input->post('state');
        $city_id=$this->input->post('city');
        $gst_reg=$this->input->post('gst_reg_type');
        $user_id = $this->session->userdata("userId");
        $filename=$_FILES["file"]["tmp_name"];      
    
        $tmp = explode('.', $_FILES["file"]["name"]);
        $extension = end($tmp);
        

        if($extension != 'csv')
        {
            $this->session->set_flashdata('success', 'Please upload Only CSV file');
            redirect("customer",'refresh'); 
        }

        if($_FILES["file"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            
            for ($lines = 0; $data = fgetcsv($file,1000,",",'"'); $lines++) 
            {
                if ($lines == 0) continue;
                
                $sql = "INSERT INTO `customer`(`name`, `email`, `phone`, `street`, `city_id`, `state_id`, `zip_code`, `country_id`, `gstin`,`gst_registration_type`,`user_id`) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','$city_id','$state_id','".$data[4]."','$country_id','".$data[5]."','$gst_reg','$user_id')";
                $this->db->query($sql);                 
                $insert_id = $this->db->insert_id();
                $sql1 ="INSERT INTO `shipping_address`(`customer_id`, `street`, `city_id`, `state_id`, `zip_code`, `country_id`,`user_id`) VALUES ('$insert_id','".$data[3]."','$city_id','$state_id','".$data[4]."','$country_id','$user_id')";
                $this->db->query($sql1);

             }
             fclose($file); 
        }
        else{
            $this->session->set_flashdata('success', 'Please Select valid csv file.');
            redirect("customer",'refresh'); 
        }
        $this->session->set_flashdata('success', 'Data imported successfully');
        redirect('customer','refresh');
    }


    /*
        Download item csv file
    */
    public function download_sample_csv()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT name,email,phone,street,zip_code,gstin,gst_registration_type FROM customer");

        $this->load->dbutil();
        //$data = ltrim(strstr($this->dbutil->csv_from_result($query, ',', "\r\n"), "\r\n"));
        $data = $this->dbutil->csv_from_result($query);
        $this->load->helper('download');
        force_download("Customer_sample.csv", $data);
    }

    public function create_full_csv()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin')
        {
            $query = $this->db->query("SELECT c.name,c.email,c.phone,c.street as customer_street,ct.name as city,st.name as state,c.zip_code,cnt.name as country,c.gstin,s.street as shipping_street,ct.name as shipping_city,st.name as shipping_state,s.zip_code as shipping_zipcode,cnt.name as shipping_country FROM customer c LEFT JOIN shipping_address s ON c.id = s.customer_id LEFT JOIN cities ct ON ct.id = c.city_id LEFT JOIN states st ON st.id = c.state_id LEFT JOIN countries cnt ON cnt.id = c.country_id WHERE c.delete_status = 0");
        }
        else
        {
            $query = $this->db->query("SELECT c.name,c.email,c.phone,c.street as customer_street,ct.name as city,st.name as state,c.zip_code,cnt.name as country,c.gstin,s.street as shipping_street,ct.name as shipping_city,st.name as shipping_state,s.zip_code as shipping_zipcode,cnt.name as shipping_country FROM customer c LEFT JOIN shipping_address s ON c.id = s.customer_id LEFT JOIN cities ct ON ct.id = c.city_id LEFT JOIN states st ON st.id = c.state_id LEFT JOIN countries cnt ON cnt.id = c.country_id WHERE c.delete_status = 0 AND c.user_id = $user_id");
        }

        $this->load->dbutil();
        //$data = ltrim(strstr($this->dbutil->csv_from_result($query, ',', "\r\n"), "\r\n"));
        $data = $this->dbutil->csv_from_result($query);
        $this->load->helper('download');
        force_download("all_customer.csv", $data);
    }


}