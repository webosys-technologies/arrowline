<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('Payment_model','Quotation_model','Invoice_model'));
		$this->load->library(array('form_validation','ion_auth'));
	}

	public function index()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['payment']=$this->Payment_model->getPaymentDetails();
		
		$this->load->view('payment/list',$data);
	}

	/*
		This method generate payment receipt
	*/
	public function receipt($id,$sales_id)
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['payment'] = $this->Payment_model->getPaymentReceiptDetails($id);
		$data['country'] = $this->Quotation_model->companyDetails();
		$data['pay']=$this->Invoice_model->getPaymentData($sales_id);
		/*echo "<pre>";
		print_r($data);
		exit();*/

		$this->load->view('payment/payment_receipt',$data); 
	}

	/*
		This method generate payment print and PGF
	*/
	public function payment_print($id)
	{
		
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data['payment'] = $this->Payment_model->getPaymentReceiptDetails($id);
		$data['country'] = $this->Quotation_model->companyDetails();
		
		/*echo "<pre>";
		print_r($data);
		exit();*/

		ob_start();
	    $html=ob_get_clean();
	    $html=utf8_encode($html);
	   
	    
	    $html=$this->load->view('payment/payment_print',$data,TRUE);
	    require_once(APPPATH.'third_party/mpdf60/mpdf.php');
	    
	    $mpdf=new mPDF();
	    $mpdf->allow_charset_conversion=true;
	    $mpdf->charset_in='UTF-8';
	    $mpdf->WriteHTML($html);
	    $mpdf->output('meu-pdf','I');
	}

	/*
		Send payment Details email
	*/
	function payment_email()
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$to=$this->input->post('email');
		$subject=$this->input->post('subject');
		$description=$this->input->post('message');
        require("class.phpmailer.php");
		$data = $this->Quotation_model->getEmailSetup();
        
        if($data == "" && $data == null)
		{
			$this->session->set_flashdata('success','Please Enter data in email settings');
	        redirect('payment','refresh');
		}
        if($data == "" && $data == null)
		{
			$this->session->set_flashdata('success','Please Enter data in email settings');
	        redirect('payment','refresh');
		}
		
	 	$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = $data->host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = $data->port;
        $mail->Username = $data->username;
        $mail->Password = $data->password;
        $mail->From = $data->email;
        $mail->FromName = $data->name;
        $mail->AddAddress($to);
        //$mail->AddReplyTo("mail@mail.com");
        //$this->mail->to('$email');
        $mail->IsHTML(true);
        
        $mail->Subject = $subject;
        $mail->Body =$description;
        //$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        
        if(!$mail->Send())
        {
            //echo "mail coundn't sent";
            $this->session->set_flashdata("success","Email couldn't send!!");
			redirect('payment');
        }
        else
        {
           
           $this->session->set_flashdata("success","Email sent successfully please check your email !!");
				redirect('payment');
           
        }
	}

	/*
		This method is call when End user Delete sales data
	*/
	function delete($id)
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

		$data=array(
			'delete_status' => 1,
			'delete_date' => date('Y-m-d'),
			'id' => $id
		);

		if($this->Payment_model->deletePayment($data))
		{
			$this->session->set_flashdata('success', 'Payment Deleted successfully.');
            redirect("payment",'refresh');
		}
	}

}