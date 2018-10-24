<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Log_model'));
		$this->load->library(array('ion_auth','form_validation'));
	}

	/*
		Display All purchase Details
	*/

	public function index()
	{
		$data['log']=$this->Log_model->getLogData();
		/*echo "<pre>";
		print_r($data);*/
		$this->load->view('log/list',$data);
	}

}