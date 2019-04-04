<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class OrderHistory extends CI_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model(array('OrderHistory_model'));
    }


        /*
         * Show List Method
        */

        public function index(){
      		$data = array( 'page_title' => 'List of Order History', );
       		$data['ListOfOrderHistory'] = $this->OrderHistory_model->ShowList();
       		$this->parser->parse('order_history/order_history_list', $data);
      	}


		/*
		 * Add Method
		*/

        public function AddOrderHistory(){

          $data = array( 'page_title' => 'Add Order History', );

          $this->form_validation->set_rules('hair_color', 'Color', 'required');

              if ($this->form_validation->run() == FALSE)
              {
                 $this->parser->parse('hair/hairadd', $data);
              }
			        else
              {
                $post = $this->input->post();


				$RowData = $this->OrderHistory_model->InsertOrderHistory($post);

				if($RowData == true){
				  $this->session->set_flashdata('message', '<span style="color:green;">OrderHistory Added Succssfully !</span>');
				  redirect('hair/hair-list');
				}else{
				  $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add OrderHistory Please try again !</span>');
				  redirect('hair/hair-add');
				}
               }

        }



        /*
         * Edit Method
        */


        	public function EditOrderHistory(){

        		$data = array('page_title' => 'Edit OrderHistory color');

         		$data['UpdateData'] = $this->OrderHistory_model->EditRowOrderHistory($this->input->get('id'));

         		$this->form_validation->set_rules('hair_color', 'OrderHistory', 'required');


        		if ($this->form_validation->run() == FALSE)
                {
                  $this->parser->parse('hair/hairedit', $data);
                }
                else
                {
                $post = $this->input->post();

           			$RowAffetectd = $this->OrderHistory_model->UpdateOrderHistory($post,$post['id']);

         			if($RowAffetectd == true){
        				$this->session->set_flashdata('message', '<span style="color:green;">OrderHistory Update Sucessfully !</span>');
        				redirect('hair/hair-list');
        			}else{
         				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update OrderHistory Please try again !</span>');
        				redirect('hair/hair-edit?id='.$this->input->get('id'));
        			}

                 }

         	}



          /*
           * Delete Method
          */

          public function DeleteOrderHistory(){

        		$result = $this->OrderHistory_model->DeleteOrderHistory($this->input->get('id'));
        		if($result == true){
        			$message = '<span style="color:green;">OrderHistory Delete Sucessfully !</span>';
         		}else{
        			$message = '<span style="color:green;">Unable to Delete OrderHistory!</span>';
        		}

        		$this->session->set_flashdata('message', $message);

        		redirect('hair/hair-list');

        	}



}
