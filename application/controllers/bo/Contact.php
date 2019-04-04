<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Contact extends CI_Controller{
    function __construct()
    {
        parent::__construct();

    }

    function index()
    {
      $data = array( 'page_title' => 'Careers us', );
  		$data['listData'] = $this->db->get_where('careers')->result_array();
   		$this->parser->parse('contact/newcontactlist', $data);
    }

    function careerslist()
    {
      $data = array( 'page_title' => 'Careers us', );
  		$data['listData'] = $this->db->get_where('careers')->result_array();
   		$this->parser->parse('careers/listcareers', $data);
    }


}
