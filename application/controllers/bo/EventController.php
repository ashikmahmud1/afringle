<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */
    
class EventController extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Event_model'));
    }

    /*
     * List of services
     */
  	public function index(){
 		$data = array('page_title' => 'List Event');
  		$data['ListEvent'] = $this->Event_model->ListEvent();
  		$this->parser->parse('event/eventlist', $data);
 	}

  /*
   * Add services
   */
/*  	public function addevent(){


        die("sdsds");
 		$data = array(
         'page_title' => 'Add Event',
  		);
  

 		if ($this->input->post())
     {
       $post = $this->input->post();
       $RowAffetectd = $this->Story_model->InsertStory($post);
       if($RowAffetectd == true){
         $this->session->set_flashdata('message', '<span style="color:green;">Event Added Succssfully !</span>');
      	redirect('Event/addEvent');
       }else{
         $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Event Please try again !</span>');
        	redirect('Event/addEvent');
       }
     }
     else
     {
        $this->parser->parse('event/addevent', $data);
      }
 	} */


  /*
   * Edit services
   */
/*  	public function editevent(){
 		$data = array(
         'page_title' => 'Edit Event',
  		);
  	$data['StoryData'] = $this->Story_model->EditRowStory($this->input->get('id'));
    if ($this->input->post())
   {
    $post = $this->input->post();
    $RowAffetectd = $this->Story_model->UpdateStory($post,$this->input->get('id'));
    if($RowAffetectd == true){
        $this->session->set_flashdata('message', '<span style="color:green;">Story Update Succssfully !</span>');
         redirect('Story/Storylist');
      }else{
        $this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Story Please try again !</span>');
      redirect('Story/Storylist');
      }
   }
   else
   {
     $this->parser->parse('story/editstory', $data);
   }

 	} */


  /*
   * Delete services
   */
/*  	public function deleteevent(){
 		$result = $this->Story_model->DeleteStory($this->input->get('id'));
 		if($result == true){
 			$message = '<span style="color:green;">Story Delete Succssfully !</span>';
  		}else{
 			$message = '<span style="color:green;">Unable to Delete Story !</span>';
 		}
 		$this->session->set_flashdata('message', $message);
 		  redirect('Story/Storylist');
 	} */


}


/* End of file Controllername.php */
