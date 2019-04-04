<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Religion_model extends CI_Model
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
			$this->db->from('af_religion');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertReligion($data){

			$result = $this->db->insert('af_religion', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditReligion($id)
		{
 			$this->db->select('*');
			$this->db->from('af_religion');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}




		public function UpdateReligion($data,$id){

			$result = $this->db->update('af_religion', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteReligion($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_religion');
			if($res == 1)
			return true;
			else
			return false;

		}

}
