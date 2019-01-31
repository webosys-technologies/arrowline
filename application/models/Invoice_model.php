<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function getPaymentReference($id)
    {
        return $this->db->select('reference')->where('sales_id',$id)->get('payment')->row();
    }

    public function getLastInvoiceID()
    {
        $sql1="SELECT id FROM  `invoice` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->id;
        } 
        return FALSE;
    }
    

    public function getLastPaymentID()
    {
        $sql1="SELECT id FROM  `payment` ORDER BY `id` DESC LIMIT 1";
        $query=$this->db->query($sql1);
        if( $query->num_rows() > 0 )
        {
            return $query->row()->id;
        } 
        return FALSE;
    }


    public function saveInvoice($data)
    {
        $sql="INSERT INTO `invoice`(`invoice_no`, `sales_id`, `quotation_id`,`sales_amount`, `invoice_date`) VALUES (?,?,?,?,?)";
        if($this->db->query($sql,$data)){
            return $this->db->insert_id();
        }
        return false;
    }

    public function getSalesDetails($sales_id)
    {
        $query = $this->db->select('*')->from('sales')->where('id',$sales_id)->get();
        return $query->row();
    }

    public function getInvoiceDetails($invoice_id)
    {
        $query = $this->db->select('*')->from('invoice')->where('id',$invoice_id)->get();
        return $query->row();
    }

    public function getBankAccount(){
        $query = $this->db->select('*')->from('account')->get();
        return $query->result();   
    }

    public function getExpanseCategory(){
        $query = $this->db->select('*')->from('expense_category')->where('delete_status',0)->where('type','income')->get();
        return $query->result();   
    }

    public function getPaymentMethod()
    {
        $query = $this->db->select('*')->from('payment_method')->get();
        return $query->result();      
    }

    public function addQuotationPayment($paymemtDetails)
    {
        /*echo "<pre>";
        print_r($paymemtDetails);exit();*/

        //$this-> db->insert('payment', $paymemtDetails);
        $sql="INSERT INTO `payment`(
            `quotation_id`, 
            `account_id`, 
            `payment_method_id`, 
            `income_exp_category_id`, 
            `payment_no`, 
            `amount`, 
            `payment_date`,
            `description`, 
            `reference` 
            ) VALUES (?,?,?,?,?,?,?,?,?)";
        if($this->db->query($sql,$paymemtDetails)){
            return true;
        }
        return false;
    }

    public function addSalesPayment($paymemtDetails)
    {
       /* echo "<pre>";
        print_r($paymemtDetails);exit();
*/
        //$this-> db->insert('payment', $paymemtDetails);
        /*$sql="INSERT INTO `payment`(
            `sales_id`, 
            `account_id`, 
            `payment_method_id`, 
            `income_exp_category_id`, 
            `payment_no`, 
            `amount`, 
            `bank_name`, 
            `cheque_no`, 
            `payment_date`,
            `description`, 
            `reference` ,
            `status` 
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";*/
        if($this->db->insert('payment',$paymemtDetails)){
            return true;
        }
        return false;
    }


    public function getPayamentDetails($id)
    {
        $this->db->select('*');
        $this->db->from('quotation q');
        $this->db->join('payment p','q.id=p.quotation_id');
        $this->db->where('q.id',$id);
        $query=$this->db->get();
        return $query->result();
    }

    function quotationOrderDetails($id)
    {   
        $this->db->select('q.id as quotation_id,q.*,qi.*,t.*,i.*,l.*,c.*,c.name as cust_name,ad.street as cust_street,ad.city as cust_city,ad.state as cust_state,ad.zip_code as cust_zipcode,inv.id as invoice_id,inv.*');
        $this->db->from('quotation q');
        $this->db->join('quotation_items qi','q.id=qi.quotation_id');
        $this->db->join('invoice inv','q.id=inv.quotation_id');
        $this->db->join('tax t','qi.tax_id=t.id');
        $this->db->join('item i','qi.item_id=i.id');
        $this->db->join('location l','q.location_id=l.id');
        $this->db->join('customer c','c.id=q.customer_id');
        $this->db->join('shipping_address ad','ad.customer_id=c.id');
        $this->db->where('q.id',$id);
        $query = $this->db->get();
        return $query->result();
    }

