<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Bodytype extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Bodytype_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Bodytype', );
       		$data['ListOfBodytype'] = $this->Bodytype_model->ShowList();
       		$this->parser->parse('bodytype/bodytypelist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddBodytype(){

          $data = array( 'page_title' => 'Add bodytype', );

          if ($this->input->post())
           {
             $post = $this->input->post();

             $bodytypelist = explode(",",$post['name']) ;

             foreach ($bodytypelist as $bodytype) {
               $post['name'] = $bodytype;

              $RowAffetectd = $this->Bodytype_model->InsertBodytype($post);
             }


             if($RowAffetectd == true){
               $this->session->set_flashdata('message', '<span style="color:green;">bodytype Added Succssfully !</span>');
            	redirect('bodytype/bodytype-add');
             }else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Bodytype Please try again !</span>');
				  redirect('bodytype/bodytype-add');
				}
      }

      $this->parser->parse('bodytype/bodytypeadd', $data);



        }



        /*
         * Edit Method
        */


        	public function EditBodytype(){

        		$data = array('page_title' => 'Edit bodytype');

         		$data['UpdateData'] = $this->Bodytype_model->EditBodytype($this->input->get('id'));

         		$this->form_validation->set_rules('name', 'name', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('bodytype/bodytypeedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Bodytype_model->Updatebodytype($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Bodytype Update Sucessfully !</span>');
        				redirect('bodytype/bodytype-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Bodytype Please try again !</span>');
        				redirect('bodytype/bodytype-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          public function DeleteBodytype(){

        		$result = $this->Bodytype_model->DeleteBodytype($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Bodytype Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Bodytype!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('bodytype/bodytype-list');

        	}



}
