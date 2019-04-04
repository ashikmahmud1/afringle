<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Event extends CI_Controller{
    function __construct()
    {
        parent::__construct();
  $this->load->model(array('Event_model'));
    }



        /*
         * List of Room Type
        */
        public function index(){
      		$data = array( 'page_title' => 'List Room Type', );
       		$data['EventList'] = $this->Event_model->ListEvent();
       		$this->parser->parse('event/eventlist', $data);
      	}

        public function dataentry(){
           $data = array( 'page_title' => 'List Room Type', );
       		$data['EventList'] = $this->Event_model->dataentry($_GET['s'],$_GET['e']);
       		$this->parser->parse('event/dataentry', $data);
      	}

            /*
             * Add Room Type
            */
        public function Add(){

          $data = array( 'page_title' => 'Add Room Type', );
          $this->form_validation->set_rules('event_name', 'Event', 'required');
          $this->form_validation->set_rules('event_price', 'Price', 'required');
          $this->form_validation->set_rules('event_start_date', 'Event', 'required');
          $this->form_validation->set_rules('event_end_date', 'Event', 'required');
          $this->form_validation->set_rules('event_location', 'Event', 'required');
          $this->form_validation->set_rules('event_details', 'Event', 'required');

              if ($this->form_validation->run() == FALSE)
              {
                 $this->parser->parse('event/eventadd', $data);
              }
              else
              {
                  $post = $this->input->post();
                if(isset($_FILES['event_image']['name'])){
              $config['upload_path']          = './upload/room';
                      $config['allowed_types']        = 'gif|jpg|jpeg|png';

                      $this->load->library('upload', $config);
                  if ( ! $this->upload->do_upload('event_image'))
                      {
                             $error = $this->upload->display_errors();
                             $this->session->set_flashdata('message', '<span style="color:red;">'. $error .'</span>');
                              redirect('event/event-add');
                      }
                      else
                      {
                            $file_data = $this->upload->data();
                            $post['event_image'] = $file_data['file_name'];
                       }
            }

            $imagepath = base_url('upload/room/').$post['event_image'];

            $rowdata = array(
                'event_name' => $post['event_name'],
                'event_price' => $post['event_price'],
                'event_start_date' => $post['event_start_date'],
                'event_end_date' => $post['event_end_date'],
                'event_location' => $post['event_location'],
                'event_details' => $post['event_details'],
                'event_image' => $imagepath
            );

              $RowAffetectd = $this->Event_model->InsertEventData($rowdata);
            if($RowAffetectd == true){
              $this->session->set_flashdata('message', '<span style="color:green;">Event Added Succssfully !</span>');
              redirect('event/event-add');
            }else{
              $this->session->set_flashdata('message', '<span style="color:red;">Event Add Room Please try again !</span>');
              redirect('event/event-add');
            }
               }

        }


        /*
         * Edit Room Type
        */

        	public function EventEdit(){

        		$data = array(
                'page_title' => 'Edit Event Type',
         		);


            $this->form_validation->set_rules('event_name', 'Event', 'required');
            $this->form_validation->set_rules('event_price', 'Price', 'required');
            $this->form_validation->set_rules('event_start_date', 'Event', 'required');
            $this->form_validation->set_rules('event_end_date', 'Event', 'required');
            $this->form_validation->set_rules('event_location', 'Event', 'required');
            $this->form_validation->set_rules('event_details', 'Event', 'required');

        		if ($this->form_validation->run() == FALSE)
                {
                  $data['EventData'] = $this->Event_model->EditRowEvent($this->input->get('id'));
                  $this->parser->parse('event/editevent', $data);
                }
                else
                {
                   	$post = $this->input->post();

        			if(isset($_FILES['event_image']['name'])){
        				$config['upload_path']          = './upload/room';
                        $config['allowed_types']        = 'gif|jpg|jpeg|png';

                        $this->load->library('upload', $config);

                        if ( ! $this->upload->do_upload('event_image'))
                        {
                          $post['event_image'] = $post['oldevent_image'];
                        }
                        else
                        {
                                $file_data = $this->upload->data();
         						            $post['event_image'] = base_url('/upload/room/').$file_data['file_name'];

                         }
        			}


              $eventdata = array(
                'event_name' => $post['event_name'],
                'event_price' => $post['event_price'],
                'event_start_date' => $post['event_start_date'],
                'event_end_date' => $post['event_end_date'],
                'event_location' => $post['event_location'],
                'event_details' => $post['event_details'],
                'event_image' => $post['event_image'],

              );


           			$RowAffetectd = $this->Event_model->UpdateEvent($eventdata,$this->input->post('event_id'));
         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">event Update Succssfully !</span>');
        				redirect('event/event-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update event Please try again !</span>');
        				redirect('event/event-edit?id='.$this->input->get('id'));
        			}
                 }

         	}

          /*
           * Delete Room Type
          */

          public function EventDelete(){

        		$result = $this->Event_model->DeleteEvent($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Room Type Delete Succssfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Room Type !</span>';
        		}
        		$this->session->set_flashdata('message', $message);
        		redirect('event/event-list');
        	}






}
