<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Coupon extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Couponcode_model'));
	 }

   function index()
   {
     $data = array( 'page_title' => 'List Coupon Code' );
     $data['ListData'] = $this->Couponcode_model->ListData();
     $this->parser->parse('coupon/couponlist', $data);
   }


   public function add(){

     $data = array( 'page_title' => 'Add Coupon Code', );
     $data['CopuonType'] = $this->Couponcode_model->CopuonType();

     $this->form_validation->set_rules('type', 'coupon type', 'required');
     $this->form_validation->set_rules('code', 'coupon code', 'required');
     $this->form_validation->set_rules('discount', 'coupon discount', 'required|numeric');
     $this->form_validation->set_rules('start_end_dates', 'coupon start/end date', 'required');

     if ($this->form_validation->run() == FALSE)
     {
        $this->parser->parse('coupon/addcoupon', $data);
     }
     else
     {
		 
		 $post = $this->input->post();
		 $hotelid = $this->session->userdata['is_logged_admin']['hotel_id'];
         $post = $this->input->post();
         $date = explode('-',$post['start_end_dates']);
         $post['start_date'] = $date[0];
         $post['end_date'] = $date[1];
         $post['created_date'] = date('Y-m-d H:i:s');
         $post['hotel_id'] = $hotelid;

         unset($post['start_end_dates']);
           $RowAffetectd = $this->Couponcode_model->Insert($post);
         if($RowAffetectd == true){
           $this->session->set_flashdata('message', '<span style="color:green;">Coupon Code Added Succssfully !</span>');
           redirect('coupon/coupon-list');
         }else{
           $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Coupon Code Please try again !</span>');
           redirect('coupon/coupon-add');
         }
     }

   }

   public function edit(){

     $data = array( 'page_title' => 'Edit Coupon Code', );

     $data['CopuonType'] = $this->Couponcode_model->CopuonType();
     $data['RowData'] = $this->Couponcode_model->RowData($this->input->get('id'));


     $this->form_validation->set_rules('type', 'coupon type', 'required');
     $this->form_validation->set_rules('code', 'coupon code', 'required');
     $this->form_validation->set_rules('discount', 'coupon discount', 'required|numeric');
     $this->form_validation->set_rules('start_end_dates', 'coupon start/end date', 'required');

     if ($this->form_validation->run() == FALSE)
     {
         $this->parser->parse('coupon/edit', $data);
     }
     else
     {
         $post = $this->input->post();

         $date = explode('-',$post['start_end_dates']);
         $post['start_date'] = $date[0];
         $post['end_date'] = $date[1];
         $post['created_date'] = date('Y-m-d H:i:s');

         unset($post['start_end_dates']);

           $RowAffetectd = $this->Couponcode_model->Update($post,$this->input->get('id'));
         if($RowAffetectd == true){
           $this->session->set_flashdata('message', '<span style="color:green;">Coupon Code Update Succssfully !</span>');
           redirect('coupon/coupon-list');
         }else{
           $this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Coupon Code Please try again !</span>');
           redirect('coupon/edit-coupon?id='.$this->input->get('id'));
         }
     }

   }

   public function delete(){

     $result = $this->Couponcode_model->Delete($this->input->get('id'));
     if($result == true){
       $message = '<span style="color:green;">Coupon Code Delete Succssfully !</span>';
     }else{
       $message = '<span style="color:green;">Unable to Delete Coupon Code !</span>';
     }
     $this->session->set_flashdata('message', $message);
     redirect('coupon/coupon-list');
   }


}
