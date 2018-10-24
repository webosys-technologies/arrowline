<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Deposite_model extends CI_Model
{
	
	
	public function __construct(){
        parent:: __construct();
   }

   /*
        Get All Category Data
    */
   public function getCategory()
   {
  		$query=$this->db->where('type','income')->where('delete_status',0)->get('expense_category');
	   	return $query->result();
   }

   public function addTransaction($transaction)
   {
      /*$sql="INSERT INTO `transaction`(`amount`, `type`, `account_id`, `date`,`reference`, `description`, `category_id`, `payment_method`) VALUES (?,?,?,?,?,?,?,?)";*/
       if($this->db->insert('transaction',$transaction)){
           return true;
       }
       return false;
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
        Get Account and bank deposit join data
    */
   public function joinDeposit()
   {
        
        $this->db->select('*');
        $this->db->from('account a');
        $this->db->join('bank_account_deposit b', 'b.account_id = a.id');
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
        Add new bank deposit in table
    */
   public function addDeposite($acc)
   {

   	  /*$sql="INSERT INTO `bank_account_deposit`(
   		`account_id`,
    	`date`,
    	`description`,
    	`amount`,
    	`category_id`,
      `payment_method_id`,
      `bank_name`,
    	`cheque_no`,
    	`reference_no`
            ) VALUES (?,?,?,?,?,?,?,?,?)";*/
       if($this->db->insert("bank_account_deposit",$acc)){
           return true;
       }
       return false;

   }

  /*
       Delete Bank deposite data
  */
  public function delete($del)
  {

      $sql="UPDATE bank_account_deposit set delete_status = ? , delete_date = ? WHERE id = ? ";
        if($this->db->query($sql,$del)) {
             return true;
        }
        return FALSE;
  }

  /*
      Update Bank deposit data
  */
  public function edit($id,$acc)
  {
    /*$sql="UPDATE `bank_account_deposit` SET
            `account_id`=?,
             `date`=?,
             `description`=?,
             `amount`=?,
             `category_id`=?,
             `payment_method_id`=?,
             `bank_name`=?,
             `cheque_no`=?,
             `reference_no`=?
             WHERE id = ?";*/
      $this->db->where('id',$id);
       if($this->db->update("bank_account_deposit",$acc)){
           return true;
       }
       return false;  

  }

  /*
     Get Bank deposit data by id for edit
  */
  public function updateDeposit($id)
  {
    
    $this->db->select('*'); 
      $this->db->from('bank_account_deposit');   
      $this->db->where('id', $id);
      return $this->db->get()->row();
  }
   
   
    public function updateBankAmountPlus($account_id,$new_amount)
    {

        $this->db->select('opening_balance');
        $this->db->from('account');
        $this->db->where('id',$account_id);
        $query = $this->db->get();
        $result = $query->row();

        $amount = $result->opening_balance;

        $final = $amount +  $new_amount;

        $sql="UPDATE account set opening_balance = $final WHERE id = $account_id";
        if($this->db->query($sql)) {
             return true;
        }
        return FALSE;

    }

    public function updateBankAmountMinus($account_id,$new_amount)
    {

        $this->db->select('opening_balance');
        $this->db->from('account');
        $this->db->where('id',$account_id);
        $query = $this->db->get();
        $result = $query->row();

        $amount = $result->opening_balance;
        $final = $amount - $new_amount;

        $sql="UPDATE account set opening_balance = $final WHERE id = $account_id";
        if($this->db->query($sql)) 
        {
             return true;
        }
        return FALSE;

    }

    public function afterDeleteDeposit($id)
    {
        $this->db->select('amount,account_id');
        $this->db->from('bank_account_deposit');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $deposit_result = $query->row();

        $deposit_amount = $deposit_result->amount;
        $account_id = $deposit_result->account_id;

        $this->db->select('opening_balance');
        $this->db->from('account');
        $this->db->where('id',$account_id);
        $query = $this->db->get();
        $account_result = $query->row();

        $amount = $account_result->opening_balance;
        $final = $amount - $deposit_amount;

        $sql="UPDATE account set opening_balance = $final WHERE id = $account_id";
        if($this->db->query($sql)) 
        {
            return true;
        }
        return FALSE;
    }

    public function addCategory($cat)
    {
        $sql="INSERT INTO `expense_category`(`name`,`type`) VALUES (?,?)";
        if($this->db->query($sql,$cat)){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getCategoryName()
    {
        $this->db->select('id,name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('expense_category');
        return $query->result();
    }

 }