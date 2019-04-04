<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Facility_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    private $Facilitie = 'facilities';

 		public function InsertFacilitie($data){
			$result = $this->db->insert($this->Facilitie, $this->security->xss_clean($data) );
			if($result == 1)
				return true;//$this->db->insert_id();
			else
				return false;
		}

		public function ListFacilitie()
		{
 			$this->db->select('*');
			$this->db->from($this->Facilitie);
			$this->db->order_by('id','DESC');
  		$query = $this->db->get();
			return $query->result_array();
		}


		public function EditRowFacilitie($id)
		{
 			$this->db->select('*');
			$this->db->from($this->Facilitie);
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}


		public function UpdateFacilitie($data,$id)
    {
			$result = $this->db->update($this->Facilitie, $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
				return true;
			else
				return false;
		}

		public function DeleteFacilitie($id)
    {
			$this->db->where('id', $id);
			$res = $this->db->delete($this->Facilitie);
			if($res == 1)
				return true;
			else
				return false;
		}

}
