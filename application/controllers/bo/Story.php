<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Story extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Story_model','Tax_model'));
    }

    /*
     * List of services
     */
  	public function index(){
 		  $data = array('page_title' => 'List Service');
  		$data['ListStory'] = $this->Story_model->ListStory();
  		$this->parser->parse('story/storylist', $data);
 	}

  /*
   * Add services
   */
 	public function addstory(){
 		$data = array(
         'page_title' => 'Add Story',
  		);
        $post = $this->input->post();
      $data['ListCountry'] = $this->Story_model->ListCountry();

 		if ($this->input->post())
     {

                          if(isset($_FILES['story_image']['name'])){
     							          $config['upload_path']          = './upload';
     			                  $config['allowed_types']        = 'gif|jpg|jpeg|png';

     			                  $this->load->library('upload', $config);

     			                if (! $this->upload->do_upload('story_image'))
  		                        {
  		                           $error = $this->upload->display_errors();
  		                           $this->session->set_flashdata('message', '<span style="color:red;">'. $error .'</span>');
  		                          redirect('Story/addStory');
  		                        }
			                        else
			                        {
			                          $file_data = $this->upload->data();
			                          $post['story_image'] = $file_data['file_name'];
			                        }
     			                    }

            $rowdata = array(
            'story_name'=>$post['story_name'],
            'story_image'=>base_url('upload/').$post['story_image'],
              'location' => $post['location'],
            'story_details'=>$post['story_details']
          );

       $RowAffetectd = $this->Story_model->InsertStory($rowdata);
       if($RowAffetectd == true){
         $this->session->set_flashdata('message', '<span style="color:green;">Story Added Succssfully !</span>');
      	redirect('Story/addStory');
       }else{
         $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Story Please try again !</span>');
         redirect('Story/addStory');
       }
     }
     else
     {
        $this->parser->parse('story/addstory', $data);
      }
 	}


  /*
   * Edit services
   */
 	public function editstory(){
 		$data = array(
         'page_title' => 'Edit Service',
  		);
  	$data['StoryData'] = $this->Story_model->EditRowStory($this->input->get('id'));
    if ($this->input->post())
   {

	       $post = $this->input->post();



	                   if(isset($_FILES['story_image']['name'])){
					$config['upload_path']          = './upload';
                    $config['allowed_types']        = 'gif|jpg|jpeg|png';

                   $this->load->library('upload', $config);

                 if ( ! $this->upload->do_upload('story_image'))
                      {
                            $post['story_image'] = $post['oldstory_image'];
                      }
                      else
                      {
                            $file_data = $this->upload->data();
                            $post['story_image'] = base_url('/upload/').$file_data['file_name'];
                       }
            }


            $storydata = array(
              'location' => $post['location'],
              'story_name' => $post['story_name'],
              'story_image' => $post['story_image'],
              'story_details' => $post['story_details']
            );





    $RowAffetectd = $this->Story_model->UpdateStory($storydata,$this->input->get('id'));
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

 	}


  /*
   * Delete services
   */
 	public function deletestory(){
 		$result = $this->Story_model->DeleteStory($this->input->get('id'));
 		if($result == true){
 			$message = '<span style="color:green;">Story Delete Succssfully !</span>';
  		}else{
 			$message = '<span style="color:green;">Unable to Delete Story !</span>';
 		}
 		$this->session->set_flashdata('message', $message);
 		  redirect('Story/Storylist');
 	}


}
