<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library(array('form_validation'));
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
        $this->load->model('Settings_model');
	}

	public function index(){
	    
		if (!$this->ion_auth->logged_in())
	    {
	        // redirect them to the login page
	        redirect('auth/login', 'refresh');
	    }
	
		$data['country']  = $this->Settings_model->getCountry();
		$data['state'] = $this->Settings_model->getState();
		$data['city'] = $this->Settings_model->getCity();
		$data['currency'] = $this->Settings_model->getCurrency();
		$data['data']     = $this->Settings_model->getData();
			//echo "Settings";exit();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('settings/company_settings',$data);
		
	}

	/*
		get all state of country
	*/
	public function getState($id){
		$data = $this->Settings_model->getState($id);
		echo json_encode($data);
	}
	/*
		get all city of state
	*/
	public function getCity($id){
		$data = $this->Settings_model->getCity($id);
		echo json_encode($data);
	}

	private function do_upload($image){
		if(!empty($image)){
			$type = explode('.',$_FILES["login_logo"]["name"]);
			$type = $type[count($type)-1];
			$name = uniqid(rand()).'.'.$type;
			$url = './assets/images/'.$name;//uniqid(rand()).'.'.$type;
			if(in_array($type,array("jpg","jpeg","gif","png"))){
				if(is_uploaded_file($_FILES["login_logo"]["tmp_name"])){
					if(move_uploaded_file($_FILES["login_logo"]["tmp_name"],$url)){
						return $name;
					}
				}	
			}
			return  "";		
		}
	}


	private function do_upload1($image){
		if(!empty($image)){
			$type = explode('.',$_FILES["invoice_logo"]["name"]);
			$type = $type[count($type)-1];
			$name = uniqid(rand()).'.'.$type;
			$url = './assets/images/'.$name;//uniqid(rand()).'.'.$type;
			if(in_array($type,array("jpg","jpeg","gif","png"))){
				if(is_uploaded_file($_FILES["invoice_logo"]["tmp_name"])){
					if(move_uploaded_file($_FILES["invoice_logo"]["tmp_name"],$url)){
						return $name;
					}
				}	
			}
			return  "";		
		}
	}


	/*
	/****Company settings*****/
	public function add_company()
	{
		if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
     	

     	/*--  Login page Logo --*/

     	if(!empty($_FILES['login_logo']['name']))
    	{
			$image = $_FILES['login_logo']['name'];
			$temp = $this->input->post('login_image');
        	if(!empty($temp)){
        	    unlink('assets/images/'.$temp);
        	}
			$path=$this->do_upload($image);
		}
		if(empty($_FILES['login_logo']['name'])){
			$path=$this->input->post('login_image');
		}

		/*----  Invoice Logo----*/

		if(!empty($_FILES['invoice_logo']['name']))
    	{
			$inv_image = $_FILES['invoice_logo']['name'];
			$inv_temp = $this->input->post('invoice_image');
        	if(!empty($inv_temp)){
        	    unlink('assets/images/'.$inv_temp);
        	}
			$invoice_img=$this->do_upload1($inv_image);
		}
		if(empty($_FILES['invoice_logo']['name'])){
			$invoice_img=$this->input->post('invoice_image');
		}

		$data=array(
			'name'=>$this->input->post('name'),
			'site_short_name'=>$this->input->post('short_name'),	
			'email'=>$this->input->post('email'),
			'phone'=>$this->input->post('phone'),
			'street'=>$this->input->post('street'),
			'city_id'=>$this->input->post('city'),
			'state_id'=>$this->input->post('state'),
			'zip_code'=>$this->input->post('zipcode'),
			'country_id'=>$this->input->post('country'),
			'gstin'=>$this->input->post('gstin'),
			'default_language'=>$this->input->post('lang'),
			'default_currency'=>$this->input->post('currency'),
			'loginpage_image'=>$path,
			'bank_name'=>$this->input->post('bank_name'),
			'ac_no'=>$this->input->post('ac_no'),
			'ifs_code'=>$this->input->post('ifs_code'),
			'pan'=>$this->input->post('pan'),
			'invoice_image'=>$invoice_img,
		);
		
		if($this->Settings_model->add($data))
		{
			$symboldata = $this->Settings_model->getSymbol();
	        if(isset($symboldata)){
	          $symbol = $symboldata->symbol;
	          $this->session->set_userdata("currencySymbol",$symbol); 
	        }

	        $language = $this->ion_auth->getLanguage();
			if(isset($language)){
				$lan = $language->default_language;
				$this->session->set_userdata("site_lang",$lan);	
			}
			
			$this->session->set_flashdata('fail','Comapany Setting Successfully Updated.');
			redirect('settings','refresh');
		}
		else
		{
			$this->session->set_flashdata('fail','Error in Update Comapany Setting.');
			redirect('settings','refresh');
		}
			
	}

	/*******New Member****/
	public function member_list()
	{
		if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }


		$this->data['users'] = $this->ion_auth->users()->result();
		foreach ($this->data['users'] as $k => $user)
		{
			$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		/*echo "<pre>";
		print_r($this->data);exit();*/

		$this->load->view('settings/member_list',$this->data);
	}	
   /*
		Download csv file
   */
   public function create_csv()
   {
		ob_start();
		$this->load->helper('download');
		$this->load->dbutil();
		 $this->load->helper('file');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "item.csv";
        //$query = "SELECT * FROM item";
        $query="SELECT c.category_name,u.unit_name,t.tax_name,i.item_name,
        			i.purchase_price,i.sales_price,i.item_description 
        		FROM category c 
        		INNER JOIN item i ON i.category_id=c.id 
        		INNER JOIN unit u ON i.unit_id=u.id 
        		INNER JOIN tax t ON i.tax_id=t.id";
        		
        $result = $this->db->query($query);
        //$result = $this->product_alert_model->getCsvData();
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        
        force_download($filename, $data);
	}

	

	/*
		View add new payment getway form
   	*/
	public function pgetway()
	{
		$this->load->view('settings/add_pgetway');

	}

	/*
		Add new payment getway
   	*/
	public function add_pgetway()
	{

		$this->form_validation->set_rules('username','User Name','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('signature','Signature','required');
		$this->form_validation->set_rules('mode','Mode','required');
			
			
			if($this->form_validation->run()==FALSE){
				//redirect("product");	
				$this->load->view('settings/add_pgetway');
			}		
					
			else{
				
				$acc=array(
					'username'=>$this->input->post('username'),		
					'password'=>$this->input->post('password'),
					'signature'=>$this->input->post('signature'),
					'mode'=>$this->input->post('mode'),
					
					);
				$this->Settings_model->addPgetway($acc);	
				$this->load->view('settings/add_pgetway');
				
			}	
	}
	
	public function emailSetup()
	{
		$this->load->view('settings/email_setup');
	}
        
        public function member_view($id)
        {
            $data=$this->Settings_model->getmember($id);
            echo json_encode($data);
        }
        
        

	
}	

?>