<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Clerk_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
  private  $Admin_users = 'as_users';

  /*
   * Get Clerk List
   */
    public function ClerksList()
 		{
			
			$hotelid = $this->session->userdata['is_logged_admin'];
			$h_id = $hotelid['hotel_id'];
  			$this->db->select('*');
 			$this->db->from($this->Admin_users);
 			$this->db->where('role','Clerk');
 			$this->db->where('hotel_id',"$h_id");
  			$query = $this->db->get();
 			return $query->result_array();
 		}

    /*
     * Insert Admin Manager
     */
    public function InsertClerk($data){
			$hotelid = $this->session->userdata['is_logged_admin'];
			
			$h_id = $hotelid['hotel_id'];
			$data['hotel_id'] = $h_id;
			$this->db->select('*');
			$this->db->from('as_users');
			$this->db->where('email', $data['email']);
			$query = $this->db->get();

			if($query ->num_rows() > 0){
			    return false;
			}else{
			     return $this->db->insert('as_users', $data);
			}
		}

    /*
     * Edit Admin Manager
     */
    public function EditClerkRow($id)
		{
 			$this->db->select('*');
			$this->db->from($this->Admin_users);
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update Admin Manager
     */
    public function UpdateClerk($userData, $id)
    {
			$this->db->where('id', $id);
			if($this->db->update('as_users', $userData) > 0){
				return true;
			}else{
				return false;
			}
		}

    /*
     * Delete Admin Clerk
     */
    public function ClerkDelete($id){
			$this->db->where('id', $id);
			$res = $this->db->delete($this->Admin_users);
			if($res == 1)
				return true;
			else
				return false;
		}

}
