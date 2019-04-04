<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Schedule extends CI_Controller{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
      $data = array( 'page_title' => 'Schedule', );
      //$data['listData'] = $this->db->get_where('careers')->result_array();
      $this->parser->parse('schedule/calander', $data);
    }
}
