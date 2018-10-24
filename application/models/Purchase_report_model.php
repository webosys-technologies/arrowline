<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


   class Purchase_report_model extends CI_Model
   {
    protected $table = 'billing';
    function __construct()
    {
        parent::__construct();

    }
     /*
         this function used for get item data 

     */ 
    public function getItem()
    {
        $this->db->where('delete_status','0');
        $query=$this->db->get('item');
        return $query->result();    
    }
   /*
       this function used for get supplier data 
   */ 
    public function getSupplier()
    {
        $this->db->where('delete_status','0');
        $query=$this->db->get('supplier');
        return $query->result();    
    }
     /*

         this function used for get location data 

     */ 
    public function getLocation()
    {
        $this->db->where('delete_status','0');
        $query=$this->db->get('location');
        return $query->result();    
    }
     /*

         this function used for get purchase data 

     */ 
    public function getPurchase()
    {   

        $user_id = $this->session->userdata('userId');

        if($this->session->userdata('type')=='admin'){
          $result = $this->db->query('SELECT p.date, COUNT(DISTINCT(p.id )) AS total, sum(pi.qty) as qty, SUM( pi.amount ) AS cost_volume
                    FROM purchase p
                    INNER JOIN purchase_item pi ON pi.purchase_id = p.id
                    INNER JOIN supplier s ON s.id = p.supplier_id
                    WHERE p.delete_status =0
                    GROUP BY p.date');
                return $result->result();
        }
        else{
          $result = $this->db->query('SELECT p.date, COUNT(DISTINCT(p.id )) AS total, sum(pi.qty) as qty, SUM( pi.amount ) AS cost_volume
                    FROM purchase p
                    INNER JOIN purchase_item pi ON pi.purchase_id = p.id
                    INNER JOIN supplier s ON s.id = p.supplier_id
                    WHERE p.delete_status =0 AND p.user_id = "'.$user_id.'"
                    GROUP BY p.date');
                return $result->result(); 
        }
    }

     /*

         this function used for get purchase total data 

     */ 
    public function total()
    {
          $result = $this->db->query('SELECT COUNT(DISTINCT(si.id)) AS id,
          SUM(i.qty) AS qty, SUM( si.total_amount ) AS cost
          FROM purchase si
          INNER JOIN supplier sd ON sd.id = si.supplier_id
          INNER JOIN purchase_item i ON i.purchase_id = si.id WHERE si.delete_status="0"');
           
          return $result->result();
   }
    /*

         this function used for get purchase data 

     */ 
   public function getData()
   {
      $this->db->select('SUM(total_amount) as cost,date');
      $this->db->from('purchase');
      $this->db->where('purchase.delete_status',0);
      $this->db->group_by('date');
      $query=$this->db->get();

      return $query->result();
   }
    
     /*

         this function used for get purchase data date wise

     */ 
   public function date($date)
   {
        $result = $this->db->query('SELECT si.id,si.reference_no,si.date, s.name,(si.total_amount)AS total, si.date
          FROM purchase AS si
          INNER JOIN supplier s ON si.supplier_id = s.id
          INNER JOIN purchase_item i ON i.purchase_id = si.id
         WHERE si.date="'.$date.'" AND si.delete_status="0"
         group by i.purchase_id
         ');
         return $result->result();   
   }

    /*
         this function used for generate pdf of purchase data 
     */ 
    public function orderDetails()
    {   
      $sql="SELECT p.date,i.item_name,l.location_name,SUM( p.id ) AS no_of_order, SUM( pi.qty ) AS purchase_volume, SUM( p.total_amount ) AS cost_value
        FROM purchase p
         INNER JOIN supplier s ON p.supplier_id = s.id
         INNER JOIN purchase_item pi ON pi.purchase_id = p.id
          INNER JOIN location l ON l.id = p.location_id
          INNER JOIN item i ON i.id = pi.item_id
          WHERE p.delete_status='0'
          ";
       $result = $this->db->query($sql);
            return $result->result();    
    }

     /*

         this function used for get company data 

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

    public function getFilter($item,$location,$supplier)
    {  
        $query = $this->db->query('
                SELECT p.date, l.location_name, i.item_name, COUNT(DISTINCT(p.id)) AS no_of_order, SUM( pi.qty ) AS purchase_volume, SUM( pi.amount ) AS cost_value
                FROM purchase p
                INNER JOIN supplier s ON p.supplier_id = s.id
                INNER JOIN purchase_item pi ON pi.purchase_id = p.id
                INNER JOIN location l ON l.id = p.location_id
                INNER JOIN item i ON i.id = pi.item_id
                
                WHERE 
                  p.delete_status="0"
                AND
                    (pi.item_id = ? OR ? IN("",NULL))
                AND
                    (p.location_id = ? OR ? IN("",NULL)) 
                AND
                    (p.supplier_id = ? OR ? IN("",NULL)) 

                GROUP BY p.date
                ',
                array(
                    $item,
                    $item,
                    $location,
                    $location,
                    $supplier,
                    $supplier
                )
                );
       return $query->result();
      }


      public function getPurchasePDF()
      {

        if($this->session->userdata('type')=='admin'){
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
 }