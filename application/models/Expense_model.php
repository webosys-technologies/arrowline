<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Expense_model extends CI_Model
{
    protected $table = 'billing';

    function __construct()
    {
        parent::__construct();
    }

    /*
        this function used for add new expense record
    */
    public function addExpanses($expenses)
    {  
       /*$sql="INSERT INTO `expense`(`account_id`, `date`, `description`, `amount`, `category_id`, `payment_method_id`, `bank_name` , `cheque_no`, `reference_no`) VALUES (?, ?, ?, ?, ?, ?, ? ,? , ?)";*/

        if($this->db->insert("expense",$expenses)){
                return true; 
        }
        else{
            return false;
        }
    }

     /*

       this function used for display expense data

    */
    public function expensesData()
    {
       $this->db->where('delete_status','0');   
       $query=$this->db->get('expense');
        return $query->result();    
    }

     /*

       this function used for display expense data where delete_status is 0.

    */
    public  function expUserData()
    {               
        if($this->session->userdata('type')=='admin')
        {
            $user_id = $this->session->userdata('userId');
            $result = $this->db->query("SELECT e.id,a.account_name, a.account_no,
                      e.description,  e.amount, e.date FROM expense AS e
                      INNER JOIN account as a ON a.id = e.account_id 
                      WHERE e.delete_status=0");
            return $result->result(); 
        }
        else{
            $user_id = $this->session->userdata('userId');
            $result = $this->db->query("SELECT e.id,a.account_name, a.account_no,
                      e.description,  e.amount, e.date FROM expense AS e
                      INNER JOIN account as a ON a.id = e.account_id 
                      WHERE e.delete_status=0 AND e.user_id=$user_id");
            return $result->result(); 
        }   
    } 

     /*

       this function used for get account data 

    */
    public function getAccount()
    {
         $query=$this->db->get('account');
        return $query->result();    
    }

     /*

       this function used for get payment data 

    */
    public function getPayment()
    {
         $query=$this->db->get('payment_method');
        return $query->result();    
    }

     /*

       this function used for get category data 

    */
    public function getCategory()
    {
        $this->db->where('delete_status',0);
        $this->db->where('type','expense');
        $query=$this->db->get('expense_category');
        return $query->result();    
    }

     /*

       this function used for get last insert id  

    */
    public function getLastID()
    {
       $sql1="SELECT id FROM  `expense` ORDER BY `id` DESC LIMIT 1";
       $query=$this->db->query($sql1);
       if( $query->num_rows() > 0 )
       {
           return $query->row()->id;      
       } 
       return FALSE;
    }  

     /*

       this function used for fetch data 

    */
    public  function getContents() 
    {
        $this->db->select('*');
        $this->db->from('expense');
        $query = $this->db->get();
        return $result = $query->result();
        $this->load->view('edit_content', $result);
    }

    /*

       this function used for fetch data at update time

    */
    public  function getData($id) 
    {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
            
    }

    /*

       this function used for delete expense data 

    */
    public function delete($del)
    {
        $sql="UPDATE expense set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del))
        {
           
            return true;
        }
        return FALSE;
    }

    /*

    this function used for update expense details

    */
    public function editExpanses($id,$expenses)
    {

        /*echo "<pre>";
        print_r($expenses);exit();*/
       
        /*$sql="UPDATE `expense` SET 
            `account_id`= ? ,
            `date`= ?,
            `description`= ?,
            `amount`= ?,
            `category_id`= ?,
            `payment_method_id`= ?,
            `bank_name`= ?,
            `cheque_no`= ?,
            `reference_no`= ?
            WHERE id = ?";*/
        $this->db->where('id',$id);
        if($this->db->update("expense",$expenses))
        {
            return true;
        }
        
        return FALSE;
    }

}
