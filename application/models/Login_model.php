<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

		public function __construct()
    {
        // Call the CI_Model constructor
       parent::__construct();
       $this->load->database();
    }
		private $Admin_users = 'as_users';
		private $Admin_privileges = 'as_users';


		 public function loginCheck($data)

		{
			$condition = "username =" . "'" . $data['username']. "' AND " . "password =" . "'" . $data['password']. "'  ";
   			$this->db->select('*');
 			$this->db->from($this->Admin_users);
 			$this->db->where($condition);
 			$this->db->limit(1);
 			$query = $this->db->get();
 			if ($query->num_rows() == 1) {
 				 return $query->result();
 			} else {
 				return false;
 			}
		}

}
 ?>
