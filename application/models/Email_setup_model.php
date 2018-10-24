<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Email_setup_model extends CI_Model{
    
  protected $table = 'billing';

    function __construct()
    {
        parent::__construct();

    }


     /*

       this function used for add & update emailsetup data

     */           
    public function add($email)
    {
    
      $d = $this->db->get('email_setup')->result();
      if($d != null)
      {
        return $this->db->update('email_setup',$email);
      }
      else
      {
        return $this->db->insert('email_setup',$email); 
      }

    }
     
     /*
       this function used for display emailsetup data

     */
    public function emailData()
    {
        return $this->db->get('email_setup')->result();  
    }

}