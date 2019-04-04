<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

		public function __construct()
        {
            // Call the CI_Model constructor
           parent::__construct();
		   $this->load->database();
        }

		private $Room = 'rooms';
   		private $Booking = 'bookings';
		private $Service = 'services';
		private $Facilitie = 'facilities';


		public function SMTP_config() {

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.hl.optisoft.in',
            'smtp_port' => 465,
            'smtp_user' => 'dev@hl.optisoft.in',
            'smtp_pass' => 'sar4812',
            'mailtype' => 'text/html',
            'newline' => '\r\n',
            'charset' => 'utf-8'
        );
        $this->load->library('email', $config);
    }

		function GetClientDetail($clientid)
		{
				 	$this->db->select('*');
					$this->db->from('customers');
		 			$this->db->where('id', $clientid );
		 			$query = $this->db->get();
				  return $query->result_array();
		}


		//////////////////New Funcitons/////////////
		public function RoomsAvailablesSearchHome($start,$end,$max_person,$limit, $offset)
		{


			$start = date('Y-m-d',strtotime($start));
			$end =  date('Y-m-d',strtotime($end));


			/*$this->db->select('room_id');
			$this->db->from('bookings');

			$this->db->where("booking_start_date <=",$end);
			$this->db->where("booking_end_date >=",$start);

			$sub_query = $this->db->get_compiled_select();

			$this->db->select('room_id,room_name,max_person,room_slug,end_date,adult_price,child_price,end_date,services,features,room_tax,room_short_description,room_long_description,room_main_image,other_image');
			$this->db->from('rooms');
			$this->db->where("max_person >= ",$max_person);
			$this->db->where('end_date < ', date('Y-m-d') );
			$this->db->where_not_in("room_id", $sub_query);
			$this->db->limit($limit, $offset);
			return $this->db->get()->result_array();*/

/*echo '<pre>';
	print_r($query); die;
*/


			if(empty($offset)){$offset=3;}
/* 				$sql = "Select rooms.room_id, rooms.room_name,rooms.max_person,rooms.room_slug,rooms.end_date,rooms.adult_price,rooms.child_price,rooms.end_date,rooms.services,rooms.features,rooms.room_tax,rooms.room_short_description,rooms.room_long_description,rooms.room_main_image,rooms.other_image
								From rooms
								Where rooms.max_person >= '$max_person' AND rooms.room_id Not In    (
														Select room_ids
														From bookings
														Where booking_start_date <= '$end'
															And booking_end_date >= '$start'
														)
								Order By rooms.room_id LIMIT $limit,$offset"; */
/* 			$sql = "Select rooms.room_id, rooms.room_name,rooms.max_person,rooms.room_slug,rooms.end_date,rooms.adult_price,rooms.child_price,rooms.end_date,rooms.services,rooms.features,rooms.room_tax,rooms.room_short_description,rooms.room_long_description,rooms.room_main_image,rooms.other_image								From rooms								Where rooms.max_person >= '$max_person' AND rooms.room_id Not In    (														Select room_ids														From bookings														Where booking_start_date <= '$end'															And booking_end_date >= '$start'														)								Order By rooms.room_id ";
 */

			$sql = "Select rooms.room_id, rooms.room_name,rooms.max_person,rooms.room_slug,rooms.end_date,rooms.adult_price,rooms.child_price,rooms.end_date,rooms.services,rooms.features,rooms.room_tax,rooms.room_short_description,rooms.room_long_description,rooms.room_main_image,rooms.other_image								From rooms								Where rooms.max_person >= '$max_person' AND rooms.room_id Not In    (														Select room_ids														From bookings														Where booking_start_date <= '$end'															And DATE_ADD( booking_end_date, INTERVAL -1 DAY )  >= '$start'														)								Order By rooms.room_id ";

      $query = $this->db->query($sql);
			return $query->result_array();

		}
		//////////////////New Funcitons/////////////



  		public function TotalRooms($max_person,$start,$end){

		 	/*$this->db->select('*');
			$this->db->from($this->Room);
 			$this->db->where('max_person >=', $maxperson );
			//$this->db->where('status', 'published' );
 			$this->db->where('end_date < ', date('Y-m-d') );
 			$query = $this->db->get();
		  	return $query->num_rows();*/


			$start = date('Y-m-d',strtotime($start));
			$end =  date('Y-m-d',strtotime($end));


			$sql = "Select rooms.room_id
								From rooms
								Where rooms.max_person >= '$max_person' AND rooms.room_id Not In    (
														Select room_ids
														From bookings
														Where booking_start_date <= '$end'
															And booking_end_date >= '$start'
														)
								Order By rooms.room_id;";
			$query = $this->db->query($sql);
			return $query->num_rows();



			/*$this->db->select('room_id');
			$this->db->from('bookings');

			$this->db->where("booking_start_date <=",$end);
			$this->db->where("booking_end_date >=",$start);

			$sub_query = $this->db->get_compiled_select();

			$this->db->select('room_id,room_name,max_person,room_slug,end_date,adult_price,child_price,end_date,services,features,room_tax,room_short_description,room_long_description,room_main_image,other_image');
			$this->db->from('rooms');
			$this->db->where("max_person >= ",$max_person);
			$this->db->where('end_date < ', date('Y-m-d') );
			$this->db->where_not_in("room_id", $sub_query);*/

			//return $this->db->get()->num_rows();

		 }
		public function RoomsAvailables($maxperson,$limit, $offset)
		{
			if(empty($maxperson)){$maxperson=1;}

 			$this->db->select('*');
			$this->db->from($this->Room);
			$this->db->where('max_person >=', $maxperson );
			//$this->db->where('status', 'published' );
 			$this->db->where('end_date < ', date('Y-m-d') );
			$this->db->limit($limit, $offset);
			$query = $this->db->get();
			return $query->result_array();
 		}
		public function BookingsData($booking_start_date,$booking_end_date)
		{
 			$this->db->select('booking_id,booking_start_date,booking_end_date,room_ids');
			$this->db->from($this->Booking);
 			$this->db->where('booking_start_date', date('Y-m-d',strtotime($booking_start_date))  );
			$this->db->where('booking_end_date', date('Y-m-d',strtotime($booking_end_date)) );
			$query = $this->db->get();
			return $query->result_array();
 		}
		public function AllBookingsData()		{

			  $sess = $this->session->userdata('is_logged_admin');
				$this->db->select('*');
				$this->db->from($this->Booking);
				$this->db->where('hotel_id', $sess['hotel_id']);
				$this->db->order_by('booking_id','desc');
				$query = $this->db->get();
				return $query->result_array();
		}

		public function GetRoomServices($services_ids)
		{
 			$this->db->select('service_id,title');
			$this->db->from($this->Service);
 			$this->db->where_in('service_id', $services_ids );
 			$query = $this->db->get();
			return $query->result_array();
 		}
		public function GetRoomFeatures($features_ids)
		{
 			$this->db->select('facilitie_id,facilitie_name,facilitie_icon');
			$this->db->from($this->Facilitie);
 			$this->db->where_in('facilitie_id', $features_ids );
 			$query = $this->db->get();
			return $query->result_array();
 		}

		public function GetSingleRoomData($slug)
		{
 			$this->db->select('*');
			$this->db->from($this->Room);
 			$this->db->where_in('room_slug', $slug );
 			$query = $this->db->get();
			return $query->row_array();
 		}

