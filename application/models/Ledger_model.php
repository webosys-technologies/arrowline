<?php

class Ledger_model extends CI_Model
{
    public function ledgerFilter($customer,$from,$to)
  {
      
            $this->db->select('s.date as dt,py.description as desc ,s.total_amount as deb , py.amount as cr ');
            $this->db->from('customer c'); 
            $this->db->join('sales s','s.customer_id=c.id');
            $this->db->join('invoice in','in.sales_id=s.id');
            $this->db->join('payment py','py.sales_id=s.id');
//            if(!$this->session->userdata('type')=='admin')
//            {
//              $this->db->where('s.user_id',$this->session->userdata('userId')); 
//            }
            
            if($customer=="all")
            {   
              $this->db->where('s.date >=',$from); 
              $this->db->where('s.date <=',$to); 
            }
            else{
              $this->db->where('c.id="'.$customer.'"');
              $this->db->where('s.date >=',$from); 
              $this->db->where('s.date <=',$to);   
            }
            $this->db->order_by('s.date'); 
            
            $query = $this->db->get();
            return $query->result();   
        
  }
  
  function opening_balance($customer,$from,$to)
  {
      $this->db->select('SUM(sales_amount)- SUM(paid_amount)as ob');
      $this->db->from('customer c');
      $this->db->join('sales s','s.customer_id=c.id');
      $this->db->join('invoice in','in.sales_id=s.id');
      $this->db->where('c.id=',$customer);
      $this->db->where('in.invoice_date <',$from);
      $query=$this->db->get()->result();
      
      return $query;
  }
}