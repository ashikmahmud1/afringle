  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class AppController extends CI_Controller{

    public function __construct()
    {

      parent::__construct();
        $this->load->model(array('Api_model'));
      //Codeigniter : Write Less Do More
    }
	
	
	

	
	
	
	
	
		public function SMTP_config()
		{
			$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'mail.optisoft.in',
					'smtp_port' => 25,
					'smtp_user' => 'aashutosh@optisoft.in',
					'smtp_pass' => 'Ankita#1995',
					'mailtype' => 'text/html',
					'newline' => '\r\n',
					'charset' => 'utf-8'
			);

			$this->load->library('email', $config);

		}
		
		public function testmail(){
			$data = array(
							'sender' => 'testoptisoft@gmail.com',
							'receiver' => 'aashutoshyadav19@gmail.com',
							'subject' => 'Test Subject',
							'message_body' => 'test message',
							);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://optisoft.in/app/email_api.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$response = curl_exec($ch);
			//var_export($response);
			 if($response == 1){
				 echo "Success";
			 }else{
				 echo "Failed";
			 }
			
		}
		
		
		public function send($data){

			$from_email = $data['sender'];
			$replyemail = $data['sender'];
			$to_email= $data['receiver'];
			$subject= $data['subject'];
			$bodyTxt= $data['message_body'];
			$this->SMTP_config(); //
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from($from_email,$name='');
			$this->email->to($to_email);
			$this->email->reply_to($replyemail);
			$this->email->subject($subject);
			//$this->email->message($this->parser->parse('mail_template/forgot', $templatedata , true));
			$this->email->message($bodyTxt);
			//$this->email->message($this->parser->parse($templatePath, $templateData , true));
			return $this->email->send();
		}



        public function index() 
        {
                echo 'Hello World!';
        }

        public function testUpload()
        {
          $data = json_decode(file_get_contents('php://input'), true);
          $name = "profile.png" ;
          $file_content = base64_decode($data['imageData']);
          file_put_contents("./upload/test/".$name, $file_content);
          $response = array('status'=>1,'message'=>'Favorite List Not Available');
          return $response;
        }


        public function insertuser()
        {



          // $temp = '{"Register1":{"username":"Test","password":"aaa","cnf_password":"","email":"Test@test.com ","cnf_email":"","contact":"","gender":"","tribe":"","dob":"2016-05-15","country":"","otp":""},"Register2":{"zip":"4555","state":"Andhra Pradesh","city":"","children":"","marital":"","seeking":"Man","haveChildren":"","isSmoke":"","lookingFor":"","isDrugs":"","isHair":"","isDrink":"","bodyType":"","isCar":"","profession":"","education":"","pets":"","eye":"","personality":"","language":"","ambitious":"","height":""},"Register3":{"your_intent":"4","longest_relationship":"","first_name":"","last_name":"","show_publically":"","income":"","isSmoke":"","isBodyType":"3","isKids":""},"headline":"Ssfss","description":"Djdjd","interests":"","conversation":"","cnf_dob":"2016-05-15","imageData":"test"}';

		$data = json_decode(file_get_contents('php://input'), true);
		//$data = json_decode($temp, true);
		$baseUrl = "http://portfolio.madehuge.com/animesh/upload/";

		$imagename = time()."-".$data['imageName'];
		$file_content = base64_decode($data['imageData']);
		file_put_contents("./upload/profile/".$imagename, $file_content);
		
		
		$docname = "";
		if($data['documentName'] != '')
		{
			$docname = time()."-".$data['documentName'];
			$file_content = base64_decode($data['documentData']);
			file_put_contents("./upload/doc/".$docname, $file_content);
		}
		


		$Register1 = $data['Register1'] ;
		$Register2 = $data['Register2'] ;
		$Register3 = $data['Register3'] ;


          $data2 = array(
    			"username" => $Register1['username'],
    			"password" => md5($Register1['password']),
    			"email" => $Register1['email'],
    			"contact" => $Register1['contact'],
    			"gender" => $Register1['gender'],
    			"tribe" => $Register1['tribe'],
    			"hometown" => $Register1['hometown'],
    			"country" => $Register1['country'],
    			"select_country" => $Register1['select_country'],
    			"select_hometown" => $Register1['select_hometown'],
    			"zip" => $Register2['zip'],
    			"state" => $Register2['state'],
    			"city" => $Register2['city'],
    			"children" => $Register2['children'],
    			"marital" => $Register2['marital'],
    			"seeking" => $Register2['seeking'],
    			"haveChildren" => $Register2['haveChildren'],
    			"isSmoke" => $Register2['isSmoke'],
    			"lookingFor" => $Register2['lookingFor'],
    			"isDrugs" => $Register2['isDrugs'],
    			"isHair" => $Register2['isHair'],
    			"isDrink" => $Register2['isDrink'],
    			"bodyType" => $Register2['bodyType'],
    			"isCar" => $Register2['isCar'],
    			"profession" => $Register2['profession'],
    			"education" => $Register2['education'],
    			"pets" => $Register2['pets'],
    			"eye" => $Register2['eye'],
    			"personality" => $Register2['personality'],
    			"language" => $Register2['language'],
    			"ambitious" => $Register2['ambitious'],
    			"height" => $Register2['height'],


    			"your_intent" => $Register3['your_intent'],
    			"longest_relationship" => $Register3['longest_relationship'],
    			"first_name" => $Register3['first_name'],
    			"last_name" => $Register3['last_name'],
    			"show_publically" => $Register3['show_publically'],
    			"income" => $Register3['income'],
    			"isSmoke" => $Register3['isSmoke'],
    			"isBodyType" => $Register3['isBodyType'],
    			"isKids" => $Register3['isKids'],



    			"headline" => $data['headline'],
    			"description" => $data['description'],
    			"interests" => $data['interests'],
    			"conversation" => $data['conversation'],
    			"imageData" => $baseUrl."profile/".$imagename,
    			"dob" => $data['cnf_dob'],
    			"push_token" => $data['token'],

    			"photo" => "dshgkd",
    			"documents" => $baseUrl."doc/".$docname,
    			"chamestry_test_status" => 0,
    			"plan" => 0,
    			);
				
				if($data['isfb'] == true || $data['isln'] == true){
					$data2['account_status'] = 1;
				}else{
					$data2['account_status'] = 0;
				}


         $responseData = $this->Api_model->InsertUser($data2);

        echo json_encode($responseData);

        }
		
		public function updateUserFields(){
			$data = json_decode(file_get_contents('php://input'), true);
			$id = $data['userid'];
			
			 $data2 = array(
    			"select_country" 	=> $data['select_country'],
    			"select_hometown" 	=> $data['select_hometown'],
    			"children" 			=> $data['children'],
    			"seeking" 			=> $data['seeking'],
    			"haveChildren" 		=> $data['haveChildren'],
    			"isSmoke" 			=> $data['isSmoke'],
    			"lookingFor" 		=> $data['lookingFor'],
    			"isDrugs" 			=> $data['isDrugs'],
    			"isHair" 			=> $data['isHair'],
    			"isDrink" 			=> $data['isDrink'],
    			"bodyType" 			=> $data['bodyType'],
    			"isCar" 			=> $data['isCar'],
    			"profession" 		=> $data['profession'],
    			"education" 		=> $data['education'],
    			"pets" 				=> $data['pets'],
    			"eye" 				=> $data['eye'],
    			"personality" 		=> $data['personality'],
    			"language" 			=> $data['language'],
    			"ambitious" 		=> $data['ambitious'],
    			"height" 			=> $data['height'],
    			"your_intent" 		=> $data['your_intent'],
    			"longest_relationship" => $data['longest_relationship'],
    			"show_publically" 	=> $data['show_publically'],
    			"income" 			=> $data['income'],
    			"isSmoke" 			=> $data['isSmoke'],
    			"isBodyType" 		=> $data['isBodyType'],
    			"isKids" 			=> $data['isKids'],
    			"headline" 			=> $data['headline'],
    			"description" 		=> $data['description'],
    			"interests" 		=> $data['interests'],
    			"conversation" 		=> $data['conversation'],
    			"dob" 				=> $data['dob'],
    			);

			$responseData = $this->Api_model->UpdateUser($id, $data2);
			echo json_encode($responseData);
		}

		public function editProfile1()
        {
			$data = json_decode(file_get_contents('php://input'), true);
			$id = $data['userid'];
			$isimage = $data['isimage'];
			$imagename = "";
			$baseUrl = "http://portfolio.madehuge.com/animesh/upload/";
			if ($isimage){
				$imagename = time()."-".$data['imageName'];
				$file_content = base64_decode($data['imageData']);
				file_put_contents("./upload/profile/".$imagename, $file_content);
			}

			  $data2 = array(
    			"first_name" => $data['first_name'],
    			"last_name" => $data['last_name'],
    			"gender" => $data['gender'],
    			"tribe" => $data['tribe'],
    			"hometown" => $data['hometown'],
    			"country" => $data['country'],
    			"zip" => $data['zip'],
    			"state" => $data['state'],
    			"city" => $data['city'],
    			"marital" => $data['marital']
    			);

				if ($isimage){
					$data2['imageData'] = $baseUrl."profile/".$imagename;
				}

			$responseData = $this->Api_model->UpdateUser($id, $data2);
			echo json_encode($responseData);
        }


		public function sendNotification($token, $title, $body, $user_id, $type,$from){

			$res = $this->Api_model->InsertNotification($from, $user_id, $type, $title, $body);
			
			if($token == ''){
				return false;
			}
			$ApiKey = "AIzaSyC1cQBvGA0jtYrhXfdAoHV4aHyNwj9BenE";
			$msg = array(
						'body' 	=> $body,
						'title'	=> $title,
						"sound" => "default",
						"priority" => "high",
						"show_in_foreground" => true
						);
			$fields = array(
							'to'		    => $token,
							"priority"      => 10,
							'data'	=> array('custom_notification' => $msg )
							);
			$headers = array(
							'Authorization: key=' . $ApiKey,
							'Content-Type: application/json'
							);
			$ch = curl_init();
			curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			curl_setopt( $ch,CURLOPT_POST, true );
			curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			$result = curl_exec($ch );
			curl_close( $ch );

			return $result;
		}



        public function loginUser()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->loginUser($data);
		if($responseData['status'] == 1){
			$responseData['notification'] = $this->sendNotification($data['token'], "Login Success", "You have successfully loggedin", $responseData['data'][0]->id, "LOGIN" , "ADMIN");
		}
        echo json_encode($responseData);
        }

        public function verifyclient()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->verificationUser($data);
        echo json_encode($responseData);
        }

		public function verifyfbUser(){
			$data = json_decode(file_get_contents('php://input'), true);
			$responseData = $this->Api_model->verificationFbUser($data);
			echo json_encode($responseData);
		}

        public function userlist()
        {
        $data = array("email" => 'hemraj@gmail.com');
        $responseData = $this->Api_model->userList($data);
        echo json_encode($responseData);
        }
		
		public function getChatList()
        {
			$id = $this->input->get('id');
			$responseData = $this->Api_model->getChatList($id);
			echo json_encode($responseData);
        }
		
		public function getAppGuideData()
        {
			$responseData = $this->Api_model->getAppGuideData();
			echo json_encode($responseData);
        }
		

		public function getChatUser()
        {
			$id = $this->input->get('id');
			$responseData = $this->Api_model->getChatUser($id);
			echo json_encode($responseData);
        }
		
        public function search()
        {
          $data = json_decode(file_get_contents('php://input'), true);

        $responseData = $this->Api_model->searchUserdata($data);
        echo json_encode($responseData);
        }

        public function message()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->messageData($data);
        echo json_encode($responseData);
        }
		
		public function forgotPassword(){
			$data = json_decode(file_get_contents('php://input'), true);
			//$data['email'] = "aashutoshyadav19@gmail.com";
			$responseData = $this->Api_model->forgotPassword($data);
			echo json_encode($responseData);
		}
		
		public function resetPassword(){
			$data = json_decode(file_get_contents('php://input'), true);
			$data["password"] = $this->random_password(6);
			$msg = "Your new password : ".$data["password"];
			$id = $data["userid"];
			$responseData = $this->Api_model->changePassword($data);
			if($responseData['status'] == 1){
			
				$mailArr = array(
								'sender' => "afringle@gmail.com",
								'receiver' => $data['email'],
								'subject' => "AFRINGLE : PASSSWORD RESET",
								'message_body' => $msg,
								);
				if($this->send($mailArr)){
					$responseData['notification'] = $this->sendNotification($this->Api_model->getUserToken($id), "Password Changed", "You have successfully changed your password", $id, "PASSWORD", "ADMIN");
				}else{
					$responseData['status'] = 0;
				}
				   
			  }
            echo json_encode($responseData);
		}

		public function random_password( $length = 6 ) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
		}

        public function changePassword()
        {
          $data = json_decode(file_get_contents('php://input'), true);
          $id = $data['userid'];
          $password = $data['password'];
          $oldPassword = $data['old_password'];
          $isCorrent = $this->Api_model->checkCurrentPassword($id, $oldPassword);
          if ($isCorrent) {
            $responseData = $this->Api_model->changePassword($data);
			if($responseData['status'] == 1){
				   $responseData['notification'] = $this->sendNotification($this->Api_model->getUserToken($id), "Password Changed", "You have successfully changed your password", $id, "PASSWORD", "ADMIN");
			  }
            echo json_encode($responseData);
          }else {
            $responseData = array('status' => 0, 'message0' => 'Incorrect Old Password');
            echo json_encode($responseData);
          }

        }

        public function mediaData()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->mediaData($data);
        echo json_encode($responseData);
        }

        public function friendData()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->friendData($data);
        echo json_encode($responseData);
        }

        public function invite()
        {
        $data = $this->input->post();
        $responseData = $this->Api_model->inviteData($data);
        echo json_encode($responseData);
        }

        public function story()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->storyData($data);
        echo json_encode($responseData);
        }

        public function getChamestryQuestions()
        {
          $responseData = $this->Api_model->getChamestryQuestions();
          echo json_encode($responseData);
        }

        public function countryPicker()
        {
          $responseData = $this->Api_model->countryPicker();
          echo json_encode($responseData);
        }

        public function tribePicker()
        {
          $country_code = $this->input->get('country_code');
          $responseData = $this->Api_model->tribePicker($country_code);
          echo json_encode($responseData);
        }

		 public function getNotificationCount()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getNotificationCount($id);
          echo json_encode($responseData);
        }

		
		public function checkPlan()
        {
			$id = $this->input->get('id');
			$date = $this->input->get('date');
			$today=date("Y-m-d");
			$diff=date_diff(date_create($today), date_create($date));
			$diffDay = $diff->format("%R%a");
			if( $diffDay < 0){
				$responseData = $this->Api_model->checkPlan($id);
				echo json_encode($responseData);
			}else{
				echo json_encode(array('status' => 0, 'message' => "Not Expiered"));
			}
        }
		
		public function getGalleryImageList()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getGalleryImageList($id);
          echo json_encode($responseData);
        }

		public function uploadGalleryImage()
        {
			$data = json_decode(file_get_contents('php://input'), true);

			$baseUrl = "http://portfolio.madehuge.com/animesh/upload/";

			$imagename = time()."-".$data['imageName'];
			$file_content = base64_decode($data['imageData']);
			file_put_contents("./upload/gallary/".$imagename, $file_content);


			  $data2 = array(
					"user_id" => $data['id'],
					"status" => 1,
					"url" => $baseUrl."gallary/".$imagename
					);

			$responseData = $this->Api_model->uploadGalleryImage($data2);
			echo json_encode($responseData);
        }

		public function deleteGallaryImage()
        {
          $id = $this->input->get('id');
          $path = $this->input->get('path');
          $responseData = $this->Api_model->deleteGallaryImage($id);

		  if($responseData['status'] == 1){
			  $this->load->helper("file");
			 delete_files("../upload/gallary/".basename($path));
		  }
          echo json_encode($responseData);
        }
		
		
		public function checkEvent()
        {
          $id = $this->input->get('id');
          $user_id = $this->input->get('user_id');
          $responseData = $this->Api_model->checkEvent($id, $user_id);
          echo json_encode($responseData);
        }

		public function deleteGallaryImage1()
        {
          $path = "http://portfolio.madehuge.com/animesh/upload/gallary/1513771143-image-df1ed5c7-57d1-45ed-8063-4bcdff44218c.jpg";
          echo basename($path) ;
		  echo 	unlink('././upload/gallary/'.basename($path));
        }

		 public function getAllNotification()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getAllNotification($id);
          echo json_encode($responseData);
        }

		public function getPaySlipContent()
        {
          $responseData = $this->Api_model->getPaySlipContent();
          echo json_encode($responseData);
        }

        public function getRegState()
        {
          $data = array();
          $country_code = $this->input->get('country_code');
          $data['state'] = $this->Api_model->getstatePicker($country_code);
          $data['country'] = $this->Api_model->getAllCountries();
          $data['education'] = $this->Api_model->getEducations();
          $data['hair'] = $this->Api_model->getHairs();
          $data['height'] = $this->Api_model->getHeights();
          $data['professions'] = $this->Api_model->getProfessions();
          $data['body'] = $this->Api_model->getBodyTypes();
          $data['eye'] = $this->Api_model->getEyeColors();
          $data['status'] = 1;
          $data['message'] = 'Success';
          echo json_encode($data);
        }

        public function statePicker()
        {
          $country_code = $this->input->get('country_code');
          $responseData = $this->Api_model->statePicker($country_code);
		  $responseData['tribes'] = $this->Api_model->getTribePicker($country_code);
          echo json_encode($responseData);
        }

        public function cityPicker()
        {
          $state_id = $this->input->get('state_id');
          $responseData = $this->Api_model->cityPicker($state_id);
          echo json_encode($responseData);
        }

        public function getfavoritesList()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getfavoritesList($id);
          echo json_encode($responseData);
        }

        public function deleteFavorite()
        {
          $id = $this->input->get('id');
          $userid = $this->input->get('userid');
          $responseData = $this->Api_model->deleteFavorite($id, $userid);
		  if($responseData['status'] == 1){
			  	$temp = $this->sendNotification($this->Api_model->getUserToken($id), "Removed from Favorites", $this->Api_model->getUserName($userid)." Dislike's you", $id, "PROFILE", $userid);
			}
          echo json_encode($responseData);
        }

        public function sendRequest()
        {
          $id = $this->input->get('id');
          $userid = $this->input->get('userid');
          $responseData = $this->Api_model->sendRequest($id, $userid);
		  if($responseData['status'] == 1){
				   $temp = $this->sendNotification($this->Api_model->getUserToken($id), "Friend Request", $this->Api_model->getUserName($userid)." sent you friend request", $id, "PROFILE", $userid);
			  }
          echo json_encode($responseData);
        }
		
		public function acceptRequest()
        {
			$id = $this->input->get('id');
			$userid = $this->input->get('userid');
			$profile_id = $this->input->get('profile_id');
			$responseData = $this->Api_model->acceptRequest($id);
			if($responseData['status'] == 1){
				$temp = $this->sendNotification($this->Api_model->getUserToken($profile_id), "Request Accepted", $this->Api_model->getUserName($userid)." accepted your request", $profile_id, "PROFILE", $userid);
			}
			echo json_encode($responseData);
        }
		
		public function rejectRequest()
        {
          $id = $this->input->get('id');
          $userid = $this->input->get('userid');
          $profile_id = $this->input->get('profile_id');
          $responseData = $this->Api_model->rejectRequest($id);
		  if($responseData['status'] == 1){
			$temp = $this->sendNotification($this->Api_model->getUserToken($profile_id), "Request Ignored", $this->Api_model->getUserName($userid)." ignore your request", $profile_id, "PROFILE", $userid);
		  }
			echo json_encode($responseData);
        }
		
		public function unfriend()
        {
          $id = $this->input->get('id');
          $userid = $this->input->get('userid');
          $profile_id = $this->input->get('profile_id');
          $responseData = $this->Api_model->unfriend($id);
		  if($responseData['status'] == 1){
			$temp = $this->sendNotification($this->Api_model->getUserToken($profile_id), "Unfriend", $this->Api_model->getUserName($userid)." unfriend you", $profile_id, "PROFILE", $userid);
		  }
			echo json_encode($responseData);
        }



        public function getUserDataById()
        {
          $id = $this->input->get('id');
          $responseData['settings'] = $this->Api_model->getSettingsData($id);
		  $comma_separated = implode(",", $responseData['settings']);
		  $responseData = $this->Api_model->getUserDataById($id , $comma_separated);
          echo json_encode($responseData);
        }
		
		public function viewUserProfile()
        {
          $id = $this->input->get('id');
          $user_id = $this->input->get('userid');
		  $this->Api_model->insertVisitor($id, $user_id);
          $responseData['settings'] = $this->Api_model->getSettingsData($id);
		  $comma_separated = implode(",", $responseData['settings']);
		  $responseData = $this->Api_model->getUserDataById($id , $comma_separated);
          echo json_encode($responseData);
        }

        public function getMatchesData()
        {
          $id = $this->input->get('id');
          $data = array();
          $data['stories'] = $this->Api_model->getStoriesData($id);
          $data['matches'] = $this->Api_model->getMatchesData($id);
          $data['status'] = 1;
          $data['message'] = 'Success';
          echo json_encode($data);
        }
		
		public function getExclusiveVisitorsData()
        {
          $id = $this->input->get('id');
          $data = array();
          $data['data'] = $this->Api_model->getExclusiveVisitorsData($id);
          $data['status'] = 1;
          $data['message'] = 'Success';
          echo json_encode($data);
        }
		
		public function getAllFriendsData()
        {
          $id = $this->input->get('id');
          $data = array();
          $data['requests'] = $this->Api_model->getAllRequest($id);
          $data['friends']  = $this->Api_model->getAllFriends($id);
          $data['likes']    = $this->Api_model->getAllLikes($id);
          $data['dislikes'] = $this->Api_model->getAllDislikes($id);
          $data['status'] = 1;
          $data['message'] = 'Success';
          echo json_encode($data);
        }

        public function getInvoices()
        {
            $id = $this->input->get('id');
            $data = array();
            $data['invoices'] = $this->Api_model->getInvoices($id);
            $data['status'] = 1;
            $data['message'] = 'Success';
            echo json_encode($data);
        }
		
		public function userLogout($id)
        {
            $data['data'] = $this->Api_model->userLogout($id);
            $data['status'] = 1;
            $data['message'] = 'Success';
            echo json_encode($data);
        }

        public function getEvents()
        {
            $id = $this->input->get('id');
            $data = array();
            $data['invoices'] = $this->Api_model->getEvents($id);
            $data['status'] = 1;
            $data['message'] = 'Success';
            echo json_encode($data);
        }

        public function getExclusiveUsersList()
        {
            $id = $this->input->get('id');
            $data = array();
            $data['data'] = $this->Api_model->getExclusiveUsersList($id);
            $data['status'] = 1;
            $data['message'] = 'Success';
            echo json_encode($data);
        }

        public function getEventsList()
        {
          $responseData = $this->Api_model->getEventsList();
          echo json_encode($responseData);
        }

        public function serachData()
        {
            $data = json_decode(file_get_contents('php://input'), true);
            $responseData = $this->Api_model->searchData($data);
            echo json_encode($responseData);
        }

        public function getInviteUserList()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getInviteUserList($id);
          echo json_encode($responseData);
        }



        public function usersettingbyplan()
        {

			 $userid = $this->input->get('userid');;
			 $planid = $this->input->get('planid');;
          //$id = $this->input->post('planid');
		 // die();
          $responseData = $this->Api_model->usersettingbyplan($userid , $planid);


		  		$response = array('status'=>1,'message'=>'There is some error please try again' , "data" => $responseData );
		  echo json_encode( $response );

        }


