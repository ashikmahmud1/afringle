<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Eyecolor extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Eyecolor_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Eyecolor', );
       		$data['ListOfEyecolor'] = $this->Eyecolor_model->ShowList();
       		$this->parser->parse('eyecolor/eyecolorlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddEyecolor(){

          $data = array( 'page_title' => 'Add Eyecolor', );

          if ($this->input->post())
           {
             $post = $this->input->post();

             $eyecolorlist = explode(",",$post['name']) ;

             foreach ($eyecolorlist as $eyecolor) {
               $post['name'] = $eyecolor;

              $RowAffetectd = $this->Eyecolor_model->InsertEyecolor($post);
             }


             if($RowAffetectd == true){
               $this->session->set_flashdata('message', '<span style="color:green;">Eyecolor Added Succssfully !</span>');
            	redirect('eyecolor/eyecolor-add');
             }else{
    				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Eyecolor Please try again !</span>');
    				  redirect('eyecolor/eyecolor-add');
    				}
      }

      $this->parser->parse('eyecolor/eyecoloradd', $data);



        }



        /*
         * Edit Method
        */


        	public function EditEyecolor(){

        		$data = array('page_title' => 'Edit Eyecolor');

         		$data['UpdateData'] = $this->Eyecolor_model->EditEyecolor($this->input->get('id'));

         		$this->form_validation->set_rules('name', 'name', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('eyecolor/eyecoloredit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Eyecolor_model->Updateeyecolor($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Eyecolor Update Sucessfully !</span>');
        				redirect('eyecolor/eyecolor-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Eyecolor Please try again !</span>');
        				redirect('eyecolor/eyecolor-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          public function DeleteEyecolor(){

        		$result = $this->Eyecolor_model->DeleteEyecolor($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Eyecolor Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Eyecolor!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('eyecolor/eyecolor-list');

        	}



}
