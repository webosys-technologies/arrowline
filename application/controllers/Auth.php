<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->lang->load('message','english');
	}

	// redirect if needed, otherwise display the user list
	public function index()
	{
		//echo "Hello";exit();

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		//elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		//{
			// redirect them to the home page because they must be an administrator to view this
		//	return show_error('You must be an administrator to view this page.');
		//}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			//$this->getData();
			//$this->ion_auth->getExpenseDetails();
			//$this->get_expense();
			$this->data['invoicedata'] = $this->ion_auth->geTotalInvoice();
			$this->data['account'] = $this->ion_auth->bankAccount();
			$this->data['deposit'] = $this->ion_auth->bankDeposit();
			$this->data['expense'] = $this->ion_auth->expense();
			$this->data['exp_category'] = $this->ion_auth->getExpenseDetails();
			/*echo "<pre>";
			print_r($this->data);exit();*/
			//$this->data['income'] = $this->ion_auth->getIncomes();
			$this->data['invoice'] = $this->ion_auth->getInvoice();

			
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			/*echo "<pre>";
			print_r($this->data['users']);
			exit();*/
			$this->_render_page('auth/index', $this->data);
		}
	}

	function switchLang($language = "") {
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }

	
	function get_expense()
	{
		$data = $this->ion_auth->getExpenseDetails();

		$expense = array();
		foreach ($data as $value) {
			$e['category'] = $value->name;
			$e['amount'] = $value->expense;
			array_push($expense,$e);
		}

		print_r(json_encode($expense, true));
	}


	function get_data()
	{

		$expense= $this->ion_auth->getExpense();
		$income = $this->ion_auth->getIncome();
		
		/*echo "<pre>";
		print_r($expense);exit();*/

		$dateArray = array();
		for($i=30; $i>=0; $i--){

			$date1 = date('Y-m-d',strtotime("-$i day"));
			array_push($dateArray,$date1);
		}

		$expArray = array();
		foreach ($expense as $value) {
			$e['date'] = $value->date;
			$e['amount'] = $value->amount;
			array_push($expArray,$e);
		}

		$incArray = array();
		foreach ($income as $value) {
			$e['date'] = $value->date;
			$e['amount'] = $value->amount;
			array_push($incArray,$e);
		}

		$final =array();
		foreach ($dateArray as $da) {
				$d= array();
				$a = explode('-',$da);
			foreach ($expArray as $exp) {
				$b = explode('-',$exp['date']);
				if(decbin($a[0]).decbin($a[1]).decbin($a[2])==decbin($b[0]).decbin($b[1]).decbin($b[2])){
					$d['date'] = $exp['date'];
					$d['e_amount'] = $exp['amount'];
				}
				else
				{
					$d['date'] = $da;
				}
			}
			foreach ($incArray as $inc) {
				$b = explode('-',$inc['date']);
				if(decbin($a[0]).decbin($a[1]).decbin($a[2])==decbin($b[0]).decbin($b[1]).decbin($b[2])){
					$d['date'] = $inc['date'];
					$d['i_amount'] = $inc['amount'];
				}
				else
				{
					$d['date'] = $da;
				}
			}	
			if(!isset($d['e_amount'])){
				$d['e_amount'] = 0;
			}
			if(!isset($d['i_amount'])){
				$d['i_amount'] = 0;
			}
			$profit = 	$d['i_amount'] - $d['e_amount'];
			if($profit<0){
				$d['profit'] = 0;
			}
			else{
				$d['profit'] = $profit;
			}
			array_push($final,$d);	

		}

		/*echo "<pre>";
		print_r($final);exit();*/
		
		print_r(json_encode($final, true));
		
	}

        public function demo()
        {
            $this->load->model('Account_model');
            $this->Account_model->demo();
        }


	// log the user in
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');
                       
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$email=$this->input->post('identity');

				$log_user_id=$this->ion_auth->getUserId($email);
				//echo $log_user_id;exit();
				$log_user_name=$this->ion_auth->getUserName($email);
				$user_type = $this->ion_auth->getUserType($log_user_id);

				$this->session->set_userdata("type",$user_type);
				$this->session->set_userdata("userId",$log_user_id);
					
				/*   Default Symbol   */				
				$symboldata = $this->ion_auth->getSymbol();
				
				if(isset($symboldata)){
					$symbol = $symboldata->symbol;
					$this->session->set_userdata("currencySymbol",$symbol);	
				}
				else
				{
					$symbol = '$';
					$this->session->set_userdata("currencySymbol",$symbol);		
				}

				/* Set Default Language */
				$language = $this->ion_auth->getLanguage();

				if(isset($language)){
					$lan = $language->default_language;
					$this->session->set_userdata("site_lang",$lan);	
				}
				else
				{
					$lan = 'english';
					$this->session->set_userdata("site_lang",$lan);		
				}




				$data = $this->ion_auth->getUserRole($this->session->userdata('userId'));
				/*echo "<pre>";
				print_r($data);
				exit();*/
				//$role = $this->ion_auth->getRole($this->session->userdata('userId'));
				
				$userRole = array();
				foreach ($data as $value) {
					array_push($userRole, $value->name);
				}

				$this->session->set_userdata("userRole",$userRole);
				
				$data=array(
					'first_name'=>$log_user_name->first_name,
					'last_name'=>$log_user_name->last_name,
					'created_on'=>$log_user_name->created_on,
					'profile'=>$log_user_name->profile,
					'email'=>$log_user_name->email
				);
				$this->session->set_userdata($data);

				redirect('/', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->_render_page('auth/login', $this->data);
		}
	}

	// log the user out
	public function logout()
	{
		$this->session->unset_userdata('userRole');
		$this->session->unset_userdata('userId');
		//$this->session->unset_userdata('site_lang');
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	// change password
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	// forgot password
	public function forgot_password()
	{
		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("auth/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	// activate the user
	public function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	// create a new user
	public function create_user()
    {
    	if(isset($_FILES['images']['name']))
    	{
			$image = $_FILES['images']['name'];
			$path=$this->do_upload($image);
		}


        $this->data['title'] = $this->lang->line('create_user_heading');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input

        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        $this->form_validation->set_rules('group_id','User Role', 'required');


        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone'),
                'profile'    => $path,
                'group_id'   =>$this->input->post('group_id')
            );
            /*echo "<pre>";
            print_r($additional_data);exit();*/
        }
        if ($this->form_validation->run() == true)
        {
            $res=$this->ion_auth->register($identity, $password, $email, $additional_data);
            if($res)
            {
                $per=array('user_id' =>$res,
                            'dob'=>$this->input->post('dob'),
                            'address' => $this->input->post('address'),
                            'gender' => $this->input->post('gender'),
                            'education' => $this->input->post('education'),
                    );
                $this->load->model('Ion_auth_model');
                $this->Ion_auth_model->addpersonal($per);
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("settings/member_list", 'refresh');
            }
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name'  => 'company',
                'id'    => 'company',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->data['image1'] = array(
                'name'  => 'images',
                'id'    => 'images',
                'type'  => 'file',
                'value' => $this->form_validation->set_value('images'),
            );

            $this->data['group']=$this->ion_auth->getGroup();
            
            $this->_render_page('auth/create_user', $this->data);
        }
    }


    private function do_upload($image){
		if(!empty($image)){
		
			$type = explode('.',$_FILES["images"]["name"]);
			$type = $type[count($type)-1];
			$name = uniqid(rand()).'.'.$type;
			$url = './assets/images/'.$name;//uniqid(rand()).'.'.$type;

			if(in_array($type,array("jpg","jpeg","gif","png"))){
				
				if(is_uploaded_file($_FILES["images"]["tmp_name"])){
					
					if(move_uploaded_file($_FILES["images"]["tmp_name"],$url)){

						return $name;
					}
				}	
			}
			return  "";		
		}
	}

	// edit a user
	public function edit_user($id)
	{

		if(!empty($_FILES['images']['name'])){
			$image = $_FILES['images']['name'];
			$temp=$this->input->post('tmp');
			if(!empty($temp)){
            	    unlink('assets/images/'.$temp);
            }
			$path=$this->do_upload($image);
			//echo "Hello".$path;exit();
		}

		if(empty($_FILES['images']['name'])){
			$path=$this->input->post('tmp');
		}

		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
					'profile'    => $path,
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {

			    	$userdata = $this->ion_auth->getUser($id);
					$data1=array(
						'first_name'=>$userdata->first_name,
						'last_name'=>$userdata->last_name,
						'created_on'=>$userdata->created_on,
						'profile'=>$userdata->profile,
						'email'=>$userdata->email
					);
					$this->session->set_userdata($data1);


			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('settings/member_list', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('settings/member_list', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);

		$this->data['image1'] = array(
            'name'  => 'images',
            'id'    => 'images',
            'type'  => 'file',
            'value' => $this->form_validation->set_value('images'),
        );

		$this->data['tmpimg'] = array(
            'name'  => 'tmp',
            'id'    => 'tmp',
            'type'  => 'hidden',
            'value' => $this->form_validation->set_value('tmp',$user->profile),
        );
        
		/*echo "<pre>";
		print_r($this->data);exit();*/

		$this->_render_page('auth/edit_user', $this->data);
	}

	// create a new group
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);
			$this->_render_page('auth/create_group', $this->data);
		}
	}

	// edit a group
	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	public function edit()
	{
		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }

        $id = $this->input->post('id');
        //$filename = $this->input->post('temp');
        //$base =  "./assets/images/".$filename;

        if(!empty($_FILES['images']['name']))
        {
			$image = $_FILES['images']['name'];
			$temp=$this->input->post('temp');

			if(!empty($temp)){
				unlink('assets/images/'.$temp);
			}
			
			$path=$this->do_upload($image);
			//unlink($base);
		}

		if(empty($_FILES['images']['name']))
		{
			$path=$this->input->post('temp');
		}

        $this->form_validation->set_rules('fname','First Name','required');
        $this->form_validation->set_rules('lname','Last Name','required');
        //$this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('phone','Phone','required');

        if($this->form_validation->run()== true)
        {
			$data['email']=$this->input->post('email');	
			$data['first_name']=$this->input->post('fname');	
			$data['last_name']=$this->input->post('lname');	
			$data['phone']=$this->input->post('phone');	
			$data['profile']=$path;		
			$data['id']=$id;

			if($this->ion_auth->updateUser($data))
			{	
				$data = $this->ion_auth->getUser($id);
				$data1=array(
					'first_name'=>$data->first_name,
					'last_name'=>$data->last_name,
					'created_on'=>$data->created_on,
					'profile'=>$data->profile,
					'email'=>$data->email
				);
				$this->session->set_userdata($data1);
				redirect('auth/set/'.$id,'refresh');
			}
		}
		else
		{
			$this->set($id);
		}
	}

	public function set($id)
	{

		if(!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
		
		$data['user'] = $this->ion_auth->getUser($id);	
		$this->load->view('auth/profile',$data);
	}

	function db_backup(){
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
         // Backup your entire database and assign it to a variable 
         $backup =& $this->dbutil->backup($prefs); 
         // Load the file helper and write the file to your server 
         $this->load->helper('file'); 
         write_file('assets/backup/'.'dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup); 
         // Load the download helper and send the file to your desktop 
         $this->load->helper('download'); 
         force_download('dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup);
	}


}
