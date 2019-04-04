<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplete_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private $Table = 'email_templates';
  private $Table_id = 'template_id';

  public function Insert($data){

    $result = $this->db->insert($this->Table, $this->security->xss_clean($data) );
    if($result == 1)
      return true;//$this->db->insert_id();
    else
      return false;
  }
  public function ListData()
  {
    $this->db->select('*');
    $this->db->from($this->Table);
    $this->db->order_by($this->Table_id,'DESC');
      $query = $this->db->get();
    return $query->result_array();
  }


  public function RowData($id)
  {
    $this->db->select('*');
    $this->db->from($this->Table);
    $this->db->where($this->Table_id,$id);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function Update($data,$id){

    $result = $this->db->update($this->Table, $this->security->xss_clean($data), [ $this->Table_id => $id] );
    if($result == 1)
      return true;
    else
      return false;
  }

  public function Delete($id){
    $this->db->where($this->Table_id, $id);
    $res = $this->db->delete($this->Table);
    if($res == 1)
      return true;
    else
      return false;

  }
}
