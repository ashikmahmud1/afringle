<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Bodytype_model extends CI_Model
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
			$this->db->from('af_body_type');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertBodytype($data){

			$result = $this->db->insert('af_body_type', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditBodytype($id)
		{
 			$this->db->select('*');
			$this->db->from('af_body_type');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}




		public function UpdateBodytype($data,$id){

			$result = $this->db->update('af_body_type', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteBodytype($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_body_type');
			if($res == 1)
			return true;
			else
			return false;

		}

}