public function usersettinginsert()
{

  $data = json_decode(file_get_contents('php://input'), true);


  $responseData = $this->Api_model->usersettinginsert($data);


		$response = array('status'=>1,'message'=>'Setting Updated'  );
		echo json_encode( $response );



}





		 public function sendNotificationToMatch()
        {
          $id = $this->input->get('id');
          $userid = $this->input->get('userid');
          $temp = $this->sendNotification($this->Api_model->getUserToken($id), "Profile Matched", $this->Api_model->getUserName($userid)." sent you notification", $id, "PROFILE", $userid);
		  $responseData = array('status' => 1, 'message' => 'Notification Sent Successfully');
          echo json_encode($responseData);
        }


        public function addMyFavorites()
        {
          $id = $this->input->get('id');
          $userid = $this->input->get('userid');
          $responseData = $this->Api_model->addMyFavorites($id, $userid);
		  if($responseData['status'] == 1){
				   $temp = $this->sendNotification($this->Api_model->getUserToken($id), "Added in Favorites", $this->Api_model->getUserName($userid)." Like's you", $id, "PROFILE", $userid);
			  }
          echo json_encode($responseData);
        }

        public function removeMyFavorites()
        {
          $id = $this->input->get('id');
		  $data = $this->Api_model->getDataFromFavorites($id);
          $userid = $data[0]->user_id;
          $profileid = $data[0]->profile_id;
          $responseData = $this->Api_model->removeMyFavorites($id);
		  if($responseData['status'] == 1)
		  {
			$temp = $this->sendNotification($this->Api_model->getUserToken($profileid), "Removed from Favorites", $this->Api_model->getUserName($userid)." Dislike's you", $profileid, "PROFILE", $userid);
		  }
          echo json_encode($responseData);
        }

        public function getPlansList()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getPlansList($id);
          echo json_encode($responseData);
        }

        public function getAppData()
        {
          $appdata = array();
          $appdata['countries']   = $this->Api_model->getSearchCountry();
          $appdata['professions'] = $this->Api_model->getProfessions();
          $appdata['educations']  = $this->Api_model->getEducations();
          $appdata['religions']   = $this->Api_model->getReligions();
          $appdata['hairs']       = $this->Api_model->getHairs();
          $appdata['heights']     = $this->Api_model->getHeights();
          echo json_encode($appdata);
        }

        public function getEditUserData()
        {
            $data = json_decode(file_get_contents('php://input'), true);
            $appdata = array();
            $appdata['country']   = $this->Api_model->getAllCountries();
            $appdata['state']   = $this->Api_model->getStateByCountry($data['country']);
            $appdata['city']   = $this->Api_model->getCityByState($data['state']);
			$appdata['tribes'] = $this->Api_model->getTribePicker($data['country']);
            echo json_encode($appdata);
        }

        public function findChemistryResult()
        {
          //$responseData = $this->Api_model->getEventsList();
		   $player1_data = array();
		   $player2_data = array();

		   $datadd = json_decode(file_get_contents('php://input'), true);

		   $p1 = $datadd['p1'];
		   $p2 = $datadd['p2'];

			  $p1_data = $this->Api_model->p1_data($p1);
			  $p2_data = $this->Api_model->p1_data($p2);



$user1_top = 0 ;
$user1_bottom = 0 ;
foreach($p1_data['messagedata'] as $key => $val)
{
$question_id  = $val->question_id;
foreach($p2_data['messagedata'] as $key1 => $val1)
{
$question_id1  = $val1->question_id;
if($question_id1 == $question_id)
{
$question2_p1  = $val->question2;
$question1_p1  = $val1->question1;
if($question2_p1 == $question1_p1 )
{
$user1_top = $user1_top + $val->question3 ;
$user1_bottom = $user1_bottom + $val->question3 ;
}
else
{
$user1_top = $user1_top + 0 ;
$user1_bottom = $user1_bottom + $val->question3 ;
}
}
else
{
}
}
}




$user1_top2 = 0 ;
$user1_bottom2 = 0 ;
foreach($p2_data['messagedata'] as $key => $val)
{
$question_id  = $val->question_id;
foreach($p1_data['messagedata'] as $key1 => $val1)
{
$question_id1  = $val1->question_id;
if($question_id1 == $question_id)
{
$question2_p1  = $val->question2;
$question1_p1  = $val1->question1;
if($question2_p1 == $question1_p1 )
{
$user1_top2 = $user1_top2 + $val->question3 ;
$user1_bottom2 = $user1_bottom2 + $val->question3 ;
}
else
{
$user1_top2 = $user1_top2 + 0 ;
$user1_bottom2 = $user1_bottom2 + $val->question3 ;
}
}
else
{
}
}
}

$calc1 = (($user1_top / $user1_bottom) * 100 ) ; ;
$calc2 = (( $user1_top2 / $user1_bottom2 ) * 100 );;
$calc3 = ( $calc1 * $calc2 ) ;
$calc4 = pow($calc3, (1/count($p2_data['messagedata']))) ; ;



$calc11 = round( $calc1 , 2 ); ;
$calc21 = round( $calc2 , 2 ); ;
$calc41 = round( $calc4 , 2 ); ;



$response = array('status'=>1,'message'=>'Test Submited Successfully', 'percenteg'=> "$calc11" , 'percenteg1' => "$calc21" , 'percenteg2' => "$calc41" );


echo json_encode($response);


        }


        public function getChemistryUsers()
        {
          $id = $this->input->get('id');
          $responseData = $this->Api_model->getChemistryUsers($id);
          echo json_encode($responseData);
        }

        public function submitChemistryTest()
        {
        //  $str = '{"userid":"5","answers":{"17-1":"3","17-2":"2","17-3":"1","16-1":"9","16-2":"8","16-3":"7"}}';
        //  $data = json_decode($str, true);
          $data = json_decode(file_get_contents('php://input'), true);

          $userid = $data['userid'];
          $answers = $data['answers'];
          ksort($answers);
          $newData = array();
          $count = 0;
          $tempArr = array();

          foreach ($answers as $key => $value) {
            $temp = explode("-",$key);
            $tempArr['user_id'] = $userid;
            $tempArr['question_id'] = $temp[0];
            switch ($temp[1]) {
              case '1':
                $tempArr['question1'] = $value;
                break;
              case '2':
                $tempArr['question2'] = $value;
                break;
              case '3':
                $tempArr['question3'] = $value;
                break;
            }

            $count++;
            if ($count == 3) {
              $newData[] = $tempArr;
              reset($tempArr);
              $count = 0;
            }

          }

          $responseData = $this->Api_model->submitChemistryTest($newData, $userid);
          echo json_encode($responseData);
        }








        public function login()
        {
			      $responce  = array("status" => 0 , "message" => "Login Fail");
            echo json_encode($responce);
        }



        public function databyuserid()
        {

			$responce  = array(
			"userid" => 1 ,
			"username" => $this->input->post('username'),
			"password" => $this->input->post('username'),
			"email" => $this->input->post('username'),
			"contact" => $this->input->post('username'),
			"gender" => $this->input->post('username'),
			"tribe" => $this->input->post('username'),
			"dob" => $this->input->post('username'),
			"country" => $this->input->post('username'),
			"zip" => $this->input->post('username'),
			"state" => $this->input->post('username'),
			"city" => $this->input->post('username'),
			"children" => $this->input->post('username'),
			"marital" => $this->input->post('username'),
			"seeking" => $this->input->post('username'),
			"haveChildren" => $this->input->post('username'),
			"isSmoke" => $this->input->post('username'),
			"lookingFor" => $this->input->post('username'),
			"isDrugs" => $this->input->post('username'),
			"isHair" => $this->input->post('username'),
			"isDrink" => $this->input->post('username'),
			"bodyType" => $this->input->post('username'),
			"isCar" => $this->input->post('username'),
			"profession" => $this->input->post('username'),
			"education" => $this->input->post('username'),
			"pets" => $this->input->post('username'),
			"eye" => $this->input->post('username'),
			"personality" => $this->input->post('username'),
			"language" => $this->input->post('username'),
			"ambitious" => $this->input->post('username'),
			"height" => $this->input->post('username'),
			"longest_relationship" => $this->input->post('username'),
			"first_name" => $this->input->post('username'),
			"last_name" => $this->input->post('username'),
			"show_publically" => $this->input->post('username'),
			"income" => $this->input->post('username'),
			"isSmoke" => $this->input->post('username'),
			"isBodyType" => $this->input->post('username'),
			"isKids" => $this->input->post('username'),
			"description" => $this->input->post('username'),
			"interests" => $this->input->post('username'),
			"conversation" => $this->input->post('username'),
			"photo" => $this->input->post('username'),

			);
            echo json_encode($responce);
        }



        public function signUpData()
        {
			       $responce  = array("status" => 0 , "message" => "Login Fail");
            echo json_encode($responce);
        }





      public function AddOrderHistory()
      {
        $data = json_decode(file_get_contents('php://input'), true);
        $responce  = array(
                      			"order_user_id" => $data['order_user_id'],
                      			"order_transsection_number_id" => $data['order_transsection_number_id'],
                      			"order_status" => $data['order_status'],
                      			"order_plan_price" => $data['order_plan_price'],
                      			"order_date" => $data['order_date'],
                      			"order_type" => $data['order_type'],
                      			"event_id" => $data['event_id'],
                      			"event_order_json" => $data['event_order_json'],
                        );


      $responseData = $this->Api_model->InsertOrderHistory($responce);

	  if($responseData['status'] == 1){
		  $responseData['notification'] = $this->sendNotification($data['token'], "Booking Successfull", "Transaction ID : ". $data['order_transsection_number_id'], $data['order_user_id'], "EVENT", "ADMIN");
	  }
      echo json_encode($responseData);
    }

    public function addPlanHistory()
    {
      $data = json_decode(file_get_contents('php://input'), true);
	  
      $responce  = array(
                          "order_user_id" => $data['order_user_id'],
                          "order_transsection_number_id" => $data['order_transsection_number_id'],
                          "order_status" => $data['order_status'],
                          "order_plan_price" => $data['order_plan_price'],
                          "order_date" => $data['order_date'],
                          "order_type" => $data['order_type'],
                          "event_order_json" => $data['event_order_json'],
                      );

        if($this->Api_model->updatePlan($data['order_user_id'], $data['plan_id'], $data['plan_time'])){
            $responseData = $this->Api_model->InsertOrderHistory($responce);
			if($responseData['status'] == 1){
				   $responseData['notification'] = $this->sendNotification($data['token'], "New Plan Activated Successfully", "Transaction ID : ".$data['order_transsection_number_id'], $data['order_user_id'], "PLAN", "ADMIN");
			  }
            echo json_encode($responseData);
            die();
        }else {
          $response = array('status'=>0,'message'=>'Plans List Not Available');
          echo json_encode($response);
          die();
        }
  }


                  public function selectOrderHistory()
                  {
                  $data = json_decode(file_get_contents('php://input'), true);
                  $responseData = $this->Api_model->selectOrderHistory($data);
                  echo json_encode($responseData);
                  }



}
