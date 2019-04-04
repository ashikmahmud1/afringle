<?php
/* 
 * Developed By : OptiSoft 
 * www.optisoft.in
 */
 
class Customer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get customer by id
     */
    function get_customer($id)
    {
        return $this->db->get_where('customers',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all customers
     */
    function get_all_customers()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('customers')->result_array();
    }
        
    /*
     * function to add new customer
     */
    function add_customer($params)
    {
        $this->db->insert('customers',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update customer
     */
    function update_customer($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('customers',$params);
    }
    
    /*
     * function to delete customer
     */
    function delete_customer($id)
    {
        return $this->db->delete('customers',array('id'=>$id));
    }
}
