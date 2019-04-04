<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Clients extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Clients_model', 'App_model'));
    }

    /*
    *list hotels
    */
    public function index()
  	{
  		$data = array( 'page_title' => 'List Clients');
  		$data['ClientsList'] = $this->Clients_model->ClientsList();
      $this->parser->parse('clients/clientlist', $data);
  	}



    public function viewclient()
    {

      $cId = $this->input->get('c_id');
      $data = array( 'page_title' => 'Client informatin');
      $idmatch = $this->Clients_model->CheckSalesAccess($cId);

      if($idmatch == false){
        redirect('access-denied');
      }else{
      $data['Clientnotes'] = $this->Clients_model->ClientNotesList();
      $data['Clientinfo'] = $this->Clients_model->ClientsView($cId);
      $this->parser->parse('clients/view-clients', $data);
    }

    }




    public function UpdateNotes()
    {
        $post = $this->input->post();
        $sid = $post['client_id'];
        $clientnotes = [
                  'client_id' => $post['client_id'],
                  'sales_id' => $post['sales_id'],
                  'notes_text' => $post['txtMessage'],
                ];
          if($clientnotes != false){
            $this->Clients_model->InsertClientnote($clientnotes);
            $this->session->set_flashdata('message', '<span style="color:green;">Notes Added Succssfully !</span>');
            redirect('clients/view-client?c_id='.$sid);
          }else{
            $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Notes Please try again !</span>');
            redirect('clients/clientlist');

      }
    }



public function UpdateClient()
{
   $savehotel = $this->Clients_model->updateClientInfo($_POST);
   if($savehotel){
     $this->session->set_flashdata('message', 'Client informatin Updated Succesfully');
   }else{
       $this->session->set_flashdata('message', 'Client informatin Not Updated');
   }
   redirect('clients/view-client?c_id='.$_POST['client_id']);
}







}
