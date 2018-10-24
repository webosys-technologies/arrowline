<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Location_model extends CI_Model
{
		
  	public function __construct(){
        parent:: __construct();
    }
    
     /*
        Get All Location data 
    */
     public function getLocation()
     {

        if($this->session->userdata('type')=='admin')
        {
            $this->db->where('delete_status',0);
            $query=$this->db->get('location');
            return $query->result();
        }
        else{
            $this->db->where('delete_status',0);
            $this->db->where('user_id',$this->session->userdata('userId'));
            $query=$this->db->get('location');
            return $query->result();
        }
     }

     /*
          Add New Location 
      */
     public function addLocation($location)
     {
        /*$sql="INSERT INTO `location`(
              `location_name`,
               `location_code`,
               `delivery_address`,
               `phone`,
               `fax`,
               `email`,
               `contact_person`
               ) VALUES (?,?,?,?,?,?,?)";*/
         if($this->db->insert("location",$location)){
             return true;
         }
         return false;
     }

    /*
        Delete Location 
    */
    public function deleteLocation($del)
    {
         $sql="UPDATE location set delete_status = ? , delete_date = ? WHERE id = ? ";
         if($this->db->query($sql,$del)) {
           
             return true;
         }
         return FALSE;
    }

    /*
        Get location data for update 
    */
    public function updateLocation($id)
    {
      
      $this->db->select('*'); 
        $this->db->from('location');   
        $this->db->where('id', $id);
        return $this->db->get()->row();
        /*echo "<pre>";
        print_r($data);exit();
        echo "</pre>";*/
    }

    /*
        Update Location data 
    */
    public function editLocation($id,$location)
    {
        $this->db->where('id',$id);
        if($this->db->update('location',$location))
        {
            return true;   
        }
        return false;
    }
}   


