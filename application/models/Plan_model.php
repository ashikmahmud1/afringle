<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Plan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		//private $Service = 'services';

	  /*
    * Show List Method
    */
		public function ShowList()
		{
 			$this->db->select('*');
			$this->db->from('af_plan');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertPlan($data){

			$result = $this->db->insert('af_plan', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditRowPlan($id)
		{
 			$this->db->select('*');
			$this->db->from('af_plan');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update Method
     */
		public function UpdatePlan($data,$id){
      // print_r($data);
      // die();
			$result = $this->db->update('af_plan', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeletePlan($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_plan');
			if($res == 1)
			return true;
			else
			return false;

		}

}
