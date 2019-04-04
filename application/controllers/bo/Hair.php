<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Hair extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('Hair_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Hair Color', );
       		$data['ListOfHair'] = $this->Hair_model->ShowList();
       		$this->parser->parse('hair/hairlist', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddHair(){

          $data = array( 'page_title' => 'Add Hair Color', );

          $this->form_validation->set_rules('hair_color', 'Color', 'required');

              if ($this->form_validation->run() == FALSE)
              {
                 $this->parser->parse('hair/hairadd', $data);
              }
			           else
              {
                $post = $this->input->post();


				$RowData = $this->Hair_model->InsertHair($post);

				if($RowData == true){
				  $this->session->set_flashdata('message', '<span style="color:green;">Hair Color Added Succssfully !</span>');
				  redirect('hair/hair-list');
				}else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Hair Color Please try again !</span>');
				  redirect('hair/hair-add');
				}
               }



        }



        /*
         * Edit Method
        */


        	public function EditHair(){

        		$data = array('page_title' => 'Edit Hair color');

         		$data['UpdateData'] = $this->Hair_model->EditRowHair($this->input->get('id'));

         		$this->form_validation->set_rules('hair_color', 'Hair Color', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('hair/hairedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Hair_model->UpdateHair($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Hair Color Update Sucessfully !</span>');
        				redirect('hair/hair-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Hair Color Please try again !</span>');
        				redirect('hair/hair-edit?id='.$this->input->get('id'));
        			}

                 }

         	}

        	public function PaySlip(){

        		$data = array('page_title' => 'Update Pay Slip');

         		$data['UpdatePaySlip'] = $this->Hair_model->EditRowSlip();

         		$this->form_validation->set_rules('pay_slip', 'Pay Slip', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('pay_slip/payslipedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->Hair_model->PaySlip($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">Pay Slip Updated Sucessfully !</span>');
        				redirect('slip/pay-slip');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Pay Slip Please try again !</span>');
        				redirect('slip/pay-slip');
        			}

                 }

         	}



          /*
           * Delete Method
          */

          public function DeleteHair(){

        		$result = $this->Hair_model->DeleteHair($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">Hair Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete Hair!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('hair/hair-list');

        	}



}
