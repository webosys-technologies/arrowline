<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Supplier_model');
        $this->load->library(array('ion_auth','form_validation'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
	}

     /*

    this function used for display supplier list and view data

    */
	public function index()
	{
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['data'] = $this->Supplier_model->suppUserData();
        $data['supplier']=$this->Supplier_model->getSupplier();
        $data['status']=$this->Supplier_model->getStatus();
        $data['deactive']=$this->Supplier_model->getDeactive();
		$this->load->view('supplier/list',$data);
		
	}

    /*

    this function used for display supplier form

    */
	public function add_supplier(){
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $data['country']  = $this->Supplier_model->dataCountry();
        $data['state'] = $this->Supplier_model->dataState();
        $data['city'] = $this->Supplier_model->dataCity();
        $this->load->view('supplier/add',$data);	
	}

    /*
        get all state of country
    */
    public function getState($id)
    {
        $data = $this->Supplier_model->getState($id);
     //log_message('debug',print_r($data,true));
        print_r(json_encode($data,true));
    }
    /*
        get all city of state
    */
    public function getCity($id)
    {
        $data = $this->Supplier_model->getCity($id);
        print_r(json_encode($data,true));
    }


    /*  get all state code

    */
    public function get_statecode($id,$country)
    {
        if($country==101)
        {
             $data=$this->Supplier_model->getStateCode($id);
             echo $data;
        }
       else
       {
            echo "";
       }
        //print_r(json_encode($data,true));
    }
    

     /*

    this function used for add new supplier record

    */
	public function add()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_rules('name', 'Name ', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        //$this->form_validation->set_rules('contact', '', 'required|numeric');
        //$this->form_validation->set_rules('street', 'Street Name', 'required');
        $this->form_validation->set_rules('city', 'City Name', 'required');
        $this->form_validation->set_rules('state', 'state name', 'required');
        //$this->form_validation->set_rules('zip_code','Zip Code', 'required|numeric');
        $this->form_validation->set_rules('country', 'Country', 'required');
        //$this->form_validation->set_rules('gstin', 'GSTIN', 'required');
        
        
        if ($this->form_validation->run() == true)
        {
            $supplier = array(
                'name'              =>$this->input->post('name'),
                'email'             =>$this->input->post('email'),
                'contact'           =>$this->input->post('contact'),
                'street'            =>$this->input->post('street'),
                'city'              =>$this->input->post('city'),
                'state'             =>$this->input->post('state'),
                'state_code'        =>$this->input->post('state_code'),
                'zip_code'          =>$this->input->post('zip_code'),
                'country'           => $this->input->post('country'),
                'gstin'             => $this->input->post('gstin'),
                'user_id'          => $this->session->userdata("userId")
            );

            /*echo "<pre>";
            print_r($supplier);exit();*/
        }

        if ( ($this->form_validation->run() == true) && $this->Supplier_model->addSupplier($supplier))
        {
            redirect('supplier','refresh');
        }    
		else
		{  
			$this->add_supplier();
		}
     }

		
    /*

         this function used for download csv data of supplier data

    */
    public function import()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $data['supplier'] = $this->Supplier_model->importData();
        $data['country']  = $this->Supplier_model->dataCountry();

        /*echo "<pre>";
        print_r($data);exit();*/

        $this->load->view('supplier/import',$data);
    }

    /*

    this function used for delete supplier data

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
		
    	if($this->Supplier_model->deleteSupplier($del))
        {
            $this->session->set_flashdata('success', 'supplier Deleted successfully.');
            redirect('supplier','refresh');
        }
    }
    
     /*
         this function used for fetch data at update supplier details
     */
	public function edit_data($id)
    {	  
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $data['data'] = $this->Supplier_model->editData($id);

        $count_id = $data['data']->country_id;
        $state_id = $data['data']->state_id;
       /* echo "country_id".$state_id;
        exit();*/
        $data['country']=$this->Supplier_model->dataCountry();
        $data['state'] = $this->Supplier_model->getStateByID($count_id);
        $data['city'] = $this->Supplier_model->getCityByID($state_id);

       /* echo "<pre>";
        print_r($data);exit();*/
        

    	$this->load->view('supplier/edit',$data);
    } 


    /*
          this function used for update supplier details

     */
	public function edit()
    { 

        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $id=$this->input->post('id');

        $this->form_validation->set_rules('name', 'Name ', 'required');
        /*$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', '', 'required|numeric');
        $this->form_validation->set_rules('street', 'Street Name', 'required');*/
        $this->form_validation->set_rules('city', 'City Name', 'required');
        $this->form_validation->set_rules('state', 'state name', 'required');
        //$this->form_validation->set_rules('zip_code','Zip Code', 'required|numeric');
        $this->form_validation->set_rules('country', 'Country', 'required');
        //$this->form_validation->set_rules('gstin', 'GSTIN', 'required');
        
        if ($this->form_validation->run() == true)
        {
        	$id = $this->input->post('id');
        	
            $supplier = array(

            'name'              =>$this->input->post('name'),
            'email'             =>$this->input->post('email'),
            'phone'             =>$this->input->post('phone'),
            'street'            =>$this->input->post('street'),
            'city'              =>$this->input->post('city'),
            'state'             =>$this->input->post('state'),
            'state_code'             =>$this->input->post('state_code'),
            'zip_code'          =>$this->input->post('zip_code'),
            'country'           => $this->input->post('country'),
            'gstin'             => $this->input->post('gstin'),
            'user_id'          => $this->session->userdata("userId"),
            'id'                =>$id
            );
        }

        if ( ($this->form_validation->run() == true) && $this->Supplier_model->editSupplier($supplier))
        {
            $this->session->set_flashdata('success', 'supplier Updated successfully.');
            redirect('supplier','refresh');
        }    
		
		else
		{  
			$this->edit_data($id);
		}
     }
        
    /*
        this function used for display country data supplier 
    */
    public function select($id)
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['single']=$this->Supplier_model->getSupplierById($id);
        $data['country']=$this->Supplier_model->getCountry();
        $this->load->view('supplier/edit',$data);
    }

    /*
        Upload supplier CSV file into database
    */

    public function update_csv()
    {
        $country_id=$this->input->post('country');
        $state_id=$this->input->post('state');
        $city_id=$this->input->post('city');
        
        $filename=$_FILES["file"]["tmp_name"];      
    
        $tmp = explode('.', $_FILES["file"]["name"]);
        $extension = end($tmp);
        

        if($extension != 'csv')
        {
            $this->session->set_flashdata('success', 'Please upload Only CSV file');
            redirect("supplier",'refresh'); 
        }

        if($_FILES["file"]["size"] > 0)
        {
            $file = fopen($filename, "r");
            
            for ($lines = 0; $data = fgetcsv($file,1000,",",'"'); $lines++) 
            {
                if ($lines == 0) continue;
                
                $sql = "INSERT INTO `supplier`(`name`, `email`, `phone`, `street`, `city_id`, `state_id`, `zipcode`, `country_id`, `gstin`) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','$city_id','$state_id','".$data[4]."','$country_id','".$data[5]."')";
                $this->db->query($sql);                 
             }
             fclose($file); 
        }
        else{
            $this->session->set_flashdata('success', 'Please Select valid csv file.');
            redirect("supplier",'refresh'); 
        }
        $this->session->set_flashdata('success', 'Data imported successfully');
        redirect('supplier','refresh');
    }


    /*
        Download sample supplier csv file
    */
    public function download_sample_csv()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT name,email,phone,street,zipcode,gstin FROM supplier");

        $this->load->dbutil();
        //$data = ltrim(strstr($this->dbutil->csv_from_result($query, ',', "\r\n"), "\r\n"));
        $data = $this->dbutil->csv_from_result($query);
        $this->load->helper('download');
        force_download("supplier_sample.csv", $data);
    }   

    /*
        Download All suppliers data in CSV file 
    */

    public function create_full_csv()
    {
        if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin'){
            $query = $this->db->query("SELECT s.name as supplier,s.email,s.phone,s.street,ct.name as city,st.name as state,s.zipcode,cnt.name as country,s.gstin FROM supplier s INNER JOIN  cities ct ON ct.id = s.city_id INNER JOIN states st ON st.id = s.state_id INNER JOIN countries cnt ON cnt.id = s.country_id WHERE s.delete_status = 0");
        }
        else{
            $query = $this->db->query("SELECT s.name as supplier,s.email,s.phone,s.street,ct.name as city,st.name as state,s.zipcode,cnt.name as country,s.gstin FROM supplier s INNER JOIN  cities ct ON ct.id = s.city_id INNER JOIN states st ON st.id = s.state_id INNER JOIN countries cnt ON cnt.id = s.country_id WHERE s.delete_status = 0 AND s.user_id=$user_id");    
        }
        

        $this->load->dbutil();
        //$data = ltrim(strstr($this->dbutil->csv_from_result($query, ',', "\r\n"), "\r\n"));
        $data = $this->dbutil->csv_from_result($query);
        $this->load->helper('download');
        force_download("all_supplier.csv", $data);
    }



}