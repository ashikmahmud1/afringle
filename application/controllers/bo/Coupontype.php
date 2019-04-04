<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Coupontype extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Coupontype_model'));
    }
    public function index(){
     $data = array( 'page_title' => 'List Coupon' );
     $data['ListData'] = $this->Coupontype_model->ListData();
     $this->parser->parse('coupontype/coupontypelist', $data);
   }

   public function add(){
     if($this->Permissions->CouponAdd() != 1){ redirect('access-denied');}
     $data = array( 'page_title' => 'Add Coupon', );

     $this->form_validation->set_rules('coupon_name', 'coupon name', 'required');
     //$this->form_validation->set_rules('coupon_code', 'coupon code', 'required');
     if ($this->form_validation->run() == FALSE)
     {
        $this->parser->parse('coupontype/addcoupontype', $data);
     }
     else
     {
         $post = $this->input->post();
         $post['created_date'] = date('Y-m-d H:i:s');
         $RowAffetectd = $this->Coupontype_model->Insert($post);
         if($RowAffetectd == true){
           $this->session->set_flashdata('message', '<span style="color:green;">Coupon Added Succssfully !</span>');
           redirect('couponcode/couponcode-list');
         }else{
           $this->session->set_flashdata('message', '<span style="color:red;">Unable to Add Coupon Please try again !</span>');
           redirect('couponcode/couponcode-add');
         }
     }
   }

   public function edit(){
     if($this->Permissions->CouponEdit() != 1){ redirect('access-denied');}
     $data = array(  'page_title' => 'Edit Coupon', );
     $data['RowData'] = $this->Coupontype_model->RowData($this->input->get('id'));

     $this->form_validation->set_rules('coupon_name', 'coupon name', 'required');
     //$this->form_validation->set_rules('coupon_code', 'coupon code', 'required');

     if ($this->form_validation->run() == FALSE)
     {
         $this->parser->parse('coupontype/edit_couponcode', $data);
     }
     else
     {
         $post = $this->input->post();
         $RowAffetectd = $this->Coupontype_model->Update($post,$this->input->get('id'));
         if($RowAffetectd == true){
           $this->session->set_flashdata('message', '<span style="color:green;">Coupon Update Succssfully !</span>');
           redirect('couponcode/couponcode-list');
         }else{
           $this->session->set_flashdata('message', '<span style="color:red;">Unable to Update Coupon Please try again !</span>');
           redirect('couponcode/edit-couponcode?id='.$this->input->get('id'));
         }
     }
   }

   public function delete(){

     if($this->Permissions->CouponRemove() != 1){ redirect('access-denied');}

     $result = $this->Coupontype_model->Delete($this->input->get('id'));
     if($result == true){
       $message = '<span style="color:green;">Coupon Delete Succssfully !</span>';
     }else{
       $message = '<span style="color:green;">Unable to Delete Coupon !</span>';
     }
     $this->session->set_flashdata('message', $message);
     redirect('couponcode/couponcode-list');
   }


}
