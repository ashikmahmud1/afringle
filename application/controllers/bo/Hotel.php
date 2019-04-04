<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Hotel extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Hotel_model', 'App_model'));
    }

    /*
    *list hotels
    */
    public function index()
  	{
  		$data = array( 'page_title' => 'List User');
  		$data['HotelsList'] = $this->Hotel_model->HotelList();

      $this->parser->parse('hotel/hotellist', $data);
  	}


	
	

    /*
    *Add hotels
    */
    public function add()
    {
      $data = array( 'page_title' => 'Add New Hotel', );
      if (empty($_FILES['hotel_image']['name'])){    $this->form_validation->set_rules('hotel_image', 'Attachment', 'required','callback_file_check');}
      if (empty($_FILES['image']['name'])){    $this->form_validation->set_rules('image', 'Attachment', 'required','callback_file_check');}
      $this->form_validation->set_rules('firstname', 'First name', 'required');
      $this->form_validation->set_rules('lastname', 'Last name', 'required');
      $this->form_validation->set_rules('mobile', 'Phone Number', 'required');
      $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('hotel_contact', 'Hotel Contact', 'required');
      $this->form_validation->set_rules('hotel_type', 'Hotel Type', 'required');
      $this->form_validation->set_rules('hotel_address', 'Hotel Address', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('state', 'State', 'required');
      $this->form_validation->set_rules('country', 'Country', 'required');
      $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[as_users.email]');
      $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.') );
      $this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');

      if ($this->form_validation->run() == FALSE)
      {
         $this->parser->parse('hotel/addhotel', $data);
      }
      else
      {
        $post = $this->input->post();
        $login_id = $this->session->userdata['is_logged_admin']['admin_id'];

        $admin_userData = [
                  'firstname' => $post['firstname'],
                  'lastname' => $post['lastname'],
                  'email' => $post['email'],
                  'phone' => $post['mobile'],
                  'username' => $post['username'],
                  'status' => 'Active',
                  'active' => 1,
				'Booking_add' => '1',
				'Booking_remove' => '1',
				'Booking_edit' => '1',
				'Room_add' => '1',
				'Room_remove' => '1',
				'Room_edit' => '1',
				'Coupon_add' => '1',
				'Coupon_remove' => '1',
				'Coupon_edit' => '1',
				'Facilities_add' => '1',
				'Facilities_remove' => '1',
				'Facilities_edit' => '1',
				'Services_add' => '1',
				'Services_remove' => '1',
				'Services_edit' => '1',
				'Calander_add' => '1',
				'Calander_remove' => '1',
				'Calander_edit' => '1',
                  'password' => $this->App_model->hashPassword( $post['password']),
                  'role' => 'Hotel',
                  'refer_by' => $login_id,
                ];

        $HotelData = [
                'hotel_name' => $post['hotel_name'],
                'hotel_refer_id' => $login_id,
                'hotel_address' => $post['hotel_address'],
                'hotel_slug' => $post['hotel_name'],
                'hotel_contact' => $post['hotel_contact'],
                'images' => '',
                'description' => $post['hotel_description'],
                'hotel_type' => $post['hotel_type'],
                'city' => $post['city'],
                'state' => $post['state'],
                'country' => $post['country'],
                'zipcode' => $post['zipcode'],
              ];

        if($this->Hotel_model->isUserexist($this->input->post('email'))){
          $lastAdminInsertId = $this->Hotel_model->InsertHotel($HotelData);
          if($lastAdminInsertId != false){
            $admin_userData['hotel_id']=$lastAdminInsertId;
            $addAdmin_privileges = $this->Hotel_model->InsertAdminUser($admin_userData);
            $this->session->set_flashdata('message', '<span style="color:green;">Hotel Added Succssfully !</span>');
            redirect('hotel/hotel-list');
          }else{
            $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Hotel Please try again !</span>');
            redirect('hotel/hotel-add');
          }
        }else{
          $this->session->set_flashdata('message', '<span style="color:red;">Email Existing !</span>');
          redirect('hotel/hotel-add');
        }
      }
    }













    /*
    *Add hotel Type
    */
    public function hoteltype()
    {
      $data = array( 'page_title' => 'Add Hotel Type', );

      $this->form_validation->set_rules('hotel_type', 'Hotel Type', 'required');

      if ($this->form_validation->run() == FALSE)
      {
         $this->parser->parse('hotel/hoteltype', $data);
      }
      else
      {
        $post = $this->input->post();
        $login_id = $this->session->userdata['is_logged_admin']['hotel_id'];

      
        $data = [
                  'hotel_id' => $login_id,
                  'hotel_type' => $post['hotel_type']
                  ];

            $success = $this->Hotel_model->InsertHotelType($data);
            if($success){
            $this->session->set_flashdata('message', '<span style="color:green;">Hotel type Added Succssfully !</span>');
            redirect('hotel/hoteltype-add');
          }else{
            $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Hotel type Please try again !</span>');
            redirect('hotel/hoteltype-add');
          }

      }
    }



  //========================FRONT HOTEL ADD ========================

  /*
  *Add hotels from front end
  */
  public function FrontHotel()
  {
      $data = array( 'page_title' => 'Add New Hotel', );
      if (empty($_FILES['hotel_image']['name'])){    $this->form_validation->set_rules('hotel_image', 'Attachment', 'required','callback_file_check');}
      if (empty($_FILES['image']['name'])){    $this->form_validation->set_rules('image', 'Attachment', 'required','callback_file_check');}
      $this->form_validation->set_rules('firstname', 'First name', 'required');
      $this->form_validation->set_rules('lastname', 'Last name', 'required');
      $this->form_validation->set_rules('mobile', 'Phone Number', 'required');
      $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('hotel_contact', 'Hotel Contact', 'required');
      $this->form_validation->set_rules('hotel_type', 'Hotel Type', 'required');
      $this->form_validation->set_rules('hotel_address', 'Hotel Address', 'required');
      $this->form_validation->set_rules('city', 'City', 'required');
      $this->form_validation->set_rules('state', 'State', 'required');
      $this->form_validation->set_rules('country', 'Country', 'required');
      $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_exists_username');

      $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.') );
      $this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');

      $config['upload_path']   = './assets/uploads';
      $config['allowed_types'] = 'gif|jpg|png';

      $this->load->library('upload', $config);
      $send = $this->input->post() ;
      if (!$this->upload->do_upload('hotel_image'))
      {
          $error = array('error' => $this->upload->display_errors());
      }
      else
      {
          $upload_data = $this->upload->data();
          $data = array('upload_data' =>$upload_data);
          $upload_data['file_name'];
          $send['image_url1'] = $upload_data['file_name'];
      }

      if ( !$this->upload->do_upload('image')){
        $error = array('error' => $this->upload->display_errors());
      }else {
        $upload_data = $this->upload->data();
        $data = array('upload_data' =>$upload_data);
        $upload_data['file_name'];
        $send['image_url2'] = $upload_data['file_name'];
      }

    if ($this->form_validation->run() == FALSE)
    {
       $this->parser->parse('front/hotelier-join', $data);
    }
    else
    {
      $post = $this->input->post();
      $admin_userData = [
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'email' => $post['email'],
                'phone' => $post['mobile'],
                'status' => 0,
                'active' => 0,
                'username' => $post['email'],
                'password' => $this->App_model->hashPassword( $post['password']),
                'role' => 'Hotel',
                'refer_by' => 1,
                'image' =>  $send['image_url2']
              ];

      $HotelData = [
              'hotel_name' => $post['hotel_name'],
              'hotel_refer_id' => 1,
              'hotel_address' => $post['hotel_address'],
              'hotel_contact' => $post['hotel_contact'],
              'description' => $post['hotel_description'],
              'hotel_type' => $post['hotel_type'],
              'city' => $post['city'],
              'state' => $post['state'],
              'country' => $post['country'],
              'zipcode' => $post['zipcode'],
              'hotel_image' =>  $send['image_url1']
            ];

      if($this->Hotel_model->isUserexist($this->input->post('email')))
      {
        $lastAdminInsertId = $this->Hotel_model->InsertfrontHotel($HotelData);
        if($lastAdminInsertId != false){
          $admin_userData['hotel_id']=$lastAdminInsertId;
          $addAdmin_privileges = $this->Hotel_model->InsertfrontHotelUser($admin_userData);
          $this->session->set_flashdata('message', '<span style="color:green;">Hotel Added Succssfully !</span>');
          redirect('hotelier-join');
        }else{
          $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Hotel Please try again !</span>');
          redirect('hotelier-join');
        }
      }else{
        $this->session->set_flashdata('message', '<span style="color:red;">Email already Existing !</span>');
        redirect('hotelier-join');
      }
    }
  }

  //========================END FRONT HOTEL ADD ========================

  /*
  *Check hotel owner existing or not
  */
     function exists_username()
    {
        if ($this->Hotel_model->isUserexist($this->input->post('email')))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


    /*
    *list Pending hotels who is signup from front End
    */
    public function pending_list()
    {
      $data = array( 'page_title' => 'Pending User List');
      $data['HotelsList'] = $this->Hotel_model->pendingHotelList();
      $this->parser->parse('hotel/hotelapproval', $data);
    }


    /*
    *Update hotel data
    */
    public function UpdateHoteldata()
    {
       $savehotel = $this->Hotel_model->updateHotel_save($_POST);
       if($savehotel){
         $this->session->set_flashdata('message', 'Updated');
       }else{
           $this->session->set_flashdata('message', 'Not Updated');
       }
       redirect('hotel/update-hotel?h_id='.$_POST['hotel_id']);
    }

    /*
    *Redirect to update view
    */
      public function update($data= "")
      {
        $hId = $this->input->get('h_id');
        $data['hotelId'] = $this->Hotel_model->UpdateHotel($hId);
        $this->load->view('hotel/update-hotel', $data);
      }


      /*
      *Edit hotel
      */
    	public function edit()
    	{

    		$data = array( 'page_title' => 'Edit Hotel' );

    		$data['HotelData'] = $this->Hotel_model->EditHotelRow($this->input->get('id'));
    		$data['HotelPrivilegeData'] = $this->Hotel_model->EditHotelPrivilegeRow($this->input->get('id'));

     		$post = $this->input->post();

    		$this->form_validation->set_rules('firstname', 'First name', 'required');
    		$this->form_validation->set_rules('lastname', 'Last name', 'required');
    		//$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin_users.email]');
    		if(!empty($post['password'])){
    			$this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.') );
    			$this->form_validation->set_rules('c_password', 'Password Confirmation', 'required|matches[password]');
    		}

    		if ($this->form_validation->run() == FALSE)
        {
           $this->parser->parse('hotel/edit_hotel_page', $data);
        }
        else
        {
    			$admin_userData = [
    								'name' => $post['firstname'].' '. $post['lastname'],
    								'firstname' => $post['firstname'],
    								'lastname' => $post['lastname'],
    								//'email' => $post['email'],
    								'mobile' => $post['mobile'],
    								//'username' => $post['email'],
    								//'password' => $this->App_model->hashPassword( $post['password']),
    								'role' => 'Hotel',
     							];

    			if(!empty($post['password'])){
    				$admin_userData['password'] =  $this->App_model->hashPassword( $post['password']);
    			}

    			$UpdateResult = $this->Hotel_model->UpdateAdminHotel($admin_userData,$this->input->get('id'));
    			if($UpdateResult == TRUE){
    				unset($post['firstname'],$post['lastname'],$post['email'],$post['mobile'],$post['password'],$post['c_password']);//remove admin user data
    				$addAdmin_privileges = $this->Hotel_model->UpdateAdminPrivileges($post,$this->input->get('id'));
    				$this->session->set_flashdata('message', '<span style="color:green;">Hotel Update Succssfully !</span>');
    				redirect('hotel/hotel-list');
    			}else{
     				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Upage Hotel Please try again !</span>');
    				redirect('hotel/edit-hotel?id='.$this->input->get('id'));
    			}
        }
      }

      /*
      *Delete hotel
      */
    	public function delete(){

    		$result = $this->Hotel_model->HotelDelete($this->input->get('id'));
    		if($result == true){
    			$message = '<span style="color:green;">Hotel Delete Succssfully !</span>';
     		}else{
    			$message = '<span style="color:green;">Unable to Delete Hotel !</span>';
    		}
    		$this->session->set_flashdata('message', $message);
    		redirect('hotel-list');
    	}


      public function removehotel($data="")
      {
         $hotlId = $this->input->get('h_id');
         $this->Hotel_model->removehotel($hotlId);
         redirect('hotel/hotel-list');
      }


      /*
      *Approve pending hotels
      */
      public function approveHotel()
      {
        $hId = $this->input->get('h_id');
        if ($this->Hotel_model->approveHotel($hId)) {
          $this->session->set_flashdata('message', 'Hotel Approved Succesfully');
        }else {
          $this->session->set_flashdata('message', 'Hotel Not Approved');
        }
        redirect('hotel/hotel-pending');
      }
}
