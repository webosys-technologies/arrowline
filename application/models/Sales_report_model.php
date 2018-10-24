<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Sales_report_model extends CI_Model{
    
   protected $table = 'billing';

    function __construct()
    {
        parent::__construct();
    }

    /*

       this function used for display item data

    */
    public function getItem()
    {
        $this->db->where('delete_status','0');
        $query=$this->db->get('item');
        return $query->result();    
    }

    /*

       this function used for display customer data

    */
    public function getCustomer()
    {
        $this->db->where('delete_status','0');
        $query=$this->db->get('customer');
        return $query->result();    
    }

    /*

       this function used for display location data

    */
    public function getLocation()
    {
        $this->db->where('delete_status','0');
        $query=$this->db->get('location');
        return $query->result();    
    }
    
    /*

       this function used for display sales data

    */
    public function getSales()
    {
        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin')
        {

            $result = $this->db->query('SELECT sd.date, count(DISTINCT(si.sales_id )) AS id, sum(si.qty) as qty, SUM( si.rate * si.qty ) AS sales_volume, SUM( i.purchase_price * si.qty ) AS cost_volume, SUM( si.rate * si.qty ) - SUM(i.purchase_price * si.qty) AS profit, (( 100 * ( SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty)) / ( SUM( si.rate * si.qty )))) AS main
                    FROM sales_item si
                    INNER JOIN sales sd ON sd.id = si.sales_id
                    INNER JOIN item i ON i.id = si.item_id
                    WHERE sd.delete_status="0"
                    GROUP BY sd.date');
                return $result->result();    
        }
        else
        {
            $result = $this->db->query('SELECT sd.date, count(DISTINCT(si.sales_id )) AS id, sum(si.qty) as qty, SUM( si.rate * si.qty ) AS sales_volume, SUM( i.purchase_price * si.qty ) AS cost_volume, SUM( si.rate * si.qty ) - SUM(i.purchase_price * si.qty) AS profit, (( 100 * ( SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty)) / ( SUM( si.rate * si.qty )))) AS main
                    FROM sales_item si
                    INNER JOIN sales sd ON sd.id = si.sales_id
                    INNER JOIN item i ON i.id = si.item_id
                    WHERE sd.delete_status="0" AND sd.user_id = "'.$user_id.'" 
                    GROUP BY sd.date');
                return $result->result();       
        }
    }
    /*

       this function used for display sales total data

    */
    public function total()
    {
        $query=$this->db->get('sales');
        $result=$this->db->query('SELECT count(DISTINCT(si.sales_id )) AS id,SUM(si.qty) as qty, SUM( si.rate * si.qty ) as sales_volume , SUM( i.purchase_price * si.qty ) as cost_volume , SUM( si.rate * si.qty ) - SUM(i.purchase_price * si.qty) AS profit
            FROM sales_item si
            INNER JOIN sales sd ON sd.id = si.sales_id
            INNER JOIN item i ON i.id = si.item_id');
            return $result->result(); 
    }  

    /*

       this function used for show date wise sales total data

    */
    public function salesTotal($date)
    {
        $result=$this->db->query('SELECT  sum(DISTINCT(sd.total_tax)) as total_tax,sum(si.qty) as qty, 
            sum( si.rate * si.qty ) AS sales_value, sum( i.purchase_price * si.qty ) AS cost_volume, 
            ( sum( si.rate * si.qty ) ) - (sum( i.purchase_price * si.qty )) AS profit
            FROM sales_item si 
            INNER JOIN sales sd ON sd.id = si.sales_id 
            INNER JOIN item i ON i.id = si.item_id 
            INNER JOIN customer c ON c.id=sd.customer_id
             WHERE sd.date="'.$date.'"');
            return $result->result(); 
    }  

    /*
       this function used for generate pdf of sales data 
    */

    function orderDetails()
    {  

       $query=$this->db->get('sales');
        $result = $this->db->query('SELECT sd.date,l.location_name,c.name, SUM( si.sales_id ) AS id,SUM(si.qty) as qty, 
                                    SUM( si.rate * si.qty ) as sales_volume , SUM( i.purchase_price * si.qty ) as cost_volume , 
                                    SUM( si.rate * si.qty ) - SUM(i.purchase_price * si.qty) AS profit 
                                    FROM sales_item si INNER JOIN sales as sd ON sd.id=si.sales_id 
                                    INNER JOIN location as l ON l.id=sd.location_id 
                                    INNER JOIN customer as c ON c.id=sd.customer_id 
                                    INNER JOIN item as i ON i.id=si.item_id');
            return $result->result();    
    }

    /*

       this function used for generate pdf of sales data date

    */
    function orderDetailsDate()
    {  

       $query=$this->db->get('sales');
        $result = $this->db->query('SELECT  sd.date,l.location_name,c.name, SUM( si.sales_id ) AS id,SUM(si.qty) as qty, SUM( si.rate * si.qty ) as sales_volume , SUM( i.purchase_price * si.qty ) as cost_volume , SUM( si.rate * si.qty ) - SUM(i.purchase_price * si.qty) AS profit
            FROM sales_item si
            INNER JOIN sales sd ON sd.id = si.sales_id
            INNER JOIN item i ON i.id = si.item_id
            INNER JOIN location l ON l.id = sd.location_id
            INNER JOIN customer c ON c.id = sd.customer_id
            GROUP BY sd.date');
            return $result->result();    
    }

     /*

         this function used for get comapany data 

     */ 
    function companyDetails()
    {
          $this->db->select('cs.*,(c.name)as country_name,(s.name)as state_name,(ct.name)as city_name');
        $this->db->from('company_settings cs');
        $this->db->join('countries c','c.id=cs.country_id');
        $this->db->join('states s','s.id=cs.state_id');
        $this->db->join('cities ct','ct.id=cs.country_id');
        $query = $this->db->get();
        return $query->row();
    }


    /*
        this function used for generate graph sales data date wise 

    */
    public function getGraph()
    {       
            $query=$this->db->get('sales');
            $sql=$this->db->query("SELECT sd.date, SUM( si.sales_id ) AS id, si.qty, SUM( si.rate * si.qty ) AS sales_volume, SUM( i.purchase_price * si.qty ) AS cost_volume, SUM( si.rate * si.qty ) - SUM(i.purchase_price * si.qty) AS profit, (( 100 * ( SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty)) / ( SUM( si.rate * si.qty )))) AS main
                FROM sales_item si
                INNER JOIN sales sd ON sd.id = si.sales_id
                INNER JOIN item i ON i.id = si.item_id
                GROUP BY sd.date");
                return $sql->result(); 

 
    }

     /*
        this function used for sales data date wise

    */
    public function  salesDate($date)
    {
        $result = $this->db->query('SELECT sd.id,sd.reference_no,sd.date,c.name, SUM(si.qty) as qty, 
        SUM( si.rate * si.qty ) AS sales_volume, SUM( i.purchase_price * si.qty ) AS cost_volume, 
        ( SUM( si.rate * si.qty ) ) - SUM(( i.purchase_price * si.qty )) AS profit,(sd.total_tax) as tax, 
        ( 100 * ( SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty)) / ( SUM( si.rate * si.qty ))) AS main
        FROM sales sd INNER JOIN sales_item si ON sd.id = si.sales_id 
        INNER JOIN item i ON i.id = si.item_id 
        INNER JOIN customer c ON c.id=sd.customer_id 
        WHERE sd.date="'.$date.'" GROUP BY sd.id');
        return $result->result(); 

    }


     /*
        this function used for generate sales data date wise

    */
    public function salesPdf($date)
    {
        $query=$this->db->get('sales');
        $result = $this->db->query('SELECT sd.reference_no,sd.date,c.name, si.qty, 
            ( si.rate * si.qty ) AS sales_volume, ( i.purchase_price * si.qty ) AS cost_volume, 
            ( si.rate * si.qty ) - (i.purchase_price * si.qty) AS profit,(sd.total_tax) as tax, 
            (( 100 * ( ( si.rate * si.qty ) - ( i.purchase_price * si.qty)) / ( ( si.rate * si.qty )))) AS main
            FROM sales_item si INNER JOIN sales sd ON sd.id = si.sales_id 
            INNER JOIN item i ON i.id = si.item_id 
            INNER JOIN customer c ON c.id=sd.customer_id
            WHERE sd.date="'.$date.'"');
            return $result->result(); 
    }

    /*
        this function used for filter data

    */
    public function getFilter($item,$location,$customer)
    {  

        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin')
        {
            $query = $this->db->query('
                SELECT sd.date, count(DISTINCT(si.sales_id )) AS id, si.qty, SUM( si.rate * si.qty ) AS sales_volume, SUM( i.purchase_price * si.qty ) AS cost_volume, SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty ) AS profit, (
                ( 100 * ( SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty ) ) / ( SUM( si.rate * si.qty ) ) )
                ) AS main
                FROM sales_item si
                INNER JOIN sales sd ON sd.id = si.sales_id
                INNER JOIN customer c ON sd.customer_id = c.id
                INNER JOIN item i ON i.id = si.item_id
                INNER JOIN location l ON l.id = sd.location_id
                WHERE
                    (si.item_id = ? OR ? IN("",NULL))
                AND
                    (sd.location_id = ? OR ? IN("",NULL)) 
                AND
                    (sd.customer_id = ? OR ? IN("",NULL)) 
                GROUP BY sd.date
                ',
                array(
                    $item,
                    $item,
                    $location,
                    $location,
                    $customer,
                    $customer
                )
                );
            return $query->result(); 
        }
        else
        {
            $query = $this->db->query('
                SELECT sd.date, count(DISTINCT(si.sales_id )) AS id, si.qty, SUM( si.rate * si.qty ) AS sales_volume, SUM( i.purchase_price * si.qty ) AS cost_volume, SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty ) AS profit, (
                ( 100 * ( SUM( si.rate * si.qty ) - SUM( i.purchase_price * si.qty ) ) / ( SUM( si.rate * si.qty ) ) )
                ) AS main
                FROM sales_item si
                INNER JOIN sales sd ON sd.id = si.sales_id
                INNER JOIN customer c ON sd.customer_id = c.id
                INNER JOIN item i ON i.id = si.item_id
                INNER JOIN location l ON l.id = sd.location_id
                WHERE 
                    sd.user_id = "'.$user_id.'"
                AND
                    (si.item_id = ? OR ? IN("",NULL))
                AND
                    (sd.location_id = ? OR ? IN("",NULL)) 
                AND
                    (sd.customer_id = ? OR ? IN("",NULL)) 
                GROUP BY sd.date
                ',
                array(
                    $item,
                    $item,
                    $location,
                    $location,
                    $customer,
                    $customer
                )
                );
            return $query->result();    
        }
    }

    public function salesReportData($state_id)
    {
        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin'){

            $result = "SELECT 
            s.reference_no,
            DATE_FORMAT(s.date,'%d/%m/%Y') as dates,
              c.name as customer_Name,
              c.gstin as Customer_GSTIN,
              c.phone,
              s.total_tax as TaxAmount,
              s.total_amount*si.discount/100 as DiscountValue,
              if(s.state_id = $state_id, s.total_tax/2, 0) as CGST,
              if(s.state_id = $state_id, s.total_tax/2, 0) as SGST,
              if(s.state_id = $state_id, 0, s.total_tax) as IGST,
              s.total_amount as SalesAmount 

          FROM sales s INNER JOIN sales_item si ON s.id = si.sales_id INNER JOIN item i ON i.id = si.item_id INNER JOIN customer c ON c.id = s.customer_id WHERE s.delete_status='0' GROUP BY s.id";
            $query = $this->db->query($result);
            return $query->result();
        }
        else
        {
            $result = "SELECT 
            s.reference_no,
            DATE_FORMAT(s.date,'%d/%m/%Y') as dates,
              c.name as customer_Name,
              c.gstin as Customer_GSTIN,
              c.phone,
              s.total_tax as TaxAmount,
              s.total_amount*si.discount/100 as DiscountValue,
              if(s.state_id = $state_id, s.total_tax/2, 0) as CGST,
              if(s.state_id = $state_id, s.total_tax/2, 0) as SGST,
              if(s.state_id = $state_id, 0, s.total_tax) as IGST,
              s.total_amount as SalesAmount 

          FROM sales s INNER JOIN sales_item si ON s.id = si.sales_id INNER JOIN item i ON i.id = si.item_id INNER JOIN customer c ON c.id = s.customer_id WHERE s.delete_status='0' AND s.user_id =$user_id GROUP BY s.id";
            $query = $this->db->query($result);
            return $query->result();
        }
            /*echo "<pre>";
            print_r($query->result());    
            exit();*/
    }

 }