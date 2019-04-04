<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Service extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Service_model','Tax_model'));

    }

    /*
     * List of services
     */
  	public function index(){

 		$data = array(
         'page_title' => 'List Service'
  		);
  		$data['ListServices'] = $this->Service_model->ListService();
  		$this->parser->parse('service/servicelist', $data);
 	}

  /*
   * Add services
   */
 	public function add_services(){
if($this->Permissions->ServicesEdit() != 1){ redirect('admin/access-denied');}

 		$data = array(
         'page_title' => 'Add Service',
  		);



      $data['ListCountry'] = $this->Service_model->ListCountry();

 		if ($this->input->post())
     {
       $post = $this->input->post();

       $tribelist = explode(",",$post['name']) ;

       foreach ($tribelist as $tribe) {
         $post['name'] = $tribe;
        $RowAffetectd = $this->Service_model->InsertService($post);
       }

        //die();





       if($RowAffetectd == true){
         $this->session->set_flashdata('message', '<span style="color:green;">Tribe Added Succssfully !</span>');
      	redirect('tribe/add-tribe');
       }else{
         $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Tribe Please try again !</span>');
        	redirect('tribe/add-tribe');
       }
     }
     else
     {
        $this->parser->parse('service/addservice', $data);
      }
 	}


  /*
   * Edit services
   */
 	public function edit_services(){
 		if($this->Permissions->ServicesEdit() != 1){ redirect('admin/access-denied');}
 		$data = array(
         'page_title' => 'Edit Service',
  		);
  	$data['ServiceData'] = $this->Service_model->EditRowService($this->input->get('id'));
	$data['ListCountry'] = $this->Service_model->ListCountry();





    if ($this->input->post())
   {
    $post = $this->input->post();


    $tribelist = explode(",",$post['name']) ;

    foreach ($tribelist as $tribe) {
      $post['name'] = $tribe;
     $RowAffetectd = $this->Service_model->UpdateService($post,$this->input->get('id'));
    }



    if($RowAffetectd == true){
        $this->session->set_flashdata('message', '<span style="color:green;">Tribe Update Succssfully !</span>');
         redirect('tribe/tribelist');
      }else{
        $this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Tribe Please try again !</span>');
      redirect('tribe/tribelist');
      }
   }
   else
   {
     $this->parser->parse('service/editservice', $data);
   }

 	}


  /*
   * Delete services
   */
 	public function delete_services(){
 		if($this->Permissions->ServicesRemove() != 1){ redirect('admin/access-denied');}
 		$result = $this->Service_model->DeleteServices($this->input->get('id'));
 		if($result == true){
 			$message = '<span style="color:green;">Service Delete Succssfully !</span>';
  		}else{
 			$message = '<span style="color:green;">Unable to Delete Service !</span>';
 		}
 		$this->session->set_flashdata('message', $message);
 		  redirect('tribe/tribelist');
 	}


}
