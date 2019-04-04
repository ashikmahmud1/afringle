<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplete extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Emailtemplete_model'));
  }

  public function index(){
      $data = array( 'page_title' => 'List Email Template' );
      $data['ListData'] = $this->Emailtemplete_model->ListData();
      $this->parser->parse('emailtemplate/list_emailtemplate_page', $data);
  }

  public function add(){

      $data = array( 'page_title' => 'Add Email Template', );
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('subject', 'Subject', 'required');
      $this->form_validation->set_rules('bodyTxt', 'Body Text', 'required');

      if ($this->form_validation->run() == FALSE)
      {
         $this->parser->parse('emailtemplate/index_emailtemplate_page', $data);
      }
      else
      {
        $post = $this->input->post();
        $post['created_date'] = date('Y-m-d H:i:s');
          $RowAffetectd = $this->Emailtemplete_model->Insert($post);
        if($RowAffetectd == true){
          $this->session->set_flashdata('message', '<span style="color:green;">Email Template Added Succssfully !</span>');
          redirect('admin/email-template-list');
        }else{
          $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Email Template Please try again !</span>');
          redirect('admin/email-template-add');
        }
      }
  }

  public function edit(){
      $data = array( 'page_title' => 'Edit Email Template', );
      $data['RowData'] = $this->Emailtemplete_model->RowData($this->input->get('id'));
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('subject', 'Subject', 'required');
      $this->form_validation->set_rules('bodyTxt', 'Body Text', 'required');
      if ($this->form_validation->run() == FALSE)
      {
          $this->parser->parse('emailtemplate/edit_emailtemplate_page', $data);
      }
      else
      {
        $post = $this->input->post();
        $RowAffetectd = $this->Emailtemplete_model->Update($post,$this->input->get('id'));
        if($RowAffetectd == true){
          $this->session->set_flashdata('message', '<span style="color:green;">Email Template Update Succssfully !</span>');
          redirect('admin/email-template-list');
        }else{
          $this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Email Template Please try again !</span>');
          redirect('admin/edit-email-template?id='.$this->input->get('id'));
        }
      }
  }

  public function delete(){
      $result = $this->Emailtemplete_model->Delete($this->input->get('id'));
      if($result == true){
        $message = '<span style="color:green;">Email Template Delete Succssfully !</span>';
      }else{
        $message = '<span style="color:green;">Unable to Delete Email Template !</span>';
      }
      $this->session->set_flashdata('message', $message);
      redirect('admin/email-template-list');
  }

}
