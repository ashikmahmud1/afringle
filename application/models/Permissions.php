<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Model {

		public function __construct()
        {
            // Call the CI_Model constructor
           parent::__construct();
		   $this->load->database();
        }

		private $Admin_users = 'admin_users';
		private $Admin_privileges = 'admin_privileges';
		private $Admin_Permission_Column = 'admin_id';

 		public function RolePermissions()
		{

 			$this->db->select('*');
			$this->db->from($this->Admin_privileges);
			$this->db->where($this->Admin_Permission_Column, $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get();
			return $query->row_array();
		}
		public function is_Clerk(){
			if($this->session->userdata['is_logged_admin']['admin_role'] == 'Clerk'){
				return 1;
			}else{
				return 0;
			}
		}

////Booking//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function BookingAdd()
		{
  			$this->db->select('Booking_add');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Booking_add'];
		}
		public function BookingRemove()
		{
  			$this->db->select('Booking_remove');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Booking_remove'];
		}
		public function BookingEdit()
		{
  			$this->db->select('Booking_edit');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Booking_edit'];
		}
////Booking//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




////Room//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function RoomAdd()
		{
  			$this->db->select('Room_add');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();

			return $query['Room_add'];
		}
		public function RoomRemove()
		{
  			$this->db->select('Room_remove');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Room_remove'];
		}
		public function RoomEdit()
		{
  			$this->db->select('Room_edit');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Room_edit'];
		}
////Booking//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////Coupon//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function CouponAdd()
		{
  			$this->db->select('Coupon_add');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Coupon_add'];
		}
		public function CouponRemove()
		{
  			$this->db->select('Coupon_remove');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Coupon_remove'];
		}
		public function CouponEdit()
		{
  			$this->db->select('Coupon_edit');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Coupon_edit'];
		}
////Coupon//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////Facilities//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function FacilitiesAdd()
		{
  			$this->db->select('Facilities_add');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Facilities_add'];
		}
		public function FacilitiesRemove()
		{
  			$this->db->select('Facilities_remove');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Facilities_remove'];
		}
		public function FacilitiesEdit()
		{
  			$this->db->select('Facilities_edit');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Facilities_edit'];
		}
////Facilities//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




////Services//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function ServicesAdd()
		{
  			$this->db->select('Services_add');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Services_add'];
		}
		public function ServicesRemove()
		{
  			$this->db->select('Services_remove');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Services_remove'];
		}
		public function ServicesEdit()
		{
  			$this->db->select('Services_edit');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Services_edit'];
		}
////Services//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////Calander//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function CalanderAdd()
		{
  			$this->db->select('Calander_add');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Calander_add'];
		}
		public function CalanderRemove()
		{
  			$this->db->select('Calander_remove');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Calander_remove'];
		}
		public function CalanderEdit()
		{
  			$this->db->select('Calander_edit');
			$this->db->from('as_users');
			$this->db->where('id', $this->session->userdata['is_logged_admin']['admin_id'] );
 			$query = $this->db->get()->row_array();
			return $query['Calander_edit'];
		}
////Services//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}

?>
