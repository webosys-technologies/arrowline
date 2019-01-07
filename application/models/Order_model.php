<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Order_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }

    function getLocationItem($id)
    {
        $this->db->select('i.id,i.item_name');
        $this->db->from('item i');
        $this->db->join('warehouse w','i.id = w.item_id');
        $this->db->where('w.location_id',$id);
        $this->db->where('i.delete_status',0);
        $this->db->where('w.qty >',0);
        $query=$this->db->get();
        return $query->result();
    }


    public function getProductBarcode($term,$warehouse)
    {
        $this->db->select('i.product_code,i.id');
        $this->db->from('item i');
        $this->db->join('warehouse w','i.id = w.item_id');
        $this->db->like('i.product_code', $term);
        $this->db->where('w.location_id',$warehouse);
        $this->db->where('i.delete_status',0);
        $this->db->where('w.qty >',0);
        $query=$this->db->get();
        return $query->result();
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
    
     public function getlastorder()
    {
        $sql1="SELECT * FROM  `sales_order` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->reference_no;
        } 
        return FALSE;
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

    public function getQuotationAddress($id)
    {
        $this->db->select('country_id,state_id,city_id,shipping_address');
        $this->db->where('id',$id);
        $query=$this->db->get('quotation');
        return $query->row();
    }

    public function getShippingAddress($id)
    {
            $sql="SELECT q.shipping_address,ct.name as city_name,s.name as state_name,c.name as country_name FROM  quotation q LEFT JOIN countries c ON q.country_id = c.id LEFT JOIN states s ON q.state_id = s.id LEFT JOIN cities ct ON q.city_id = ct.id WHERE q.id = ".$id;
            $query=$this->db->query($sql);
            if( $query->num_rows() > 0 )
            {
                return $query->row();   
            }
                    
    }


    public function getCompanySettins()
    {
        return $this->db->select('country_id,state_id,city_id,street')->get('company_settings')->row();
    }

     public function getCompanyState($id)
    {
        $this->db->select('*');
        $this->db->where('country_id',$id);
        $query=$this->db->get('states');
        return $query->result();
    }

    public function getCompanyCity($id)
    {
        $this->db->select('*');
        $this->db->where('state_id',$id);
        $query=$this->db->get('cities');
        return $query->result();
    }



    function getItemByLocation($location_id)
    {
        $this->db->select('i.id,i.item_name');
        $this->db->from('item i');
        $this->db->join('warehouse w','i.id=w.item_id');
        $this->db->where('w.location_id',$location_id);
        $this->db->where('i.delete_status',0);
        $query=$this->db->get();
        return $query->result();      
    }

    function getOrder()
    {   
        if($this->session->userdata('type')=='admin')
        {
            return $this->db->select('qa.id,sum(qa.qty) as salesqty,q.total_amount,q.date,q.reference_no,c.name,q.id as order_id,q.invoice_status,c.id as customer_id,qa.id as qua_item_id,q.status,q.supplier_ref')
                        ->from('sales_order q')
                        ->join('order_items qa','q.id=qa.order_id')
                        ->join('customer c','c.id=q.customer_id')
                        ->where('q.delete_status',0)
                        ->group_by('qa.order_id')
                        ->get()->result();
        }
        else
        {
            return $this->db->select('qa.id,sum(qa.qty) as salesqty,q.total_amount,q.date,q.reference_no,c.name,q.id as order_id,q.invoice_status,c.id as customer_id,qa.id as qua_item_id,q.status,q.supplier_ref')
                        ->from('sales_order q')
                        ->join('order_items qa','q.id=qa.order_id')
                        ->join('customer c','c.id=q.customer_id')
                        ->where('q.delete_status',0)
                        ->where('q.user_id',$this->session->userdata('userId'))
                        ->group_by('qa.order_id')
                        ->get()->result();   
        }
    }




    public function orderByID($id)
    {
        
        return $this->db->select('state_id')->where('id',$id)->get('sales_order')->row();
    }

    public function getCustomerID($id)
    {
        $this->db->select('customer_id');
        $this->db->where('id',$id);
        $query=$this->db->get('quotation');
        return $query->row();
    }

    public function getStateByCountryID($id)
    {
        $this->db->select('*');
        $this->db->where('country_id',$id);
        $query=$this->db->get('states');
        return $query->result();
    }

    public function getCityByStateID($id)
    {
        $this->db->select('*');
        $this->db->where('state_id',$id);
        $query=$this->db->get('cities');
        return $query->result();
    }


    public function getStateByID($country_id)
    {
        return $this->db->where('country_id',$country_id)->get('states')->result();
    }

    public function getCountryID($id)
    {
        return $this->db->select('country_id')->where('customer_id',$id)->get('shipping_address')->row();
    }    

    public function getStateID($id)
    {
        return $this->db->select('state_id')->where('customer_id',$id)->get('shipping_address')->row();
    }    

    public function SalesShippingAddress($id)
    {
        return $this->db->select('shipping_address')->where('id',$id)->get('sales_order')->row();   
    }

    public function updateInvoice($id)
    {
        $sql="UPDATE `quotation` SET 
            `invoice_status`= 1 
             WHERE id =".$id;

        if($this->db->query($sql)){
            return true;
        }
        return false;
    }

    public function getLocation()
    {
        $this->db->select('id,location_name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('location');
        return $query->result();
    }

    public function getShippingIds($customer_id)
    {
        $this->db->select('country_id,state_id,city_id,street');
        $this->db->where('customer_id',$customer_id);
        $query=$this->db->get('shipping_address');
        return $query->row();   
    }


    public function getPaymentMethod()
    {
        $this->db->select('id,name,default');
        $this->db->where('delete_status',0);
        $query=$this->db->get('payment_method');
        return $query->result();
    }

    public function getLastID()
    {
        $sql1="SELECT id FROM  `sales_order` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->id;
        } 
        return FALSE;
    }

    public function getEmailSetup()
    {
        $sql1="SELECT * FROM  `email_setup`";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row();
        } 
        return FALSE;
    }   


    public function getLocationID($id)
    {
        $sql1="SELECT location_id FROM  `quotation` WHERE id =".$id;
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->location_id;
        } 
        return FALSE;
    }


    public function getItems()
    {
        $this->db->select('id,item_name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('item');
        return $query->result();
    }

    

    
    function getTaxById($tax_id)
    {
        $this->db->select('*');
        $this->db->where('id',$tax_id);
        $query=$this->db->get('tax');
        return $query->row();   
    }

    function getTaxs()
    {
        $this->db->select('tax_id,tax_name,tax_value');
        $this->db->where('delete_status',0);
        $query=$this->db->get('tax');
        return $query->result();      
    }

    public function addOrder($data)
    {
        if($this->db->insert('sales_order', $data))
        {
            return $this->db->insert_id();    
        }
        return false;
    }
    public function get_order_detail($id)
    {
        $this->db->from('sales_order as quot');
        $this->db->join('order_items as item','item.order_id=quot.id','LEFT');
        $this->db->where('quot.id',$id);
        $query=$this->db->get();
        return $query->row();
        }
    
    public function addOrderItem($quotationItem)
    {
        $data = $this->db->insert_batch('order_items', $quotationItem);
    }

    function orderDetails($quotation_id)
    {   
        $this->db->select('q.id as order_id,q.*,qi.*,t.*,i.*,l.*,c.*,c.name as cust_name,ad.street as cust_street,ct.id as cust_city_id,ct.name as cust_city,st.id as cust_state_id,st.name as cust_state,con.name as country_name,ad.zip_code as cust_zipcode,q.status as status_edit,pt.due_days,pm.name as payment_method_name');
        $this->db->from('sales_order q');
        $this->db->join('order_items qi','q.id=qi.order_id','left');
        $this->db->join('payment_term pt','pt.id=q.payment_term_id','left');
        $this->db->join('payment_method pm','pm.id=q.payment_method_id','left');
        $this->db->join('tax t','qi.tax_id=t.tax_id','left');
        $this->db->join('item i','qi.item_id=i.id','left');
        $this->db->join('location l','q.location_id=l.id','left');
        $this->db->join('customer c','c.id=q.customer_id','left');
        $this->db->join('shipping_address ad','ad.customer_id=c.id','left');
        $this->db->join('countries con','con.id=ad.country_id','left');
        $this->db->join('states st','st.id=ad.state_id','left');
        $this->db->join('cities ct','ct.id=ad.city_id','left');
        $this->db->where('q.id',$quotation_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getOrders($id)
    {
        $this->db->select('
                q.id as order_id,
                q.reference_no,
                q.date,
                q.total_tax,
                q.total_amount,
                q.shipping_charges,
                c.name as cust_name,
                c.street as cust_street,
                c.email,
                c.phone,
                c.gstin,
                ct.name as cust_city,
                st.name as cust_state,
                con.name as country_name,
                c.zip_code as cust_zipcode,
                pm.name as payment_method_name,
                pt.due_days,
                l.location_name,
                q.total_amount,
                q.status');
        $this->db->from('sales_order q');
        $this->db->join('payment_term pt','pt.id=q.payment_term_id','left');
        $this->db->join('payment_method pm','pm.id=q.payment_method_id','left');
        $this->db->join('location l','q.location_id=l.id','left');
        $this->db->join('customer c','c.id=q.customer_id','left');
        $this->db->join('countries con','con.id=c.country_id','left');
        $this->db->join('states st','st.id=c.state_id','left');
        $this->db->join('cities ct','ct.id=c.city_id','left');
        $this->db->where('q.id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getOrderItems($id)
    {
         $this->db->select('
                q.id as order_id,
                q.*,
                qi.*,
                t.tax_value,
                i.item_name,
                i.hsn_code,
                i.item_description');
        
        $this->db->from('sales_order q');
        $this->db->join('order_items qi','q.id=qi.order_id','left');
        $this->db->join('tax t','qi.tax_id=t.tax_id','left');
        $this->db->join('item i','qi.item_id=i.id','left');
        $this->db->where('q.id',$id);
        $query = $this->db->get();
        return $query->result();
    }    




    function getQuotationDetails($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $query=$this->db->get('quotation');
        return $query->row();
    }
    
    function getQuotationItem($id)
    {
       $this->db->where('order_id',$id);
        $query=$this->db->get('order_items');
        return $query->result();  
    }


    function companyDetails()
    {
        $this->db->select('cs.*,c.id as country_id,c.name as country_name,st.id as state_id,st.name as state_name,ct.id as city,ct.name as city_name');
        $this->db->from('company_settings cs');
        $this->db->join('countries c','c.id=cs.country_id');
        $this->db->join('states st','st.id=cs.state_id');
        $this->db->join('cities ct','ct.id=cs.city_id');
        $query = $this->db->get();
        return $query->row();
    }

    function getQuotationData($id)
    {

        return $this->db->select('*')
                ->from('quotation')
                ->where('id',$id)
                ->get()->row();
    }


    function getQuotationItems($id)
    {
        $sql1="SELECT location_id FROM  `quotation` WHERE id =".$id;
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            $location_id = $query->row()->location_id;
        } 

        return $this->db->select('q.id as quotation_id,qi.id as qua_item_id,t.tax_id,t.*,q.*,qi.*,i.hsn_code,i.item_description,i.item_name,w.qty as available_qty')
                ->from('quotation q')
                ->join('quotation_items qi','q.id=qi.quotation_id')
                ->join('item i','i.id=qi.item_id')
                ->join('tax t','qi.tax_id=t.tax_id')
                ->join('warehouse w','w.item_id=qi.item_id')
                ->where('q.id',$id)
                ->where('w.location_id',$location_id)
                ->get()->result();
    }

    function updateQuotation($id,$data)
    {

        $this->db->where('id', $id);    
        if($this->db->update('quotation', $data))
        {
            return true;
        }
        return false;
        
    }

    function deleteQuotationItem($id)
    {
        $sql="DELETE FROM quotation_items WHERE quotation_id = ? ";
        if($this->db->query($sql,$id)) {
            return true;
        }
        return FALSE;
    }

    function getInvoiceDetails($order_id)
    {
        $this->db->where('quotation_id',$order_id);
        $query=$this->db->get('invoice');
        return $query->row();   
    }

    function getQuotationItemDetails($id)
    {
        $this->db->select('*');
        $this->db->where('quotation_id',$id);
        $query=$this->db->get('quotation_items');
        return $query->result();
    }
    
    public function deleteOrder($data)
    {
        $sql="UPDATE sales_order SET delete_status= ? , delete_date = ? WHERE id =?";
        if($this->db->query($sql,$data)) {
            return true;
        }
        return FALSE;
    }    


    public function getTaxsValue($id)
    {
        $this->db->select('tax_value');
        $query = $this->db->get_where('tax', array('tax_id' => $id));
        return $query->row();
    }

    public function addWarehouse($warehouse)
    {
        $sql="INSERT INTO `location`(`location_name`) VALUES (?)";
        if($this->db->query($sql,array($warehouse))){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getWarehouse()
    {
        $this->db->select('id,location_name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('location');
        return $query->result();
    }

    public function addPaymentMethod($paymentmethod)
    {
        $sql="INSERT INTO `payment_method`(`name`) VALUES (?)";
        if($this->db->query($sql,array($paymentmethod))){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getPayment()
    {
        $this->db->select('id,name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('payment_method');
        return $query->result();
    }

    public function addPaymentTerm($term)
    {
        $sql="INSERT INTO `payment_term`(`term`,`due_days`) VALUES (?,?)";
        if($this->db->query($sql,$term)){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getPaymentTerm()
    {
        $this->db->select('id,term');
        $this->db->where('delete_status',0);
        $query=$this->db->get('payment_term');
        return $query->result();
    }

    public function addCustomer($customer,$shipping)
    {
        $sql="INSERT INTO `customer`(`name`, `email`, `phone`, `street`, `city_id`, `state_id`,`state_code`, `zip_code`, `country_id`,`gstin`) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

        if($this->db->query($sql,$customer))
        {
             $cust=$this->db->insert_id();
           

            $sql1="INSERT INTO `shipping_address`(`customer_id`, `street`, `city_id`, `state_id`, `zip_code`, `country_id`) VALUES (?,?,?,?,?,?)";
            if($this->db->query($sql1,array($cust,$shipping['street'],$shipping['city_id'],$shipping['state_id'],$shipping['zip_code'],$shipping['country_id']))){
              
                return $cust;
            }
            else
            {
                return false;
            }
        }
           else
           {
            return false;
           }
    }

    public function getCustomer()
    {
        $this->db->select('id,name');
        $this->db->where('delete_status',0);
        $query=$this->db->get('customer');
        return $query->result();
    }

}
?>