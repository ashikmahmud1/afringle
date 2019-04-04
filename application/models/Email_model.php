<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Email_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }


    /*
     * Insert services
     */
 		public function InsertService($data){

			$result = $this->db->insert('tribes', $data );
			if($result == 1)
				return true;
			else
				return false;
		}

    /*
     * list of services
     */
		public function ListService()
		{
 			$this->db->select('*');
			$this->db->from('tribes');
			$query = $this->db->get();
			return $query->result_array();
		}


		public function ListCountry()
		{
 			$this->db->select('*');
			$this->db->from('countries');
			$query = $this->db->get();
			return $query->result_array();
		}

    /*
     * Edit services
     */
		public function EditRowService($id)
		{
 			$this->db->select('*');
			$this->db->from('tribes');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update services
     */
		public function UpdateService($data,$id){

			$result = $this->db->update('tribes', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
				return true;
			else
				return false;
		}

    /*
     * Delete services
     */
		public function DeleteServices($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('tribes');
			if($res == 1)
				return true;
			else
				return false;

		}

}
