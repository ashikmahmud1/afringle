<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Manager extends CI_Controller{
    function __construct()
    {
        parent::__construct();
          $this->load->model(array('Manager_model','App_model'));

    }




/**
** Start List Manager Controller
**/

public function index()
{
       $data = array( 'page_title' => 'List Manager', );
  $data['ManagersList'] = $this->Manager_model->ManagersList();
  $this->parser->parse('manager/managerlist', $data);
}



/**
** Start Add New Manager Controller
**/
     	public function AddManager()
    	{
    		$data = array(   'page_title' => 'Add New Manager', );

    		$this->form_validation->set_rules('f_name', 'First name', 'required');
    		$this->form_validation->set_rules('l_name', 'Last name', 'required');
    		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[as_users.email]');

            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');


    		if ($this->form_validation->run() == FALSE)
            {
              $data['ManagerData'] = NULL;
               $this->parser->parse('manager/addmanager', $data);
            }
            else
            {

              	$post = $this->input->post();
                $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];

               			$managerData = [
               								'firstname' => $post['f_name'],
               					 			'lastname' => $post['l_name'],
                                            'username' => $post['username'],
               								'email' => $post['email'],
               								'phone' => $post['mobile'],
               								'password' => md5($post['password']),
               								'role' => 'Manager',
               								'status' => 'Active',
											
               								'active' => '1',
											
										
               								'created_date' => date('Y-m-d H:i:s'),
               								'hotel_id' => $hotelid ];



                    if (array_key_exists('Booking_add', $post)) {
                    $managerData['Booking_add'] = $post['Booking_add'];
                    }
                    if (array_key_exists('Booking_remove', $post)) {
                    $managerData['Booking_remove'] = $post['Booking_remove'];
                    }
                    if (array_key_exists('Booking_edit', $post)) {
                    $managerData['Booking_edit'] = $post['Booking_edit'];
                    }

                    if (array_key_exists('Room_add', $post)) {
                    $managerData['Room_add'] = $post['Room_add'];
                    }
                    if (array_key_exists('Room_remove', $post)) {
                    $managerData['Room_remove'] = $post['Room_remove'];
                    }
                    if (array_key_exists('Room_edit', $post)) {
                    $managerData['Room_edit'] = $post['Room_edit'];
                    }


                    if (array_key_exists('Coupon_add', $post)) {
                    $managerData['Coupon_add'] = $post['Coupon_add'];
                    }
                    if (array_key_exists('Coupon_remove', $post)) {
                    $managerData['Coupon_remove'] = $post['Coupon_remove'];
                    }
                    if (array_key_exists('Coupon_edit', $post)) {
                    $managerData['Coupon_edit'] = $post['Coupon_edit'];
                    }

                    if (array_key_exists('Facilities_add', $post)) {
                    $managerData['Facilities_add'] = $post['Facilities_add'];
                    }
                    if (array_key_exists('Facilities_remove', $post)) {
                    $managerData['Facilities_remove'] = $post['Facilities_remove'];
                    }
                    if (array_key_exists('Facilities_edit', $post)) {
                    $managerData['Facilities_edit'] = $post['Facilities_edit'];
                    }

                    if (array_key_exists('Services_add', $post)) {
                    $managerData['Services_add'] = $post['Services_add'];
                    }
                    if (array_key_exists('Services_remove', $post)) {
                    $managerData['Services_remove'] = $post['Services_remove'];
                    }
                    if (array_key_exists('Services_edit', $post)) {
                    $managerData['Services_edit'] = $post['Services_edit'];
                    }

                    if (array_key_exists('Calander_add', $post)) {
                    $managerData['Calander_add'] = $post['Calander_add'];
                    }
                    if (array_key_exists('Calander_remove', $post)) {
                    $managerData['Calander_remove'] = $post['Calander_remove'];
                    }
                    if (array_key_exists('Calander_edit', $post)) {
                    $managerData['Calander_edit'] = $post['Calander_edit'];
                    }

    			          $managerInsertId = $this->Manager_model->InsertAdminManager($managerData);
                    $this->session->set_flashdata('message', '<span style="color:green;">Manager Added Succssfully !</span>');
                    redirect('manager/manager-list');
             }

      	}




  /**
  **  Edit Manager Controller
  **/

  public function EditManager()
  {
    $data = array( 'page_title' => 'Edit Manager', );
    $hotelid = $this->session->userdata['is_logged_admin']['admin_id'];
    $data['ManagerData'] = $this->Manager_model->EditManagerRow($this->input->get('id'));

    $post = $this->input->post();
    $this->form_validation->set_rules('f_name', 'First name', 'required');
    $this->form_validation->set_rules('l_name', 'Last name', 'required');

    if ($this->form_validation->run() == FALSE)
        {
           $this->parser->parse('manager/editmanager', $data);
        }
        else{
        $UpdateResult = $this->Manager_model->UpdateAdminManager($managerData,$this->input->get('id'));
      if($UpdateResult == TRUE){
        $this->session->set_flashdata('message', '<span style="color:green;">Manager Update Succssfully !</span>');
        redirect('manager/manager-list');
      }else{
        $this->session->set_flashdata('message', '<span style="color:red;">Unable to Upage Manager Please try again !</span>');

        redirect('manager/edit-manager?id='.$this->input->get('id'));
          }
        }

    }



    /**
    **  Delete Manager Controller
    **/
    public function delete_manager(){

      $result = $this->Manager_model->ManagerDelete($this->input->get('id'));
      if($result == true){
        $message = '<span style="color:green;">Manager Delete Succssfully !</span>';
      }else{
        $message = '<span style="color:green;">Unable to Delete Manager !</span>';
      }
      $this->session->set_flashdata('message', $message);
      redirect('manager/manager-list');
    }



}
