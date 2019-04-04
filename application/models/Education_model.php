<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Education_model extends CI_Model
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
			$this->db->from('af_educations');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertEducation($data){

			$result = $this->db->insert('af_educations', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditEducation($id)
		{
 			$this->db->select('*');
			$this->db->from('af_educations');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}




		public function UpdateEducation($data,$id){

			$result = $this->db->update('af_educations', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteEducation($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_educations');
			if($res == 1)
			return true;
			else
			return false;

		}

}
