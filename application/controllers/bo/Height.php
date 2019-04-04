<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Height extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Height_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Height Color', );
       		$data['ListOfHeight'] = $this->Height_model->ShowList();
       		$this->parser->parse('height/heightlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddHeight(){

          $data = array( 'page_title' => 'Add Height Color', );

          $this->form_validation->set_rules('height', 'Color', 'required');

              if ($this->form_validation->run() == FALSE)
              {
                 $this->parser->parse('height/heightadd', $data);
              }
			           else
              {
                $post = $this->input->post();


				$RowData = $this->Height_model->InsertHeight($post);

				if($RowData == true){
				  $this->session->set_flashdata('message', '<span style="color:green;">Height Added Succssfully !</span>');
				  redirect('height/height-list');
				}else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Height  Please try again !</span>');
				  redirect('height/height-add');
				}
               }



        }



        /*
         * Edit Method
        */


        	public function EditHeight(){

        		$data = array('page_title' => 'Edit Height ');

         		$data['UpdateData'] = $this->Height_model->EditRowHeight($this->input->get('id'));

         		$this->form_validation->set_rules('height', 'Height', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('height/heightedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Height_model->UpdateHeight($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Height  Update Sucessfully !</span>');
        				redirect('height/height-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Height Please try again !</span>');
        				redirect('height/height-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          /*
           * Delete Method
          */

          public function DeleteHeight(){

        		$result = $this->Height_model->DeleteHeight($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Height Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Height!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('height/height-list');

        	}



}
