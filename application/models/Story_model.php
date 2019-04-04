<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Story_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }



		private $Story = 'af_story';

    /*
     * Insert services
     */
 		public function InsertStory($data){

			$result = $this->db->insert('af_story', $data );
			if($result == 1)
				return true;
			  else
				return false;
		}

    /*
     * list of services
     */
		public function ListStory()
		{
 			$this->db->select('*');
			$this->db->from('af_story');
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
		public function EditRowStory($id)
		{
 			$this->db->select('*');
			$this->db->from('af_story');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update services
     */
		public function UpdateStory($data,$id){

			$result = $this->db->update('af_story', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
				return true;
			else
				return false;
		}

    /*
     * Delete services
     */
		public function DeleteStory($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_story');
			if($res == 1)
				return true;
			else
				return false;

		}

}
