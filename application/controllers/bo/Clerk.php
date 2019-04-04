<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clerk extends CI_Controller {

 	function __construct() {
		parent::__construct();
        $this->load->model(array('Clerk_model','App_model'));

	 }


/*
*Get List of Clerk
*/
   public function index()
   {
     $data = array( 'page_title' => 'List Clerk', );
     $data['ClerksList'] = $this->Clerk_model->ClerksList();
     $this->parser->parse('clerk/clerklist', $data);
  }


  /*
  *Add New Clerk
  */
 	public function add()
	{
    		$data = array( 'page_title' => 'Add New Clerk', );

    		$this->form_validation->set_rules('f_name', 'First name', 'required');
    		$this->form_validation->set_rules('l_name', 'Last name', 'required');
    		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[as_users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.') );
        $this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');

    		if ($this->form_validation->run() == FALSE)
        {
           $this->parser->parse('clerk/addclerk', $data);
        }
        else
        {
			
			              	$post = $this->input->post();
                $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
				
            $post = $this->input->post();
      			$admin_userData = [
      								'firstname' => $post['f_name'],
      								'lastname' => $post['l_name'],
      								'email' => $post['email'],
      								'phone' => $post['mobile'],
      								'username' => $post['email'],
      								'password' => $this->App_model->hashPassword( $post['password']),
      								'role' => 'Clerk',
									'status' => 'Active',
									'active' => '1',									
									'created_date' => date('Y-m-d H:i:s'),
									'hotel_id' => $hotelid ];									
      							

      			$lastAdminInsertId = $this->Clerk_model->InsertClerk($admin_userData);
      			if($lastAdminInsertId != false){

      				$this->session->set_flashdata('message', '<span style="color:green;">Clerk Added Succssfully !</span>');
      				redirect('clerk/clerk-list');
      			}else{
       				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Clerk Please try again !</span>');
      				redirect('clerk/clerk-add');
      			}
          }
  }

  /*
  *Edit Clerk Data
  */
	public function edit()
	{
		$data = array( 'page_title' => 'Edit Clerk', );
		$data['ManagerData'] = $this->Clerk_model->EditClerkRow($this->input->get('id'));
 		$post = $this->input->post();
		$this->form_validation->set_rules('f_name', 'First name', 'required');
		$this->form_validation->set_rules('l_name', 'Last name', 'required');
		if(!empty($post['password'])){
			$this->form_validation->set_rules('password', 'Password', 'required',
							array('required' => 'You must provide a %s.')
					);
			$this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');
		}

		if ($this->form_validation->run() == FALSE)
    {
       $this->parser->parse('clerk/edit_clerk', $data);
    }
    else
    {
			$admin_userData = [
								'firstname' => $post['f_name'],
								'lastname' => $post['l_name'],
								'phone' => $post['mobile'],
  							];
			if(!empty($post['password'])){
				$admin_userData['password'] =  $this->App_model->hashPassword( $post['password']);
			}

			$UpdateResult = $this->Clerk_model->UpdateClerk($admin_userData,$this->input->get('id'));
			if($UpdateResult == TRUE)
      {
				$this->session->set_flashdata('message', '<span style="color:green;">clerk Update Succssfully !</span>');
				redirect('clerk/clerk-list');
			}else{
 				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Upage clerk Please try again !</span>');
				redirect('clerk/edit-clerk?id='.$this->input->get('id'));
			}
    }
  }

	public function delete(){
		$result = $this->Clerk_model->ClerkDelete($this->input->get('id'));
		if($result == true)
    {
			$message = '<span style="color:green;">clerk Delete Succssfully !</span>';
 		}else{
			$message = '<span style="color:green;">Unable to Delete clerk !</span>';
		}
		$this->session->set_flashdata('message', $message);
		redirect('clerk/clerk-list');
	}

}