///Booking Controller methods--------^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


		public function RoomsAvailablesSearch($limit, $offset)
		{

  			$this->db->select('*');
		 	$this->db->from($this->Room);

			$adult = $this->session->userdata['Search']['adults'];
			$child = $this->session->userdata['Search']['childs'];
			$maxperson = $adult+$child;
			$this->db->or_where('max_person >=', $maxperson );


 			$this->db->where('end_date < ', date('Y-m-d') );
			/* $this->db->limit($limit, $offset); */
			$query = $this->db->get();
			return $query->result_array();
 		}

		public function TotalRoomsAd(){

		 	$this->db->select('*');
			$this->db->from($this->Room);

			$adult = $this->session->userdata['Search']['adults'];
			$child = $this->session->userdata['Search']['childs'];
			$maxperson = $adult+$child;
			$this->db->or_where('max_person >=', $maxperson );

			$this->db->where('end_date <', date('Y-m-d') );
			$query = $this->db->get();
	  	return $query->num_rows();
		 }

///BookingStepsController methods--------^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


		public function Services(){
			$this->db->select('*');
		 	$this->db->from('services');
 			$this->db->where('status', 'Published' );
 			$query = $this->db->get();
			return $query->result_array();
 		}

		public function checkGuestRoomData($guest_user_id,$room_id){
			$this->db->select('*');
		 	$this->db->from('guestuser_data');
   		$this->db->where('guest_user_id', $guest_user_id );
			$this->db->where('room_id', $room_id );
 			$query = $this->db->get();
			$res = $query->row_array();
			return $res['room_id'];
		}

		public function InsertGuestRoomData($guest_user_id,$room_id){
			return $this->db->insert('guestuser_data',['guest_user_id' => $guest_user_id ,'room_id' => $room_id ] );
		}

		public function UpdateGuestRoomData($guest_user_id,$room_id,$jsondata){
			return $this->db->update('guestuser_data', ['json' => $jsondata ] , ['guest_user_id' => $guest_user_id ,'room_id' => $room_id ] );
		}

		public function DeleteGuestRoomData($guest_user_id){
			return $this->db->delete('guestuser_data', ['guest_user_id' => $guest_user_id ] );
		}

		public function GuestRoomData($guest_user_id){

			$this->db->select('*');
		 	$this->db->from('guestuser_data');
   			$this->db->where('guest_user_id', $guest_user_id );
			$query = $this->db->get();
			$room_ids=[];
			foreach($query->result_array() as $row){
				$room_ids[] = $row['room_id'];
			}

			if(!empty($room_ids)){
				$this->db->select('room_id,room_name,max_person,adult_price,child_price');
				$this->db->from($this->Room);
				$this->db->where_in('room_id', $room_ids );
				$query = $this->db->get();
				return $query->result_array();
			}else{
				return false;
			}

		}

		public function GetRoomDataByM($id){

			$this->db->select('room_id,room_name,max_person,adult_price,child_price');
			$this->db->from($this->Room);
			$this->db->where('room_id', $id );
			$query = $this->db->get();
			return $query->result_array();
		}

		public function CustomerData($data){

			$result = $this->db->insert('customers', $this->security->xss_clean($data) );
			if($result == 1)
				return $this->db->insert_id();
			else
				return false;
		}

		public function BookingData($data){

			$result = $this->db->insert('bookings', $this->security->xss_clean($data) );
			if($result == 1)
				return $this->db->insert_id();
			else
				return false;

		}

		public function GetCouponDiscount($coupon_code){
			$this->db->select('*');
		 	$this->db->from('coupon_code');
   			$this->db->where('code', $coupon_code );
			$this->db->limit(1);
 			$query = $this->db->get();
			$res = $query->row_array();
			return $res;
		}

	public function GetBookingRow($id){
			$this->db->select('*');
		 	$this->db->from('bookings');
   			$this->db->where('booking_id', $id );
			$this->db->limit(1);
 			$query = $this->db->get();
			$res = $query->row_array();
			return $res;
		}


