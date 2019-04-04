<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Sales extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Sales_model'));
    }


    /*
     * List of Sales Person
     */
  	public function index($data="")
  	{
  		$data['page_title'] =  "List of Sales Person";
      $data['listofsales'] =$this->Sales_model->listsalesperson($data);
  		$this->parser->parse('sales/saleslist', $data);
    }


  function approvelist()
  {
    $data['page_title'] =  "List of Pending Sales Person";
    $data['listofsales'] =$this->Sales_model->listpendingsalesperson($data);
    $this->parser->parse('sales/salesapproval', $data);
  }




  function approvesales()
  {
    $id = $this->input->get('id');
    if ($this->Sales_model->approvesales($id)) {
      $this->session->set_flashdata('message', '<span style="color:green;">Salesman Approved Succssfully !</span>');
    }else {
        $this->session->set_flashdata('message', '<span style="color:red;">Salesman Not Approved !</span>');
    }
    redirect('sales/sales-approve');
  }

    /*
     * Add Sales Person
     */
    	public function addsalesperson($value='')
    	{

    				$this->form_validation->set_rules('f_name', 'fieldlabel', 'required');
    				$this->form_validation->set_rules('l_name', 'fieldlabel', 'required');
    				$this->form_validation->set_rules('phone_number', 'fieldlabel', 'required');
    				$this->form_validation->set_rules('email_id', 'fieldlabel', 'required|valid_email|callback_check_email_exists');
    				$this->form_validation->set_rules('password', 'fieldlabel', 'required');
    				$this->form_validation->set_rules('confirm_password', 'fieldlabel', 'required|matches[password]');
    				$this->form_validation->set_rules('address', 'fieldlabel', 'required');




    				if (empty($_FILES['attach_resume']['name']))
    				{

    				    $this->form_validation->set_rules('attach_resume', 'Attachment', 'required','callback_file_check');
    				}

    				if ($this->form_validation->run() == FALSE)
    				{


    					$data['page_title'] =  "Add New Sales Person";
              //  print_r($_POST);
              // die();
    					$this->parser->parse('sales/addsales', $data);
    				}
    				else
    				{

    						$userdata = $_POST;
    						$sid = $this->session->userdata('is_logged_admin');
    						$user_role = $sid['admin_role'];
    						if($user_role == "Admin"){
    							$activevalue=  "Active";
    							$actv ="1";
    						}else {
    							$activevalue = "0";
    							$actv ="0";
    						}

    						$data = array(
    						    'firstname' => $userdata['f_name'],
    						    'lastname' => $userdata['l_name'],
    								'email' => $userdata['email_id'],
    								'username' => $userdata['username'],
    								'status' => $activevalue,
    							  'active' =>$actv,
    						    'last_update' => date('Y-m-d H:i:s'),
    						    'created_date' =>  date('Y-m-d H:i:s'),
    						    'image' => "lllllll",
    						    'address' => $userdata['address'],
    						    'phone' => $userdata['phone_number'],
    						    'password' => md5($userdata['password']),
    						    'role' => 'Sales'
    						);

    						$success = $this->Sales_model->addsalesperson($data);
    						if($success){
    							$this->session->set_flashdata('message', '<span style="color:green;">Salesman Added Succssfully !</span>');
    							redirect('sales/saleslist');
    						}else {
    							$this->session->set_flashdata('message', '<span style="color:red;">Salesman Not Added !</span>');
    							redirect('sales/addsales');
    						}
    				}

    	}


      /*
       * Check db email of Sales Person
       */
    	public function check_email_exists($email)
    	{
    	  if ($this->Sales_model->isUserexist($email))
    	  {
    	    $this->form_validation->set_message('message', 'That email address alredy exist.');
    	    return FALSE;
    	  }
    	  else
    	  {
    	    return TRUE;
    	  }
    	}



      /*
       *Remove Sales Person
       */
    	public function removesalesperson($data)
    	{
    $removeid = $this->input->get('id');
    $rtnremove = $this->Sales_model->removesalesperson($removeid);
    redirect('sales/saleslist');
    	}




      /*
       * Single Sales Person
       */
    	public function singlesalesperson($data="")
    	{
    	 	$personId = $this->input->get('id');
    		$data['singlesalespersonId'] = $this->Sales_model->singlesalesperson($personId);
    		$data['page_title'] =  "Sales Person";
  		  $this->parser->parse('sales/editsales', $data);
    	}


      /*
       * Update Sales Person
       */
    	public function updatesalesperson_save()
    	{
    		$savepreson = $this->Sales_model->updatesalesperson_save($_POST);
    		if($savepreson){
    			$this->session->set_flashdata('message', '<span style="color:green;">Your data updated succssfully!</span>');
    		}else{
    			$this->session->set_flashdata('message', '<span style="color:red;">Data Not Updated!</span>');
    		}
    		redirect('sales/saleslist');
    	}






}
