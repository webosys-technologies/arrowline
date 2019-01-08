<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sales_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }

    function getSales()
    {   
        if($this->session->userdata('type')=='admin')
        {
            $this->db->select('s.id as sales_id,s.shipping_charges,c.id as customer_id,c.name,i.sales_amount,i.paid_amount,invoice_date,i.invoice_no,s.status,i.id as invoice_id,s.supplier_ref   ');
            $this->db->from('invoice i');
            $this->db->join('sales s','i.sales_id=s.id');
            $this->db->join('customer c','c.id=s.customer_id');
            $this->db->where('s.delete_status',0);
            $this->db->order_by("s.id", "desc");
            $query = $this->db->get();
            return $query->result();
        }
        else
        {
            $this->db->select('s.id as sales_id,s.shipping_charges,c.id as customer_id,c.name,i.sales_amount,i.paid_amount,invoice_date,i.invoice_no,s.status,i.id as invoice_id,s.supplier_ref');
            $this->db->from('invoice i');
            $this->db->join('sales s','i.sales_id=s.id');
            $this->db->join('customer c','c.id=s.customer_id');
            $this->db->where('s.delete_status',0);
            $this->db->where('s.user_id',$this->session->userdata('user_id'));
            $this->db->order_by("s.id", "desc");
            $query = $this->db->get();
            return $query->result();   
        }
    }


    public function getProductBarcode($term,$warehouse)
    {   
        $where = "(i.product_code LIKE '%".$term."%' OR i.item_name LIKE '%".$term."%' )";
        $this->db->select('i.product_code,i.id,i.item_name');
        $this->db->from('item i');
        $this->db->join('warehouse w','i.id = w.item_id');
        $this->db->where('w.location_id',$warehouse);
        $this->db->where('i.delete_status',0);
        $this->db->where($where);
        $this->db->where('w.qty >',0);
        $query=$this->db->get();
        return $query->result();
    }
    
    public function getTax($id)
    {
        $this->db->select('total_tax');
        $this->db->from('sales');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row()->total_tax;
    }

    public function getProductName($term,$warehouse)
    {
        $this->db->select('i.item_name,i.product_code,i.id');
        $this->db->from('item i');
        $this->db->join('warehouse w','i.id = w.item_id');
        $this->db->like('i.item_name', $term);
        $this->db->where('w.location_id',$warehouse);
        $this->db->where('i.delete_status',0);
        $this->db->where('w.qty >',0);
        $query=$this->db->get();
        return $query->result();
    }

    function getItemById($id,$location_id)
    {
     
        $this->db->select('t.tax_id,t.*,i.*,w.qty as qty_available');
        $this->db->from('item i');
        $this->db->join('tax t','i.tax_id=t.tax_id');
        $this->db->join('warehouse w','i.id=w.item_id');
        $this->db->where('w.item_id',$id);
        $this->db->where('w.location_id',$location_id);
        $this->db->where('i.delete_status',0);
        $query=$this->db->get();
        return $query->row();   
    }
    
    function getProductById($id)
    {
        $this->db->from('item');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->row();
    }


    public function getSalesAddress($id)
    {
        $this->db->select('country_id,state_id,city_id,shipping_address');
        $this->db->where('id',$id);
        $query=$this->db->get('sales');
        return $query->row();
    }


    public function getShippingAddress($id)
    {
        $sql="SELECT sl.shipping_address,ct.name as city_name,s.name as state_name,c.name as country_name FROM  sales sl LEFT JOIN countries c ON sl.country_id = c.id LEFT JOIN states s ON sl.state_id = s.id LEFT JOIN cities ct ON sl.city_id = ct.id WHERE sl.id = ".$id;
            $query=$this->db->query($sql);
            if( $query->num_rows() > 0 )
            {
                return $query->row();   
            }            
    }

    public function getCustomerID($id)
    {
        $this->db->select('customer_id');
        $this->db->where('id',$id);
        $query=$this->db->get('sales');
        return $query->row();
    }


    public function SalesByID($id)
    {
        return $this->db->select('state_id')->where('id',$id)->get('sales')->row();
    }
    public function SalesShippingAddress($id)
    {
        return $this->db->select('shipping_address')->where('id',$id)->get('sales')->row();   
    }


    public function getCityByID($state_id)
    {
        return $this->db->where('state_id',$state_id)->get('cities')->result();
    }

    public function getStateByID($country_id)
    {
        return $this->db->where('country_id',$country_id)->get('states')->result();
    }

    function getCustomerState($id)
    {
        return $this->db->select('state_id')->from('customer')->where('id',$id)->get()->row();
    }

    function getCompanyState()
    {
        return $this->db->select('state_id')->from('company_settings')->get()->row();
    }

    public function getPaymentTerm()
    {
        $this->db->select('id,term,default');
        $this->db->where('delete_status',0);
        $query=$this->db->get('payment_term');
        return $query->result();
    }

    public function getLastSalesId()
    {
        $sql1="SELECT id FROM  `sales` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->id;
        } 
        return FALSE;
    }
    
     public function getlastreference()
    {
        $sql1="SELECT * FROM  `sales` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->reference_no;
        } 
        return FALSE;
    }

    public function getItems()
    {
        $this->db->select('id,item_name');
        $query=$this->db->get('item');
        return $query->result();
    }

    /*function getItemById($id)
    {
        $this->db->select('t.id as text_id,t.*,i.*');
        $this->db->from('item i');
        $this->db->join('tax t','i.tax_id=t.id');
        $this->db->where('i.id',$id);
        $query=$this->db->get();
        return $query->row();   
    }*/
    
    function getTaxById($tax_id)
    {
        $this->db->select('*');
        $this->db->where('id',$tax_id);
        $query=$this->db->get('tax');
        return $query->row();   
    }

    function getTaxs()
    {
        $this->db->where('delete_status',0);
        $query=$this->db->get('tax');
        return $query->result();      
    }

    public function addSales($data)
    {

        /*$sql="INSERT INTO `sales`(`location_id`, `customer_id`, `date`, `payment_method_id`, `payment_term_id`, `reference_no`, `total_tax`,shipping_charges,`total_amount`,`notes`,`country_id`,`state_id`,`city_id`,`shipping_address`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        if($this->db->query($sql,$data)){
            return $this->db->insert_id();
        }
        return false;*/

        if($this->db->insert('sales', $data))
        {
            return $this->db->insert_id();    
        }
        return false;

    }
    
    public function addSalesItems($SalesItem)
    {
        $this->db->insert_batch('sales_item', $SalesItem);
    }

    public function saveInvoice($data)
    {
        $sql="INSERT INTO `invoice`(`invoice_no`, `sales_id`, `sales_amount`, `invoice_date`) VALUES (?,?,?,?)";
        if($this->db->query($sql,$data)){
            return true;
        }
        return false;
    }

    public function getLocationID($id)
    {
        $sql1="SELECT location_id FROM  `sales` WHERE id =".$id;
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->location_id;
        } 
        return FALSE;
    }

    function getSalesData($id)
    {

        return $this->db->select('*')
                ->from('sales')
                ->where('id',$id)
                ->get()->row();
    }


    function getSalesItems($id)
    {

        $sql1="SELECT location_id FROM  `sales` WHERE id =".$id;
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            $location_id = $query->row()->location_id;
        } 
        //echo $location_id;exit();

        return $this->db->select('s.id as sales_id,si.id as sales_item_id,i.item_description,i.item_name,i.hsn_code,t.*,s.*,si.*,w.qty as available_qty')
                ->from('sales s')
                ->join('sales_item si','s.id=si.sales_id')
                ->join('tax t','si.tax_id=t.tax_id')
                ->join('item i','si.item_id=i.id')
                ->join('customer c','c.id=s.customer_id')
                ->join('warehouse w','w.item_id=si.item_id')
                ->where('s.id',$id)
                ->where('w.location_id',$location_id)
                ->get()->result();
    }

    function orderDetails($quotation_id)
    {   
        $this->db->select('q.id as quotation_id,q.*,qi.*,t.*,i.*,l.*,c.*,c.name as cust_name,ad.street as cust_street,ad.city as cust_city,ad.state as cust_state,ad.zip_code as cust_zipcode');
        $this->db->from('quotation q');
        $this->db->join('quotation_items qi','q.id=qi.quotation_id');
        $this->db->join('tax t','qi.tax_id=t.id');
        $this->db->join('item i','qi.tax_id=i.id');
        $this->db->join('location l','q.location_id=l.id');
        $this->db->join('customer c','c.id=q.customer_id');
        $this->db->join('shipping_address ad','ad.customer_id=c.id');
        $this->db->where('q.id',$quotation_id);
        $query = $this->db->get();
        return $query->result();
    }

    function companyDetails()
    {
        $this->db->select('cs.*,c.*');
        $this->db->from('company_settings cs');
        $this->db->join('apps_countries c','c.id=cs.country_id');
        $query = $this->db->get();
        return $query->row();
    }

    function getQuotationItems($id)
    {
        return $this->db->select('q.id as quotation_id,qi.id as qua_item_id,t.id as text_id,t.*,q.*,qi.*')
                ->from('quotation q')
                ->join('quotation_items qi','q.id=qi.quotation_id')
                ->join('tax t','qi.tax_id=t.id')
                ->where('q.id',$id)
                ->get()->result();
    }

    function updateSales($data,$id)
    {
       
        /*$sql="UPDATE `sales` SET 
            `location_id`= ?,
            `customer_id`= ?,
            `date`= ?,
            `payment_method_id`= ?,
            `payment_term_id`= ?,
            `total_tax`= ?,
            `shipping_charges`= ?,
            `total_amount`= ?,
            `notes`= ?,
            `country_id`= ?,
            `state_id`= ?,
            `city_id`= ?,
            `shipping_address`= ?,
            `status`= ?
            WHERE id =? ";

        if($this->db->query($sql,$data)){
            return true;
        }
        return false;*/

        $this->db->where('id', $id);
        if($this->db->update('sales', $data))
        {
            return true;
        }
        return false;
    }

    public function updateInvoice($inv)
    {
        $sql="UPDATE `invoice` SET 
            `sales_amount` = ? ,`paid_amount` = 0
            WHERE sales_id =?";
        if($this->db->query($sql,$inv)){
            return false;
        }
        return false;
    }

    public function deleteSalesItem($id)
    {
        $sql="DELETE FROM sales_item WHERE sales_id = ? ";
        if($this->db->query($sql,$id)) {
            return true;
        }
        return FALSE;
    }

    public function deletePayment($id)
    {
        $sql="DELETE FROM payment WHERE sales_id = ? ";
        if($this->db->query($sql,$id)) {
            return true;
        }
        return FALSE;
    }


    public function deleteSales($data)
    {

        $sql="UPDATE sales SET delete_status= ? , delete_date = ? WHERE id =?";
        if($this->db->query($sql,$data)) {
            return true;
        }
        return FALSE;
    }     
}
?>