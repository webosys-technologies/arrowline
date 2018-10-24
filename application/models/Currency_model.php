<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Currency_model extends CI_Model
{
   protected $table = 'billing';
    function __construct()
    {
        parent::__construct();

    }

    /*

    this function used for add new currency record

    */

    public function addCurrency($currency)
    {
        /*$sql=" INSERT INTO `currency`(`name`, `symbol`) VALUES (?, ?)";*/
        if($this->db->insert("currency",$currency))
        {
                return true; 
        }
        else
        {
            return false;
        }
    }

     /*
        this function used for get currency data from database
    */
    public function currencyData()
    {
      $this->db->where('delete_status','0');  
       $query=$this->db->get('currency');
        return $query->result();    
    }

     /*

    this function used for display currency data from database where delete_status is 0

    */
    public  function payUserData()
    {
        $this->db->where('delete_status','0');                  
        $data = $this->db->get('currency');
       return $data->result();
    } 

    /*

    this function used for get content of currency data from database

    */
    public  function getContents() 
    {
        $this->db->select('*');
        $this->db->from('currency');
        $query = $this->db->get();
        return $result = $query->result();
        $this->load->view('edit_content', $result);
     }

    /*

    this function used for fetch data of customer at update time

    */
    public  function getData($id) 
    {
        $this->db->select('*');
        $this->db->from('currency');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

      /*

    this function used for delete currency details

    */
     public function delete($del)
     {
        $sql="UPDATE currency set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del)) 
        {
            return true;
        }
        return FALSE;
    }

    /*

    this function used for update currency details

    */
    public function editcurrency($id,$currency)
    {
    
        /*$sql="UPDATE `currency` SET `name`= ?,`symbol`= ? WHERE id = ?";*/
        $this->db->where('id',$id);
        if($this->db->update("currency",$currency)){
            return TRUE;
        }
        return FALSE;
    }

 }