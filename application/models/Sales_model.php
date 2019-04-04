<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Sales_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
         $this->load->database();
    }


    /*
     * Add Sales Person
     */
    public function addsalesperson($data)
    {
    	return $this->db->insert('as_users', $data);

    }

    /*
     * Check user email
     */
    public function isUserexist($email)
    {
    		$this->db->select('*');
    		$this->db->from('as_users');
    		$this->db->where('email', $email);
    		$query = $this->db->get();
    		if($query->num_rows() > 0){
    			return true;
    		}else{
    			return false;
    		}
    }


    /*
     * Remove Sales Person
     */
    public function removesalesperson($data)
    {
    	$tables = array('as_users');
    	$this->db->where('id', $data);
    	$this->db->delete($tables);
      $this->db->last_query();
    }


    /*
     * Update Sales Person
     */
    public function updatesalesperson_save($data)
    {

    	 $this->db->set('firstname', $data['f_name']);
    	 $this->db->set('lastname', $data['l_name']);
    	 $this->db->set('phone', $data['phone_number']);
    	 $this->db->set('address', $data['address']);
    	 $this->db->where('id', $data['personid']);
    	 if($this->db->update('as_users') > 0){
    		 return true;
    	 }else{
    		 return false;
    	 }
    }


    /*
     * List of Sales Person
     */
    public function listsalesperson($data)
    {
    	$this->db->select('*');
    	$this->db->from('as_users');
    	$this->db->where('role', 'Sales');
		      $this->db->where('status', 'Active');
      $this->db->where('active', '1');
    	$query = $this->db->get();
    	$salespersonlist = $query->result_array();
    	return $salespersonlist;
    }

    /*
     * List of Pending Sales Person
     */
    public function listpendingsalesperson($data)
    {
      $this->db->select('*');
      $this->db->from('as_users');
      $this->db->where('role', 'Sales');
      $this->db->where('status !=', 'Active');
      $this->db->where('active !=', '1');
      $query = $this->db->get();
      $salespersonlist = $query->result_array();
      return $salespersonlist;
    }

    /*
     * List of Pending Sales Person
     */
    public function Dashboardlistpendingsalesperson()
    {
      $this->db->select('*');
      $this->db->from('as_users');
      $this->db->where('role', 'Sales');
      $this->db->where('status !=', 'Active');
      $this->db->where('active !=', '1');
      $query = $this->db->get();
      $salespersonlist = $query->result_array();
      return $salespersonlist;
    }

    /*
     * Approve Sales Person
     */
    public function approvesales($id)
    {
       $this->db->set('status', 'Active');
       $this->db->set('active', '1');
       $this->db->where('id', $id);
       if($this->db->update('as_users') > 0){
         return true;
       }else{
         return false;
       }
    }


    /*
     * Single Sales Person
     */
    public function singlesalesperson($data)
    {
    	$this->db->select('*');
    	$this->db->from('as_users');
    	$this->db->where('id', $data);
    	$query = $this->db->get();
    	return $query->result_array();

    }



}
