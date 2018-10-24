<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gst_return extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('gst_return_model');
		$this->load->library(array('form_validation','ion_auth'));
		$this->load->helper('download');
		//$this->load->model('log_model');
	}
	public function index(){
		$this->load->view('gst_return/gstr1');
	}
	/*
		get date and month
	*/
	public function gstr1(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');

		if($this->input->post('submit')=="b2b"){
			$this->GSTR1b2b($month,$year);
		}
		elseif ($this->input->post('submit')=="b2cs") {
			$this->GSTR1b2cs($month,$year);
		}
		elseif ($this->input->post('submit')=="b2cl") {
			$this->GSTR1b2cl($month,$year);
		}
		elseif ($this->input->post('submit')=="cdnr") {
			$this->GSTR1cdnr($month,$year);
		}
		elseif ($this->input->post('submit')=="cdnur") {
			$this->GSTR1cdnur($month,$year);
		}
		elseif ($this->input->post('submit')=="exp") {
			$this->GSTR1exp($month,$year);
		}
		elseif ($this->input->post('submit')=="exemp") {
			$this->GSTR1exemp($month,$year);
		}
		elseif ($this->input->post('submit')=="hsn") {
			$this->GSTR1hsn($month,$year);
		}
	}
	/*
		generate csv GSRTR1 b2b
	*/
	public function GSTR1b2b($month,$year)
	{

		$data = $this->gst_return_model->GSTR1b2b($month,$year);
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "b2b.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        $this->load->helper('download');
        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 b2cs
	*/
	public function GSTR1b2cs($month,$year){
		$data = $this->gst_return_model->GSTR1b2cs($month,$year);
		/*echo "<pre>";
		print_r($data);
		exit;*/
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "b2cs.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        $this->load->helper('download');
        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 b2cl
	*/
	public function GSTR1b2cl($month,$year){
		$data = $this->gst_return_model->GSTR1b2cl($month,$year);
		/*echo "<pre>";
		print_r($data);
		exit;*/
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "b2cl.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);

        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 cdnr
	*/
	public function GSTR1cdnr($month,$year){
		$data = $this->gst_return_model->GSTR1cdnr($month,$year);
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "cdnr.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 b2cl
	*/
	public function GSTR1cdnur($month,$year){
		$data = $this->gst_return_model->GSTR1cdnur($month,$year);
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "cdnur.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 b2cl
	*/
	public function GSTR1exp($month,$year){
		$data = $this->gst_return_model->GSTR1exp($month,$year);
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "cdnur.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 b2cl
	*/
	public function GSTR1exemp($month,$year){
		$data = $this->gst_return_model->GSTR1exemp($month,$year);
		/*echo "<pre>";
		print_r($data);
		exit;*/
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "exemp.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);
	}
	/*
		generate csv GSRTR1 hsn
	*/
	public function GSTR1hsn($month,$year){
		$data = $this->gst_return_model->GSTR1hsn($month,$year);
		/*echo "<pre>";
		print_r($data->result());
		exit;*/
		ob_start();
		$this->load->dbutil();
		$delimiter = ",";
        $newline = "\r\n";
        $filename = "hsn.csv";
        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);
	}
}
?>