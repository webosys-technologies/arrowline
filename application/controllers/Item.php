<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
		//$this->load->library('csvreader');
        $this->load->model('Item_model');
	}

	/*
		View list of Item
	*/
	public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data['item'] = $this->Item_model->getItems();
		$data['total']=$this->Item_model->getTotal();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('item/list',$data);
	}

	/*
		View Add new Item form
	*/
	public function create_item()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['item']=$this->Item_model->getCategory();
		$data['tax'] = $this->Item_model->getTax();
		$data['unit']=$this->Item_model->getUnits();
		$data['sac'] = $this->Item_model->getSac();
		$data['chapter'] = $this->Item_model->getHsnChapter();
		$data['hsn'] = $this->Item_model->getHsn();
		$this->load->view('item/add',$data);

	}

	/*
		Get HSN data in model
	*/

	public function getHsnData($id){
		$data = $this->Item_model->getHsnData($id);
		//log_message('debug', print_r($data, true));
		echo json_encode($data);
	}



	/*
		Add New Item
	*/
	public function add_item()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $pk2 = $this->input->post('product_code');


		$this->form_validation->set_rules('itemname','Item Name','required');
		$this->form_validation->set_rules('hsn_sac_code','HSN/SAC Code','required|numeric');
		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('unit','Unit','required');
		$this->form_validation->set_rules('tax_type','Tax Type','required');
		$this->form_validation->set_rules('purchase_price','Purchase Price','required');
		$this->form_validation->set_rules('sales_price','Sales Price','required');
		$this->form_validation->set_rules('product_code', 'Product Code', 'required|is_unique[item.product_code]');

		
		if($this->form_validation->run()==FALSE){
			$this->create_item();
		}
		else
		{
			$product_code = $this->input->post('product_code');
			$barcode = $this->set_barcode($product_code);

			if(isset($_FILES['picture']['name'])){
        		$image = $_FILES['picture']['name'];
        		$path=$this->do_upload($image);
        	}

			$item=array(
				'product_code'	=>$this->input->post('product_code'),
				'item_name'		=>$this->input->post('itemname'),		
				'hsn_code'		=>$this->input->post('hsn_sac_code'),		
				'category_id'	=>$this->input->post('category'),
				'unit_id'		=>$this->input->post('unit'),
				'tax_id'		=>$this->input->post('tax_type'),
				'item_description'=>$this->input->post('itemdesc'),
				'purchase_price'=>$this->input->post('purchase_price'),
				'sales_price'	=>$this->input->post('sales_price'),
				'status'		=>$this->input->post('status'),
				'picture'		=>$path,
				'bar_code'		=>$barcode,
				'user_id'		=> $this->session->userdata("userId")
			);

			if($this->Item_model->addItem($item))
			{
				$this->session->set_flashdata('success', 'Product Added Successfully.');
            	redirect("item",'refresh');	
			}
			else
			{
				$this->create_item();
			}	
		}		
	}

	function set_barcode($code)
	{
	   $this->load->library('zend');
	   $this->zend->load('Zend/Barcode');
	   $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
	   $code = time().$code;
	   $store_image = imagepng($file,"./assets/barcode/{$code}.png");
	   return $code.'.png';
	}


	/*
		Image Upload in folder
	*/
	public function do_upload($image)
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        if(!empty($image)){
        
            $type = explode('.',$_FILES["picture"]["name"]);
            $type = $type[count($type)-1];
            $name = uniqid(rand()).'.'.$type;
            $url = './uploads/'.$name;//uniqid(rand()).'.'.$type;

                if(in_array($type,array("jpg","jpeg","gif","png"))){
                    
                    if(is_uploaded_file($_FILES["picture"]["tmp_name"])){
                        
                        if(move_uploaded_file($_FILES["picture"]["tmp_name"],$url)){

                            return $name;
                        }
                    }    
                }
                return  "";        
        }
    }

    /*
		View edit form with data
	*/
	public function edit_item($id)
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['item']=$this->Item_model->updateItem($id);
		$data['cat']=$this->Item_model->getCategory();
		$data['tax']=$this->Item_model->getTax();	
		$data['unit']=$this->Item_model->getUnits();
		$data['sac'] = $this->Item_model->getSac();
		$data['chapter'] = $this->Item_model->getHsnChapter();
		$data['hsn'] = $this->Item_model->getHsn();

		$this->load->view('item/edit',$data);
	}
	
	/*
		Update item details
	*/
	public function edit_data()
	{
		
		

		
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$id = $this->input->post('item_id');
		
		$this->form_validation->set_rules('itemname','Item Name','required');
		$this->form_validation->set_rules('hsn_sac_code','HSN/SAC Code','required|numeric');
		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('units','Unit','required');
		$this->form_validation->set_rules('tax','Tax Type','required');
		$this->form_validation->set_rules('purchase_price','Purchase Price','required');
		$this->form_validation->set_rules('sales_price','Sales Price','required');
		
		if($this->form_validation->run()==FALSE){

			$this->edit_item($id);
		}
		else{
			if(!empty($_FILES['picture']['name'])){
            	$image = $_FILES['picture']['name'];
            	$temp = $this->input->post('pic');

            	if(!empty($temp)){
            	    unlink('uploads/'.$temp);
            	}
            	$path=$this->do_upload($image);
			}

			if(empty($_FILES['picture']['name']))
			{
	            $path=$this->input->post('pic');
	        }	

			$item=array(
				'item_name'		=>$this->input->post('itemname'),
				'hsn_code'		=>$this->input->post('hsn_sac_code'),
				'category_id'	=>$this->input->post('category'),
				'unit_id'		=>$this->input->post('units'),
				'tax_id'		=>$this->input->post('tax'),
				'item_description'=>$this->input->post('itemdesc'),
				'purchase_price'=>$this->input->post('purchase_price'),
				'sales_price'	=>$this->input->post('sales_price'),
				'status'		=>$this->input->post('status'),
				'picture'		=>$path,	
				'user_id'		=> $this->session->userdata("userId")
			);

			/*echo "<pre>";
			print_r($item);
			exit();*/

			$this->Item_model->editItem($id,$item);

			if ($this->db->trans_status() === TRUE)
			{
				$this->session->set_flashdata('success', 'Product Updated Successfully.');
            	redirect("item",'refresh');	
			}
			else
			{
				$this->session->set_flashdata('success', 'Oops ! Product Updates Failed.');
            	redirect("item",'refresh');	
			}

		}
		
	}

	/*
		edit sales value in item
	*/
	public function edit_sales()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$item=array(
			'sales_price'=>$this->input->post('retail'),
			'id'=>$this->input->post('item_id')
		);
			/*print_r($item);
			exit();*/
				
		$this->Item_model->addSales($item);			
	    $this->session->set_flashdata('success','Successfully updated.');	
		$data['item'] = $this->Item_model->getItem();
		$data['cat']=$this->Item_model->getCategory();
		$data['tax']=$this->Item_model->getTax();
		$data['unit']=$this->Item_model->getUnits();
		$data['sac'] = $this->Item_model->getSac();
		$data['chapter'] = $this->Item_model->getHsnChapter();
		$data['hsn'] = $this->Item_model->getHsn();

		$this->load->view('item/edit',$data);

	}

	/*
		edit purchase value in item
	*/
	public function edit_purchase()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$item=array(
			'purchase_price'=>$this->input->post('price'),
			'id'=>$this->input->post('item_id'),
		);
	
		$this->Item_model->addPurchase($item);	
		$this->session->set_flashdata('success','Successfully updated.');
		$data['item'] = $this->Item_model->getItem();
		$data['cat']=$this->Item_model->getCategory();
		$data['tax']=$this->Item_model->getTax();
		$data['unit']=$this->Item_model->getUnits();

		$data['sac'] = $this->Item_model->getSac();
		$data['chapter'] = $this->Item_model->getHsnChapter();
		$data['hsn'] = $this->Item_model->getHsn();


		$this->load->view('item/edit',$data);
	}

	/*
		Delete Item detail delete_status=1
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
        
       if($this->Item_model->deleteItem($del)){
           	
           /*$data['item'] = $this->Item_model->getItem();
           	$data['total']=$this->Item_model->getTotal();
			$this->load->view('item/list',$data);*/
			$this->session->set_flashdata('success', 'Item Deleted successfully.');
			redirect("item",'refresh');
		}
		else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("item",'refresh');	
		}
	
	}

	/*
		Download item csv file
	*/
	public function create_csv()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $query = $this->db->query("SELECT item_name,hsn_code,item_description,purchase_price,sales_price FROM item");

		$this->load->dbutil();
		//$data = ltrim(strstr($this->dbutil->csv_from_result($query, ',', "\r\n"), "\r\n"));
		$data = $this->dbutil->csv_from_result($query);
		$this->load->helper('download');
		force_download("item.csv", $data);
	}

	/*
		Download item csv file
	*/
	public function create_full_csv()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin')
        {
        	$query = $this->db->query("SELECT i.item_name,i.hsn_code,c.category_name,u.unit_name,t.tax_name,i.item_description,i.purchase_price,i.sales_price FROM item i INNER JOIN category c ON c.id = i.category_id INNER JOIN unit u ON u.id = i.unit_id INNER JOIN tax t ON t.tax_id = i.tax_id WHERE i.delete_status = 0");
        }
        else
        {
        	$query = $this->db->query("SELECT i.item_name,i.hsn_code,c.category_name,u.unit_name,t.tax_name,i.item_description,i.purchase_price,i.sales_price FROM item i INNER JOIN category c ON c.id = i.category_id INNER JOIN unit u ON u.id = i.unit_id INNER JOIN tax t ON t.tax_id = i.tax_id WHERE i.delete_status = 0 AND i.user_id = $user_id");
        }
        

		$this->load->dbutil();
		//$data = ltrim(strstr($this->dbutil->csv_from_result($query, ',', "\r\n"), "\r\n"));
		$data = $this->dbutil->csv_from_result($query);
		$this->load->helper('download');
		force_download("item.csv", $data);
	}


	/*
		view import item csv file
	*/
	public function import()
    {

    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['item'] = $this->Item_model->importData();
        $data['cat']=$this->Item_model->getCategory();
		$data['tax'] = $this->Item_model->getTax();
		$data['unit']=$this->Item_model->getUnits();
        /*echo "<pre>";
       	print_r($data);
        exit();*/
        $this->load->view('item/import',$data);
    }

    public function update_csv()
    {

    		$category_id=$this->input->post('category');
			$unit_id=$this->input->post('unit');
			$tax_id=$this->input->post('tax_type');
			$user_id = $this->session->userdata('userId');


			$filename=$_FILES["file"]["tmp_name"];		
 		
			$tmp = explode('.', $_FILES["file"]["name"]);
			$extension = end($tmp);
			if($extension != 'csv')
			{
				$this->session->set_flashdata('success', 'Please upload Only CSV file');
            	redirect("item",'refresh');	
			}


			 if($_FILES["file"]["size"] > 0)
			 {
			  	$file = fopen($filename, "r");
			  	
			  	for ($lines = 0; $data = fgetcsv($file,1000,",",'"'); $lines++) {
		        //while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		        	if ($lines == 0) continue;
		        	
		           	$sql = "INSERT INTO `item`(`item_name`, `hsn_code`, `category_id`, `unit_id`, `tax_id`, `item_description`, `purchase_price`, `sales_price`,`user_id`) VALUES ('".$data[0]."','".$data[1]."','$category_id','$unit_id','$tax_id','".$data[2]."','".$data[3]."','".$data[4]."','$user_id')";
	                $this->db->query($sql);					                
		         }
		         fclose($file);	
			}
			else{
				$this->session->set_flashdata('success', 'Please Select valid csv file.');
            	redirect("item",'refresh');	
			}
			redirect('item','refresh');
			
    }

    public function upload_data()
    {
        
    	$this->Item_model->uploadData();
        //redirect('csv');
        
    }

    public function product_print()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $data['barcode'] = $this->Item_model->getAllBarcode();

        /*echo "<pre>";
        print_r($data);
        exit();*/

	    ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	    $html=$this->load->view('item/barcode_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}

	public function add_category()
	{		
		$cat = array(
			'category_name' => $this->input->post('category_name'),
			'unit' => $this->input->post('unit_id')
		);
		//log_message('debug', print_r($cat, true));
		$data['category_id']=$this->Item_model->addCategory($cat);
		$data['category']=$this->Item_model->getCategoryName();
		//log_message('debug', print_r($data, true));
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
	}

	public function add_unit()
	{		
		$unit = array(
			'unit_name' => $this->input->post('unit_name'),
			'abbr' => $this->input->post('abbreviation')
		);
		$data['unit_id']=$this->Item_model->addUnit($unit);
		$data['unit']=$this->Item_model->getUnitName();
		//log_message('debug', print_r($data, true));
		/*echo "<pre>";
		print_r($data);*/
		echo json_encode($data);
	}


}
