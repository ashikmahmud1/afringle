<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Clients_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }



  public function ClientsList()
  {
    $sid = $this->session->userdata('is_logged_admin');
    $user_id = $sid['admin_id'];
    $user_role = $sid['admin_role'];
    $user = "SELECT *  FROM  `as_users`  WHERE  `role` = '$user_role' AND status = 'Active'";
    $userquery = $this->db->query($user);
    $row = $userquery->result_array();
    $adminrole =  $row[0]['role'];
    if($adminrole == 'Admin'){
    $sql = "SELECT *  FROM  `as_users`";
    }else{
      $sql = "SELECT *  FROM  `as_users`  WHERE  `refer_by` = $user_id  ";
    }
    $query = $this->db->query($sql);
    return $query->result_array();
  }


  public function ClientsView($data){
    $this->db->select('*');
    $this->db->from('as_users');
    $this->db->where('id', $data);
    $query = $this->db->get();
    return $query->result_array();
  }




    public function InsertClientnote($data){
     $result = $this->db->insert('notes', $this->security->xss_clean($data) );
     if($result == 1)
      return $this->db->insert_id();
     else
      return false;
    }




      public function ClientNotesList()
      {

      $sid = $_GET['c_id'];

      $this->db->select('*');
      $this->db->from('notes');
      $this->db->where('client_id',$sid);
      $query = $this->db->get();
        return $query->result_array();
      }

      public function updateClientInfo($data)
      {



         $this->db->set('firstname', $data['firstname']);
         $this->db->set('lastname', $data['lastname']);
         $this->db->set('email', $data['email']);
         $this->db->set('phone', $data['phone']);
         $this->db->set('address', $data['address']);
         $this->db->set('txtComments', $data['txtComments']);
         $this->db->where('id', $data['client_id']);
         if($this->db->update('as_user') > 0){
           return true;
         }else{
           return false;
         }
      }



public function CheckSalesAccess($cid)
{
  $clientId = $cid;
  $sid = $this->session->userdata('is_logged_admin');
  $sales_id = $sid['admin_id'];


  $this->db->select('*');
  $this->db->from('as_users');
  $this->db->where('refer_by', $sales_id);
  $this->db->where('id', $clientId);
  $query = $this->db->get();
  $query->result_array();

  if($query->num_rows() > 0){
    return true;
  }else{
    return false;
  }

}



}
