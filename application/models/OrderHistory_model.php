<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class OrderHistory_model extends CI_Model
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
			$this->db->from('af_order_history');
			$query = $this->db->get();
			return $query->result_array();
		}


    /*
     * Insert Method
     */
 		public function InsertHair($data){

			$result = $this->db->insert('af_order_history', $data );
			if($result == 1)
			return true;
			else
			return false;
		}



    /*
     * Edit Method
     */
		public function EditRowHair($id)
		{
 			$this->db->select('*');
			$this->db->from('af_order_history');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update Method
     */
		public function UpdateHair($data,$id){

			$result = $this->db->update('af_order_history', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
			return true;
			else
			return false;
		}

    /*
     * Delete services
     */
		public function DeleteHair($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_order_history');
			if($res == 1)
			return true;
			else
			return false;

		}

}
