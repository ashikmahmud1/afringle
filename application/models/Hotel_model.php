<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Hotel_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  public function InsertHotel($data)
  {

$data['hotel_slug'] = $this->Slug($data['hotel_name'], "-");


     $result = $this->db->insert('as_hotel', $this->security->xss_clean($data) );
     if($result == 1)
      return $this->db->insert_id();
     else
      return false;
  }

  public function InsertAdminUser($data){
   $result = $this->db->insert('as_users', $this->security->xss_clean($data) );
   if($result == 1)
    return $this->db->insert_id();
   else
    return false;
  }


  public function InsertHotelType($data){
   $result = $this->db->insert('hotel_type', $this->security->xss_clean($data) );
   if($result == 1)
    return $this->db->insert_id();
   else
    return false;
  }

  public function Slug($str, $delimiter = "-")
  {
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
     return $slug;

  }



  public function UpdateHotel($data){
    $this->db->select('*');
    $this->db->from('as_hotel');
    $this->db->where('id', $data);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function updateHotel_save($data)
  {
     $this->db->set('hotel_name', $data['hotel_name']);
     $this->db->set('hotel_address', $data['hotel_address']);
     $this->db->set('hotel_contact', $data['hotel_contact']);
     $this->db->set('description', $data['description']);
     $this->db->set('city', $data['city']);
     $this->db->set('state', $data['state']);
     $this->db->set('country', $data['country']);
     $this->db->set('zipcode', $data['zipcode']);
     $this->db->where('id', $data['hotel_id']);
     if($this->db->update('as_hotel') > 0){
       return true;
     }else{
       return false;
     }
  }

  public function approveHotel($id)
  {
     $this->db->set('status', 'Active');
     $this->db->set('active', '1');
     $this->db->where('hotel_id', $id);
     if($this->db->update('as_users') > 0){
       return true;
     }else{
       return false;
     }
  }

  function removehotel($data)
  {
      $tables = array('as_hotel');
      $this->db->where('id', $data);
      $this->db->delete($tables);
      $this->db->last_query();
  }

  // public function HotelList()
  //  {
  //   $sql = "SELECT as_hotel.*, as_users.*, as_hotel.id as h_id, as_users.id as user_id FROM as_hotel, as_users WHERE as_hotel.id = as_users.hotel_id";
  //   $query = $this->db->query($sql);
  //   return $query->result_array();
  //  }

  public function HotelList()
  {
    $sid = $this->session->userdata('is_logged_admin');
    $user_id = $sid['admin_id'];
    $user_role = $sid['admin_role'];
    $user = "SELECT *  FROM  `af_users`  WHERE   account_status = '1'";
    $userquery = $this->db->query($user);

    return $userquery->result_array();
  }

  public function HotelDelete($id)
  {
     $this->db->where('id', $id);
     $res = $this->db->delete('as_hotel');
     if($res == 1)
      return true;
     else
      return false;
  }

  public function pendingHotelList()
  {
    $sql = "SELECT as_hotel.*, as_users.*, as_hotel.id as hotel_id, as_users.id as user_id FROM as_hotel, as_users WHERE as_hotel.id = as_users.hotel_id AND as_users.role = 'Hotel' AND as_users.status != 'Active'";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function isUserexist($email)
  {
     $this->db->select('*');
     $this->db->from('as_users');
     $this->db->where('email', $email);
     $query = $this->db->get();
     if($query->num_rows() > 0){
      return false;
     }else{
      return true;
     }
  }
    /**************** Hotel *******************/
}
