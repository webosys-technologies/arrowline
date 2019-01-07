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
   
   public function addCustomer($customer,$shipping)
   {
       

        $sql="INSERT INTO `customer`(`name`, `email`, `phone`, `street`, `city_id`, `state_id`,`state_code`, `zip_code`, `country_id`,`gstin`,`gst_registration_type`,`user_id`,`follow`,`nextfollow`,`remark`,`telecaller`,`status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?)";

        if($this->db->query($sql,$customer))
        {
             $cust=$this->db->insert_id();
            $sql1="INSERT INTO `shipping_address`(`customer_id`, `street`, `city_id`, `state_id`, `zip_code`, `country_id`,`user_id`) VALUES (?,?,?,?,?,?,?)";
            if($this->db->query($sql1,array($cust,$shipping['street1'],$shipping['city1'],$shipping['state1'],$shipping['zip_code1'],$shipping['country_id'],$shipping['user_id']))){
                return true;
            }
            else
            {
                return false;
            }
        }
       else
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
     
       $query=$this->db->query('ALTER TABLE `customer` ADD `follow` DATE NOT NULL AFTER `country_id`, ADD `nextfollow` DATE NOT NULL AFTER `follow`, ADD `remark` VARCHAR(55) NOT NULL AFTER `nextfollow`, ADD `telecaller` VARCHAR(55) NOT NULL AFTER `remark`');
   
     
   }
}
