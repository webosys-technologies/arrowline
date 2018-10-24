<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
		$this->load->model('Barcode_model');
	}

	/*
		View list of Bank Account data
	*/
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		//$data['db'] = $this->Backup_model->getBackup();
		$this->load->view('barcode/add');
	}

	public function getNameProducts($term)
    {
    	$data = $this->Barcode_model->getProductName($term);

    	/*echo "<pre>";
    	print_r($data);*/


    	echo json_encode($data);	
    }

    public function getProductUseName($id)
    {
    	log_message('debug',print_r($id,TRUE));
    	$data['items']=$this->Barcode_model->getItemById($id);
		echo json_encode($data);
    }

    public function print_barcode()
    {	
    	$data['name'] = $this->input->post('product');
    	$data['print']=json_decode($this->input->post('temptext'));
    	
    	/*echo "<pre>";
    	print_r($data);exit();*/

    	$this->load->view('barcode/add',$data);
    }

}