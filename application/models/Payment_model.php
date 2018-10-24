<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }

    function getPaymentDetails()
    {
        if($this->session->userdata('type')=='admin')
        {
            $query=$this->db->select('p.id as payment_id,p.payment_no,s.id as sales_id,s.reference_no,i.id as invoice_id,c.id as customer_id,c.name as cust_name,pm.name as payment_method,p.amount,p.payment_date,p.status')
            ->from('payment p')
            ->join('sales s','s.id = p.sales_id')
            ->join('invoice i','i.sales_id = s.id')
            ->join('customer c','c.id = s.customer_id')
            ->join('payment_method pm','pm.id = p.payment_method_id')
            ->where('p.delete_status',0)
            ->get();
            return $query->result();
        }
        else
        {   
            $query=$this->db->select('p.id as payment_id,p.payment_no,s.id as sales_id,s.reference_no,i.id as invoice_id,c.id as customer_id,c.name as cust_name,pm.name as payment_method,p.amount,p.payment_date,p.status')
            ->from('payment p')
            ->join('sales s','s.id = p.sales_id')
            ->join('invoice i','i.sales_id = s.id')
            ->join('customer c','c.id = s.customer_id')
            ->join('payment_method pm','pm.id = p.payment_method_id')
            ->where('p.delete_status',0)
            ->where('p.user_id',$this->session->userdata('userId'))
            ->get();
            return $query->result();
        }

    	
         
    }


    function getPaymentReceiptDetails($id)
    {
        $query=$this->db->select('p.id as payment_id,p.payment_no,s.id as sales_id,s.reference_no,i.id as invoice_id,i.invoice_date,i.sales_amount,i.paid_amount,c.id as customer_id,c.*,ct.id as cust_city_id,ct.name as cust_city,st.id as cust_state_id,st.name as cust_state,con.name as country_name,c.name as cust_name,pm.name as payment_method,p.amount,p.payment_date,p.status')
            ->from('payment p')
            ->join('sales s','s.id = p.sales_id','left')
            ->join('invoice i','i.sales_id = s.id','left')
            ->join('customer c','c.id = s.customer_id','left')
            ->join('payment_method pm','pm.id = p.payment_method_id','left')
            ->join('countries con','con.id=c.country_id','left')
            ->join('states st','st.id=c.state_id','left')
            ->join('cities ct','ct.id=c.city_id','left')
            ->where('p.id',$id)
            ->get();
           /* echo "<pre>";
            print_r($query->result());exit();*/
        return $query->result();
    }

    public function deletePayment($data)
    {
      /*  echo "<pre>";
        print_r($data);
        exit();*/
        $sql="UPDATE payment SET delete_status= ? , delete_date = ? WHERE id = ?";
        if($this->db->query($sql,$data)) {
            return true;
        }
        return FALSE;
    }

}