////////////Admin manager search rooms////////////////////////

		public function RoomsAvailablesSearchManger($start,$end,$max_person)
		{
				$sql = "Select rooms.room_id, rooms.room_name,rooms.max_person,rooms.end_date
								From rooms
								Where rooms.max_person >= '$max_person' AND rooms.room_id Not In    (
														Select room_ids
														From bookings
														Where booking_start_date <= '$end'
															And DATE_ADD( booking_end_date, INTERVAL -1 DAY ) >= '$start'
														)
								Order By rooms.room_id";
			$query = $this->db->query($sql);
			return $query->result_array();

 		}
		public function AllBookings($start_date,$end_date)
		{
				$this->db->select('booking_id,booking_start_date,booking_end_date,room_ids,status');
				$this->db->from($this->Booking);
 				$query = $this->db->get();
				return $query->result_array();
		}

		public function RoomData($id){
			$this->db->select('*');
		 	$this->db->from($this->Room);
   			$this->db->where('room_id', $id );
			$this->db->limit(1);
 			$query = $this->db->get();
			$res = $query->row_array();
			return $res;
		}

		public function GetTax($id){
			$this->db->select('*');
		 	$this->db->from('taxes');
   			$this->db->where('tax_id', $id );
  			$query = $this->db->get();
			$res = $query->row_array();
			return $res;
		}
}

?>
