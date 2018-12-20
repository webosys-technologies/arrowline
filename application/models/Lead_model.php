<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead_model extends CI_Model
{
         var $table="lead_customer";
	  public function __construct(){
        parent:: __construct();
    }

    /*
        Get All Bank account Data
    */
    
    public function getall()
    {
            $this->db->from('lead_customer as lead');     
            $this->db->join('customer as cust','cust.id=lead.customer_id','LEFT');
            $data = $this->db->get();
            return $data->result();
          
    }
    
    public function getCity($id)
    {
        $sql="SELECT * FROM cities where id='$id'";
        $query=$this->db->query($sql);
        return $query->row();  
    }
    
    public function getrow($data)
    {
        $this->db->from($this->table);
        $this->db->where($data);
        $query=$this->db->get();
        return $query->row();
    }
    
   public function insert($data)
   {
     
       if($this->db->insert($this->table,$data))
       {
           return $this->db->insert_id();
       }else
       {
           return false;
       }
   }
   
   public function delete($del)
   {
       $sql="UPDATE lead_customer set is_deleted = ? , delete_date = ? WHERE customer_id = ? ";
        if($this->db->query($sql,$del)) {
           
            return true;
        }
        return FALSE;
   }
   
   public function update($customer)
   {
    
       $sql="UPDATE `lead_customer` SET 
            `customer_id`= ?,
            `followup`= ?,
            `nextfollow`= ?,
            `remark`= ?,
            `telecaller`= ?
             WHERE `id` = ?";


        if($this->db->query($sql,$customer))
        {
            return true;
        }else{
            return false;
        }
   }
   
   function query()
   {
     
       $query=$this->db->query('select total_tax from sales_order INNER JOIN customer ON sales_order.customer_id=customer.id');
   
       echo "<pre>";
       print_r($query->result());
   }
}
