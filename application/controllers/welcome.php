<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class welcome extends CI_Controller{
    function __construct()
    {
        parent::__construct();
       
    }

    /*
    *Get All Booking List
    */
    function index()
    {
       
        redirect('admin/dashboard');
    }
    
    ?>