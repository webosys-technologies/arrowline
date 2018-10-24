<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Transaction_model extends CI_Model{
   
    function __construct()
    {
        parent::__construct();

    }
    
     /*

         this function used for get Transaction data 

     */ 
    public function getTransaction()
    {
        $result = $this->db->query('SELECT t.date,a.account_name,a.account_no,t.type,c.name,t.description,t.amount
                FROM transaction t 
                LEFT JOIN account a ON a.id = t.account_id 
                LEFT JOIN expense_category c ON  c.id = t.category_id ORDER BY t.date desc
		');                   
        return $result->result();    
    }

    public function getAccount()
    {
        $result = $this->db->query('SELECT id,account_name
                FROM account WHERE delete_status = 0');                   
        return $result->result();    
    }

    public function transactionFilter($account,$from,$to)
    {
            $this->db->select('t.date,a.account_name,a.account_no,t.type,c.name,t.description,t.amount');
            $this->db->from('transaction t '); 
            $this->db->join('account a','a.id = t.account_id ');
            $this->db->join('expense_category c','c.id = t.category_id');
            if($account == "all"){
                $this->db->where('t.date >=',$from); 
                $this->db->where('t.date <=',$to); 
            }
            else{
                $this->db->where('t.date >=',$from); 
                $this->db->where('t.date <=',$to);    
                $this->db->where('account_id="'.$account.'"');
            }
            $this->db->order_by("t.date", "desc");
            $query = $this->db->get();
            return $query->result();
    }




}