<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Religion extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Religion_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Religion', );
       		$data['ListOfReligion'] = $this->Religion_model->ShowList();
       		$this->parser->parse('religion/religionlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddReligion(){

          $data = array( 'page_title' => 'Add Religion', );

          if ($this->input->post())
           {
             $post = $this->input->post();

             $religionlist = explode(",",$post['name']) ;

             foreach ($religionlist as $religion) {
               $post['name'] = $religion;

              $RowAffetectd = $this->Religion_model->InsertReligion($post);
             }


             if($RowAffetectd == true){
               $this->session->set_flashdata('message', '<span style="color:green;">Religion Added Succssfully !</span>');
            	redirect('religion/religion-add');
             }else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Religion Please try again !</span>');
				  redirect('religion/religion-add');
				}
      }

      $this->parser->parse('religion/religionadd', $data);



        }



        /*
         * Edit Method
        */


        	public function EditReligion(){

        		$data = array('page_title' => 'Edit Religion');

         		$data['UpdateData'] = $this->Religion_model->EditReligion($this->input->get('id'));

         		$this->form_validation->set_rules('name', 'name', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('religion/religionedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Religion_model->Updatereligion($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Religion Update Sucessfully !</span>');
        				redirect('religion/religion-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Religion Please try again !</span>');
        				redirect('religion/religion-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          public function DeleteReligion(){

        		$result = $this->Religion_model->DeleteReligion($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Religion Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Religion!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('religion/religion-list');

        	}



}
