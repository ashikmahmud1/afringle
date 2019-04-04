<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Access extends CI_Controller{
    function __construct()
    {
        parent::__construct();

    }


    /*
     * List of taxes
     */
     	public function index(){
     		$data = array( 'page_title' => 'Access Denied' );
     		$this->parser->parse('access/index',$data );
    	}



}
