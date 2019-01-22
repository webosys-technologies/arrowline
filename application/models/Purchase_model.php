<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Purchase_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }

    public function getProductBarcode($term)
    {
        $this->db->select('i.product_code,i.id');
        $this->db->from('item i');
        $this->db->like('i.product_code', $term);
        $this->db->where('i.delete_status',0);
        $query=$this->db->get();
        return $query->result();
    }

    public function getProductName($term)
    {
        $this->db->select('i.item_name,i.product_code,i.id');
        $this->db->from('item i');
        $this->db->like('i.item_name', $term);
        $this->db->where('i.delete_status',0);
        $query=$this->db->get();
        return $query->result();
    }

    function getItemById($id)
    {
        $this->db->select('t.tax_id,t.*,i.*');
        $this->db->from('item i');
        $this->db->join('tax t','i.tax_id=t.tax_id');
        $this->db->where('i.id',$id);
        //$this->db->where('i.delete_status',0);
        $query=$this->db->get();
        return $query->row();   
    }

    function getTaxs()
    {
        $this->db->select('tax_id,tax_name,tax_value');
        $this->db->where('delete_status',0);
        $query=$this->db->get('tax');
        return $query->result();      
    }
    
    public function getSupplier()
    {
        $this->db->select('id,name');
        $query=$this->db->get('supplier');
        return $query->result();
    }

    public function getLastPurchaseID()
    {
        $sql1="SELECT id FROM  `purchase` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
        	return $query->row()->id;
        } 
        return FALSE;
    }

    public function addPurchase($data)
    {
        /*$sql="INSERT INTO `purchase`(`supplier_id`, `location_id`, `date`, `reference_no`, `total_tax`, `total_amount`,`vendor_invoice`,`received_in`,`delivery_date`,`notes`) VALUES (?,?,?,?,?,?,?,?,?,?)";*/
        /*echo "<pre>";
        print_r($data);
        exit();*/
        if($this->db->insert('purchase', $data))
        {
            return $this->db->insert_id();    
        }
        return false;
    }


    public function addPurchaseItem($purchaseItem)
    {
        /*echo "<pre>";
        print_r($purchaseItem);
        exit();*/
        $data = $this->db->insert_batch('purchase_item', $purchaseItem);
    }

    public function getLocationItems($location_id,$items)
    {

        $item_id="";
        foreach ($items as $value) {
            $item_id.=$value->item_id.',';
        }
        $item_id=implode(',', $items);
        
        echo $item_id."<br>";
        echo $location_id;

        $sql="SELECT * FROM warehouse_item WHERE location_id=$location_id AND item_id IN ('$item_id')";
        $query=$this->db->query($sql);
        
        if($query->num_rows() > 0 )
        {
            log_message('debug', print_r($query->result(), true));
            echo "<pre>";
            print_r($query->result());
            exit();

        } 
        return FALSE;

        
    }


    function getPurchase()
    {   
        if($this->session->userdata('type')=='admin')
        {
            return $this->db->select('p.id as purchase_id,p.date,p.reference_no,p.total_amount,s.id as supplier_id,s.name')
                    ->from('purchase p')
                    ->join('supplier s','p.supplier_id=s.id')
                    ->where('p.delete_status',0)
                    ->get()->result();
        }
        else
        {
            return $this->db->select('p.id as purchase_id,p.date,p.reference_no,p.total_amount,s.id as supplier_id,s.name')
                    ->from('purchase p')
                    ->join('supplier s','p.supplier_id=s.id')
                    ->where('p.delete_status',0)
                    ->where('p.user_id',$this->session->userdata('userId'))
                    ->get()->result();
        }

        
    }

    function getPurchaseItems($id)
    {
         return $this->db->select('p.id as purchase_id,pi.id as pur_item_id,t.tax_id,t.*,p.*,pi.*,i.item_description,i.item_name,i.hsn_code,p.date,s.state_id')
                ->from('purchase p')
                ->join('supplier s','s.id=p.supplier_id')
                ->join('purchase_item pi','p.id=pi.purchase_id')
                ->join('tax t','pi.tax_id=t.tax_id')
                ->join('item i','i.id=pi.item_id')
                ->where('p.id',$id)
                ->get()->result();
    }

    function updatePurchase($id,$data)
    {
        /*echo "<pre>";
        print_r($data);exit();*/
        /*$sql="UPDATE `purchase` SET 
            `date`= ? ,
            `total_tax`= ? ,
            `total_amount`= ? ,
            `vendor_invoice`= ? ,
            `received_in`= ? ,
            `delivery_date`= ? ,
            `notes` = ?
             WHERE id = ?";*/
        $this->db->where('id',$id);
        if($this->db->update("purchase",$data)){
            return true;
        }
        return false;
    }

    function deletePurchaseItem($id)
    {
        $sql="DELETE FROM purchase_item WHERE purchase_id = ? ";
        if($this->db->query($sql,$id)) {
            return true;
        }
        return FALSE;
    }

    function purchaseDetail($id)
    {   
        $this->db->select('p.id as purchase_id,p.*,s.*,l.*,s.name as name,s.street as street,ct.id as cust_city_id,ct.name as cust_city,st.id as cust_state_id,st.name as cust_state,con.name as country_name,s.zipcode as zipcode');
        $this->db->from('purchase p');
        $this->db->join('supplier s','s.id=p.supplier_id');
        $this->db->join('location l','p.location_id=l.id');
        $this->db->join('countries con','con.id=s.country_id');
        $this->db->join('states st','st.id=s.state_id');
        $this->db->join('cities ct','ct.id=s.city_id');

        $this->db->where('p.id',$id);
        $query = $this->db->get();
        return $result = $query->result();
        
    }

    function companyDetails()
    {
        $this->db->select('cs.*,c.*');
        $this->db->from('company_settings cs');
        $this->db->join('apps_countries c','c.id=cs.country_id');
        $query = $this->db->get();
        return $query->row();
    }

    function itemDetails($id)
    {   
        $this->db->select('p.id as purchase_id,pi.id as pur_item_id,pi.*,i.item_description');
        $this->db->from('purchase p');
        $this->db->join('purchase_item pi','p.id=pi.purchase_id');

        $this->db->join('item i','i.id=pi.item_id');
        $this->db->where('p.id',$id);
        $query=$this->db->get();
        return $query->row();   
    }

    
    public function deletePurchase($data)
    {
        $sql="UPDATE purchase SET delete_status= ? , delete_date = ? WHERE id =?";
        if($this->db->query($sql,$data)) {
            return true;
        }
        return FALSE;
    }
    
    public function addItemLocation($item_id,$quantity,$location_id,$location){
        $sql = "select * from warehouse where item_id = ? AND location_id = ?";
        $query = $this->db->query($sql,array($item_id,$location_id));
        
        if($query->num_rows()>0){
            $result = $query->result();
            foreach ($result as  $value) {
                $qty = $quantity + $value->qty;
                $sql = "update warehouse set qty = ? where item_id = ? AND location_id = ?";
                $this->db->query($sql,array($qty,$item_id,$location_id));
            }
        }
        else{
            $sql = "insert into warehouse(item_id,location_id,qty) values (?,?,?)";
            $this->db->query($sql,$location);
        }

    }

    public function AddPurchaseLog($purchase_id)
    {
        $user_id = $this->session->userdata('userId');
        $sql="INSERT INTO `log`(`user_id`,`row_id`,`msg`) VALUES ($user_id,$purchase_id,'New Purchase Record Add')";

        if($this->db->query($sql))
        {
            return true;
        }

        return false;  
    }

    public function UpdatePurchaseLog($purchase_id)
    {
        $user_id = $this->session->userdata('userId');
        $sql="INSERT INTO `log`(`user_id`, `row_id`,`msg`) VALUES ($user_id,$purchase_id,'Purchase Record Update')";

        if($this->db->query($sql))
        {
            return true;
        }

        return false;  
    }

}