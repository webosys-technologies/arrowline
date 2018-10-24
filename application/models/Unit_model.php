<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Unit_model extends CI_Model
{
		
  	public function __construct(){
        parent:: __construct();
    }

    /*
      Get All Units Data
    */
    public function getUnits()
    {
      $this->db->where('delete_status',0);
      $query=$this->db->get('unit');
      return $query->result();
    }

    /*----------------------------------------------------------------------*/
    /*--------------- Unit Module Method Done By Avantika ------------------*/
    /*----------------------------------------------------------------------*/


    /*
        Get All Units Data
    */
   public function addUnit($unit)
   {

    /*$sql="INSERT INTO `unit`(
            `unit_name`,
             `abbr`
             ) VALUES (?,?)";*/
       if($this->db->insert("unit",$unit)){
           return true;
       }
       return false;
   }


    /*
     Get Unit Data for Update 
    */  
    public function updateUnit($id)
    {
      
      $this->db->select('*'); 
        $this->db->from('unit');   
        $this->db->where('id', $id);
        return $this->db->get()->result();
        /*echo "<pre>";
        print_r($data);exit();
        echo "</pre>";*/
    }

    /*
      Update Unit Data 
    */
    public function editUnit($id,$unit)
    {
      /*print_r($unit);
      exit();*/
      $this->db->where('id',$id);
      $this->db->update('unit',$unit);
    }

    /*
        Delete Unit Data 
    */
    public function deleteUnit($del)
    {
      $sql="UPDATE unit set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del)) {
         
             return true;
         }
          return FALSE;
    }


    /*----------------------------------------------------------------------*/
    /*--------------- End Unit Module Method Done By Avantika --------------*/
    /*----------------------------------------------------------------------*/
}