<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Transfer_model extends CI_Model
{
	
	
	public function __construct(){
        parent:: __construct();
   }


   /*
        Get All Category Data
    */
   public function getCategory()
   {
  		$query=$this->db->get('category');
	   	return $query->result();
   }

   /*
        Get All Deposit Data
    */
   public function getDeposite()
   {

   		$query=$this->db->get('bank_account_deposit');
		  return $query->result();
   }

   /*
        Get Account and bank transfer join data
    */
   public function joinTransfer()
   {
    $this->db->select('*');
        $this->db->from('account a');
        $this->db->join('bank_account_transfer b', 'b.to_account_id = a.id');
        $this->db->where('b.delete_status',0);
         $query = $this->db->get();
        return $query->result();

   }

   /*
        Get All Payment Data
    */
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


    /*
        Add new bank transfer in table
    */
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

       if($this->db->insert("bank_account_transfer",$acc)){
           return true;
       }
       return false;

   }
  /*
      Update Bank Transfer data
  */
  public function edit($id,$acc)
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
      if($this->db->update("bank_account_transfer",$acc)){
          return true;
      }
       return false;  

  }

  /*
     Get Bank transfer data by id for edit
  */
  public function update($id)
  {
    
    $this->db->select('*'); 
      $this->db->from('bank_account_transfer');   
      $this->db->where('id', $id);
      return $this->db->get()->row();
      /*echo "<pre>";
      print_r($data);exit();
      echo "</pre>";*/
  }

  /*
       Delete Bank Transfer data
  */
  public function delete($del)
  {
       $sql="UPDATE bank_account_transfer set delete_status = ? , delete_date = ? WHERE id = ? ";
       if($this->db->query($sql,$del)) {
         
           return true;
       }
       return FALSE;
   }
  
   public function addTransaction($transaction)
   {
      if($this->db->insert('transaction',$transaction))
      {
        return true;
      }
      return false;
   }


 }