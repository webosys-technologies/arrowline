<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customer_model extends CI_Model
{
    
    protected $table = 'billing';

    function __construct()
    {
        parent::__construct();

    }

    public function getCountryID($id)
    {
        return $this->db->select('country_id')->where('id',$id)->get('customer')->row();
    }    

    public function getShippingCountryID($id)
    {
        return $this->db->select('country_id')->where('customer_id',$id)->get('shipping_address')->row();
    }

    

    public function getStateID($id)
    {
        return $this->db->select('state_id')->where('id',$id)->get('customer')->row();
    }

    public function getShippingStateID($id)
    {
        return $this->db->select('state_id')->where('customer_id',$id)->get('shipping_address')->row();
    }    

     /*

    this function used for add new customer record

    */
    public function addCustomer($customer,$shipping)
    {

        /*if($this->db->insert($customer))
        {
            $cust=$this->db->insert_id();
            if($this->db->insert())
        }*/



        $sql="INSERT INTO `customer`(`name`, `email`, `phone`, `street`, `city_id`, `state_id`,`state_code`, `zip_code`, `country_id`,`gstin`,`gst_registration_type`,`user_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)";

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

     /*
          Get All Country Data
    */     
    public function dataCountry()
    {
      return $this->db->get('countries')->result();
    }


    /*
          Get All state Data
    */ 
    public function dataState()
    {
          return $this->db->get('states')->result();
    }


    /*
          Get All city Data
    */ 
    
    public function dataCity()
    {
        return $this->db->get('cities')->result();
    }

    /*
          Get All state Data
    */ 
    public function getState($id = null)
    {      
      $data=$this->db->query("SELECT s.* FROM `states` as s 
              WHERE s.country_id='".$id."'");
              return $data->result(); 
    }

     /*
          Get All city Data
    */ 
     public function getCity($id = null)
     {
        $data=$this->db->query("SELECT c.* FROM `cities` as c 
                WHERE c.state_id='".$id."'");
                return $data->result();
    }
    
     /*

    this function used for get customer data from database

    */
    public function customerData()
    {
     $this->db->where('delete_status','0');   
       $query=$this->db->get('customer');
        return $query->result();    
    }

     /*

    this function used for get customer where delete status is 0.

    */
    public  function custUserData()
    {

        if($this->session->userdata('type')=='admin')
        {
            $this->db->where('delete_status','0');                  
            $data = $this->db->get('customer');
            return $data->result();
        }
        else{
            $this->db->where('delete_status','0');                  
            $this->db->where('user_id',$this->session->userdata('userId'));                  
            $data = $this->db->get('customer');
            return $data->result();   
        }
        
    } 

    /*

    this function used for import customer data where delete status is 0.

    */
    public  function importData()
    {
        //$this->db->where('c.delete_status','0');                  
        $data=$this->db->query("SELECT c.name, c.email, c.phone, c.street, (ct.name) as city_name, (s.name) as state_name, c.zip_code, (a.name) as country_name, c.gstin,c.gst_registration_type
                        FROM customer AS c
                        INNER JOIN countries AS a ON  c.country_id = a.id
                        INNER JOIN cities AS ct ON  ct.id = c.city_id
                        INNER JOIN states AS s ON  s.id = c.state_id
                        WHERE c.delete_status=0");
                        return $data->row();
    } 

     /*

    this function used for get content of customer at update time

    */
    public  function getContents() 
    {
        $this->db->select('*');
        $this->db->from('customer');
        $query = $this->db->get();
        return $result = $query->result();
        $this->load->view('edit_data', $result);
    }

     /*

    this function used for fetch data of customer at update time

    */
    public  function getData($id) 
    {
        $query="SELECT c.*,(ct.name) as city_name, (s.name) as state_name, c.zip_code, (a.name) as country_name
                        FROM customer AS c
                        LEFT JOIN countries AS a ON  c.country_id = a.id
                        LEFT JOIN cities AS ct ON  ct.id = c.city_id
                        LEFT JOIN states AS s ON  s.id = c.state_id
                         WHERE c.id='".$id."'";
                $result = $this->db->query($query);
                 return $result->row();
        
    }


     /*

    this function used for fetch data of shipping at update time

    */
    public function getShipping($id)
    {
         $query="SELECT sh.*,(ct.name)as city_name,(s.name)as state_name,sh.zip_code,(a.name)as country_name FROM `shipping_address` as sh
                        LEFT JOIN countries AS a ON  a.id = sh.country_id
                        LEFT JOIN cities AS ct ON  ct.id = sh.city_id
                        LEFT JOIN customer AS cu ON  cu.id = sh.customer_id
                        LEFT JOIN states AS s ON  s.id = sh.state_id
                         WHERE customer_id='".$id."'" ;
                 $result = $this->db->query($query);
                 return $result->row();
    }
    
    /*

    this function used for update customer details

    */
    public function editCustomer($customer,$shipping)
    {
       
       
        $sql="UPDATE `customer` SET 
            `name`= ?,
            `email`= ?,
            `phone`= ?,
            `street`= ?,
            `city_id`= ?,
            `state_id`= ?,
            `state_code`= ?,
            `zip_code`= ?,
            `country_id`= ?, 
            `gstin`= ?,
            `gst_registration_type` = ?,
            `user_id` = ?
            WHERE id = ?";


        if($this->db->query($sql,$customer))
        {
           
            $sql1="UPDATE `shipping_address` SET 
                `customer_id`= ?,
                `street`= ?,
                `city_id`= ?,
                `state_id`= ?,
                `zip_code`= ?,
                `country_id`=?,
                `user_id`=?
                 WHERE `id` = ?";


          if($this->db->query($sql1,$shipping)){
          
                return true;
            }
            else
            {
                return false;
            }
        }
       
        return false;
    }
    
     /*

    this function used for delete customer details

    */
    public function deleteCustomer($del)
    {
        $sql="UPDATE customer set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del)) {
           
            return true;
        }
        return FALSE;
    }

     /*

    this function used for get customer by id

    */
    public function getCustomerById($id)
    {
       $this->db->select('c.name,s.*');
       $this->db->from('customer s');
       $this->db->join('countries c','c.id=s.country_id');
       $q = $this->db->get_where('customer', array('s.id' => $id), 1); 
       if( $q->num_rows() > 0 )
       {   
           return $q->row();
       } 
   
       return FALSE;
   }


     /*

    this function used for get customer by id

    */
    public function getshippingById($id)
    {
       $this->db->select('c.name,s.*');
       $this->db->from('shipping_address s');
       $this->db->join('countries c','c.id=s.country_id');
       $q = $this->db->get_where('customer', array('s.id' => $id), 1); 
       if( $q->num_rows() > 0 )
       {   
           return $q->row();
       } 
   
       return FALSE;
   }


    /*

    this function used for get total customer where status is 1. 

    */
   public function getCustomer()
   {

    $sql="SELECT count(id) AS total FROM customer where status=1";
    $query=$this->db->query($sql);
    return $query->row();       
   }
   public function leadCustomer()
   {

    $sql="SELECT count(id) AS total FROM lead_customer where status=1";
    $query=$this->db->query($sql);
    return $query->row();       
   }
   
   /*

    this function used for get total Active customer where status is 1. 

    */
   public function getStatus()
   {

    $sql="SELECT count(status) AS Active  FROM customer where delete_status=0 ";
    $query=$this->db->query($sql);
    return $query->row();      
   }

   /*

    this function used for get total Deactive customer where status is 1. 

    */
   public function getDeactive()
   {

    $sql="SELECT count(status) AS Deactive  FROM customer where delete_status=1 ";
    $query=$this->db->query($sql);
    return $query->row();      
   }
}
?>