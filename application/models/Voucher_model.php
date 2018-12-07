<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Voucher_model extends CI_Model
{
	
	
	public function __construct(){
        parent:: __construct();
   }
   
   public function add($acc)
   {

   	/*$sql="INSERT INTO `bank_account_transfer`(
   		`from_account_id`,
      `to_account_id`,
		  `date`,
		  `description`,
		  `amount`,
      `payment_method_id`,
      `bank_name`,
		  `cheque_no`,
		  `reference_no`
            ) VALUES (?,?,?,?,?,?,?,?,?)";*/

       if($this->db->insert("voucher",$acc)){
           return true;
       }
       return false;

   }
   
    public function addTransaction($transaction)
   {
      if($this->db->insert('transaction',$transaction))
      {
        return true;
      }
      return false;
   }
   
   public function get()
   {
    $this->db->select('*');
        $this->db->from('account a');
        $this->db->join('voucher b', 'b.to_account_id = a.id');
        $this->db->where('b.delete_status',0);
         $query = $this->db->get();
        return $query->result();

   }
}