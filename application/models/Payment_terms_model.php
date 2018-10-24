<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    class Payment_terms_model extends CI_Model
    {    
    protected $table = 'billing';

    function __construct()
    {
        parent::__construct();

    }

    /*

    this function used for add new payment_terms at insert time

    */
    public function addpaymentTerms($terms)
    {
        /*$sql="INSERT INTO `payment_term`(`term`, `due_days`, `default`) VALUES (?, ?, ?)";*/
        if($this->db->insert("payment_term",$terms))
        {
            return TRUE; 
        }
        else
        {
            return FALSE;
        }
    }
            
    /*

    this function used for fetch payment_terms data

   */
    public function paymenttermsData()
    {
        $this->db->where('delete_status','0');  
        $query=$this->db->get('payment_term');
        return $query->result();    
     }

    /*
        this function used for fetch payment_terms data where delete_status is 0.
    */
    public  function payUserData()
    {
        $this->db->where('delete_status','0');                  
        $data = $this->db->get('payment_term');
        return $data->result();
    } 
     
    /*
        this function used for fetch payment_terms data
    */
    public  function getContents() 
    {
        $this->db->select('*');
        $this->db->from('payment_term');
        $query = $this->db->get();
        return $result = $query->result();
        //$this->load->view('edit_content', $result);
    }
    /*
        this function used for fetch payment_terms data at upadte time
    */
    public  function getData($id) 
    {
        $this->db->select('*');
        $this->db->from('payment_term');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    /*
        this function used for delet payment_terms data
    */
    public function delete($del)
    {
        $sql="UPDATE payment_term set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del)) {
           
            return true;
        }
        return FALSE;
    }

    /*
        this function used for edit payment_terms data at upadte time
    */
    public function editTerms($id,$terms)
    {
        /*$sql="UPDATE `payment_term` SET `term`= ?,`due_days`= ?,`default`= ? WHERE id = ?";*/
        $this->db->where('id',$id);
        if($this->db->update("payment_term",$terms))
        {
            return TRUE;      
        }  
        else{
            return FALSE;
        }
    }
}