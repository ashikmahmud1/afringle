<?php
/* 
 * Developed By : OptiSoft 
 * www.optisoft.in
 */
 
class Contact_u_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get contact_u by id
     */
    function get_contact_u($id)
    {
        return $this->db->get_where('contact_us',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all contact_us
     */
    function get_all_contact_us()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('contact_us')->result_array();
    }
        
    /*
     * function to add new contact_u
     */
    function add_contact_u($params)
    {
        $this->db->insert('contact_us',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update contact_u
     */
    function update_contact_u($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('contact_us',$params);
    }
    
    /*
     * function to delete contact_u
     */
    function delete_contact_u($id)
    {
        return $this->db->delete('contact_us',array('id'=>$id));
    }
}
