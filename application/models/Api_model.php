<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

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
			
			public function uploadGalleryImage($data){
				$result = $this->db->insert('af_media', $data);
				$userdata = $this->getGalleryImageList($data['user_id']);
				if($result == 1){
					return $userdata;
				}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
				}
			}
			
			
			public function insertVisitor($userId , $profile_id)
			{
				$this->db->select('*');
				$this->db->from('af_profile_visitors');
				$this->db->where('user_id',$userId);
				$this->db->where('profile_id',$profile_id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$data = $query->result();
					$count = $data[0]->totalCount;
					$count1 = (int)$count + 1;
					$this->db->flush_cache();
					$this->db->where('user_id',$userId);
				    $this->db->where('profile_id',$profile_id);
					$this->db->update('af_profile_visitors', array('totalCount' => "$count1"));
				}else{
					$this->db->flush_cache();
					$dataoo = array('user_id' => $userId , 'profile_id' => $profile_id , 'totalCount' => '1');
					$this->db->insert('af_profile_visitors', $dataoo);
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
			
			public function getUserToken($id)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('id',$id);
				$query = $this->db->get();
				if($query->num_rows() == 1){
					$data = $query->result();
					return $data[0]->push_token;
				}else{
					return "";
				}
			}
			
			public function getUserName($id)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('id',$id);
				$query = $this->db->get();
				if($query->num_rows() == 1){
					$data = $query->result();
					return $data[0]->first_name ." ". $data[0]->last_name;
				}else{
					return "Unknown";
				}
			}
			
			
			public function getChatUser($id)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('id',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$image = $this->getImageList($id);
					$response = array('status'=>1,'message'=>'Sucessfully', 'data' => $query->result() );
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Data not available');
					return $response;
				}
			}

			public function getUserDataById($id , $databb)
			{
				$defaultStr = "first_name, last_name, (SELECT countries.name FROM countries WHERE countries.sortname = af_users.country) as country";
				if($databb == ''){
					$databb = $defaultStr;	
				}
				$this->db->select($databb);
				$this->db->from('af_users');
				$this->db->where('id',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$image = $this->getImageList($id);
					$response = array('status'=>1,'message'=>'Sucessfully', 'data' => $query->result(), 'image' => $image);
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Data not available');
					return $response;
				}
				
			}
			
			public function forgotPassword($data)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('email',$data['email']);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$this->db->flush_cache();
					$sql = "SELECT af_users.id, af_users.contact, countries.phonecode FROM af_users LEFT JOIN countries ON af_users.country = countries.sortname WHERE af_users.email = '".$data['email']."' LIMIT 1;";
					$query1 = $this->db->query($sql);
					if($query1->num_rows() > 0){
						$response = array('status'=>1,'message'=>'Password reset link successfully sent to your email', 'data' => $query1->result());
						return $response;
					}else{
						$response = array('status'=>0,'message'=>'User not registered with this email');
						return $response;
					}
				
					
				}else{
					$response = array('status'=>0,'message'=>'User not registered with this email');
					return $response;
				}
				
			}
			
			
			
			public function getChatList($id)
			{
				//$sql = "SELECT a.*, b.first_name, b.last_name, b.imageData FROM af_message_requests a LEFT JOIN af_users b ON a.to_id = b.id WHERE a.to_id = $id OR a.from_id = $id ORDER BY  a.updated_date DESC";
				$sql = "SELECT id, first_name, last_name, imageData FROM af_users WHERE id != $id ORDER BY username ASC";
				$query1 = $this->db->query($sql);
				if($query1->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Chat List', 'data' => $query1->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Chat List Not Available');
					return $response;
				}
			}
			
			
			public function getImageList($id)
			{
				$this->db->select('*');
				$this->db->from('af_media');
				$this->db->where('user_id',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
				
			}
			
			
			public function checkEvent($id, $user_id)
			{
				$this->db->select('*');
				$this->db->from('af_order_history');
				$this->db->where('order_user_id',$user_id);
				$this->db->where('event_id',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Event Existing', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Event Not Existing');
					return $response;
				}
				
			}
			
			
			public function acceptRequest($id){
				$this->db->where('id',$id);
				$result = $this->db->update('af_friend_data', array('request_status' => '2'));
				if($result){
					$response = array('status'=>1,'message'=>'Success');
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Failed');
					return $response;
				}
			}
			
			public function rejectRequest($id){
				$this->db->where('id',$id);
				$result = $this->db->update('af_friend_data', array('request_status' => '0'));
				if($result){
					$response = array('status'=>1,'message'=>'Success');
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Failed');
					return $response;
				}
			}
			
			public function unfriend($id){
				$this->db->where('id', $id);
				$res = $this->db->delete('af_friend_data');
				if($res){
					$response = array('status'=>1,'message'=>'Successfully Unfriend');
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Failed...!');
					return $response;
				}
			}


			public function getSearchCountry()
			{
				$this->db->select('*');
				$this->db->from('countries');
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getProfessions()
			{
				$this->db->select('*');
				$this->db->from('af_profession');
				$this->db->order_by("name","asc");
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}
			
			public function getBodyTypes()
			{
				$this->db->select('*');
				$this->db->from('af_body_type');
				$this->db->order_by("name","asc");
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}
			
			public function getEyeColors()
			{
				$this->db->select('*');
				$this->db->from('af_eye_color');
				$this->db->order_by("name","asc");
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}
			

			public function getEducations()
			{
				$this->db->select('*');
				$this->db->from('af_educations');
				$this->db->order_by("name","asc");
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getReligions()
			{
				$this->db->select('*');
				$this->db->from('af_religion');
				$this->db->order_by("name","asc");
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getStoriesData($id)
			{
				$this->db->select('*');
				$this->db->from('af_story');
				$this->db->order_by("story_name","asc");
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getMatchesData($id)
			{
				$country = "(SELECT `name` FROM `countries` WHERE countries.sortname = a.country ) as country";
				$state = "(SELECT `name` FROM `states` WHERE states.id = a.state ) as state";
				$city = "(SELECT `name` FROM `cities` WHERE cities.id = a.city ) as city";
				$sql = "SELECT a.*, ".$country.", ".$state.", ".$city.", (SELECT x.status FROM af_settings x WHERE x.user_id = a.id AND x.plan_id = a.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT b.request_status FROM af_friend_data b WHERE (b.send_from = a.id AND b.send_to = $id) OR (b.send_to = a.id AND b.send_from = $id) LIMIT 1) as request_status, (SELECT c.favorite_id FROM af_favorites c WHERE c.user_id = $id AND c.profile_id = a.id LIMIT 1) as favorite_id FROM af_users a WHERE a.id != $id AND a.account_status = '1' AND a.chamestry_test_status = '1' ORDER BY  a.first_name ASC";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}

			public function getExclusiveUsersList($id)
			{
				$sql = "SELECT a.*, (SELECT x.status FROM af_settings x WHERE x.user_id = a.id AND x.plan_id = a.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT b.request_status FROM af_friend_data b WHERE b.send_from = a.id OR b.send_to = a.id LIMIT 1) as request_status, (SELECT c.favorite_id FROM af_favorites c WHERE c.user_id = $id AND c.profile_id = a.id LIMIT 1) as favorite_id FROM af_users a WHERE a.id != $id AND a.account_status = '1' AND a.chamestry_test_status = '1' AND a.plan='5' ORDER BY  a.first_name ASC";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}
			

/********************************  START **************************************************/	


			public function getExclusiveVisitorsData($id)
			{
				$showImg = "(SELECT x.status FROM af_settings x WHERE x.user_id = a.id AND x.plan_id = a.plan AND x.key = 'imageData' LIMIT 1) as show_image";
				$requestStatus = "(SELECT b.request_status FROM af_friend_data b WHERE b.send_from = a.id OR b.send_to = a.id LIMIT 1) as request_status";
				$favorite_id = "(SELECT c.favorite_id FROM af_favorites c WHERE c.user_id = $id AND c.profile_id = a.id LIMIT 1) as favorite_id";
				$whereQuery = "WHERE v.profile_id = $id ORDER BY  v.updated_date DESC";
				$select = "SELECT v.*, a.first_name, a.last_name, a.imageData , ".$showImg.", ".$requestStatus.", ".$favorite_id;
				$sql = $select." FROM af_profile_visitors v INNER JOIN af_users a ON v.user_id = a.id ".$whereQuery;
				
		        $query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}
			
			
			public function getAllRequest($id)
			{
				$showImg = "(SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image";
				$country = "(SELECT `name` FROM `countries` WHERE countries.sortname = b.country ) as country";
				$select = "SELECT a.*, b.id as user_id, b.first_name, b.last_name, b.imageData, ".$showImg.", ".$country;
				$whereQuery = "WHERE a.send_to = $id AND a.request_status = 1 ORDER BY  a.request_time DESC ";
				$sql = $select." FROM af_friend_data a INNER JOIN af_users b ON a.send_from = b.id ".$whereQuery;
				
		        $query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}
			
			
			public function getAllFriends($id)
			{
				$data = array();
				$sql = "SELECT a.*, b.id as user_id, b.first_name, b.last_name, b.imageData, (SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT `name` FROM `countries` WHERE countries.sortname = b.country ) as country FROM af_friend_data a INNER JOIN af_users b ON a.send_from = b.id WHERE a.send_to = $id AND a.request_status = 2 ORDER BY  a.request_time DESC ";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					$data = $query->result();
				}
				
				$sql2 = "SELECT a.*, b.id as user_id,b.first_name, b.last_name, b.imageData, (SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT `name` FROM `countries` WHERE countries.sortname = b.country ) as country FROM af_friend_data a INNER JOIN af_users b ON a.send_to = b.id WHERE a.send_from = $id AND a.request_status = 2 ORDER BY  a.request_time DESC ";
				$query2 = $this->db->query($sql2);
				if($query2->num_rows() > 0){
					$data = array_merge($data, $query2->result());
				}
				return $data;
			}
			
			
			public function getAllLikes($id)
			{
				$sql = "SELECT a.*, b.id as user_id, b.first_name, b.last_name, b.imageData, (SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT `name` FROM `countries` WHERE countries.sortname = b.country ) as country, (SELECT c.request_status FROM af_friend_data c WHERE c.send_from = a.user_id AND c.send_to = b.id LIMIT 1) as request_status FROM af_favorites a INNER JOIN af_users b ON a.profile_id = b.id WHERE a.user_id = $id ORDER BY  a.created DESC ";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}
			
			public function getAllDislikes($id)
			{
				$sql = "SELECT a.*, b.id as user_id,b.first_name, b.last_name, b.imageData, (SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT `name` FROM `countries` WHERE countries.sortname = b.country ) as country FROM af_friend_data a INNER JOIN af_users b ON a.send_from = b.id WHERE a.send_to = $id AND a.request_status = 0 ORDER BY  a.request_time DESC ";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}
/********************************  END **************************************************/			

			public function getInvoices($id)
			{
				$sql = "SELECT a.* , IF(a.event_id != '', (SELECT b.event_name FROM event b WHERE b.event_id = a.event_id LIMIT 1), '') AS event_name,  DATE_FORMAT(a.order_created_date,'%b %e, %Y') as date from af_order_history a WHERE a.order_user_id = '$id' ORDER BY a.order_created_date DESC";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getEvents($id)
			{
				$sql = "SELECT a.*, b.*, DATE_FORMAT(a.order_created_date,'%b %e, %Y') as date, IF( STR_TO_DATE( b.event_end_date, '%d/%m/%Y' ) > '".date("Y-m-d")."', 'Opened', 'Closed') AS current_status FROM af_order_history a, event b  WHERE a.event_id = b.event_id AND a.order_type='event' AND order_user_id='$id' ORDER BY order_created_date DESC";
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getHairs()
			{
				$this->db->select('*');
				$this->db->from('af_hair');
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}

			public function getHeights()
			{
				$this->db->select('*');
				$this->db->from('af_height');
				$query = $this->db->get();
				if($query->num_rows() > 0){
						return $query->result();
				}else{
					return array();
				}
			}


			public function searchData($data)
			{
				$id = $data['userid'];
				
				$country = "(SELECT `name` FROM `countries` WHERE countries.sortname = a.country ) as country";
				$state = "(SELECT `name` FROM `states` WHERE states.id = a.state ) as state";
				$city = "(SELECT `name` FROM `cities` WHERE cities.id = a.city ) as city";
				$show_image = "(SELECT x.status FROM af_settings x WHERE x.user_id = a.id AND x.plan_id = a.plan AND x.key = 'imageData' LIMIT 1) as show_image";
				$request_status = "(SELECT b.request_status FROM af_friend_data b WHERE (b.send_from = a.id AND b.send_to = $id) OR (b.send_to = a.id AND b.send_from = $id) LIMIT 1) as request_status";
				$favorite_id = "(SELECT c.favorite_id FROM af_favorites c WHERE c.user_id = $id AND c.profile_id = a.id LIMIT 1) as favorite_id";
				$select = "SELECT a.*, ".$country.", ".$state.", ".$city.", ".$show_image.", ".$request_status.", ".$favorite_id;
				$where = "WHERE a.id != $id AND a.account_status = '1' AND a.chamestry_test_status = '1' ORDER BY  a.first_name ASC";
				$sql = $select." FROM af_users a ".$where ;
				$query = $this->db->query($sql);
				if($query->num_rows() > 0){
					return $query->result();
				}else{
					return array();
				}
			}

			
			public function getPlansList($id)
			{
				$this->db->select('*');
				$this->db->from('af_plan');
				$this->db->where('id !=', 0);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Plans List', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Plans List Not Available');
					return $response;
				}
			}
			
			public function getPaySlipContent()
			{
				$this->db->select('*');
				$this->db->from('pay_slip');
				$this->db->limit(1);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Pay Slip Content', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Pay Slip Not Available');
					return $response;
				}

			}
			
			public function getAppGuideData()
			{
				$this->db->select('*');
				$this->db->from('pay_slip');
				$this->db->limit(1);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Pay Slip Content', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Pay Slip Not Available');
					return $response;
				}

			}

			public function changePassword($data)
			{
				$this->db->where('id', $data['userid']);
				$result = $this->db->update('af_users', array('password' => md5($data['password']) ));
				if($result){
					$response = array('status'=>1,'message'=>'Your password successfully changed.');
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Password unable to change');
					return $response;
				}

			}

			public function userLogout($id)
			{
				 $this->db->where('id', $id);
				 return $this->db->update('af_users', array('push_token' => ''));
			}
			
			public function updatePlan($userId, $planId, $plan_time)
			{
				 $currentDate = date("Y-m-d");
				 $d=strtotime("+".$plan_time." Months");
				 $nextDate = date("Y-m-d", $d);
				 $this->db->where('id', $userId);
				 return $this->db->update('af_users', array('plan' => $planId, 'plan_update_date' => $currentDate, 'plan_expair_date' => $nextDate));
			}


			public function getChemistryUsers($id)
			{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('chamestry_test_status',1);
				$this->db->where('id !=',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'City List', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'City List Not Available');
					return $response;
				}

			}
			
			public function getAllNotification($id)
			{
				$sql = "SELECT a.*, b.imageData, (SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image FROM af_notifications a LEFT JOIN af_users b ON a.send_from = b.id WHERE a.send_to = $id";
				$query = $this->db->query($sql);
				
			//	$this->db->select('*');
			//	$this->db->from('af_notifications');
			//	$this->db->where('send_to',$id);
			//	$query = $this->db->get();
				if($query->num_rows() > 0){
					$this->db->flush_cache();
					$this->db->where('send_to',$id);
					$this->db->update('af_notifications', array('status' => '1'));
					$response = array('status'=>1,'message'=>'Notification List', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Notification List Not Available');
					return $response;
				}

			}
			
			public function getGalleryImageList($id)
			{
				$this->db->select('*');
				$this->db->from('af_media');
				$this->db->where('user_id',$id);
				$query = $this->db->get();
				if($query->num_rows() > 0){
					$response = array('status'=>1,'message'=>'Image List', 'data' => $query->result());
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Image List Not Available');
					return $response;
				}

			}
			
			public function deleteGallaryImage($id)
			{
				$this->db->where('id', $id);
				$res = $this->db->delete('af_media');
				if($res){
					$response = array('status'=>1,'message'=>'Image Deleted');
					return $response;
				}else{
					$response = array('status'=>0,'message'=>'Image Not Deleted');
					return $response;
				}

			}


		function checkCurrentPassword($id, $password)
		{
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('id',$id);
				$this->db->where('password', md5($password));
				$query = $this->db->get();
				if($query->num_rows() > 0){
					return true;
				}else{
					return false;
				}
		}

		public function loginUser($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('username',$data['username']);
			$this->db->where('account_status','1');
			$this->db->where('password',md5($data['password']));
			$query = $this->db->get();
			if($query->num_rows() == 1){
				$this->db->flush_cache();
				$this->db->where('username',$data['username']);
				$this->db->update('af_users', array('push_token' => $data['token']));
				$this->db->flush_cache();
				$this->db->select('*');
				$this->db->from('af_users');
				$this->db->where('username',$data['username']);
				$query1 = $this->db->get();
				$response = array('status'=>1,'message'=>'Login Sucessfull', 'data'=>$query1->result());
				return $response;
			}else{
				$response = array('status'=>0,'message'=>'Authentication failed');
				return $response;
			}

		}


		public function verificationUser($data)
		{
			if($this->checkUsername($data)){
				$response = array('status'=>0,'message'=>'Username is already taken, please try another userame.', 'data'=>$query->result());
				return $response;
			}else if($this->checkEmail($data)){
				$response = array('status'=>0,'message'=>'Email is already used, please try another email.', 'data'=>$query->result());
				return $response;
			}else if($this->checkContact($data)){
				$response = array('status'=>0,'message'=>'Contact number is already used, please try another contact number.', 'data'=>$query->result());
				return $response;
			}else{
				$response = array('status'=>1,'message'=>'User Not Existing');
				return false;
			}
		}
		
		public function checkUsername($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('username',$data['username']);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function checkEmail($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('email',$data['email']);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function checkContact($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('contact',$data['contact']);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function verificationFbUser($data)
		{
			$verify = $this->verificationUser($data);
			if($verify['status'] == 1){
				$response = array('status'=>0,'message'=>'User Not Existing');
				return $response;
			}
			
			$this->db->select('*');
			$this->db->from('af_users');
			$this->db->where('email',$data['username']);
			$query = $this->db->get();
			if($query->num_rows() == 1){
				$this->db->flush_cache();
				$this->db->where('email',$data['username']);
				$this->db->update('af_users', array('push_token' => $data['token']));
				$response = array('status'=>1,'message'=>'Login Sucessfull', 'data'=>$query->result());
				return $response;
			}else{
				$response = array('status'=>2,'message'=>'Authentication failed');
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

public function getAllCountries()
{
	$this->db->select('*');
	$this->db->from('countries');
	$query = $this->db->get();
	if($query->num_rows() > 0){
		return $query->result();
	}else{
		return array();
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

public function getTribePicker($country_code)
{
	$this->db->select('*');
	$this->db->from('tribes');
	$this->db->where('country_code', $country_code);
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = $query->result();
		return $response;
	}else{
		$response = array();
		return $response;
	}
}

public function getSettingsData($id)
{
	
	
	$this->db->select('key');
	$this->db->from('af_settings');
	$this->db->where('user_id', (int)$id);
	$this->db->where('status', 'true');
	$query = $this->db->get();
	if($query->num_rows() > 0)
	{
		$response = $query->result();
		$kk = array();
		foreach($response as $val) 
		{
			$kk[] = $val->key ;
		}
		return $kk;
	}else{
		$response = array();
		return $response;
	}
}

public function UpdateUser($id, $data2){
	$this->db->where('id', $id);
	$res = $this->db->update('af_users', $data2);
	if($res){
		$this->db->flush_cache();
		$this->db->select('*');
	    $this->db->from('af_users');
		$this->db->where('id', $id );
		$this->db->limit(1);
		$query = $this->db->get();
		$response = array('status'=>1,'message'=>'Profile Updated', 'data' => $query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'Profile Not Updated');
		return $response;
	}
}


public function getNotificationCount($id)
{
	$this->db->select('*');
	$this->db->from('af_notifications');
	$this->db->where('send_to', $id);
	$this->db->where('status', '0');
	$query = $this->db->get();
	if($query->num_rows() > 0){
		$response = array('status'=>1,'message'=>'Notification Count', 'count' => "$query->num_rows");
		return $response;
	}else{
		$response = array('status'=>1,'message'=>'Notification Count', 'count' => '0');
		return $response;
	}
}


public function checkPlan($id)
{
	$this->db->where('id',$id);
	$result = $this->db->update('af_users', array('plan' => 0, 'plan_update_date' => "",'plan_expair_date' => ""));
	if($result){
		$this->db->flush_cache();
		$this->db->select('*');
		$this->db->from('af_users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$response = array('status'=>1,'message'=>'Plan Verified', 'data'=>$query->result());
		return $response;
	}else{
		$response = array('status'=>0,'message'=>'Authentication failed');
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

public function getCityByState($state_id)
{
	$this->db->select('*');
	$this->db->from('cities');
	$this->db->where('state_id', $state_id);
	$query = $this->db->get();
	if($query->num_rows() > 0){
		return $query->result();
	}else{
		return array();
	}
}

public function getInviteUserList($id)
{
	$sql = "SELECT a.*, (SELECT x.status FROM af_settings x WHERE x.user_id = a.id AND x.plan_id = a.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT b.request_status FROM af_friend_data b WHERE b.send_from = a.id OR b.send_to = a.id LIMIT 1) as request_status, (SELECT c.favorite_id FROM af_favorites c WHERE c.user_id = $id AND c.profile_id = a.id LIMIT 1) as favorite_id FROM af_users a WHERE a.id != $id AND a.account_status = '1' AND a.chamestry_test_status = '1' ORDER BY  a.first_name ASC";
	$query = $this->db->query($sql);
	if($query->num_rows() > 0){
		return $query->result();
	}else{
		return array();
	}
}



public function usersettinginsert($data)
{

$userid = $data['userid'] ;
$planid = $data['planid'] ;
$datagot = $data['data'] ;
      $this->db->where('user_id', $userid);
      $this->db->delete('af_settings'); 
 foreach( $datagot as $key => $val )
	{		
	foreach($val as $key1 => $val1) 
		{
			if( $val1 == 1 ) { $dataval = 'true' ;}  else { $dataval = 'false' ; }
			
        $dataoo = array('user_id' => $userid , 'plan_id' => $planid , 'key' => $key1 , 'status' => $dataval);
        $this->db->insert('af_settings', $dataoo) ;
		}
	}
}




public function  usersettingbyplankey($uid , $pid , $key)
{
	$sql1 = "SELECT *  FROM  `af_settings` WHERE  `user_id` = $uid and  `plan_id` = $pid and `key` = '$key' ";
	$query1 = $this->db->query($sql1);
	if($query1->num_rows() > 0)
	{		
        $data = $query1->result() ;
       $mm = $data[0]->status;
		$tt = true ;
		if($mm == "true")
		{
			$tt = true ;
		}
		else
		{
			$tt = false ;
		}
		
	return $tt ;	
	}
	else
	{
	return false ;	
	}	
}



public function usersettingbyplan($userid , $planid)
{
	 

	$sql = "SELECT plan_services  FROM  `af_plan` WHERE  `id` = $planid  ";
	$query = $this->db->query($sql);
	if($query->num_rows() > 0){
	$data = $query->result() ;
	$plan_services =	explode(',', str_replace('"',"",$data[0]->plan_services ));	
	$fianlarray = array();
	$i = 0 ;
	foreach($plan_services as $key => $val) 
	{
    $status = $this->usersettingbyplankey($userid , $planid , $val);
	$fianlarray[$i] = array( $val => $status); 
	$i++;
	}	
	return $fianlarray;
	}

}


public function getquestionstatus($userid  , $questionkey , $planid)
{
	
	
	return true ;
	
	
	
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

public function getstatePicker($country_code)
{
	$sql = "SELECT a.* FROM states a INNER JOIN countries b ON a.country_id = b.id WHERE b.sortname = '$country_code' ORDER BY a.name";
	$query = $this->db->query($sql);
	if($query->num_rows() > 0){
		return  $query->result();
	}else{
		return array();
	}
}

public function getStateByCountry($country_code)
{
	$sql = "SELECT a.* FROM states a INNER JOIN countries b ON a.country_id = b.id WHERE b.sortname = '$country_code' ORDER BY a.name";
	$query = $this->db->query($sql);
	if($query->num_rows() > 0){
		return $query->result();
	}else{
		return array();
	}
}




	public function getfavoritesList($id)
	{
		$sql = "SELECT a.*, b.first_name, b.last_name, b.imageData, (SELECT x.status FROM af_settings x WHERE x.user_id = b.id AND x.plan_id = b.plan AND x.key = 'imageData' LIMIT 1) as show_image, (SELECT c.request_status FROM af_friend_data c WHERE (c.send_from = a.user_id AND c.send_to = b.id) OR (c.send_to = a.user_id AND c.send_from = b.id) LIMIT 1) as request_status FROM af_favorites a INNER JOIN af_users b ON a.profile_id = b.id WHERE a.user_id = $id ORDER BY  a.created DESC ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$response = array('status'=>1,'message'=>'Favorite List', 'data' => $query->result());
			return $response;
		}else{
			$response = array('status'=>0,'message'=>'Favorite List Not Available');
			return $response;
		}
	}

	public function gettempfavoritesList($id)
	{
		$sql = "SELECT a.*, b.first_name, b.last_name, b.imageData, request_status IN (SELECT c.request_status FROM af_friend_data c WHERE (c.send_from = a.user_id AND c.send_to = b.id) OR (c.send_to = a.user_id AND c.send_from = b.id)) FROM af_favorites a INNER JOIN af_users b ON a.profile_id = b.id WHERE a.user_id = $id ORDER BY  a.created DESC ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$response = array('status'=>1,'message'=>'Favorite List', 'data' => $query->result());
			return $response;
		}else{
			$response = array('status'=>0,'message'=>'Favorite List Not Available');
			return $response;
		}
	}


	public function deleteFavorite($id, $userid)
	{
		$this->db->where('favorite_id', $id);
		$this->db->delete('af_favorites');
		return $this->getfavoritesList($userid);
	}

	public function sendRequest($id, $userid)
	{
		$response = array();
		if(!$this->isFriend($userid, $id))
		{
			$data = array('send_from' => $userid, 'send_to' => $id, 'request_status' => '1');
			if($this->db->insert('af_friend_data', $data)){
				$response = array('status'=>1,'message'=>'Request Sent');
				return $response;
			}else{
				$response = array('status'=>0,'message'=>'Request sending failed...!');
				return $response;
			}
		}else{
			$response = array('status'=>1,'message'=>'Request Sent');
			return $response;
		}
		
	}
	
	public function isFriend($send_from, $send_to){
		$sql = "SELECT * FROM af_friend_data WHERE (send_from = $send_from AND send_to = $send_to) OR (send_to = $send_from AND send_from = $send_to)";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function addMyFavorites($id, $userid)
	{
		$data = array('user_id' => $userid, 'profile_id' => $id);
		if($this->db->insert('af_favorites', $data)){
			$response = array('status'=>1,'message'=>'Request Sent');
			return $response;
		}else{
			$response = array('status'=>0,'message'=>'Request sending failed...!');
			return $response;
		}
	}
	
	public function getDataFromFavorites($id)
	{
		$this->db->select('*');
		$this->db->from('af_favorites');
		$this->db->where('favorite_id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return array('user_id' => "", 'profile_id' => "");
		}
	}


	public function removeMyFavorites($id)
	{
		$this->db->where('favorite_id', $id);
		if($this->db->delete('af_favorites')){
			$response = array('status'=>1,'message'=>'Success');
			return $response;
		}else{
			$response = array('status'=>0,'message'=>'Failed...!');
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



		public function searchUserdata($data)
		{
			$this->db->select('*');
			$this->db->from('af_users');


			$this->db->where($data);
			$query = $this->db->get();
			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Search List', 'messagedata'=>$query->result());
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
					$response = array('status'=>1,'message'=>'Message Data', 'data'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}

		public function mediaData($data)
		{
			$this->db->select('*');
			$this->db->from('af_media');
			$this->db->where('id',$data['id']);
			$query = $this->db->get();

			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Media Data', 'data'=>$query->result());
					return $response;
					}else{
					$response = array('status'=>0,'message'=>'There is some error please try again');
					return $response;
					}
		}

		public function friendData($data)
		{
			$this->db->select('*');
			$this->db->from('af_friend_data');
			$this->db->where('send_to',$data['send_to']);
			$query = $this->db->get();

			if($query->num_rows() == 1){
					$response = array('status'=>1,'message'=>'Friends Data', 'data'=>$query->result());
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






					public function InsertOrderHistory($data){

								$result = $this->db->insert('af_order_history', $data);
								$userdata = $this->getOrderData($data['order_user_id']);
								if($result == 1){
								$response = array('status'=>1,'message'=>'Order history added Sucessfully', 'data' => $userdata);
									return $response;
								}else{
									$response = array('status'=>0,'message'=>'There is some error please try again');
									return $response;
								}

					}
					
					public function InsertNotification($from, $user_id, $type, $title, $body){
						//SELECT `id`, `send_from`, `send_to`, `type`, `title`, `message`, `data`, `created_date`, `status` FROM `af_notifications` WHERE 1
						$data = array(
										'send_from'=> $from,
										'send_to'=> $user_id,
										'type'=> $type,
										'title'=> $title,
										'message'=> $body,
										'status'=> '0',
									);
						return $this->db->insert('af_notifications', $data);
					}


					public function getOrderData($orderuserid)
					{
						$this->db->select('*');
						$this->db->from('af_order_history');
						$this->db->where('order_user_id',$orderuserid);
						$query = $this->db->get();
						if($query->num_rows() == 1){
								return $query->result();
								}else{
								return array();
								}

					}



							public function selectOrderHistory($data)
							{
								$this->db->select('*');
								$this->db->from('af_order_history');
								$this->db->where('order_user_id',$data['order_user_id']);

								$query = $this->db->get();
								if($query->num_rows() == 1){
										$response = array('status'=>1,'message'=>'Order Id Sucessfull', 'data'=>$query->result());
										return $response;
										}else{
										$response = array('status'=>0,'message'=>'Getting some Error');
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
