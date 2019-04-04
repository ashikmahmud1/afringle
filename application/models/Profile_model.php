<?php
/* 
 * Developed By : OptiSoft 
 * www.optisoft.in
 */
 
class As_user_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get as_user by id
     */
    function get_as_user($id)
    {
        return $this->db->get_where('as_users',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all as_users
     */
    function get_all_as_users()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('as_users')->result_array();
    }
        
    /*
     * function to add new as_user
     */
    function add_as_user($params)
    {
        $this->db->insert('as_users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update as_user
     */
    function update_as_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('as_users',$params);
    }
    
    /*
     * function to delete as_user
     */
    function delete_as_user($id)
    {
        return $this->db->delete('as_users',array('id'=>$id));
    }
}
