<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Category_model extends CI_Model
{
		
  	public function __construct(){
        parent:: __construct();
    }

  	/*   Category Model Method Done By Avantika*/

    /*
      Get Unit and category join Data
    */
    public function getUnit()
    {
        return $this->db->select('*')
                 ->from('unit u')
                 ->join('category c','c.unit=u.id')
                 ->where('c.delete_status',0)
                 ->get()
                 ->result();
    }

      

  

    public function addCategory($cat)
   {

      /*$sql="INSERT INTO `category`(
            `category_name`,
             `unit`
             ) VALUES (?,?)";*/
       if($this->db->insert("category",$cat)){
           return true;
       }
       return false;
   }
     
    /*
        Get Category Data for update 
    */
    public function updateCategory($id)
    {
      
      $this->db->select('*'); 
        $this->db->from('category');   
        $this->db->where('id', $id);
        return $this->db->get()->row();
        /*echo "<pre>";
        print_r($data);exit();
        echo "</pre>";*/
    }

    /*
      Get All Units Data
    */
    public function getUnits()
    {

      $query=$this->db->get('unit');
      return $query->result();
    }

    /*
        Update Category Data 
    */
    public function editCategory($id,$cat)
    {
      
        $this->db->where('id',$id);
        $this->db->update('category',$cat);

    }

    /*
        Delete Category Data 
    */
    public function deleteCategory($del)
    {
         $sql="UPDATE category set delete_status = ? , delete_date = ? WHERE id = ? ";
         if($this->db->query($sql,$del)) {
           
             return true;
         }
         return FALSE;
    }
}
    /*   End Category Model Method Done By Avantika*/