<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class HotelService extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Hotel_Service_model','Tax_model'));

    }

    /*
     * List of services
     */
  	public function index(){

 		$data = array(
         'page_title' => 'List Service'
  		);
  		$data['ListServices'] = $this->Hotel_Service_model->ListService();
  		$this->parser->parse('hotel_service/servicelist', $data);
 	}

  /*
   * Add services
   */
 	public function add_services(){

 		$data = array(
         'page_title' => 'Add Service',
  		);
 		$data['TaxType']  = $this->Hotel_Service_model->getAllTaxes();
    $data['services'] = $this->Hotel_Service_model->getAllServices();

  	$this->form_validation->set_rules('service_id', 'Service Title', 'required');
 		$this->form_validation->set_rules('description', 'Service description', 'required');
 		$this->form_validation->set_rules('price', 'Service price', 'required');
 		$this->form_validation->set_rules('status', 'Service status', 'required');
 		$this->form_validation->set_rules('tax_type', 'Service tax type', 'required');

 		if ($this->form_validation->run() == FALSE)
     {
        $this->parser->parse('hotel_service/addservice', $data);
     }
     else
     {
        $post = $this->input->post();
  			//$post['created_date'] = date('Y-m-d H:i:s');
   			$RowAffetectd = $this->Hotel_Service_model->InsertService($post);
 			if($RowAffetectd == true){
 				$this->session->set_flashdata('message', '<span style="color:green;">Service Added Succssfully !</span>');
 				redirect('hotel_service/servicelist');
 			}else{
  				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Service Please try again !</span>');
 				redirect('hotel_service/add-service');
 			}
    }
 	}


  /*
   * Edit services
   */
 	public function edit_services(){
 		$data = array(
         'page_title' => 'Edit Service',
  		);
 		$data['TaxType'] = $this->Hotel_Service_model->getAllTaxes();
    $data['services'] = $this->Hotel_Service_model->getAllServices();
  	$tempData= $this->Hotel_Service_model->EditRowService($this->input->get('id'));

    if ( $tempData != false) {
    $data['ServiceData'] = $tempData[0];
    }else {
      $this->session->set_flashdata('message', '<span style="color:green;">Data Not Available</span>');
      redirect('hotel_service/servicelist');
    }

 		$this->form_validation->set_rules('service_id', 'Service Title', 'required');
 		$this->form_validation->set_rules('description', 'Service description', 'required');
 		$this->form_validation->set_rules('price', 'Service price', 'required');
 		$this->form_validation->set_rules('status', 'Service status', 'required');
 		$this->form_validation->set_rules('tax_type', 'Service tax type', 'required');

 		if ($this->form_validation->run() == FALSE)
         {
             $this->parser->parse('hotel_service/editservice', $data);
         }
         else
         {
          $post = $this->input->post();
    		$RowAffetectd = $this->Hotel_Service_model->UpdateService($post,$this->input->get('id'));
  			if($RowAffetectd == true){
 				$this->session->set_flashdata('message', '<span style="color:green;">Service Update Succssfully !</span>');
 				redirect('hotel_service/servicelist');
 			}else{
  				$this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Service Please try again !</span>');
 				redirect('hotel_service/edit-service?id='.$this->input->get('id'));
 			}
          }
 	}


  /*
   * Delete services
   */
 	public function delete_services(){
 		if($this->Permissions->ServicesRemove() != 1){ redirect('admin/access-denied');}
 		$result = $this->Hotel_Service_model->DeleteServices($this->input->get('id'));
 		if($result == true){
 			$message = '<span style="color:green;">Service Delete Succssfully !</span>';
  		}else{
 			$message = '<span style="color:green;">Unable to Delete Service !</span>';
 		}
 		$this->session->set_flashdata('message', $message);
 		redirect('hotel_service/servicelist');
 	}


}
