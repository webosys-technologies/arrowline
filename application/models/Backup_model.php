<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Backup_model extends CI_Model
{	
	public function __construct(){
    	parent:: __construct();
    }

    public function getBackup()
    {
    	return $this->db->where('delete_status',0)->get('backup')->result();
    }

    public function add($data)
    {
    	if($this->db->insert('backup',$data))
    	{
    		$id = $this->db->insert_id();
    		return $this->db->select('name')->where('id',$id)->get('backup')->row();
    	}
    	return false;
    }

    public function deleteBackup($del,$id)
	{

		/*$sql="UPDATE item set delete_status = ? , delete_date = ? WHERE id = ? ";
       	if($this->db->query($sql,$del)) {
         
        	   return true;
      	 }
       		return FALSE;*/
       	$this->db->where('id',$id);
       	if($this->db->update('backup',$del))
       	{
       		return true;
       	}
       	else
       	{
       		return false;
       	}
	}


}
