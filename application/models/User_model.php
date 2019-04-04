<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }





    public function InsertUser($data){

      $result = $this->db->insert('af_users', $data );
      if($result == 1)
      return true;
      else
      return false;
    }





    public function approveUsersList()
    {
      $sql = "SELECT * FROM af_users WHERE account_status = '1'";
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    public function exclusiveList()
    {
      $sql = "SELECT * FROM af_users WHERE plan = '5'";
      $query = $this->db->query($sql);
      return $query->result_array();
    }



    public function monthUsersList()
    {
      $sql = "SELECT * FROM af_users WHERE account_status = '1' AND MONTH(`created_date`) = MONTH(CURRENT_DATE()) ";

      $query = $this->db->query($sql);

      return $query->result_array();
    }


	    public function pendingUsersList()
    {
      $sql = "SELECT * FROM af_users WHERE account_status = '0' ORDER BY username DESC LIMIT 5";


      $query = $this->db->query($sql);

      return $query->result_array();
    }

    public function approveUser($Id)
    {

    $this->db->where('id', $Id);
    $result = $this->db->update('af_users', array('account_status' => '1'));

    if ($result) {
    return true;
  }else{return false;}


    }





}
