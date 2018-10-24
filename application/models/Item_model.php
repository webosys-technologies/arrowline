<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item_model extends CI_Model
{
	
	
	public function __construct(){
        parent:: __construct();
    }

    /*
        Get Category and item join data
    */
    public function getItems()
    {

      if($this->session->userdata('type')=='admin')
      {
        $this->db->select('*');
        $this->db->from('category c');
        $this->db->join('item i','i.category_id=c.id');
        $this->db->where('i.delete_status',0);
        $this->db->order_by('i.id','desc');
        $query=$this->db->get();
        return $query->result();
      }
      else{
        $this->db->select('*');
        $this->db->from('category c');
        $this->db->join('item i','i.category_id=c.id');
        $this->db->where('i.delete_status',0);
        $this->db->where('i.user_id',$this->session->userdata('userId'));
        $this->db->order_by('i.id','desc');
        $query=$this->db->get();
        return $query->result();
      }
    	
    }

    /*
      Get All SAC Code
    */
    public function getSac(){
      return $this->db->get('sac')->result();
    }

    /*
      Get All HSN Chapter
    */

    public function getHsnChapter(){
      return $this->db->get('hsn_chapter')->result();
    }

    /*
      Get All HSN code 
    */
    public function getHsn(){
      return $this->db->get_where('hsn',array('chapter'=>1))->result();
    }

    /*
      Get HSN data for bootstrap modal
    */
    public function getHsnData($id){
      return $this->db->get_where('hsn',array('chapter'=>$id))->result();
    }

    /*
        Add Item data in table
    */
    public function addItem($item)
    {

      /*echo "<pre>";
      print_r($item);exit();*/

    	/*$sql="INSERT INTO `item`(`product_code`,`item_name`, `hsn_code`, `category_id`, `unit_id`, `tax_id`, `item_description`, `purchase_price`, `sales_price`, `status`, `picture`,`user_id`,`bar_code`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";*/

       if($this->db->insert('item',$item)){
           return true;
       }
       return false;

    }

    /*
        Get All Category Data
    */
    public function getCategory(){

		  $this->db->where('delete_status',0);
	    $query=$this->db->get('category');   
	    return $query->result();

	}

	/*
        Get All Tax Data
    */
	/*public function getTaxType(){

		
	    $query=$this->db->get('tax');    
	    return $query->result();

	}*/

  public function getTax(){
    $this->db->select('tax_id,tax_name');
    $this->db->where('delete_status',0);
    $data = $this->db->get('tax');
    return $data->result();
  }


	/*
        Get All Unit Data
    */
	public function getUnits(){

		  $this->db->where('delete_status',0);
	    $query=$this->db->get('unit');   
	    return $query->result();

	}

	/*
       Delete Item data
  	*/
	public function deleteItem($del)
	{

		$sql="UPDATE item set delete_status = ? , delete_date = ? WHERE id = ? ";
       	if($this->db->query($sql,$del)) {
         
        	   return true;
      	 }
       		return FALSE;
	}

	/*
      	Update Item data in table
  	*/
	public function editItem($id,$item)
	{
    $this->db->trans_start();
		$this->db->where('id',$id);
		$this->db->update('item',$item);
    $this->db->trans_complete();
	}

	/*
      	Get item data by id for edit
  	*/
	public function updateItem($id)
	{
    $this->db->select('*'); 
    $this->db->from('item');   
    $this->db->where('id', $id);
    return $this->db->get()->row();
	}

	/*
    	 Add Sales price in item table
  	*/
	public function addSales($item)
	{

		$sql="UPDATE item set sales_price = ? WHERE id = ? ";
       	if($this->db->query($sql,$item)) {
         
        	   return true;
      	 }
       		return FALSE;

	}

	/*
    	 Add Purchase price in item table
  	*/
	public function addPurchase($item)
	{

	    $sql="UPDATE item set purchase_price = ? WHERE id = ? ";
       	if($this->db->query($sql,$item)) {
         
        	   return true;
      	 }
       		return FALSE;

	}

	/*
    	Get data into csv file
  */
	public function getCsvData()
	{
			return $this->db->SELECT('c.category_name,u.unit_name,t.tax_name,
								i.item_description,i.purchase_price,i.sales_price')
							->FROM('category c')
							->JOIN('item i','i.category_id=c.id')
							->JOIN('tax t','i.tax_id=t.id')
							->JOIN('unit u','i.unit_id=u.id')
							->get()
							->result();			

	}

	/*
    	Get category,unit,item,tax.join data for csv file 
  */
	public function getTotal()
  {
         //$query=$this->db->get('warehouse');
           $result = $this->db->query('SELECT COUNT(DISTINCT(i.id)) as item,SUM( w.qty)  AS qty, SUM( w.qty * i.purchase_price) AS purchase, SUM( i.sales_price * w.qty)  AS retail, SUM( i.sales_price * w.qty) - SUM( i.purchase_price * w.qty)  AS profit
              FROM warehouse w
             INNER JOIN item i ON w.item_id=i.id');
             return $result->result(); 
  }


              /*
    Get data into csv file for import data
  */
  public  function importData()
  {
        /*$this->db->where('delete_status','0');                 
        $data = $this->db->get('item');
       	return $data->result();*/
       	return $this->db->SELECT('c.category_name,u.unit_name,i.hsn_code,t.tax_name,i.item_name,i.item_description,i.purchase_price,i.sales_price')
							->FROM('category c')
							->JOIN('item i','i.category_id=c.id')
							->JOIN('tax t','i.tax_id=t.tax_id')
							->JOIN('unit u','i.unit_id=u.id')
							->get()
							->row();

        /*$this->db->select('c.category_name,u.unit_name,t.tax_name,i.item_name,i.item_description,i.purchase_price,i.sales_price');
        $this->db->from('item i');
        $this->db->join('category c','c.id = i.category_id');
        $this->db->join('tax t','t.tax_id = i.tax_id');
        $this->db->join('unit u','u.id = i._id');*/


  }

  /*
  	Upload data into csv file
	*/
  public function uploadData()
  {

      $count=0;
      $fp = fopen($_FILES['file']['name'],
      			$_FILES['file']['tmp_name'],'r') or die("can't open file");
      while($csv_line = fgetcsv($fp,1024))
      {
          $count++;
          if($count == 1)
          {
              continue;
          }//keep this if condition if you want to remove the first row
          for($i = 0, $j = count($csv_line); $i < $j; $i++)
          {
              $insert_csv = array();
              //$insert_csv['id'] = $csv_line[0];//remove if you want to have primary key,
              $insert_csv['category_name'] = $csv_line[0];
              $insert_csv['unit_name'] = $csv_line[1];
              $insert_csv['tax_name'] = $csv_line[2];
              $insert_csv['item_name'] = $csv_line[3];
              $insert_csv['item_description'] = $csv_line[4];
              $insert_csv['purchase_price'] = $csv_line[5];
              $insert_csv['sales_price'] = $csv_line[6];

          }
          $i++;
          $data = array(
              'category_name' => $insert_csv['category_name'],
              'unit_name' => $insert_csv['unit_name'],
              'tax_name' => $insert_csv['tax_name'],
              'item_name' =>$insert_csv['item_name'],
              'item_description' =>$insert_csv['item_description'],
              'purchase_price' =>$insert_csv['purchase_price'],
              'sales_price' =>$insert_csv['sales_price']);

          $data['crane_features']=$this->db->insert('import',$data);
      }
      fclose($fp) or die("can't close file");
      $data['success']="success";
      return $data;
  }

  public function getAllBarcode()
  {
    if($this->session->userdata('type')=='admin'){
      $this->db->select('item_name,bar_code');
      $this->db->where('delete_status',0);
      $query=$this->db->get('item');
      return $query->result();
    }
    else{
      $this->db->select('item_name,bar_code');
      $this->db->where('user_id',$this->session->userdata('userId'));
      $this->db->where('delete_status',0);
      $query=$this->db->get('item');
      return $query->result();
    }
  }


    public function addCategory($cat)
    {
        $sql="INSERT INTO `category`(`category_name`,`unit`) VALUES (?,?)";
        if($this->db->query($sql,$cat)){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getCategoryName()
    {
        $this->db->select('id,category_name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('category');
        return $query->result();
    }


    public function addUnit($unit)
    {
        $sql="INSERT INTO `unit`(`unit_name`,`abbr`) VALUES (?,?)";
        if($this->db->query($sql,$unit)){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getUnitName()
    {
        $this->db->select('id,unit_name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('unit');
        return $query->result();
    }


}
