<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Profession_model extends CI_Model
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
			$this->db->from('af_profession');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertProfession($data){

			$result = $this->db->insert('af_profession', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditProfession($id)
		{
 			$this->db->select('*');
			$this->db->from('af_profession');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}




		public function UpdateProfession($data,$id){

			$result = $this->db->update('af_profession', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteProfession($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_profession');
			if($res == 1)
			return true;
			else
			return false;

		}

}
