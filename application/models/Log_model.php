<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Log_model extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }


    function getLogData()
    {

        if($this->session->userdata('type')=='admin')
        {
            $this->db->select('l.*,u.first_name,u.last_name,p.reference_no');
            $this->db->from('log l');
            $this->db->join('purchase p','p.id=l.row_id');
            $this->db->join('users u','u.id=l.user_id');
            $query=$this->db->get();
            return $query->result();   
        }
        else
        {
            $this->db->select('l.*,u.first_name,u.last_name,p.reference_no');
            $this->db->from('log l');
            $this->db->join('purchase p','p.id=l.row_id');
            $this->db->join('users u','u.id=l.user_id');
            $this->db->where('l.user_id',$this->session->userdata('userId'));
            $query=$this->db->get();
            return $query->result();   
        }
        
    }


}