<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    class Staff_model extends CI_Model
    {
       protected $table = 'billing';
       function __construct()
       {
         parent::__construct();
       }
    /*

    this function used for add new supplier record

    */
    public function addStaff($staff)
    {
        
        $sql="INSERT INTO `staff`(`name`, `email`, `phone`, `street`, `city_id`, `state_id`,`state_code`, `zipcode`, `country_id`,`gstin`,`user_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($this->db->query($sql,$staff))
        {
            return true; 
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


  public function getStateCode($id=null)
    {
        
        /*$data=$this->db->query("SELECT * from state_code WHERE state_id=$id");
        return $data->result();*/
          $this->db->where('state_id',$id);
          return $this->db->get('state_code')->row()->tin_number;

    }
  

  /* ----------------------------------------------------------*/
  /*
        Get Partucular country state Data
  */ 
   public function getStateByID($country_id)
  {   

      return $this->db->where('country_id',$country_id)->get('states')->result();
  }


  /*
        Get All city Data
  */ 
  
   public function getCityByID($state_id)
  {
      return $this->db->where('state_id',$state_id)->get('cities')->result();
  }
  /* ------------------------------------------------------------------*/



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

       this function used for display supplier data

    */
     public function supplierData()
     {   
         return $this->db->get('supplier')->result();
     }         
    

     /*

       this function used for display supplier data where delete_status is 0.

    */
      public  function staffUserData()
      {
          if($this->session->userdata('type')=='admin')
          {
              $this->db->where('delete_status','0');                  
              $data = $this->db->get('staff');
              return $data->result();
          }
          else
          {
              $this->db->where('delete_status','0');                  
              $this->db->where('user_id',$this->session->userdata('userId'));                  
              $data = $this->db->get('staff');
              return $data->result();
          }   
       } 

        /*

         this function used for get content of supplier at update time

       */
       public  function getContents() 
       {
          $this->db->select('*');
          $this->db->from('supplier');
          $query = $this->db->get();
          return $result = $query->result();
          $this->load->view('edit_data', $result);
       }

        /*

         this function used for fetch data of supplier at update time

       */
       public  function editData($id) 
       {
          $data=$this->db->query("SELECT s.*,(st.name) as state_name,(c.name) as city_name FROM `staff` as s 
            INNER JOIN states as st ON st.id=s.state_id
            INNER JOIN cities as c ON c.id=s.city_id
              WHERE s.id='".$id."'");
          return $data->row();             
       }

   /*
 
    this function used for update supplier details

    */
    public function editStaff($staff)
    {
      
        $sql="UPDATE `staff` SET 
            `name`= ? ,
            `email`=? ,
            `phone`= ?,
            `street`= ?,
            `city_id`= ?,
            `state_id`= ?,
            `state_code`= ?,
            `zipcode`=?,
            `country_id`=?,
            `gstin`=? ,
            `user_id` =?
            WHERE id = ?";

        if($this->db->query($sql,$staff)){
            return true;  
        }
       
        return false;
    }
    
     /*

    this function used for delete supplier details

    */
    public function deleteStaff($del)
    {
        $sql="UPDATE staff set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del)) {
           
            return true;
        }
        return FALSE;
    }

   
    
    /*

    this function used for get total supplier where status is 1. 

    */
   public function getstaff()
   {
      $sql="SELECT count(id) AS total FROM staff where status=1 ";
      $query=$this->db->query($sql);
      return $query->row();       
   }
   
   /*

    this function used for get total Active supplier where status is 1. 

    */
   public function getStatus()
   {
      $sql="SELECT count(status) AS Active  FROM staff where delete_status=0 ";
      $query=$this->db->query($sql);
      return $query->row();      
   }

   /*

    this function used for get total Deactive supplier where status is 1. 

    */
   public function getDeactive()
   {
      $sql="SELECT count(status) AS Deactive  FROM staff where delete_status=1 ";
      $query=$this->db->query($sql);
      return $query->row();      
   }

   /*

    this function used for import supplier data where delete status is 0.

    */
    public  function importData()
    {
        return $this->db->SELECT('s.name, s.email, s.phone, s.street, (c.name) AS city_name, (st.name) as state_name, s.zipcode, (a.name) as country_name,s.gstin')
            ->FROM('supplier s')
            ->JOIN('countries AS a','a.id = s.country_id')
            ->JOIN('states AS st','st.id = s.state_id')
            ->JOIN('cities AS c','c.id = s.city_id')
            ->get()
            ->row();
    } 
 }