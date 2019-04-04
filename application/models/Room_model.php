<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Room_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private $Room = 'rooms';
		private $RoomType = 'room_types';


     /*
      * List of Rooms
      */
     		public function RoomsList()
     		{
		    $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
      		$this->db->select('*');
     		$this->db->from($this->Room);
     		$this->db->where("hotel_id","$hotelid");
      		$query = $this->db->get();
     		return $query->result_array();
     		}


     		public function ManagerDelete($id){
     			$this->db->where('id', $id);
     			$res = $this->db->delete($this->Admin_users);
     			if($res == 1)
     			return true;
     			else
     			return false;
        }




        /*
         * Room type
         */
        public function RoomType()
        {
          $this->db->select('room_type_id,room_type_name');
          $this->db->from('room_types');
          $query = $this->db->get();
          return $query->result_array();
        }



        		public function ServicesList()
        		{

              $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];

              $SQL = "SELECT A.title,A.icon,A.title,B.* FROM services A LEFT JOIN hotel_services B ON A.service_id = B.service_id where B.hotel_id = ".$hotelid."" ;
              $query = $this->db->query($SQL);
              return $query->result_array(); 

         			// $this->db->select('service_id,title');
        			// $this->db->from('hotel_services');
        			// $this->db->where('hotel_id',$hotelid);
         			// $query = $this->db->get();
        			// return $query->result_array();
        		}
        		public function FacilitieList()
        		{
         			$this->db->select('facilitie_id,facilitie_name,facilitie_icon');
        			$this->db->from('facilities');
         			$query = $this->db->get();
        			return $query->result_array();
        		}
        		public function TaxList()
        		{

              $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
         			$this->db->select('tax_id,tax_name,tax_percentage');
        			$this->db->from('taxes');
              $this->db->where("hotel_id","$hotelid");
         			$query = $this->db->get();
        			return $query->result_array();
        		}


            public function GetRoomType($id)
            {
              $this->db->select('*');
              $this->db->from($this->RoomType);
              $this->db->where('room_type_id',$id);
              $query = $this->db->get();
              return $query->row_array();
            }

     /*
      * Get room Slug
      */
     public function Slug($name)
     {
       $count = 0;
       $name = strtolower(url_title($name));
       $slug_name = $name;
       while(true)
       {
         $this->db->select('room_id');
         $this->db->where('room_slug', $slug_name);
         $query = $this->db->get($this->Room);
         if ($query->num_rows() == 0) break;
         $slug_name = $name . '-' . (++$count);
       }
       return $slug_name;
     }


     /*
      * Add room
      */
     public function InsertAdminRoom($data){
 			$result = $this->db->insert($this->Room, $this->security->xss_clean($data) );
 			if($result == 1)
 				return true;
 			  else
 				return false;
 	}


    /*
     * Select room data
     */
    public function RowRoomData($id)
    {
      $this->db->select('*');
      $this->db->from($this->Room);
      $this->db->where('room_id',$id);
      $query = $this->db->get();
      return $query->row_array();
    }


    /*
     * Update room data
     */
    public function UpdateRoom($data,$id){
      $result = $this->db->update($this->Room, $this->security->xss_clean($data), ['room_id' => $id] );
      if($result == 1)
        return true;
      else
        return false;
    }


    /*
     * Delete room data
     */
    public function RoomDelete($id){
       $this->db->where('room_id', $id);
       $res = $this->db->delete($this->Room);
       if($res == 1)
         return true;
         else
         return false;
     }







}
