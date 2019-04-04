<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Facility extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Facility_model'));

    }

    public function index(){
      $data = array( 'page_title' => 'List Facilitie' );
      $data['ListServices'] = $this->Facility_model->ListFacilitie();
      $this->parser->parse('facility/facilitieslist', $data);
  }

  public function add(){
    if($this->Permissions->FacilitiesAdd() != 1){ redirect('admin/access-denied');}
    $data = array( 'page_title' => 'Add Facilitie', );
    $this->parser->parse('facility/addfacilities', $data);
  }

  public function save(){

    if($this->Permissions->FacilitiesAdd() != 1){ redirect('admin/access-denied'); }
    $post = $this->input->post();
    $RowAffetectd = $this->Facility_model->InsertFacilitie($post);
    if($RowAffetectd == true){
      $message = '<span style="color:green;">Chemistry Added Succssfully !</span>';
      }else{
      $message = '<span style="color:red;">Chemistry Not added!</span>';
    }
    $this->session->set_flashdata('message', $message);
    redirect('Chemistry/Chemistry-list');

  }

  public function update(){

    if($this->Permissions->FacilitiesAdd() != 1){ redirect('admin/access-denied'); }
    $post = $this->input->post();
    $id = $post['id'];
    unset($post['id']);
    $RowAffetectd = $this->Facility_model->UpdateFacilitie($post,$id);
    if($RowAffetectd == true)
    {
      $message = 'Chemistry Update Succssfully !';
    }else{
      $message =  'Unable to Update Chemistry Please try again !';
    }

    $this->session->set_flashdata('message', $message);
    redirect('Chemistry/Chemistry-list');

  }



  public function edit(){
    if($this->Permissions->FacilitiesEdit() != 1){ redirect('admin/access-denied');}
    $data = array(  'page_title' => 'Edit Facilitie', );
    $data['RowData'] = $this->Facility_model->EditRowFacilitie($this->input->get('id'));
    $this->parser->parse('facility/editfacilities', $data);
  }

  public function delete(){

    if($this->Permissions->FacilitiesRemove() != 1){ redirect('admin/access-denied');}
    $result = $this->Facility_model->DeleteFacilitie($this->input->get('id'));
    if($result == true){
      $message = '<span style="color:green;">Facilitie Delete Succssfully !</span>';
      }else{
      $message = '<span style="color:green;">Unable to Delete Facilitie !</span>';
    }
    $this->session->set_flashdata('message', $message);
    redirect('Chemistry/Chemistry-list');
  }

  public function ajax_submit(){
    if($this->Permissions->FacilitiesAdd() != 1){ redirect('admin/access-denied');}

      $jsonResponse=[];
      $post = $this->input->post();
      if($post['type'] == 'Insert')
      {
        $post['created_date'] = date('Y-m-d H:i:s');
        unset($post['type']);
        $RowAffetectd = $this->Facility_model->InsertFacilitie($post);
      if($RowAffetectd == true)
      {
        $jsonResponse = ['status' => 1, 'message' =>  'Facilitie Added Succssfully !','redirectURL' => base_url('Chemistry/Chemistry-list')];
      }else{
        $jsonResponse = ['status' => 0, 'message' =>  'Unable to Add Facilitie Please try again !'];
      }
    }else{
      //update faceli
      $id = $post['id'];
      unset($post['type'],$post['id']);
      $RowAffetectd = $this->Facility_model->UpdateFacilitie($post,$id);
      if($RowAffetectd == true)
      {
        $jsonResponse = ['status' => 1, 'message' =>  'Facilitie Update Succssfully !','redirectURL' => base_url('Chemistry/Chemistry-list')];
      }else{
        $jsonResponse = ['status' => 0, 'message' =>  'Unable to Update Facilitie Please try again !'];
      }
    }
    echo json_encode($jsonResponse);
  }

}
