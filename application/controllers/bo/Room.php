<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Room extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Room_model'));

    }


    /*
     * Show Room List
    */
    public function index()
  	{
  		$data = array( 'page_title' => 'List Room');
  		$data['RoomsList'] = $this->Room_model->RoomsList();
   		$this->parser->parse('room/roomlist', $data);
    	}


      /*
       * Add Room
      */
      public function RoomAdd()
     {
       if($this->Permissions->RoomAdd() != 1){ redirect('access-denied');}

       $data = array('page_title' => 'Add New Room');


       $data['roomType'] = $this->Room_model->RoomType();
       $data['servicesList'] = $this->Room_model->ServicesList();
       $data['facilitieList'] = $this->Room_model->FacilitieList();
       $data['taxesList'] = $this->Room_model->TaxList();


       $this->form_validation->set_rules('room_type', 'room type', 'required');
       $this->form_validation->set_rules('room_name', 'room name', 'required');
       $this->form_validation->set_rules('max_person', 'max person ', 'required|numeric');
       $this->form_validation->set_rules('room_tax', 'room tax', 'required|numeric');
       $this->form_validation->set_rules('room_short_description', 'room short description ', 'required');
       $this->form_validation->set_rules('room_long_description', 'room long description ', 'required');


       if ($this->form_validation->run() == FALSE)
           {$this->parser->parse('room/addroom', $data);}
           else
           { $post = $this->input->post();

         if(isset($_FILES['room_main_image_file']['name']) && !empty($_FILES['room_main_image_file']['name'])){
           $config['upload_path']          = './upload/room';
                   $config['allowed_types']        = 'gif|jpg|png';
                   $this->load->library('upload', $config);
                   if ( ! $this->upload->do_upload('room_main_image_file'))
                   {
                      $data['mainImageError'] = $this->upload->display_errors();
                      $this->parser->parse('room/room-add', $data);
                      return;
                   }
                   else
                   {
                       $file_data = $this->upload->data();
                       $post['room_main_image'] = $file_data['file_name'];
                   }
         }


         if(isset($_FILES['other_image_file']['name']) && !empty($_FILES['other_image_file']['name'])){
           $config2['upload_path']  = './upload/room';
                   $config2['allowed_types']  = 'gif|jpg|png';

                   $this->load->library('upload', $config2);

                   if ( ! $this->upload->do_upload('other_image_file'))
                   {
                      $data['mainImageErrorOther'] = $this->upload->display_errors();
                      $this->parser->parse('room/room-add', $data);
                      return;
                   }
                   else
                   {
                       $file_data2 = $this->upload->data();
                       $post['other_image'] = $file_data2['file_name'];
                  }
         }


         $post['services']= json_encode($post['serviceslist']);
         $post['features']= json_encode($post['featureslist']);
         $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
         $post['hotel_id'] = $hotelid;
         if($post['status'] == 'awaiting'){
           $date = explode('-',$post['start_end_dates']);
           $post['start_date'] = date('Y-m-d',strtotime($date[0]) );
           $post['end_date'] = date('Y-m-d',strtotime($date[1]) );
         }

         $post['create_date'] = date('Y-m-d H:i:s');
         $post['room_slug'] = $this->Room_model->Slug($post['room_name']);
         unset($post['serviceslist'],$post['featureslist'],$post['start_end_dates']);
         $lastAdminInsertId = $this->Room_model->InsertAdminRoom($post);

         if($lastAdminInsertId == true){
           $this->session->set_flashdata('message', '<span style="color:green;">Room Added Succssfully !</span>');
           redirect('room/room-add');
         }else{
           $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Room Please try again !</span>');
           redirect('room/room-add');
         }
        }


}

/*
 * Edit Room
*/

