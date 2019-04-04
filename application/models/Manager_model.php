<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Manager_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }


    private $Admin_users = 'as_users';
    private $Admin_privileges = 'as_users';

    /**
    **  Check Login
    **/
     public function loginCheck($data)
     {
      $condition = "username =" . "'" . $data['username']. "' AND " . "password =" . "'" . $data['password']. "' AND " . "status = 'Active' ";
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

    /**
    **  Insert Admin Mangaer
    **/
    public function InsertAdminManager($data){
      $this->db->select('*');
      $this->db->from('as_users');
      $this->db->where('email', $data['email']);
      $query = $this->db->get();

      if($query ->num_rows() > 0){
      echo "Email already exists";
      }else{
      $this->db->insert('as_users', $data);
      }
    }


    /**
    **  Insert Admin Privileges
    **/
    public function InsertAdminPrivileges($data){

      $result = $this->db->insert($this->Admin_privileges, $this->security->xss_clean($data) );
      if($result == 1)
        return true;
      else
        return false;
    }


    /**
    **  Update Admin Mangaer
    **/
    public function UpdateAdminManager($id){

      $this->db->set('firstname', $_POST['f_name']);
      $this->db->set('lastname', $_POST['l_name']);
      $this->db->set('phone', $_POST['mobile']);

      if (array_key_exists('Booking_add', $_POST)) {
        $this->db->set('Booking_add', $_POST['Booking_add']);
      }else{$this->db->set('Booking_add', 0);}

      if (array_key_exists('Booking_remove', $_POST)) {
      $this->db->set('Booking_remove', $_POST['Booking_remove']);
      }else{$this->db->set('Booking_remove', 0);}
      if (array_key_exists('Booking_edit', $_POST)) {
      $this->db->set('Booking_edit', $_POST['Booking_edit']);
      }else{$this->db->set('Booking_edit', 0);}

      if (array_key_exists('Room_add', $_POST)) {
      $this->db->set('Room_add', $_POST['Room_add']);
      }else{$this->db->set('Room_add', 0);}
      if (array_key_exists('Room_remove', $_POST)) {
      $this->db->set('Room_remove', $_POST['Room_remove']);
      }else{$this->db->set('Room_remove', 0);}
      if (array_key_exists('Room_edit', $_POST)) {
      $this->db->set('Room_edit', $_POST['Room_edit']);
      }else{$this->db->set('Room_edit', 0);}

      if (array_key_exists('Coupon_add', $_POST)) {
     $this->db->set('Coupon_add', $_POST['Coupon_add']);
      }else{$this->db->set('Coupon_add', 0);}
      if (array_key_exists('Coupon_remove', $_POST)) {
      $this->db->set('Coupon_remove', $_POST['Coupon_remove']);
      }else{$this->db->set('Coupon_remove', 0);}
      if (array_key_exists('Coupon_edit', $_POST)) {
      $this->db->set('Coupon_edit', $_POST['Coupon_edit']);
      }else{$this->db->set('Coupon_edit', 0);}

      if (array_key_exists('Facilities_add', $_POST)) {
      $this->db->set('Facilities_add', $_POST['Facilities_add']);
      }else{$this->db->set('Facilities_add', 0);}
      if (array_key_exists('Facilities_remove', $_POST)) {
      $this->db->set('Facilities_remove', $_POST['Facilities_remove']);
      }else{$this->db->set('Facilities_remove', 0);}
      if (array_key_exists('Facilities_edit', $_POST)) {
      $this->db->set('Facilities_edit', $_POST['Facilities_edit']);
      }else{$this->db->set('Facilities_edit', 0);}

      if (array_key_exists('Services_add', $_POST)) {
      $this->db->set('Services_add', $_POST['Services_add']);
      }else{$this->db->set('Services_add', 0);}
      if (array_key_exists('Services_remove', $_POST)) {
      $this->db->set('Services_remove', $_POST['Services_remove']);
      }else{$this->db->set('Services_remove', 0);}
      if (array_key_exists('Services_edit', $_POST)) {
      $this->db->set('Services_edit', $_POST['Services_edit']);
      }else{$this->db->set('Services_edit', 0);}

      if (array_key_exists('Calander_add', $_POST)) {
      $this->db->set('Calander_add', $_POST['Calander_add']);
      }else{$this->db->set('Calander_add', 0);}
      if (array_key_exists('Calander_remove', $_POST)) {
      $this->db->set('Calander_remove', $_POST['Calander_remove']);
      }else{$this->db->set('Calander_remove', 0);}
      if (array_key_exists('Calander_edit', $_POST)) {
      $this->db->set('Calander_edit', $_POST['Calander_edit']);
      }else{$this->db->set('Calander_edit', 0);}

      $this->db->where('id', $_POST['m_id']);
      if($this->db->update('as_users') > 0){
      return true;}else{return false; }


    }


    /**
    **  Update Admin Privileges
    **/
    public function UpdateAdminPrivileges($data,$id){

      $result = $this->db->update($this->Admin_privileges, $this->security->xss_clean($data),['admin_id' => $id] );
      if($result == 1)
        return true;
      else
        return false;
      }


      /**
      **  List of Mangaer
      **/
    public function ManagersList()
    {
		
		$hotelid = $this->session->userdata['is_logged_admin'];
   $h_id = $hotelid['hotel_id'];
      $this->db->select('*');
      $this->db->from($this->Admin_users);
      $this->db->where('role','Manager');
      $this->db->where('hotel_id',"$h_id");
      $query = $this->db->get();
/* 	  echo $this->db->last_query();
	  die(); */ 
      return $query->result_array();
    }

    /**
    **  List of Clerks
    **/
    public function ClerksList()
    {
      $this->db->select('*');
      $this->db->from($this->Admin_users);
      $this->db->where('role','Clerk');
      $query = $this->db->get();
      return $query->result_array();
    }


    /**
    **  Delete Mangaer
    **/
    public function ManagerDelete($id){
      $this->db->where('id', $id);
      $res = $this->db->delete($this->Admin_users);
      if($res == 1)
        return true;
      else
        return false;

    }

    /**
    **  Edit row of Mangaer
    **/
    public function EditManagerRow($id)
    {
      $this->db->select('*');
      $this->db->from($this->Admin_users);
      $this->db->where('id',$id);
      $query = $this->db->get();
      return $query->row_array();
    }


    /**
    **  Edit Manager row Privileges
    **/
    public function EditManagerPrivilegeRow($id)
    {
      $this->db->select('*');
      $this->db->from($this->Admin_privileges);
      $this->db->where('admin_id',$id);
      $query = $this->db->get();
      return $query->row_array();
    }




}
