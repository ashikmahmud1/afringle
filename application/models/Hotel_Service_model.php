<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Hotel_Service_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }



		private $Service = 'hotel_services';

    /*
     * Insert services
     */
 		public function InsertService($data){

      $data['hotel_id'] = $this->session->userdata('is_logged_admin')['hotel_id'];

			$result = $this->db->insert($this->Service, $data);
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
      $hotel_id = $this->session->userdata('is_logged_admin')['hotel_id'];
      $sql = "SELECT hotel_services.*, services.title FROM  hotel_services, services WHERE hotel_services.service_id = services.service_id AND hotel_services.hotel_id='".$hotel_id."' ORDER BY hotel_services.id DESC";
  		$query = $this->db->query($sql);
			return $query->result_array();
		}

    function getAllServices()
    {
      $this->db->select('*');
			$this->db->from('services');
  		$query = $this->db->get();
			return $query->result_array();
    }

    function getAllTaxes()
    {
      $id = $this->session->userdata('is_logged_admin')['hotel_id'];

      $this->db->select('*');
			$this->db->from('taxes');
      $this->db->where('hotel_id', $id);
  		$query = $this->db->get();
			return $query->result_array();
    }

    /*
     * Edit services
     */
		public function EditRowService($id)
		{
      $sql = "SELECT hotel_services.*, services.title FROM  hotel_services, services WHERE hotel_services.service_id = services.service_id AND hotel_services.id=".$id;
  		$query = $this->db->query($sql);
      if($query->num_rows() > 0){
        return $query->result_array();
      }else {
        return false;
      }
		}

    /*
     * Update services
     */
		public function UpdateService($data,$id){

			$result = $this->db->update($this->Service, $this->security->xss_clean($data), ['id' => $id] );
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
			$res = $this->db->delete($this->Service);
			if($res == 1)
				return true;
			else
				return false;

		}

}
