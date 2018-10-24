<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Incomevsexpense extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Income_vs_Expense_model');	
		$this->load->library(array('form_validation','ion_auth'));
	}

	/*

    this function used for display  income_vs_expense list form

    */
	public function index()
	{
		//$data['expense']=$this->Income_vs_Expense_model->get_Data();
		$data['expense']=$this->Income_vs_Expense_model->getExpense();
		$data['income']=$this->Income_vs_Expense_model->getIncome();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('reports/income_expense',$data);	
	}

	/*

    this function used for getGraph of income_vs_expense 

    */
	public function getData()
	{
		$data=$this->Income_vs_Expense_model->get_Data();
     	print_r(json_encode($data, true));
		
	}

	public function income_filter()
    {
    	if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $year=$this->input->post('year1');     
        $expensedata=$this->Income_vs_Expense_model->expense($year);
        $incomedata=$this->Income_vs_Expense_model->income($year);

        $data = array();

		foreach ($expensedata as $key => $expense) 
		{	
			$mon = "";
			if($expense->month == 1)
			{
				$mon ="jan";
				$data[$mon]=$expense->amount;
			}

			if($expense->month == 2)
			{
			 	$mon ="feb";
			 	$data[$mon]=$expense->amount;
			}
			if($expense->month == 3)
			{ 
				$mon ="mar";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 4)
			{ 
				$mon ="apl";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 5)
			{ 
				$mon ="may";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 6)
			{ 
				$mon ="jun";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 7)
			{ 
				$mon ="july";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 8)
			{ 
				$mon ="aug";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 9)
			{ 
				$mon ="sept";
				$data[$mon]=$expense->amount;	
			}
			if($expense->month == 10)
			{ 
				$mon ="oct";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 11)
			{ 
				$mon ="nov";
				$data[$mon]=$expense->amount;
			}
			if($expense->month == 12)
			{ 
				$mon ="dec";
				$data[$mon]=$expense->amount;
			}
		}

		$temp = array();

		foreach ($incomedata as $key => $income) 
		{	
			$mon = "";
			if($income->month == 1)
			{
				$mon ="jan";
				$temp[$mon]=$income->amount;
			}

			if($income->month == 2)
			{
			 	$mon ="feb";
			 	$temp[$mon]=$income->amount;
			}
			if($income->month == 3)
			{ 
				$mon ="mar";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 4)
			{ 
				$mon ="apl";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 5)
			{ 
				$mon ="may";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 6)
			{ 
				$mon ="jun";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 7)
			{ 
				$mon ="july";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 8)
			{ 
				$mon ="aug";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 9)
			{ 
				$mon ="sept";
				$temp[$mon]=$income->amount;	
			}
			if($income->month == 10)
			{ 
				$mon ="oct";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 11)
			{ 
				$mon ="nov";
				$temp[$mon]=$income->amount;
			}
			if($income->month == 12)
			{ 
				$mon ="dec";
				$temp[$mon]=$income->amount;
			}
		}

		$data1['expense'] = $data;
		$data1['income'] = $temp;
       	echo json_encode($data1);
    }



}

