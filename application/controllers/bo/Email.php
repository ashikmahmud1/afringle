<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Email extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Email_model','Tax_model','User_model'));

    }



    		public function SMTP_config()

    		{

    			$config = Array(

    					'protocol' => 'smtp',

    					'smtp_host' => 'mail.ziocam.com',

    					'smtp_port' => 465,

    					'smtp_user' => 'testcrm@ziocam.com',

    					'smtp_pass' => 'test@ziocam',

    					'mailtype' => 'text/html',

    					'newline' => '\r\n',

    					'charset' => 'utf-8'

    			);

    			$this->load->library('email', $config);

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



	public function SendEmailTo(){

    $data = array('page_title' => 'Email send');
      $data['ExclusiveMember'] = $this->User_model->exclusiveList();

       		if ($this->input->post())
           {
             $post = $this->input->post();

              if(isset($_FILES['attachment']['name'])){
             		$config['upload_path']          = './upload';
                $config['allowed_types']        = '*';
                $this->load->library('upload', $config);

           if ( ! $this->upload->do_upload('attachment'))
               {
                      $error = $this->upload->display_errors();
                      $this->session->set_flashdata('message', '<span style="color:red;">'. $error .'</span>');
                      redirect('send-email-to');
               }
               else
               {
                     $file_data = $this->upload->data();
                     $post['attachment'] = base_url('upload/').$file_data['file_name'];
                }
              }

              $from_email = $post['sender'];
              $replyemail = $post['sender'];
              $to_email= $post['sendmailto'];
              $subject= $post['subject'];
              $bodyTxt= $post['message'].'<br>'. $post['attachment'];
              $this->SMTP_config(); //
              $this->email->set_newline("\r\n");
              $this->email->set_mailtype("html");
              $this->email->from($from_email,$name='');
              $this->email->to($to_email);
              $this->email->reply_to($replyemail);
              $this->email->subject($subject);
              $this->email->message($bodyTxt);

              //$this->email->message($this->parser->parse($templatePath, $templateData , true));

              $RowAffetectd =  $this->email->send();



             if($RowAffetectd == true){
               $this->session->set_flashdata('message', '<span style="color:green;">Email Sent Successfully!</span>');
            	redirect('send-email-to');
             }else{
               $this->session->set_flashdata('message', '<span style="color:red;">Unable to Send Email Please try again !</span>');
              	redirect('send-email-to');
             }
           }
           else
           {
              $this->parser->parse('email/sendmail', $data);
            }


  }


  /*
   * Add services
   */
 	public function SendEmail(){

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
