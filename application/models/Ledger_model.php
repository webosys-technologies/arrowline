<?php

class Ledger_model extends CI_Model
{
    
    public function getSupplier()
    {
     $this->db->select('*');
     $this->db->from('supplier');
     $query=$this->db->get();
     return $query->result();
     
    }
    public function ledgerFilter($customer,$from,$to)
  {
      
            $this->db->select('*');
            $this->db->from('cust_ledger as c'); 
//            $this->db->join('sales s','s.customer_id=c.id');
//            $this->db->join('invoice in','in.sales_id=s.id');
//            $this->db->join('payment py','py.sales_id=s.id');
//            if(!$this->session->userdata('type')=='admin')
//            {
//              $this->db->where('s.user_id',$this->session->userdata('userId')); 
//            }
            
            if($customer=="all")
            {   
              $this->db->where('c.date >=',$from); 
              $this->db->where('c.date <=',$to); 
            }
            else{
              $this->db->where('c.cust_id="'.$customer.'"');
              $this->db->where('c.date >=',$from); 
              $this->db->where('c.date <=',$to);   
            }
            $this->db->order_by('c.date'); 
            
            $query = $this->db->get();
            return $query->result();   
        
  }
  
   public function ledgerFilter1($customer,$from,$to)
  {
      
            $this->db->select('s.date as dt, ,in.sales_amount as sm');
            $this->db->from('customer c'); 
            $this->db->join('sales s','s.customer_id=c.id');
            $this->db->join('invoice in','in.sales_id=s.id');
//            $this->db->join('payment py','py.sales_id=s.id');
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
  public function supplierFilter($supplier,$from,$to)
  {
      
            $this->db->select('p.date as dt,p.refrence_no as desc ,p.total_amount as tm');
            $this->db->from('supplier s'); 
            $this->db->join('purchase p','p.supplier_id=s.id');
//            $this->db->join('invoice in','in.sales_id=s.id');
//            if(!$this->session->userdata('type')=='admin')
//            {
//              $this->db->where('s.user_id',$this->session->userdata('userId')); 
//            }
            
            if($supplier=="all")
            {   
              $this->db->where('p.date >=',$from); 
              $this->db->where('p.date <=',$to); 
            }
            else{
              $this->db->where('s.id="'.$supplier.'"');
              $this->db->where('p.date >=',$from); 
              $this->db->where('p.date <=',$to);   
            }
            $this->db->order_by('p.date'); 
            
            $query = $this->db->get();
            return $query->result();   
        
  }
  
  function opening_balance($customer,$from,$to)
  {
      $this->db->select('SUM(debit)- SUM(credit)as ob');
      $this->db->from('cust_ledger as c');
//      $this->db->join('sales s','s.customer_id=c.id');
//      $this->db->join('invoice in','in.sales_id=s.id');
      $this->db->where('c.id=',$customer);
      $this->db->where('c.date <',$from);
      $query=$this->db->get()->result();
      
      return $query;
  }
  
  function add_custledger($data)
  {
      $this->db->insert('cust_ledger',$data);
      return $this->db->insert_id();
  }
}