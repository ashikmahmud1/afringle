<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Education extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Education_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Education', );
       		$data['ListOfEducation'] = $this->Education_model->ShowList();
       		$this->parser->parse('education/educationlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddEducation(){

          $data = array( 'page_title' => 'Add Education', );

          if ($this->input->post())
           {
             $post = $this->input->post();

             $educationlist = explode(",",$post['name']) ;

             foreach ($educationlist as $education) {
               $post['name'] = $education;

              $RowAffetectd = $this->Education_model->InsertEducation($post);
             }


             if($RowAffetectd == true){
               $this->session->set_flashdata('message', '<span style="color:green;">Education Added Succssfully !</span>');
            	redirect('education/education-add');
             }else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Education Please try again !</span>');
				  redirect('education/education-add');
				}
      }

      $this->parser->parse('education/educationadd', $data);



        }



        /*
         * Edit Method
        */


        	public function EditEducation(){

        		$data = array('page_title' => 'Edit Education');

         		$data['UpdateData'] = $this->Education_model->EditEducation($this->input->get('id'));

         		$this->form_validation->set_rules('name', 'name', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('education/educationedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Education_model->Updateeducation($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Education Update Sucessfully !</span>');
        				redirect('education/education-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Education Please try again !</span>');
        				redirect('education/education-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          public function DeleteEducation(){

        		$result = $this->Education_model->DeleteEducation($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Education Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Education!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('education/education-list');

        	}



}
