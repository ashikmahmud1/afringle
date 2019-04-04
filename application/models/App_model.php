<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

		public function __construct()
    {
       parent::__construct();
    }


		public function hashPassword($password = NULL){
			return do_hash($password, 'md5');
		}

		public function Random_Generate_Password( $length = 8 ) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
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



		public function get_records(){

		}

		 public function existsEmail($email)
		 {
		   $this->db->select('id, email');
		   $this->db->from('power_client');
		   $this->db->where('email', $email);
		   $this->db->limit(1);

		   $query = $this->db->get();
		   if($query->num_rows() == 1)
		   {
			 return $query->result();
		   }
		   else
		   {
			 return false;
		   }
		 }


		public function update_password($id , $password)
		 {

		   	$this->db->where('id', $id);
			$res = $this->db->update('power_client', ['password' => $password] );
		   if($res)
			 return true;
		   else
			 return false;
		 }


		public function RelationData($data){

			$result = $this->db->insert('relation_table', $data);
			if($result == 1)
				return true;
			else
				return false;
		}

		public function get_profile(){

			$this->db->select('email, phone, address');
			$this->db->where('id', $this->session->userdata['is_logged']['id']);
			$query = $this->db->get('users');
			return $query->result();


		}


		public function ProductList()
		{

			$this->db->select('*');
			$this->db->from('products');
			$this->db->or_where('ProductType','Camera');
			$this->db->or_where('ProductType','Hard Disk' );
			$query = $this->db->get();
			return $query->result();
		}

		public function ProductType($ProductType,$camera_type)
		{

			$this->db->select('*');
			$this->db->from('products');
			$this->db->where('default_status','1');
			$this->db->where('ProductType',$ProductType );
			if($ProductType == 'Camera'){
			$this->db->where('camera_type',$camera_type);
			}
			$query = $this->db->get();
			if ($query->num_rows() == 1) {
				 return 1;
			} else {
				return 0;
			}
		}


		public function default_products_price($default_status,$camera_resolution,$camera_type)
		{
			//echo $default_status.$camera_resolution.$camera_type;
			$this->db->select('*');
			$this->db->from('products');
			$this->db->where('ProductType','Camera');
			//if($default_status == 1){
				$this->db->where('camera_type',$camera_type);
			//}
			$this->db->where('default_status',$default_status);
			if($default_status == 0){
				$this->db->where('camera_resolution',$camera_resolution);
			}
			$query = $this->db->get();
			return $query->result();

		}
		public function default_products_storage_price($default_status,$storage_type)
		{
			//echo $default_status.$storage_type; die;
			$this->db->select('*');
			$this->db->from('products');
			$this->db->where('ProductType','Hard Disk');
			$this->db->where('default_status',$default_status);
			if($default_status == 0){
				$this->db->where('storage_price',$storage_type);
				//$this->db->or_where('storage_price',$storage_type);
			}
			$query = $this->db->get();
			return $query->result();

		}

}
