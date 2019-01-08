<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Reports_model extends CI_Model
{
	
	
	public function __construct(){
        parent:: __construct();
   }
   /*
      Get Sales data using join query
  */
   public function getSales()
   {

      if($this->session->userdata('type')=='admin'){
        $this->db->select('
          s.date,SUM(st.qty) as qty,
          SUM(st.rate * st.qty)as retail,
          SUM(i.purchase_price * st.qty) as purchase,
          SUM(st.rate*st.qty)-SUM(i.purchase_price*st.qty)AS profit,
          ((100*(SUM(st.rate*st.qty)-SUM(i.purchase_price*st.qty))/(SUM(st.rate*st.qty))))AS margin,
          c.name,
          s.reference_no,
          s.total_tax');
        $this->db->from('customer c');
        $this->db->join('sales s','s.customer_id=c.id');
        $this->db->join('sales_item st','s.id=st.sales_id');
        $this->db->join('item i','i.id=st.item_id');
        $this->db->group_by('s.id');
        $query = $this->db->get();
        return $query->result();
      }
      else{

        $this->db->select('
          s.date,SUM(st.qty) as qty,
          SUM(st.rate * st.qty)as retail,
          SUM(i.purchase_price * st.qty) as purchase,
          SUM(st.rate*st.qty)-SUM(i.purchase_price*st.qty)AS profit,
          ((100*(SUM(st.rate*st.qty)-SUM(i.purchase_price*st.qty))/(SUM(st.rate*st.qty))))AS margin,
          c.name,
          s.reference_no,
          s.total_tax');
        $this->db->from('customer c');
        $this->db->join('sales s','s.customer_id=c.id');
        $this->db->join('sales_item st','s.id=st.sales_id');
        $this->db->join('item i','i.id=st.item_id');
        $this->db->where('s.user_id',$this->session->userdata('userId'));
        $this->db->group_by('s.id');
        $query = $this->db->get();
        return $query->result();
      }
   }

   /*
      Use for calculate profit
  */
   public function getProfit()
   {    
          $this->db->select('DISTINCT(SUM(si.qty))As quantity,
                             SUM(i.purchase_price *si.qty )As purchase,
                             SUM(si.rate * si.qty)As retail,
                             SUM(si.tax_amount)As tax,
                             SUM(si.rate*si.qty)-SUM(i.purchase_price*si.qty) AS profit'
                            );
          $this->db->from('sales_item si');
          $this->db->join('item i','i.id = si.item_id');
          $query = $this->db->get();
          return $query->result();
  }

  /*
      Get Users detail
  */
   public function getTeam()
   {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
   }

   /*
      Get Supplier Data
  */
   public function getSupplier()
   {

      $this->db->select('*');
      $this->db->from('supplier s');
      $this->db->join('purchase p','p.supplier_id=s.id');
      $query = $this->db->get();
      return $query->result();

   }

   public function getSuppName()
   {

      $this->db->select('*');
      $this->db->from('supplier');
      $this->db->where('delete_status',0);
      $query=$this->db->get();
      return $query->result();
   }

   /*
       Get Quotation data using join query
    */
   public function getQuotation()
   {
        $this->db->select('*');
        $this->db->from('customer c'); 
        $this->db->join('sales s','s.customer_id=c.id');
        $this->db->join('invoice i','i.sales_id=s.id');
        $this->db->join('sales_item st','st.sales_id=s.id');
        $query = $this->db->get();
        return $query->result();
   }

   /*
       Get Invoice data using join query
    */
   public function getInvoice()
   {
        $this->db->select('*');
        $this->db->from('customer c');
        $this->db->join('quotation q','q.customer_id=c.id');
        //$this->db->join('sales s','q.customer_id=s.customer_id');
        //$this->db->join('sales_item st','s.id=st.sales_id');
        $this->db->join('invoice i','i.quotation_id=q.id');
        $query = $this->db->get();
        return $query->result();
   }

   /*
       Get Payment data using join query
  */
   public function getPayment()
   {

        $this->db->select('c.name as  
                      cust_name,q.reference_no,pm.name,p.payment_no,p.amount,p.payment_date');
        $this->db->from('customer c');
        $this->db->join('quotation q','q.customer_id=c.id');
        $this->db->join('payment p','p.quotation_id=q.id'); 
        $this->db->join('payment_method pm','p.payment_method_id=pm.id');
        $query = $this->db->get();
        return $query->result();

   }


   public function getReceivablePayment()
   {
      $this->db->select('s.reference_no,i.sales_amount,i.paid_amount,c.name, (i.sales_amount - i.paid_amount) as pending');
      $this->db->from('sales s');
      $this->db->join('customer c','s.customer_id = c.id');
      $this->db->join('invoice i','s.id = i.sales_id');
      //$this->db->join('invoice ii','s.id = ii.sales_id');
      $this->db->where('i.paid_amount < i.sales_amount');
      if(!$this->session->userdata('type')=='admin')
      {
        $this->db->where('s.user_id',$this->session->userdata('userId'));
      }
      $query = $this->db->get();
      return $query->result();
   }

   /*
       Get Total Income details for date
  */
   public function getIncome()
   {

      $this->db->select('SUM(total_amount) as amount,
                        MONTH(date) as month');
      $this->db->from('sales');
      if(!$this->session->userdata('type')=='admin')
      {
        $this->db->where('user_id',$this->session->userdata('userId'));
      }
      $this->db->group_by('MONTH(date)');
      $query=$this->db->get();
      return $query->result();
   }

   /*
       Get Total sales amount
    */
   public function getData()
   {
      $this->db->select('SUM(total_amount) as amount');
      $this->db->from('sales');
      $query=$this->db->get();
      return $query->result();

   }

  /*
      Get Customer data
   */
   public function getCustomer()
   {
        $this->db->select('*');

        $this->db->from('customer');
         $this->db->where('delete_status',0);
        $query=$this->db->get();
        return $query->result();

   }

   /*
      Get Location data
   */
   public function getLocation()
   {

      $this->db->select('*');
      $this->db->from('location');
      $query=$this->db->get();
      return $query->result();
   }

  /*
      Get Sales History Filter data 
  */
  public function salesFilter($customer,$from,$to)
  {
      
            $this->db->select('(st.qty )As quantity,
                             (i.purchase_price * st.qty)As purchase,
                             (st.rate * st.qty)As retail,
                             s.total_tax,
                             (st.rate*st.qty)-
                             (i.purchase_price*st.qty) AS profit,((100*((st.rate*st.qty)-(i.purchase_price*st.qty))/((st.rate*st.qty)))) as margin,c.name,s.reference_no,s.date,s.total_tax');
            $this->db->from('customer c'); 
            $this->db->join('sales s','s.customer_id=c.id');
            $this->db->join('invoice in','in.sales_id=s.id');
            $this->db->join('sales_item st','st.sales_id=s.id');
            $this->db->join('item i','i.id = st.item_id');
            if(!$this->session->userdata('type')=='admin')
            {
              $this->db->where('s.user_id',$this->session->userdata('userId')); 
            }
            
            if($customer=="all")
            {   
              $this->db->where('s.date >=',$from); 
              $this->db->where('s.date <=',$to); 
            }
            else{
              $this->db->where('c.id="'.$customer.'"');
              $this->db->where('s.date >=',$from); 
              $this->db->where('s.date <=',$to);   
            }
            $this->db->group_by('s.id'); 
            $query = $this->db->get();
            return $query->result();   
        
  }
  

  /*
      Get Purchase Filter Data
  */
  public function purchaseFilter($supplier,$location,$from,$to)
  {

      if($supplier=="all" AND $location=="all")
      {
          $this->db->select('*');
          $this->db->from('supplier s');
          $this->db->join('purchase p','p.supplier_id=s.id'); 
          $this->db->where('p.date >=',$from); 
          $this->db->where('p.date <=',$to); 
          $this->db->group_by('p.date'); 
          $query = $this->db->get();
          return $query->result();
      }
      else
      {
          $this->db->select('*');
          $this->db->from('supplier s');
          $this->db->join('purchase p','p.supplier_id=s.id');
          $this->db->where('s.id="'.$supplier.'"');
          $this->db->where('p.location_id="'.$location.'"');
          $this->db->where('p.date >=',$from); 
          $this->db->where('p.date <=',$to); 
          $this->db->group_by('p.date'); 
          $query = $this->db->get();
          return $query->result();
      }

  } 
  /*
      Get Quotation Filter Data
  */
  public function quotationFilter($customer,$location,$from,$to)
  {

        if($customer=="all" AND $location=="all")
        {

            $this->db->select('*');
            $this->db->from('customer c'); 
            $this->db->join('sales s','s.customer_id=c.id');
            $this->db->join('invoice i','i.sales_id=s.id');
            $this->db->join('sales_item st','st.sales_id=s.id');
            $this->db->where('s.date >=',$from); 
            $this->db->where('s.date <=',$to); 
            $this->db->group_by('s.date'); 
            $query = $this->db->get();
            return $query->result();
          }
          else
          {

            $this->db->select('*');
            $this->db->from('customer c'); 
            $this->db->join('sales s','s.customer_id=c.id');
            $this->db->join('invoice i','i.sales_id=s.id');
            $this->db->join('sales_item st','st.sales_id=s.id');
            $this->db->where('c.id="'.$customer.'"');
            $this->db->where('s.location_id="'.$location.'"');
            $this->db->where('s.date >=',$from); 
            $this->db->where('s.date <=',$to); 
            $this->db->group_by('s.date'); 
            $query = $this->db->get();
            return $query->result();
          }
  }


  /*
      Get Invoice Filter Data
  */
  public function invoiceFilter($customer,$location,$from,$to)
  {

        if($customer=="all" AND $location=="all")
        {
              $this->db->select('*');
              $this->db->from('customer c');
              $this->db->join('quotation q','q.customer_id=c.id');
              $this->db->join('invoice i','i.quotation_id=q.id');
              $this->db->where('i.invoice_date >=',$from); 
              $this->db->where('i.invoice_date <=',$to); 
              $this->db->group_by('i.invoice_date'); 
              $query = $this->db->get();
              return $query->result();
        }
        else
        {
              $this->db->select('*');
              $this->db->from('customer c');
              $this->db->join('quotation q','q.customer_id=c.id');
              $this->db->join('invoice i','i.quotation_id=q.id');
              $this->db->where('c.id="'.$customer.'"');
              $this->db->where('q.location_id="'.$location.'"');
              $this->db->where('i.invoice_date >=',$from); 
              $this->db->where('i.invoice_date <=',$to); 
              $this->db->group_by('i.invoice_date'); 
              $query = $this->db->get();
              return $query->result();

        }
        
  }

  /*
      Get Payment Filter Data
  */
  public function paymentFilter($customer,$from,$to)
  {

        if($customer=="all")
        {
            $this->db->select('c.name as cust_name,q.reference_no,pm.name,p.payment_no,p.amount,p.payment_date');
            $this->db->from('customer c');
            $this->db->join('quotation q','q.customer_id=c.id');
            //$this->db->join('sales s','q.customer_id=s.customer_id');
            $this->db->join('payment_method pm','q.payment_method_id=pm.id');
            $this->db->join('payment p','p.payment_method_id=pm.id');
            $this->db->where('p.payment_date >=',$from); 
            $this->db->where('p.payment_date <=',$to); 
            $this->db->group_by('p.payment_date'); 
            $query = $this->db->get();
            return $query->result();
        }
        else
        {
            $this->db->select('c.name as cust_name,q.reference_no,pm.name,p.payment_no,p.amount,p.payment_date');
            $this->db->from('customer c');
            $this->db->join('quotation q','q.customer_id=c.id');
            //$this->db->join('sales s','q.customer_id=s.customer_id');
            $this->db->join('payment_method pm','q.payment_method_id=pm.id');
            $this->db->join('payment p','p.payment_method_id=pm.id');
            $this->db->where('c.id="'.$customer.'"');
            $this->db->where('p.payment_date >=',$from); 
            $this->db->where('p.payment_date <=',$to); 
            $this->db->group_by('p.payment_date'); 
            $query = $this->db->get();
            return $query->result();


        }
  }

    /*
        Get Income Filter Data
    */
    public function incomeFilter($year)
    {
        $this->db->select('SUM(total_amount) as amount,
                          MONTH(date) as month');
        $this->db->from('sales');
        $this->db->where('YEAR(date)',$year);
        if(!$this->session->userdata('type')=='admin')
        {
          $this->db->where('user_id',$this->session->userdata('userId'));
        }
        $this->db->group_by('MONTH(date)');
        $query=$this->db->get();
        return $query->result();

    }
}
