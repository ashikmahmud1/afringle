<?php
/* 
 * Developed By : OptiSoft 
 * www.optisoft.in
 */
 
class Error extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    {
        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
}