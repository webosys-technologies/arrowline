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
//        return true;
          echo 'success';
      }else{
           $msg = $this->db->conn_id->error_list;
           print_r($msg);
      }
      return false;
   }
   
   public function get()
   {
    $this->db->select('*');
        $this->db->from('account as a');
        $this->db->join('voucher as v','v.from_account_id = a.id','LEFT');
        $this->db->where('v.delete_status',0);
         $query = $this->db->get();
         
         if(isset($query))
         {
                     return $query->result();

         }

   }
   
   public function updateacc($id,$amount)
   {
       $this->db->select('opening_balance');
       $this->db->from('account');
       $this->db->where('id',$id);
       $res=$this->db->get();
        $data= $res->row();
       $amt= $data->opening_balance-$amount;
       $updt=array('opening_balance' => $amt);
       
       $this->db->where('id',$id);
       if($this->db->update('account',$updt))
       {
           return True;
       }
      
   }
   
   
  public function edit($id)
  {
      echo $id;
    
    $this->db->select('*'); 
      $this->db->from('voucher');   
      $this->db->where('id', $id);
      return $this->db->get()->row();
      /*echo "<pre>";
      print_r($data);exit();
      echo "</pre>";*/
  }
  
   public function update($id,$acc)
  {
      /*$sql="UPDATE `bank_account_transfer` SET
            `to_account_id`=?,
            `from_account_id`=?,
             `date`=?,
             `description`=?,
             `amount`=?,
             `payment_method_id`=?,
             `bank_name`=?,
             `cheque_no`=?,
             `reference_no`=?
             WHERE id = ?";*/

      $this->db->where('id',$id);
      if($this->db->update("Voucher",$acc)){
          return true;
      }
       return false;  

  }
  
   public function delete($del)
  {
       $sql="UPDATE voucher set delete_status = ? , delete_date = ? WHERE id = ? ";
       if($this->db->query($sql,$del)) {
         
           return true;
       }
       return FALSE;
   }
  
  
  public function getPayment()
   {

   		$query=$this->db->get('payment_method');
		  return $query->result();
   }

   /*
        Get All Bank Account Data
    */
   public function getAccount()
   {

   		$query=$this->db->get('account');
		  return $query->result();
   }
   
   public function query()
   {
       $this->db->query('ALTER TABLE `voucher` ADD `paid_amount` VARCHAR(55) NOT NULL AFTER `user_id`, ADD `status` INT(11) NOT NULL AFTER `paid_amount`');
       return true;
   }
   
}