<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model
{

	  public function __construct(){
        parent:: __construct();
    }

    /*
        Get All Bank account Data
    */
    public function getAccount()
    {
        $this->db->where('delete_status',0);
        $query=$this->db->get('account');
        return $query->result();  
    }

  public function demo()
  {
      echo "a";
  }
    /*
        Add Bank Account Data 
    */
    public function addAccount($acc)
    {
       if($this->db->insert("account",$acc)){
           return true;
       }
       return false;
    }
   
   /*
        Delete Bank Account Data 
    */
	 public function deleteAccount($del)
	 {
		  $sql="UPDATE account set delete_status = ? , delete_date = ? WHERE id = ? ";
     	if($this->db->query($sql,$del)) {
       
      	   return true;
    	}
     	return FALSE;
	 }

   /*
        Update Bank Account Data 
    */
	 public function editAccount($id,$acc)
	 {
     	$this->db->where('id',$id);
     	if($this->db->update('account',$acc)){
         return true;
     	}
     	return false;	
	 }

  /*
     Get Bank Account Data for Update 
  */
	public function updateAccount($id)
	{	
	  $this->db->select('*'); 
    $this->db->from('account');   
    $this->db->where('id', $id);
    return $this->db->get()->result();
	}
  public function getAllTrasaction($id)
  {
    $result = $this->db->query('SELECT t.date,a.account_name,a.account_no,t.type,c.name,t.description,t.amount
            FROM transaction t 
            LEFT JOIN account a ON a.id = t.account_id 
            LEFT JOIN expense_category c ON  c.id = t.category_id 
            WHERE account_id = '.$id
    );                   
    return $result->result();    
  }

}
