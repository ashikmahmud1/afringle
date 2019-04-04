  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class AppController3 extends CI_Controller{

    public function __construct()
    {

      parent::__construct();
        $this->load->model(array('Api_model2'));
      //Codeigniter : Write Less Do More
    }



        public function index()
        {
                echo 'Hello World!';
        }


        public function insertuser()
        {



          // $temp = '{"Register1":{"username":"Test","password":"aaa","cnf_password":"","email":"Test@test.com ","cnf_email":"","contact":"","gender":"","tribe":"","dob":"2016-05-15","country":"","otp":""},"Register2":{"zip":"4555","state":"Andhra Pradesh","city":"","children":"","marital":"","seeking":"Man","haveChildren":"","isSmoke":"","lookingFor":"","isDrugs":"","isHair":"","isDrink":"","bodyType":"","isCar":"","profession":"","education":"","pets":"","eye":"","personality":"","language":"","ambitious":"","height":""},"Register3":{"your_intent":"4","longest_relationship":"","first_name":"","last_name":"","show_publically":"","income":"","isSmoke":"","isBodyType":"3","isKids":""},"headline":"Ssfss","description":"Djdjd","interests":"","conversation":"","cnf_dob":"2016-05-15","imageData":"test"}';

   $data = json_decode(file_get_contents('php://input'), true);
    //$data = json_decode($temp, true);

    $Register1 = $data['Register1'] ;
		$Register2 = $data['Register2'] ;
		$Register3 = $data['Register3'] ;


          $data2 = array(
    			"username" => $Register1['username'],
    			"password" => $Register1['password'],
    			"email" => $Register1['email'],
    			"contact" => $Register1['contact'],
    			"gender" => $Register1['gender'],
    			"tribe" => $Register1['tribe'],
    			"country" => $Register1['country'],
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
    			"imageData" => $data['imageData'],
    			"dob" => $data['cnf_dob'],

    			"photo" => "dshgkd",
    			"documents" => "dshgkd",
    			"account_status" => 0,
    			"chamestry_test_status" => 0,
    			"plan" => 0,

    			);

          // print_r($data2);
          // die();
         $responseData = $this->Api_model->InsertUser($data2);

        echo json_encode($responseData);

        }



        public function loginUser()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->loginUser($data);
        echo json_encode($responseData);
        }

        public function verifyclient()
        {
        $data = json_decode(file_get_contents('php://input'), true);
        $responseData = $this->Api_model->verificationUser($data);
        echo json_encode($responseData);
        }

        public function userlist()
        {
        $data = array("email" => 'hemraj@gmail.com');
        $responseData = $this->Api_model->userList($data);
        echo json_encode($responseData);
        }

        public function search()
        {
        $data = $this->input->post();
        $responseData = $this->Api_model->search($data);
        echo json_encode($responseData);
        }

        public function message()
        {
        $data = $this->input->post();
        $responseData = $this->Api_model->messageData($data);
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
        $data = $this->input->post();
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

        public function statePicker()
        {
          $country_code = $this->input->get('country_code');
          $responseData = $this->Api_model->statePicker($country_code);
          echo json_encode($responseData);
        }


        public function cityPicker()
        {
          $state_id = $this->input->get('state_id');
          $responseData = $this->Api_model->cityPicker($state_id);
          echo json_encode($responseData);
        }

        public function getEventsList()
        {
          $responseData = $this->Api_model->getEventsList();
          echo json_encode($responseData);
        }

        public function findChemistryResult()
        {
          //$responseData = $this->Api_model->getEventsList();
		   $player1_data = array();
		   $player2_data = array();
		   $p1 = $this->input->post('p1');
		   $p2 = $this->input->post('p2');
		   $p1_data = $this->input->post('p1_data');
		   $p2_data = $this->input->post('p2_data');
		  
		  $p1_data = $this->Api_model2->p1_data($p1);
		  $p2_data = $this->Api_model2->p1_data($p2);
		  

		  
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

$calc1 = round( (($user1_top / $user1_bottom) * 100 ) ); ;
$calc2 = round(( $user1_top2 / $user1_bottom2 ) * 100 );;
$calc3 = ( $calc1 / $calc2 ) ;
$calc4 = round(pow($calc3, (1/count($p2_data['messagedata']))) ); ;


$dataresult = array("r1" => $calc1 , "r2" => $calc2 ,"r3" => $calc4 );
$response = array('status'=>1,'message'=>'Test Submited Successfully', 'data'=> $dataresult);


echo json_encode($response);



















	
		  
		  
        //  $responseData = array('status' => 1, 'message'=>'Success', 'percenteg' =>'80', 'percenteg1' =>'60' );
          //echo json_encode($responseData);
		  
		  
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



}
