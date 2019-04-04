<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Height_model extends CI_Model
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
			$this->db->from('af_height');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertHeight($data){

			$result = $this->db->insert('af_height', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditRowHeight($id)
		{
 			$this->db->select('*');
			$this->db->from('af_height');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update Method
     */
		public function UpdateHeight($data,$id){

			$result = $this->db->update('af_height', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteHeight($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_height');
			if($res == 1)
			return true;
			else
			return false;

		}

}
