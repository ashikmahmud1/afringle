<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Profession extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Profession_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Profession', );
       		$data['ListOfProfession'] = $this->Profession_model->ShowList();
       		$this->parser->parse('profession/professionlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddProfession(){

          $data = array( 'page_title' => 'Add Profession', );

          if ($this->input->post())
           {
             $post = $this->input->post();

             $professionlist = explode(",",$post['name']) ;

             foreach ($professionlist as $profession) {
               $post['name'] = $profession;

              $RowAffetectd = $this->Profession_model->InsertProfession($post);
             }


             if($RowAffetectd == true){
               $this->session->set_flashdata('message', '<span style="color:green;">Profession Added Succssfully !</span>');
            	redirect('profession/profession-add');
             }else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Profession Please try again !</span>');
				  redirect('profession/profession-add');
				}
      }

      $this->parser->parse('profession/professionadd', $data);



        }



        /*
         * Edit Method
        */


        	public function EditProfession(){

        		$data = array('page_title' => 'Edit Profession');

         		$data['UpdateData'] = $this->Profession_model->EditProfession($this->input->get('id'));

         		$this->form_validation->set_rules('name', 'name', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('profession/professionedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Profession_model->Updateprofession($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Profession Update Sucessfully !</span>');
        				redirect('profession/profession-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Profession Please try again !</span>');
        				redirect('profession/profession-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          public function DeleteProfession(){

        		$result = $this->Profession_model->DeleteProfession($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Profession Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Profession!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('profession/profession-list');

        	}



}
