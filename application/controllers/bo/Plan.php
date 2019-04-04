<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Plan extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Plan_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Plan Color', );
       		$data['ListOfPlan'] = $this->Plan_model->ShowList();
       		$this->parser->parse('plan/planlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddPlan(){

          $data = array( 'page_title' => 'Add Plan Color', );

          $this->form_validation->set_rules('plan_name', 'Plan', 'required');
          $this->form_validation->set_rules('plan_time', 'Plan time', 'required');
          $this->form_validation->set_rules('plan_price', 'Price', 'required');

              if ($this->form_validation->run() == FALSE)
              {
                 $this->parser->parse('plan/planadd', $data);
              }
			           else
              {
                $post = $this->input->post();



                if(isset($_FILES['plan_image']['name'])){
					$config['upload_path']          = './upload';
                    $config['allowed_types']        = 'gif|jpg|jpeg|png';

                   $this->load->library('upload', $config);

                 if ( ! $this->upload->do_upload('plan_image'))
                      {
                             $error = $this->upload->display_errors();
                             $this->session->set_flashdata('message', '<span style="color:red;">'. $error .'</span>');
                             redirect('plan/planadd');
                      }
                      else
                      {
                            $file_data = $this->upload->data();
                            $post['plan_image'] = base_url('/upload').'/'.$file_data['file_name'];
                       }
            }

// print_r($post); die();
      $services = json_encode($this->input->post('plan_services'));

      $services =str_replace("[","",$services);
      $services =str_replace("]","",$services);
      $post['plan_services'] =   $services;

        $RowData = $this->Plan_model->InsertPlan($post);

				if($RowData == true){
				  $this->session->set_flashdata('message', '<span style="color:green;">Plan Color Added Succssfully !</span>');
				  redirect('plan/plan-list');
				}else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Plan Color Please try again !</span>');
				  redirect('plan/plan-add');
				}
               }



        }



        /*
         * Edit Method
        */


        	public function EditPlan(){

        		$data = array('page_title' => 'Edit Plan');

         		$data['UpdateData'] = $this->Plan_model->EditRowPlan($this->input->get('id'));

            $this->form_validation->set_rules('plan_name', 'Plan', 'required');
            $this->form_validation->set_rules('plan_time', 'Plan time', 'required');
            $this->form_validation->set_rules('plan_price', 'Price', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('plan/planedit', $data);
                }
                else
                {
                $post = $this->input->post();


                if(isset($_FILES['plan_image']['name'])){
               $config['upload_path']          = './upload';
               $config['allowed_types']        = 'gif|jpg|jpeg|png';
               $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('plan_image'))
                 {
                       $post['plan_image'] = $post['oldplan_image'];
                 }
                 else
                 {
                       $file_data = $this->upload->data();
                       $post['plan_image'] = base_url('/upload').'/'.$file_data['file_name'];
                  }
       }





                  $services = json_encode($this->input->post('plan_services'));
                  $services =str_replace("[","",$services);
                  $services =str_replace("]","",$services);


                  $storydata = array(
                    'plan_services' =>   $services,
                    'plan_name' => $post['plan_name'],
                    'plan_image' => $post['plan_image'],
                    'plan_time' => $post['plan_time'],
                    'plan_price' => $post['plan_price'],
                    'plan_description' => $post['plan_description']
                  );



           		$RowAffetectd = $this->Plan_model->UpdatePlan($storydata,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Plan Color Update Sucessfully !</span>');
        				redirect('plan/plan-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Plan Color Please try again !</span>');
        				redirect('plan/plan-edit?id='.$this->input->get('id'));
        			}

              }

         	}



          /*
           * Delete Method
          */

          public function DeletePlan(){

        		$result = $this->Plan_model->DeletePlan($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Plan Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Plan!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('plan/plan-list');

        	}



}
