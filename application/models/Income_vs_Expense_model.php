<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Income_vs_Expense_model extends CI_Model{
    
   protected $table = 'billing';

      function __construct()
      {
          parent::__construct();
      }

      /*
       this function used for fetch expense data date wise
      */         
      public function getExpense()
      {

         $this->db->select('SUM(amount) as amount,
                            MONTH(date) as month');
          $this->db->from('expense');
          if(!$this->session->userdata('type')=='admin')
          {
            $this->db->where('user_id',$this->session->userdata('userId'));
          }
          $this->db->group_by('MONTH(date)');
          $query=$this->db->get();
          return $query->result();
      }
     
      /*

       this function used for fetch income of sales data date wise

     */
     public function getIncome()
     {
        
          $this->db->select('SUM(total_amount) as amount,
                            MONTH(date) as month');
          $this->db->from('sales');
          if(!$this->session->userdata('type')=='admin')
          {
            $this->db->where('user_id',$this->session->userdata('userId'));
          }
          $this->db->group_by('MONTH(date)');
          $query=$this->db->get();
          return $query->result();
        
    }

      /*

       this function used for fetch expense data 

     */
     public function get_Data()
     {
          $this->db->select('SUM(amount) as amount');
          $this->db->from('expense');
          $query=$this->db->get();
          return $query->result();
     }


     /*
       this function used for fetch expense data for perticular year
      */         
      public function expense($year)
      {
         $this->db->select('SUM(amount) as amount,MONTH(date) as month');
          $this->db->from('expense');
          if(!$this->session->userdata('type')=='admin')
          {
            $this->db->where('user_id',$this->session->userdata('userId'));
          }
          $this->db->where('YEAR(date)',$year);
          $this->db->group_by('MONTH(date)');
          $query=$this->db->get();
          return $query->result();
      }

      /*
       this function used for fetch income of particular year
     */
     public function income($year)
     {
          $this->db->select('SUM(total_amount) as amount,MONTH(date) as month');
          $this->db->from('sales');
          $this->db->where('YEAR(date)',$year);
          if(!$this->session->userdata('type')=='admin')
          {
            $this->db->where('user_id',$this->session->userdata('userId'));
          }
          $this->db->group_by('MONTH(date)');
          $query=$this->db->get();
          return $query->result();
    }
}
