<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','ion_auth'));
		$this->load->model('Backup_model');
	}

	/*
		View list of Bank Account data
	*/
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$data['db'] = $this->Backup_model->getBackup();
		/*echo "<pre>";
		print_r($data);
		exit();*/
		$this->load->view('backup/list',$data);
	}

	public function dbbackup()
	{

		date_default_timezone_set('Asia/Calcutta');
	    // Load the DB utility class 
	    $this->load->dbutil(); 
	    $prefs = array( 'format' => 'zip', // gzip, zip, txt 
                        'filename' => 'backup_'.date('d_m_Y_H_i_s').'.sql', 
                            // File name - NEEDED ONLY WITH ZIP FILES 
                        'add_drop' => TRUE,
                                                     // Whether to add DROP TABLE statements to backup file
                        'add_insert'=> TRUE,
                                                    // Whether to add INSERT data to backup file 
                        'newline' => "\n"
                                                   // Newline character used in backup file 
                    ); 

	  	$data = array(
	  		'name' => 'dbbackup_'.date('d_m_Y_H_i_s').'.zip',
	  		'date' => date('Y-m-d H:i:s'),
	  		'user_id'=>$this->session->userdata("userId")
 	  	);

	     $dbname = $this->Backup_model->add($data);
	     if($dbname!=false){
		     // Backup your entire database and assign it to a variable 
		     $backup = $this->dbutil->backup($prefs);   
		         // Load the file helper and write the file to your server 
	         $this->load->helper('file'); 
	         write_file('assets/backup/'.$dbname->name, $backup);	
	     }
	     $this->session->set_flashdata('success', 'Backup Save successfully.');
	     redirect("backup",'refresh');
         // Load the download helper and send the file to your desktop 
         /*$this->load->helper('download'); 
         force_download('dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup);*/
	}

	public function download($fileName = NULL) {   

	   if ($fileName) {
	   	$this->load->helper('download'); 
	    $file = realpath ( "assets\backup" ) . "\\" . $fileName;
	    // echo $file;exit();
	    $data = file_get_contents ( $file );
	    force_download ( $fileName, $data );
	    }
	}

	public function delete($id)
	{
		
		$del=array(
            'delete_status'   => 1,
            'delete_date'     => date('Y-m-d')
            );
        
       if($this->Backup_model->deleteBackup($del,$id)){
           	
           /*$data['item'] = $this->Item_model->getItem();
           	$data['total']=$this->Item_model->getTotal();
			$this->load->view('item/list',$data);*/
			$this->session->set_flashdata('success', 'Database Backup delete successfully.');
			redirect("backup",'refresh');
		}
		else
		{
			$this->session->set_flashdata('success', 'Failed to delete Record.');
            redirect("backup",'refresh');	
		}
	
	}


}