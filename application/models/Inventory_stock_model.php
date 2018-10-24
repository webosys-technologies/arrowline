<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Inventory_stock_model extends CI_Model{
    
   protected $table = 'billing';

    function __construct()
    {
        parent::__construct();

    }

     /*

       this function used for fetch item data 

     */
    public function getItem()
    {
        $this->db->where('delete_status','0');  
        $query=$this->db->get('item');
        return $query->result();    
    }

     /*

       this function used for fetch location data 

     */
    public function getLocation()
    {
         $this->db->where('delete_status','0');  
        $query=$this->db->get('location');
        return $query->result();    
    }

     /*

       this function used for fetch warehouse data 

     */
    public function getInventory()
    {
       
        $user_id = $this->session->userdata('userId');
        if($this->session->userdata('type')=='admin'){

            $result = $this->db->query('SELECT l.location_name,i.item_name as product,
                 w.qty,i.sales_price,SUM(w.qty*i.purchase_price) as value,SUM(w.qty*i.sales_price) as retail,
                 SUM( i.sales_price * w.qty ) - SUM( i.purchase_price * w.qty ) AS profit,((100*(SUM(i.sales_price*w.qty)-SUM(i.purchase_price * w.qty ))/(SUM(i.sales_price*w.qty)))) as main 
                FROM warehouse w 
                INNER JOIN item i ON i.id = w.item_id
                INNER JOIN location l ON l.id=w.location_id
                GROUP BY w.id');
                return $result->result();    
        }
        else
        {
            $result = $this->db->query('SELECT l.location_name,i.item_name as product,
                 w.qty,i.sales_price,SUM(w.qty*i.purchase_price) as value,SUM(w.qty*i.sales_price) as retail,
                 SUM( i.sales_price * w.qty ) - SUM( i.purchase_price * w.qty ) AS profit,((100*(SUM(i.sales_price*w.qty)-SUM(i.purchase_price * w.qty ))/(SUM(i.sales_price*w.qty)))) as main 
                FROM warehouse w 
                INNER JOIN item i ON i.id = w.item_id
                INNER JOIN location l ON l.id=w.location_id
                WHERE i.user_id = "'.$user_id.'"
                GROUP BY w.id');
                return $result->result();       
        }
    }

     /*

       this function used for fetch warehouse total data 

     */
     public function total()
     {
         $query=$this->db->get('warehouse');
           $result = $this->db->query('SELECT SUM( w.qty ) AS qty, SUM( w.qty * i.purchase_price ) AS invalue, SUM( i.sales_price * w.qty ) AS retail, SUM( i.sales_price * w.qty ) - SUM( i.purchase_price * w.qty ) AS profit
              FROM warehouse w
             INNER JOIN item i ON i.id = w.item_id');
             return $result->result(); 
    }

     /*

       this function used for fetch filter data of warehouse 

     */
     public function getFilter($id,$location)
     {
       
        if($this->session->userdata('type')=='admin'){

            $this->db->select('c.location_name,i.item_name AS product, w.qty, i.sales_price, ( w.qty * i.purchase_price ) AS value, ( w.qty * i.sales_price ) AS retail, ( i.sales_price * w.qty ) - ( i.purchase_price * w.qty ) AS profit, (
                ( 100 * ( ( i.sales_price * w.qty ) - ( i.purchase_price * w.qty ) ) / ( ( i.sales_price * w.qty ) ) )) AS main');
            $this->db->from('warehouse w');
            $this->db->join('item i','i.id = w.item_id');
            $this->db->join('location c','c.id=w.location_id');
            
            if($id != 'all' AND $location == 'all')
            {
                $this->db->where('i.id',$id);
            }
            if($id == 'all' AND $location != 'all')
            {
                $this->db->where('c.id',$location);
            }
            if($id != 'all' AND $location != 'all')
            {
                $this->db->where('i.id',$id);
                $this->db->where('c.id',$location);
            }
            $query = $this->db->get();
            return $query->result(); 
        }
        else{
            $this->db->select('c.location_name,i.item_name AS product, w.qty, i.sales_price, ( w.qty * i.purchase_price ) AS value, ( w.qty * i.sales_price ) AS retail, ( i.sales_price * w.qty ) - ( i.purchase_price * w.qty ) AS profit, (
                ( 100 * ( ( i.sales_price * w.qty ) - ( i.purchase_price * w.qty ) ) / ( ( i.sales_price * w.qty ) ) )) AS main');
            $this->db->from('warehouse w');
            $this->db->join('item i','i.id = w.item_id');
            $this->db->join('location c','c.id=w.location_id');
            $this->db->where('i.user_id',$this->session->userdata('userId'));
            
            if($id != 'all' AND $location == 'all')
            {
                $this->db->where('i.id',$id);
            }
            if($id == 'all' AND $location != 'all')
            {
                $this->db->where('c.id',$location);
            }
            if($id != 'all' AND $location != 'all')
            {
                $this->db->where('i.id',$id);
                $this->db->where('c.id',$location);
            }
            $query = $this->db->get();
            return $query->result();    
        }
    }

    
    function orderDetails()
    {   
       $query=$this->db->get('warehouse');
        $result = $this->db->query('SELECT l.location_name,c.category_name, SUM( w.qty ) AS qty, SUM( w.qty * i.purchase_price ) AS invalue, SUM( i.sales_price * w.qty ) AS retail, SUM( i.sales_price * w.qty ) - SUM( i.purchase_price * w.qty ) AS profit
              FROM warehouse w
             INNER JOIN item i ON i.id = w.item_id
                INNER JOIN location l ON l.id = w.location_id
                INNER JOIN category c ON l.id = i.category_id
                 GROUP BY w.qty');
            return $result->result();    
    }

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
}


