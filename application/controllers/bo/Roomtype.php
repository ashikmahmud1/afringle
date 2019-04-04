<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Roomtype extends CI_Controller{
    function __construct()
    {
        parent::__construct();
  $this->load->model(array('Roomtype_model'));
    }



        /*
         * List of Room Type
        */
        public function index(){

      		$data = array( 'page_title' => 'List Room Type', );
       		$data['ListRoomType'] = $this->Roomtype_model->ListRoomType();
       		$this->parser->parse('roomtype/roomtypelist', $data);
      	}



            /*
             * Add Room Type
            */
        public function Add(){

          $data = array( 'page_title' => 'Add Room Type', );
          $this->form_validation->set_rules('room_type_name', 'Room Type', 'required');

              if ($this->form_validation->run() == FALSE)
              {
                 $this->parser->parse('roomtype/addroomtype', $data);
              }
              else
              {
                  $post = $this->input->post();
                if(isset($_FILES['room_type_file']['name'])){
              $config['upload_path']          = './upload/room';
                      $config['allowed_types']        = 'gif|jpg|jpeg|png';

                      $this->load->library('upload', $config);
                  if ( ! $this->upload->do_upload('room_type_file'))
                      {
                             $error = $this->upload->display_errors();
                             $this->session->set_flashdata('messageError', '<span style="color:red;">'. $error .'</span>');
                             redirect('roomtype/room-type-add');
                      }
                      else
                      {
                            $file_data = $this->upload->data();
                            $post['room_type_file'] = $file_data['file_name'];
                       }
            }
            $post['created_date'] = date('Y-m-d H:i:s');
              $RowAffetectd = $this->Roomtype_model->InsertRoomType($post);
            if($RowAffetectd == true){
              $this->session->set_flashdata('message', '<span style="color:green;">Room Type Added Succssfully !</span>');
              redirect('roomtype/room-type-list');
            }else{
              $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Room Please try again !</span>');
              redirect('roomtype/room-type-add');
            }
               }

        }


        /*
         * Edit Room Type
        */

        	public function Edit(){

        		$data = array(
                'page_title' => 'Edit Room Type',
         		);
         		$data['RoomTypeData'] = $this->Roomtype_model->EditRowRoomType($this->input->get('id'));

         		$this->form_validation->set_rules('room_type_name', 'Room Type', 'required');

        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('roomtype/editroomtype', $data);
                }
                else
                {
                   	$post = $this->input->post();

        			if(isset($_FILES['room_type_file']['name'])){
        				$config['upload_path']          = './upload/room';
                        $config['allowed_types']        = 'gif|jpg|jpeg|png';

                        $this->load->library('upload', $config);

                        if ( ! $this->upload->do_upload('room_type_file'))
                        {
                               $error = $this->upload->display_errors();
        					   $this->session->set_flashdata('messageError', '<span style="color:red;">'. $error .'</span>');
        					   redirect('roomtype/edit-room-type?id='.$this->input->get('id'));
                        }
                        else
                        {
                                $file_data = $this->upload->data();
         						$post['room_type_file'] = $file_data['file_name'];
                         }
        			}



           			$RowAffetectd = $this->Roomtype_model->UpdateRoomType($post,$this->input->get('id'));
         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Room Type Update Succssfully !</span>');
        				redirect('roomtype/room-type-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Room Type Please try again !</span>');
        				redirect('roomtype/edit-room-type?id='.$this->input->get('id'));
        			}
                 }

         	}

          /*
           * Delete Room Type
          */

          public function Delete(){

        		$result = $this->Roomtype_model->DeleteRoomType($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Room Type Delete Succssfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Room Type !</span>';
        		}
        		$this->session->set_flashdata('message', $message);
        		redirect('roomtype/room-type-list');
        	}






}
