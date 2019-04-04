<?php
class AppController extends CI_Controller {

        public function index()
        {
                echo 'Hello World!';
        }
		
		
        public function verifyclient()
        {
			
			$responce  = array("status" => 1 , "message" => "USER ALREADY EXISTE WITH GIVEN DETAILS");
            echo json_encode($responce);
        }		
		
        public function insertuser()
        {
			
			$responce  = array("status" => 0 , "message" => "USER ALREADY EXISTE WITH GIVEN DETAILS");
            echo json_encode($responce);
        }		
		


        public function login()
        {
			
			$responce  = array("status" => 0 , "message" => "USER NOT EXISTE WITH GIVEN DETAILS");
            echo json_encode($responce);
        }
		
		
		   
		


        public function getlogindata()
        {
			
			$responce  = array("status" => 1 , "userid" => 1 , "planid" => 0);
            echo json_encode($responce);
        }





		
		
}