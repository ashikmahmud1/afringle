<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Tax extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Tax_model'));

    }


    /*
     * List of taxes
     */
     	public function index(){
    		$data = array( 'page_title' => 'List Taxes' );
     		$data['ListData'] = $this->Tax_model->ListData();
     		$this->parser->parse('tax/taxlist', $data);
    	}


      /*
       * Add new taxes
       */
    	public function Add_data(){
    		$data = array( 'page_title' => 'Add Tax', );
     		$this->form_validation->set_rules('tax_name', 'tax name', 'required');
    		$this->form_validation->set_rules('tax_percentage', 'Tax Percentage', 'required');
    		if ($this->form_validation->run() == FALSE)
            {
               $this->parser->parse('tax/addtax', $data);
            }
            else
            {
               	$post = $this->input->post();

     			$post['created_date'] = date('Y-m-d H:i:s');
      			$RowAffetectd = $this->Tax_model->Insert($post);
    			if($RowAffetectd == true){
    				$this->session->set_flashdata('message', '<span style="color:green;">Tax Added Succssfully !</span>');
    				redirect('tax/taxes-list');
    			}else{
     				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Tax Please try again !</span>');
    				redirect('tax/tax-add');
    			}
        }
    	}


      /*
       * Edit taxes data
       */
    	public function Edit_data($id=''){

      		$data = array(
            'page_title' => 'Edit Tax',
     		);
     		$data['RowData'] = $this->Tax_model->RowData($this->input->get('id'));
    		$this->form_validation->set_rules('tax_name', 'tax name', 'required');
    		$this->form_validation->set_rules('tax_percentage', 'Tax Percentage', 'required');
    		if ($this->form_validation->run() == FALSE)
            {
                $this->parser->parse('tax/edittax', $data);
            }
            else
            {
            $post = $this->input->post();
       			$RowAffetectd = $this->Tax_model->Update($post,$this->input->get('id'));
     			if($RowAffetectd == true){
    				$this->session->set_flashdata('message', '<span style="color:green;">Tax Update Succssfully !</span>');
    				redirect('tax/taxes-list');
    			}else{
     				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Tax Please try again !</span>');
    				redirect('tax/edit-tax?id='.$this->input->get('id'));
    			}
         }
    	}

      /*
       * Delete taxes data
       */
    	public function Delete_data(){

    		$result = $this->Tax_model->Delete($this->input->get('id'));
    		if($result == true){
    			$message = '<span style="color:green;">Tax Delete Succssfully !</span>';
     		}else{
    			$message = '<span style="color:green;">Unable to Delete Tax !</span>';
    		}
    		$this->session->set_flashdata('message', $message);
    		redirect('tax/taxes-list');
    	}


}
