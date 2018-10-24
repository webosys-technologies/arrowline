<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Report_expense_model extends CI_Model{
    
   protected $table = 'billing';
    function __construct()
    {
        parent::__construct();
    }

    /*
        this function used for get expesne data date wise
    */        

    public function getExpense()
    {
        $this->db->select('SUM(amount) as amount,
                          MONTH(date) as month');
        $this->db->from('expense');
        $this->db->where('delete_status',0);
        $this->db->group_by('MONTH(date)');
        $query=$this->db->get();
        return $query->result();
    }


    /*
        this function used for display expense data 
    */

    public function getData()
    {
        $this->db->select('ec.name,SUM(amount) as amount,MONTH(date) as month');
        $this->db->from('expense e');
        $this->db->join('expense_category ec','ec.id = e.category_id');
        $this->db->where('e.delete_status',0);
        $this->db->where('ec.delete_status',0);
        $this->db->group_by('ec.name,MONTH(e.date)');
        $query=$this->db->get();
        return $query->result();
    }

    public function getTotal()
    {
        $this->db->select('SUM(amount) as total');
        $query = $this->db->get('expense');
        return $query->row();
        
    }

    public function getGraphData()
    {
        $this->db->select('ec.name,SUM(amount) as amount');
        $this->db->from('expense e');
        $this->db->join('expense_category ec','ec.id = e.category_id');
        $this->db->where('e.delete_status',0);
        $this->db->where('ec.delete_status',0);
        $this->db->group_by('ec.name');
        $query=$this->db->get();
        return $query->result();
    }




    /* get expense data for ajax call */

    public function getExpenseData($year)
    {
        $this->db->select('ec.name,SUM(amount) as amount,MONTH(date) as month');
        $this->db->from('expense e');
        $this->db->join('expense_category ec','ec.id = e.category_id');
        $this->db->where('e.delete_status',0);
        $this->db->where('ec.delete_status',0);
        if(!$this->session->userdata('type')=='admin')
        {
            $this->db->where('e.user_id',$this->session->userdata('userId'));
        }
        $this->db->where("DATE_FORMAT(e.date,'%Y')",$year);
        $this->db->group_by('ec.name,MONTH(e.date)');
        $query=$this->db->get();
        return $query->result();
        
    }


    public function getExpenseSubTotal($year)
    {
        $this->db->select('SUM(amount) as amount,
                          MONTH(date) as month');
        $this->db->from('expense');
        $this->db->where('delete_status',0);
        if(!$this->session->userdata('type')=='admin')
        {
            $this->db->where('user_id',$this->session->userdata('userId'));
        }
        $this->db->where("DATE_FORMAT(date,'%Y')",$year);

        $this->db->group_by('MONTH(date)');
        $query=$this->db->get();
        return $query->result();
        
    }

    public function getExpenseTotal($year)
    {
        $this->db->select('SUM(amount) as total');
        $this->db->where("DATE_FORMAT(date,'%Y')",$year);
        if(!$this->session->userdata('type')=='admin')
        {
            $this->db->where('user_id',$this->session->userdata('userId'));
        }
        $query = $this->db->get('expense');
        return $query->row();
        
    }


}