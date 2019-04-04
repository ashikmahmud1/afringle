<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Hotel_model','User_model', 'App_model','Api_model','Hair_model','Bodytype_model','Profession_model','Education_model','Eyecolor_model'));
    }

    /*
    *list Pending hotels who is signup from front End
    */


    public function AddUser(){

      $data = array( 'page_title' => 'Add User', );
        $data['ListCountry'] = $this->Api_model->countryPicker();
        $data['ListOfHair'] = $this->Hair_model->ShowList();
        $data['ListOfbodytype'] = $this->Bodytype_model->ShowList();
        $data['ListOfProfession'] = $this->Profession_model->ShowList();
        $data['ListOfEducation'] = $this->Education_model->ShowList();
        $data['ListOfeye'] = $this->Eyecolor_model->ShowList();

      $this->form_validation->set_rules('username', 'username', 'required');
      $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[af_users.email]');
      $this->form_validation->set_rules('password', 'password', 'required');


          if ($this->form_validation->run() == FALSE)
          {
             $this->parser->parse('user/adduser', $data);
          }
             else
          {
            $post = $this->input->post();


                if(isset($_FILES['imageData']['name'])){
					$config['upload_path']          = './upload';
                    $config['allowed_types']        = 'gif|jpg|jpeg|png';

                    $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload('imageData'))
                      {
                             $error = $this->upload->display_errors();
                             $this->session->set_flashdata('message', '<span style="color:red;">'. $error .'</span>');
                             redirect('user/add-user');
                      }
                      else
                      {
                            $file_data = $this->upload->data();
                            $post['imageData'] = $file_data['file_name'];
                       }
            }

            if(isset($_FILES['documents']['name'])){
      $config['upload_path']          = './upload';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';

                $this->load->library('upload', $config);

              if ( ! $this->upload->do_upload('documents'))
                  {
                         $error = $this->upload->display_errors();
                         $this->session->set_flashdata('message', '<span style="color:red;">'. $error .'</span>');
                         redirect('user/add-user');
                  }
                  else
                  {
                        $file_data = $this->upload->data();
                        $post['documents'] = $file_data['file_name'];
                   }
        }

        $currentDate = date("Y-m-d");
        $d=strtotime("+1 Months");
        $nextDate = date("Y-m-d", $d);
            $data = array(
            "username" => $post['username'],
            "password" => md5($post['password']),
            "email" => $post['email'],
            "contact" => $post['contact'],
            "gender" => $post['gender'],
            "tribe" => $post['tribe'],
            "country" => $post['country'],
            "zip" => $post['zip'],
            "state" => $post['state'],
            "city" => $post['city'],
            "children" => $post['children'],
            "marital" => $post['marital'],
            'plan_update_date' => $currentDate,
            'plan_expair_date' => $nextDate,
            "haveChildren" => $post['haveChildren'],
            "isSmoke" => $post['isSmoke'],
            "lookingFor" => $post['lookingFor'],
            "isDrugs" => $post['isDrugs'],
            "isHair" => $post['isHair'],
            "isDrink" => $post['isDrink'],
            "bodyType" => $post['bodyType'],
            "isCar" => $post['isCar'],
            "profession" => $post['profession'],
            "education" => $post['education'],
            "pets" => $post['pets'],
            "eye" => $post['eye'],
            "personality" => $post['personality'],
            "language" => $post['language'],
            "ambitious" => $post['ambitious'],
            "height" => $post['height'],
            "hometown" => $post['country'],
            "select_country" => $post['select_country'],
            "select_hometown" => $post['select_hometown'],
            "select_tribe" => $post['select_tribe'],
            "seeking" => $post['seeking'],


            "your_intent" => $post['your_intent'],
            "longest_relationship" => $post['longest_relationship'],
            "first_name" => $post['first_name'],
            "last_name" => $post['last_name'],
            "show_publically" => $post['show_publically'],
            "income" => $post['income'],
            "isSmoke" => $post['isSmoke'],
            "isBodyType" => $post['isBodyType'],
            "isKids" => $post['isKids'],
            "imageData" => base_url('upload/').$post['imageData'],
            "documents" => base_url('upload/').$post['documents'],

            "headline" => $post['headline'],
            "description" => $post['description'],
            "interests" => $post['interests'],
            "dob" => $post['dob'],
            "photo" => $post['imageData'],
            "account_status" => 1,
            "chamestry_test_status" => 1,
            "plan" => 5,
            );




    $RowData = $this->User_model->InsertUser($data);

    if($RowData == true){
      $this->session->set_flashdata('message', '<span style="color:green;">User Added Successfully !</span>');
      redirect('user/add-user');
    }else{
      $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add User Please try again !</span>');
      redirect('user/add-user');
    }
           }



    }






    public function approve_list()
    {
      $data = array( 'page_title' => 'Pending User List');
      $data['UsersList'] = $this->User_model->approveUsersList();


      $this->parser->parse('user/approval', $data);
    }

    public function pending_list()
    {
      $data = array( 'page_title' => 'Pending User List');
      $data['UsersList'] = $this->User_model->pendingUsersList();
      $this->parser->parse('user/userapproval', $data);
    }


    public function approveUser()
    {
      $Id = $this->input->get('id');
      if ($this->User_model->approveUser($Id)) {
        $this->session->set_flashdata('message', 'User Approved Succesfully');
      }else {
        $this->session->set_flashdata('message', 'User Not Approved');
      }
      redirect('user/user-pending');
    }

    public function pendingapproveUser()
    {
      $Id = $this->input->get('id');
      if ($this->User_model->approveUser($Id)) {
        $this->session->set_flashdata('message', 'User Approved Succesfully');
      }else {
        $this->session->set_flashdata('message', 'User Not Approved');
      }
      redirect('user/user-list');
    }



}