public function Edit(){
  if($this->Permissions->RoomEdit() != 1){ redirect('access-denied');}

  $data = array( 'page_title' => 'Edit Room', );

  $data['RowRoomData'] = $this->Room_model->RowRoomData($this->input->get('id'));
  $data['roomType'] = $this->Room_model->RoomType();
  $data['servicesList'] = $this->Room_model->ServicesList();
  $data['facilitieList'] = $this->Room_model->FacilitieList();
  $data['taxesList'] = $this->Room_model->TaxList();

  $this->form_validation->set_rules('room_type', 'room type', 'required');
  $this->form_validation->set_rules('room_name', 'room name', 'required');
  $this->form_validation->set_rules('max_person', 'max person ', 'required|numeric');
  $this->form_validation->set_rules('adult_price', 'Adult ', 'required|numeric');
  $this->form_validation->set_rules('child_price', 'Child ', 'required|numeric');
  $this->form_validation->set_rules('room_tax', 'room tax', 'required|numeric');
  $this->form_validation->set_rules('room_short_description', 'room short description ', 'required');
  $this->form_validation->set_rules('room_long_description', 'room long description ', 'required');

  if ($this->form_validation->run() == FALSE)
      {         $this->parser->parse('room/editroom', $data);
      }
      else
      {
          $post = $this->input->post();

    if(isset($_FILES['room_main_image_file']['name']) && !empty($_FILES['room_main_image_file']['name'])){
      $config['upload_path']          = './upload/room';
              $config['allowed_types']        = 'gif|jpg|jpeg|png';

              $this->load->library('upload', $config);
              if ( ! $this->upload->do_upload('room_main_image_file'))
              {
               $data['mainImageError'] = $this->upload->display_errors();
               $this->parser->parse('room/editroom', $data);
               return;
              }
              else
              {
              $file_data = $this->upload->data();
              $post['room_main_image'] = $file_data['file_name'];
              }
    }


    if(isset($_FILES['other_image_file']['name']) && !empty($_FILES['other_image_file']['name'])){
      $config2['upload_path']          = './upload/room';
              $config2['allowed_types']        = 'gif|jpg|jpeg|png';

              $this->load->library('upload', $config2);
              if ( ! $this->upload->do_upload('other_image_file'))              {               $data['mainImageErrorOther'] = $this->upload->display_errors();               $this->parser->parse('room/editroom', $data);               return;              }              else              {                $file_data2 = $this->upload->data();                $post['other_image'] = $file_data2['file_name'];              }    }



    $post['room_slug'] = strtolower(url_title($post['room_name']));
    $post['services']= json_encode($post['serviceslist']);
    $post['features']= json_encode($post['featureslist']);

    if($post['status'] == 'awaiting'){
      $date = explode('-',$post['start_end_dates']);
      $post['start_date'] = date('Y-m-d',strtotime($date[0]) );
      $post['end_date'] = date('Y-m-d',strtotime($date[1]) );
      echo $start_date = date('Y-m-d',strtotime($date[0]) );
      echo $end_date = date('Y-m-d',strtotime($date[1]) );
      $res = $this->db->get_where('bookings',['room_ids' => $this->input->get('id') ])->row_array();
      echo $dbStartDate = $res['booking_start_date'];
      echo $dbEndDate = $res['booking_end_date'];
      $DateRanges = $this->dateRange($start_date,$end_date);

      if( in_array($dbStartDate,$DateRanges) || in_array($dbEndDate,$DateRanges) ){
        $this->session->set_flashdata("messageRR", "This room booking these $dbStartDate - $dbEndDate date range !");
        redirect('room/edit-room?id='.$this->input->get('id'));

      }else{ }

      }else{
      $post['start_date'] = '';
      $post['end_date'] = '';
    }

    $post['create_date'] = date('Y-m-d H:i:s');
    unset($post['serviceslist'],$post['featureslist'],$post['start_end_dates']);
    $lastAdminInsertId = $this->Room_model->UpdateRoom($post,$this->input->get('id'));
    if($lastAdminInsertId == true){
      $this->session->set_flashdata('message', '<span style="color:green;">Room update Succssfully !</span>');
      redirect('room/room-list');
    }else{
      $this->session->set_flashdata('message', '<span style="color:red;">Unable to update Room Please try again !</span>');
      redirect('room/edit-room?id='.$this->input->get('id'));
    }
     }


  }




  /*
   * Delete Room
  */

  public function Delete(){

		if($this->Permissions->RoomRemove() != 1){ redirect('access-denied');}

		$result = $this->Room_model->RoomDelete($this->input->get('id'));
		if($result == true){
			$message = '<span style="color:green;">Room Delete Successfully !</span>';
 		}else{
			$message = '<span style="color:green;">Unable to Delete Manager !</span>';
		}
		$this->session->set_flashdata('message', $message);
		redirect('room/room-list');
	}




  /*
   * Range of Date
  */

  public function dateRange($start_date,$end_date){
      date_default_timezone_set('UTC');
      $date = $start_date;
      $end_date = $end_date;
      $datesLoopArray=[];
      while (strtotime($date) <= strtotime($end_date)) {
      $datesLoopArray[] = $date;
      $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
      }
      return $datesLoopArray;
}







}
