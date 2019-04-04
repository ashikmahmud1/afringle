<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model2 extends CI_Model {

		public function __construct()
    {
       parent::__construct();
    }





			public function InsertUser($data){

						$result = $this->db->insert('af_users', $data);
						$userdata = $this->getUserData($data['username']);
						if($result == 1){
						$response = array('status'=>1,'message'=>'Registration Sucessfully', 'data' => $userdata);
							return $response;
						}else{
							$response = array('status'=>0,'message'=>'There is some error please try again');
							return $response;
						}

			}

			public function getUserData($username)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('username',$username);
				$query = $this->db->get();
				if($query->num_rows() == 1){
						return $query->result();
						}else{
						return array();
						}

			}

			public function getChemistryUsers($id)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('chamestry_test_status','1');
				$this->db->where('id !=',$id);
				$query = $this->db->get();
				if($query->num_rows() > 1){
						return $query->result();
						}else{
						return array();
						}

			}



		public function loginUser($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('username',$data['username']);
			$this->db->where('password',$data['password']);
			$query = $this->db->get();
			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Login Sucessfull', 'data'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'Authentication failed');
					return $response;
					}

		}


				public function verificationUser($data)
				{
					$this->db->select('*');
					$this->db->from('af_users');
					$this->db->where('username',$data['username']);
					$this->db->or_where('email',$data['email']);
					$this->db->or_where('contact',$data['contact']);
					$query = $this->db->get();
					if($query->num_rows() == 1){
							$response = array('status'=>0,'message'=>'User Alredy Existing With Given Details', 'data'=>$query->result());
							return $response;
							}else{
							$response = array('status'=>1,'message'=>'User Not Existing');
							return $response;
							}
				}





		public function userList($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('email','hemraj@gmail.com');

			$query = $this->db->get();
			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'List of your user',);
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}


public function getChamestryQuestions()
{
	$this->db->select('id, title, question1, question2, question3');
	$this->db->from('facilities');
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'Chamestry List', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'Chamestry List Not Available');
		return $response;
	}
}

public function countryPicker()
{
	$this->db->select('*');
	$this->db->from('countries');
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'Country List', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'Country List Not Available');
		return $response;
	}
}

public function tribePicker($country_code)
{
	$this->db->select('*');
	$this->db->from('tribes');
	$this->db->where('country_code', $country_code);
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'Tribe List', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'Tribe List Not Available');
		return $response;
	}
}

public function cityPicker($state_id)
{
	$this->db->select('*');
	$this->db->from('cities');
	$this->db->where('state_id', $state_id);
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'City List', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'City List Not Available');
		return $response;
	}
}

public function getEventsList()
{
	$this->db->select('*');
	$this->db->from('event');
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'Event List', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'Event List Not Available');
		return $response;
	}
}

public function statePicker($country_code)
{
	$sql = "SELECT a.* FROM states a INNER JOIN countries b ON a.country_id = b.id WHERE b.sortname = '$country_code' ORDER BY a.name";
	$query = $this->db->query($sql);
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'State List', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'State List Not Available');
		return $response;
	}
}

public function submitChemistryTest($data, $userid)
{
	$result = $this->db->insert_batch('chemistry_result', $data);
	if($result){
			$this->db->where('id', $userid);
			$this->db->update('af_users', array('chamestry_test_status' => '1'));
			$response = array('status'=>1,'message'=>'Test Submited Successfully', 'data'=> $data);
			return $response;
	}else{
		$response = array('status'=>0,'message'=>'There is some error please try again');
		return $response;
	}
}



		public function search($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('email',$data['email']);
			$query = $this->db->get();
			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Search List');
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}


		public function messageData($data)
		{
			$this->db->select('*');
			$this->db->from('af_message_data');
			$this->db->where('to_id',$data['to_id']);
			$query = $this->db->get();

			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Message Data', 'messagedata'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}

		public function inviteData($data)
		{
			$this->db->select('*');
			$this->db->from('af_invite');
			$this->db->where('invite_to',$data['invite_to']);
			$query = $this->db->get();

			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Message Data', 'messagedata'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}

		public function storyData($data)
		{
			$this->db->select('*');
			$this->db->from('af_story');
			$query = $this->db->get();

			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Story Data', 'messagedata'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}

		      
		
		public function p1_data($userid)
		{
			$this->db->select('*');
			$this->db->from('chemistry_result');
			$this->db->where('user_id',"$userid");
			$query = $this->db->get();


			
			if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Message Data', 'messagedata'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		



}
