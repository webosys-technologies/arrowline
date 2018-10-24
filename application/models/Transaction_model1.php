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
                INNER JOIN account a ON a.id = t.account_id 
                INNER JOIN expense_category c ON  c.id = t.category_id 
		');                   
        return $result->result();    
    }
}