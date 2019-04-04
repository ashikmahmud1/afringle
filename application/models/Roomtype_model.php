<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Roomtype_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
          $this->load->database();
    }

    private $RoomType = 'room_types';

    /*
     * Get room type
     */

    public function GetRoomType($id)
    {
    	$this->db->select('*');
    	$this->db->from($this->RoomType);
    	$this->db->where('room_type_id',$id);
    	$query = $this->db->get();
    	return $query->row_array();
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

    /*
     * Insert room type
     */
		public function InsertRoomType($data){

			$result = $this->db->insert($this->RoomType, $this->security->xss_clean($data) );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * List room type
     */
		public function ListRoomType()
		{
 			$this->db->select('*');
			$this->db->from($this->RoomType);
			$this->db->order_by('room_type_id','DESC');
  		$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Edit room type rows
     */
		public function EditRowRoomType($id)
		{
 			$this->db->select('*');
			$this->db->from($this->RoomType);
			$this->db->where('room_type_id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}


    /*
     * Update room type
     */
  		public function UpdateRoomType($data,$id){
    		$result = $this->db->update($this->RoomType, $this->security->xss_clean($data), ['room_type_id' => $id] );
  			if($result == 1)
  			return true;
  			else
  			return false;
  		}

      /*
       * Delete room type
       */
  		public function DeleteRoomType($id){
  			$this->db->where('room_type_id', $id);
  			$res = $this->db->delete($this->RoomType);
  			if($res == 1)
  			return true;
  			else
  			return false;
  		}


}