//    function salesOrderDetails($id)
//    {   
//        $this->db->select('
//                s.id as sales_id,
//                s.*,
//                si.*,
//                t.tax_value,
//                i.item_name,
//                i.hsn_code,
//                i.item_description'
//                );
//        
//        $this->db->from('sales s');
//        $this->db->join('sales_item si','s.id=si.sales_id','left');
//        $this->db->join('tax t','si.tax_id=t.tax_id','left');
//        $this->db->join('item i','si.item_id=i.id','left');
//        $this->db->where('s.id',$id);
//        $query = $this->db->get();
//        return $query->result();
//
//    }
    function salesOrderDetails($id)
    {   
        $this->db->select('
                s.id as sales_id,
                s.*,
                si.*'
               
                );
        
        $this->db->from('sales s');
        $this->db->join('sales_item si','s.id=si.sales_id','left');
//        $this->db->join('tax t','si.tax_id=t.tax_id','left');
//        $this->db->join('item i','si.item_id=i.id','left');
        $this->db->where('s.id',$id);
        $query = $this->db->get();
        return $query->result();

    }
    public function salesOrder($id)
    {
        $this->db->select('
                s.id as sales_id,
                s.reference_no,
                s.date,
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
                s.status as final_status,
                pt.due_days,
                l.location_name,
                inv.paid_amount,
                inv.id as invoice_id,
                s.total_amount,
                s.status ,
                s.supplier_ref,
                s.buyer_order,
                s.dispatch_doc_no,
                s.dilivery_note_date,
                s.dispatch_through

                ');
        $this->db->from('sales s');
        $this->db->join('payment_term pt','pt.id=s.payment_term_id','left');
        $this->db->join('payment_method pm','pm.id=s.payment_method_id','left');
        $this->db->join('invoice inv','s.id=inv.sales_id','left');
        $this->db->join('location l','s.location_id=l.id','left');
        $this->db->join('customer c','c.id=s.customer_id','left');
        $this->db->join('countries con','con.id=c.country_id','left');
        $this->db->join('states st','st.id=c.state_id','left');
        $this->db->join('cities ct','ct.id=c.city_id','left');

        $this->db->where('s.id',$id);
        $query = $this->db->get();
        return $query->row();
    }



    function getSalesPaymentData($id)
    {
        $this->db->select('inv.invoice_no,p.amount,pm.name');
        $this->db->from('sales s');
        $this->db->join('payment p','s.id=p.sales_id');
        $this->db->join('invoice inv','s.id=inv.sales_id');
        $this->db->join('payment_method pm','pm.id=s.payment_method_id');
        $this->db->where('s.id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    function getPaymentData($id)
    {
        $this->db->select('inv.invoice_no,p.amount,pm.name');
        $this->db->from('sales s');
        $this->db->join('payment p','s.id=p.sales_id');
        $this->db->join('invoice inv','s.id=inv.sales_id');
        $this->db->join('payment_method pm','pm.id=s.payment_method_id');
        $this->db->where('p.sales_id',$id);
        $query = $this->db->get();
        return $query->result();
    }


    function getQuotationPaymentData($id)
    {
        $this->db->select('inv.invoice_no,p.amount,pm.name');
        $this->db->from('quotation q');
        $this->db->join('payment p','q.id=p.quotation_id');
        $this->db->join('invoice inv','q.id=inv.quotation_id');
        $this->db->join('payment_method pm','pm.id=q.payment_method_id');
        $this->db->where('q.id',$id);
        $query = $this->db->get();
        return $query->result();
    }


}