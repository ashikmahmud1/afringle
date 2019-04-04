<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Login extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Login_model','App_model'));
    }

    /*
    * Check Login
    */
    function index()
    {

      if(@$this->session->userdata['is_logged_admin']['admin_login_status'] == 'true')
      {
        redirect('admin/dashboard');
      }
      $data = array( 'page_title' => 'Login Admin Penal', );
      $this->parser->parse('login/login', $data);
    }


    /*
    * Login from username and password
    */
    public function doLogin()
  	{

  		$data['page_title']= 'Login Admin Penal';
  		$data['message'] ='';

  		$this->form_validation->set_rules('username', 'Username', 'required');
  		$this->form_validation->set_rules('password', 'Password', 'required');
      if ($this->form_validation->run() == FALSE)
      {
		       $this->parser->parse('login/login', $data);
      }else{
  			$data = array(
                'username' => $this->input->post('username'),
  							'password' => 	$this->App_model->hashPassword($this->input->post('password'))
  						);
  			$result = $this->Login_model->loginCheck($data);



  			if($result != FALSE){
  				if ($result[0]->role == 'Admin' || $result[0]->role == 'promember' ) {
            //Put user data in session
            $session_data = array(
  									'admin_id'    => $result[0]->id,
  									'admin_name'  => $result[0]->firstname.' '.$result[0]->lastname,
  									'admin_email' =>  $result[0]->email,
  									'admin_image' =>  $result[0]->image,
  									'admin_role'  => $result[0]->role,
                    'hotel_id'  => $result[0]->hotel_id,	
  									'admin_login_status' => 'true',
  					);
  					$this->session->set_userdata('is_logged_admin', $session_data);
                   if($result[0]->status == "Active")
				   {
   					$this->session->set_flashdata('message', '<span style="color:green;">Login Successfully !</span>');
  					redirect('admin/dashboard');
				   }
				   else{
  				$data['page_title']= 'Login Admin Penal';
  				$data['message'] = '<span style="color:red;">YOUR ACCOUNT IS UNDER REVIEW !</span>';
  				$this->parser->parse('login/login', $data);
				   } 
  				}else {
  					$data['page_title']= 'Login Admin Penal';
  					$data['message'] = '<span style="color:red;">You are not authorized to login.</span>';
  					$this->parser->parse('login/login', $data);

  				}
  			}else{
  				$data['page_title']= 'Login Admin Penal';
  				$data['message'] = '<span style="color:red;">Username and Password incorrect Please try again !</span>';
  				$this->parser->parse('login/login', $data);
  			}
  		}
  	}


    /*
    * Logout
    */
  	public function logout() {
  		// Removing session data
  		$sess_array = array(
  		'admin_id' => ''
  		);
  		$this->session->unset_userdata('is_logged_admin', $sess_array);
   		$this->session->set_flashdata('message', '<span style="color:green;">Successfully Logout !</span>');
  		redirect('adminlogin');
  	}
}
