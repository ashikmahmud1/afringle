<?php
/* 
 * Developed By : OptiSoft 
 * www.optisoft.in
 */
 
class Career_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get career by id
     */
    function get_career($id)
    {
        return $this->db->get_where('careers',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all careers
     */
    function get_all_careers()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('careers')->result_array();
    }
        
    /*
     * function to add new career
     */
    function add_career($params)
    {
        $this->db->insert('careers',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update career
     */
    function update_career($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('careers',$params);
    }
    
    /*
     * function to delete career
     */
    function delete_career($id)
    {
        return $this->db->delete('careers',array('id'=>$id));
    }
}
