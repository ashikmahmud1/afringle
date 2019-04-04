<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Eyecolor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

	/*
    * Show List Method
    */
		public function ShowList()
		{
 			$this->db->select('*');
			$this->db->from('af_eye_color');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertEyecolor($data){

			$result = $this->db->insert('af_eye_color', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditEyecolor($id)
		{
 			$this->db->select('*');
			$this->db->from('af_eye_color');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}




		public function UpdateEyecolor($data,$id){

			$result = $this->db->update('af_eye_color', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteEyecolor($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_eye_color');
			if($res == 1)
			return true;
			else
			return false;

		}

}
