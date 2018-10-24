<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reportexpense extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->model('Report_expense_model');	
		 $this->load->library(array('form_validation','ion_auth'));
	}

	/*

       this function used for display Report_expense form

     */
	public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$expense=$this->Report_expense_model->getData();

		$subtotal=$this->Report_expense_model->getExpense();

		$subtotalarray = array();

		foreach ($subtotal as $key => $sub) {
			
			$subarray = array(
				'amount' => $sub->amount,
				'month' => $sub->month
			);
			array_push($subtotalarray,$subarray);
		}

		$temp = array();
		$exp = array();
		$exp1 = array();
		$test = array();
		$cnt = 0;
		$flag = 0;
		foreach ($expense as $myValue) {
			$cnt++;
			if(!in_array($myValue->name, $temp))
			{
				$temp=array(
					'name' => $myValue->name,
					$myValue->month => $myValue->amount, 
				);

				array_push($exp,$temp);
			}
			else
			{
				$exp1 = array(
					'name' => $myValue->name,
					'amount' => $myValue->amount,
					'month' => $myValue->month	
				);
				array_push($test,$exp1);
			}
		}

		foreach ($exp as $key => $value) 
		{
			foreach ($test as $value1) 
			{
				if($value['name'] == $value1['name'])
				{
					$exp[$key][$value1["month"]]=$value1['amount'];
				}
			}
				
			
		}


		
		$data['expense'] =$exp;
		$data['subtotal'] =$subtotalarray;
		$data['grandtotal'] = $this->Report_expense_model->getTotal();

		$this->load->view('reports/expense',$data);	
	}


	function get_expense()
	{

		$year = $this->input->post('y');

		$expense=$this->Report_expense_model->getExpenseData($year);

		$subtotal=$this->Report_expense_model->getExpenseSubTotal($year);

		$subtotalarray = array();
		foreach ($subtotal as $key => $sub) {
			
			/*$subarray = array(
				'amount' => $sub->amount,
				'month' => $sub->month
			);*/
			$mon = "";
			if($sub->month == 1){ $mon ="jan";}
			if($sub->month == 2){ $mon ="feb";}
			if($sub->month == 3){ $mon ="mar";}
			if($sub->month == 4){ $mon ="apl";}
			if($sub->month == 5){ $mon ="may";}
			if($sub->month == 6){ $mon ="jun";}
			if($sub->month == 7){ $mon ="july";}
			if($sub->month == 8){ $mon ="aug";}
			if($sub->month == 9){ $mon ="sept";}
			if($sub->month == 10){ $mon ="oct";}
			if($sub->month == 11){ $mon ="nov";}
			if($sub->month == 12){ $mon ="dec";}

			$subtotalarray[$key][$mon]=$sub->amount;

			//array_push($subtotalarray,$subarray);
		}




		$temp = array();
		$exp = array();
		$exp1 = array();
		$test = array();
		$cnt = 0;
		$flag = 0;
		foreach ($expense as $myValue) {
			$cnt++;
			if(!in_array($myValue->name, $temp))
			{
				$mon = "";
				if($myValue->month == 1){ $mon ="jan";}
				if($myValue->month == 2){ $mon ="feb";}
				if($myValue->month == 3){ $mon ="mar";}
				if($myValue->month == 4){ $mon ="apl";}
				if($myValue->month == 5){ $mon ="may";}
				if($myValue->month == 6){ $mon ="jun";}
				if($myValue->month == 7){ $mon ="july";}
				if($myValue->month == 8){ $mon ="aug";}
				if($myValue->month == 9){ $mon ="sept";}
				if($myValue->month == 10){ $mon ="oct";}
				if($myValue->month == 11){ $mon ="nov";}
				if($myValue->month == 12){ $mon ="dec";}

				$temp=array(
					'name' => $myValue->name,
					$mon => $myValue->amount, 
				);

				array_push($exp,$temp);
			}
			else
			{

				$mon = "";
				if($myValue->month == 1){ $mon ="jan";}
				if($myValue->month == 2){ $mon ="feb";}
				if($myValue->month == 3){ $mon ="mar";}
				if($myValue->month == 4){ $mon ="apl";}
				if($myValue->month == 5){ $mon ="may";}
				if($myValue->month == 6){ $mon ="jun";}
				if($myValue->month == 7){ $mon ="july";}
				if($myValue->month == 8){ $mon ="aug";}
				if($myValue->month == 9){ $mon ="sept";}
				if($myValue->month == 10){ $mon ="oct";}
				if($myValue->month == 11){ $mon ="nov";}
				if($myValue->month == 12){ $mon ="dec";}

				$exp1 = array(
					'name' => $myValue->name,
					'amount' => $myValue->amount,
					'month' => $mon
				);
				array_push($test,$exp1);
			}
		}

		foreach ($exp as $key => $value) 
		{
			foreach ($test as $value1) 
			{
				if($value['name'] == $value1['name'])
				{
					$exp[$key][$value1["month"]]=$value1['amount'];
				}
			}
		}
		
		$data['expense'] =$exp;
		$data['subtotal'] =$subtotalarray;
		$data['grandtotal'] = $this->Report_expense_model->getExpenseTotal($year);
	
		//log_message('debug', print_r($data, true));
		echo json_encode($data);
	}

	/*
       this function used for display Report_expense data graph

     */
	public function getGraph()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		$data=$this->Report_expense_model->getGraphData();
		//log_message('debug', print_r($data, true));
     	print_r(json_encode($data, true));
	
	}

}

