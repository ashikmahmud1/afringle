<?php $this->load->view('inc/header'); ?>

<link href="<?php echo base_url('assets'); ?>/css/plugins/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/colorpicker/bootstrap-colorpicker.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/nouislider/nouislider.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/plugins/select2/select2.css" rel="stylesheet">
<link href="<?php echo base_url('assets'); ?>/css/mouldifi-forms.css" rel="stylesheet" >

<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Manager") {
  redirect("admin/dashboard");
} ?>
<style>
label {
    font-weight: 600;
    display: inherit;
}
</style>
</head>
<body>

<!-- Page container -->
<div class="page-container">

	<!-- Page Sidebar -->
  <?php $this->load->view('inc/sidebar'); ?>
  <!-- /page sidebar -->

  <!-- Main container -->
  <div class="main-container">

	<!-- Main header -->
  <?php $this->load->view('inc/topnav'); ?>
	<!-- /main header -->

	<!-- Main content -->
		<div class="main-content">
			<h1 class="page-title">Add New Booking</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">

              <div class="col-md-12 col-sm-9 col-xs-10">

                  <?php
                    if(empty($this->input->get('booking_id'))){
                          ?>

                 <form method="post" action="<?=base_url('admin/search-booking');?>">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label" for="field-1">Check In</label>
                        <div class="controls">
                          <input type="text" name="start_date" required  value="<?=@$this->session->userdata['Admin_Search']['start_date']?>"  class="form-control" id="dpd1" >
                          <?=form_error('start_date', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-label" for="field-1">Check Out</label>
                        <div class="controls">
                          <input type="text" name="end_date" required value="<?=@$this->session->userdata['Admin_Search']['end_date']?>"  class="form-control" id="dpd2" >
                          <?=form_error('end_date', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label" for="field-1">Adults</label>
                        <div class="controls">
                          <select id="children" name="adults"  class="form-control" required>
                            <option disabled value="">Adults</option>
                            <option <?php if(@$this->session->userdata['Admin_Search']['adults']== 1){echo 'selected';}?> value="1">1</option>
                            <option <?php if(@$this->session->userdata['Admin_Search']['adults']== 2){echo 'selected';}?> value="2">2</option>
                            <option <?php if(@$this->session->userdata['Admin_Search']['adults']== 3){echo 'selected';}?> value="3">3</option>
                            <option <?php if(@$this->session->userdata['Admin_Search']['adults']== 4){echo 'selected';}?> value="4">4</option>
                            <option <?php if(@$this->session->userdata['Admin_Search']['adults']== 5){echo 'selected';}?> value="5">5</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label" for="field-1">Childs</label>
                        <div class="controls">
                          <select id="children" name="childs"  class="form-control" required>
                              <option disabled value="">Children</option>
                              <option <?php if(@$this->session->userdata['Admin_Search']['childs']== 0){echo 'selected';}?> value="0">0</option>
                              <option <?php if(@$this->session->userdata['Admin_Search']['childs']== 1){echo 'selected';}?> value="1">1</option>
                              <option <?php if(@$this->session->userdata['Admin_Search']['childs']== 2){echo 'selected';}?> value="2">2</option>
                              <option <?php if(@$this->session->userdata['Admin_Search']['childs']== 3){echo 'selected';}?> value="3">3</option>
                              <option <?php if(@$this->session->userdata['Admin_Search']['childs']== 4){echo 'selected';}?> value="4">4</option>
                              <option <?php if(@$this->session->userdata['Admin_Search']['childs']== 5){echo 'selected';}?> value="5">5</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-label" for="field-1"></label>
                        <div class="controls">
                          <button type="submit" class="btn btn-info">Check Availability <i class="fa fa-calendar"></i></button>
                        </div>
                      </div>
                    </div>
                  </form>

                  <div class="row">

                   <?php
                    $array = $this->session->userdata('ResultsArray');
                      if(!empty($array)){
                        //echo '<pre>';
                        //print_r($array);
                        foreach($array as $value){ ?>

                          <div class="col-sm-3 col-md-3">
                              <div class="team-member ">
                                  <div class="team-img">
                                      <img class="img-responsive" style="width: 90%;" src="<?=$value['main_image'];?>" alt="">
                                  </div>
                                  <div class="team-info">
                                      <h4><?=$value['room_name'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=base_url('booking/booking-add?booking_id='.$value['room_id']);?>">Book Now</a></h4>
                                      <span>$<?=$value['total_price'];?> Per Night</span>
                                  </div>
                                  <p><?=$value['short_description'];?></p>

                              </div>
                          </div>
                      <?php		}
                      if(empty($array)){ echo '<h4>No Room Found...</h4>'; }

                    }
                   ?>

                  </div>

                <?php }else{?>

                    <?php
                      //print_r($roomData);
                          ?>


                      <div class="col-sm-12 col-md-12">
                              <div class="team-member ">
                                  <div class="team-img">
                                      <img class="img-responsive" style="width: 70%;" src="<?=base_url('upload/room/'.$roomData['room_main_image']);?>" alt="">
                                  </div>
                                  <div class="team-info">
                                      <h4><?=$roomData['room_name'];?> </h4>
                                      <span>$<?=$roomData['adult_price']+$roomData['child_price'];?> Per Night</span>
                                  </div>
                                  <p><?=$roomData['room_long_description'];?></p>

                              </div>
                          </div>

                <form method="post" action="<?=base_url('booking/booking-add?booking_id='.$this->input->get('booking_id'));?>">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-1">First Name</label>
                        <div class="controls">
                          <input type="text" name="first_name"  value="<?php echo set_value('first_name'); ?>"class="form-control" id="field-1" >
                          <?=form_error('first_name', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-1">Last Name</label>
                        <div class="controls">
                          <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control" id="field-1" >
                          <?=form_error('last_name', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Email</label>
                        <div class="controls">
                          <input type="email"  name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="field-3" >
                          <?=form_error('email', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Phone</label>
                        <div class="controls">
                          <input type="text"  name="phone_number" value="<?php echo set_value('phone_number'); ?>" class="form-control" id="field-3" >
                          <?=form_error('phone_number', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Address Line 1</label>
                        <div class="controls">
                          <input type="text"  name="address_line_1" value="<?php echo set_value('address_line_1'); ?>" class="form-control" id="field-3" >
                          <?=form_error('address_line_1', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Address Line 2 </label>
                        <div class="controls">
                          <input type="text"  name="address_line_2" value="<?php echo set_value('address_line_2'); ?>" class="form-control" id="field-3" >
                          <?=form_error('address_line_2', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">City</label>
                        <div class="controls">
                          <input type="text"  name="city" value="<?php echo set_value('city'); ?>" class="form-control" id="field-3" >
                          <?=form_error('city', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">State</label>
                        <div class="controls">
                          <input type="text"  name="state" value="<?php echo set_value('state'); ?>" class="form-control" id="field-3" >
                          <?=form_error('state', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Zipcode / Postcode </label>
                        <div class="controls">
                          <input type="text"  name="zip_postcode" value="<?php echo set_value('zip_postcode'); ?>" class="form-control" id="field-3" >
                          <?=form_error('zip_postcode', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Country</label>
                        <div class="controls">
                          <input type="text"  name="country" value="<?php echo set_value('country'); ?>" class="form-control" id="field-3" >
                          <?=form_error('country', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Special Requirements</label>
                        <div class="controls">
                          <textarea name="special_requirements" class="form-control" id="field-3" ><?php echo set_value('special_requirements'); ?></textarea>
                          <?=form_error('special_requirements', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Optional Extras</label>
                        <div class="controls">
                          <ul class="list-unstyled manage">
                          <?php foreach($Services as $s){?>
                          <li>
                              <input tabindex="5" type="checkbox"  name="guest_service[]" id="square-checkbox-2" class="skin-square-green" <?php echo set_checkbox('guest_service', $s['service_id']); ?> value="<?=$s['service_id'];?>" >
                              <label class="icheck-label form-label" for="square-checkbox-2"><?=$s['title'];?> <span>($<?=$s['price'];?> / Night)</span></label>
                          </li>
                          <?php }?>
                         </ul>
                        </div>
                      </div>
                    </div>
                    <h4>Apply Coupon</h4>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="field-3">&nbsp;</label>
                        <div class="controls">
                            <?php if(!empty($this->session->userdata('admin_coupon_code') )){?>
                             <input id="coupon_code" class="form-control"  disabled name="coupon_code" value="<?=$this->session->userdata('admin_coupon_code');?>"  type="text" >
                              <?php	}else{?>
                            <input id="coupon_code" class="form-control" name="coupon_code" value="<?=set_value('coupon_code');?>"  type="text" >
                            <button class="apply-coupon-button" id="couponBtn" onClick="apply_coupon();" type="button">Apply Coupon</button>
                              <?php }?>
                        </div>
                        <div class="coupon_message"></div>
                      </div>
                    </div>
                    <h4>Payment Details : </h4>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Name on Card</label>
                        <div class="controls">
                          <input type="text"  placeholder="Card Holder's Name" name="Card_holder_name" value="<?php echo set_value('Card_holder_name'); ?>" class="form-control" id="field-3" >
                          <?=form_error('Card_holder_name', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Card Number </label>
                        <div class="controls">
                          <input type="text"  name="CardNumber" placeholder="Debit/Credit Card Number" value="<?php echo set_value('CardNumber'); ?>" class="form-control" id="field-3" >
                          <?=form_error('CardNumber', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Expiration Month</label>
                        <div class="controls">

                          <select name="expiry_month" id="expiry-month" class="form-control">
                                           <option disabled value="">Month</option>
                                          <option <?=set_select('expiry_month','01');?> value="01">Jan (01)</option>
                                          <option <?=set_select('expiry_month','02');?> value="02">Feb (02)</option>
                                          <option <?=set_select('expiry_month','03');?> value="03">Mar (03)</option>
                                          <option <?=set_select('expiry_month','04');?> value="04">Apr (04)</option>
                                          <option <?=set_select('expiry_month','05');?> value="05">May (05)</option>
                                          <option <?=set_select('expiry_month','06');?> value="06">June(06)</option>
                                          <option <?=set_select('expiry_month','07');?> value="07">July(07)</option>
                                          <option <?=set_select('expiry_month','08');?> value="08">Aug (08)</option>
                                          <option <?=set_select('expiry_month','09');?> value="09">Sep (09)</option>
                                          <option <?=set_select('expiry_month','10');?> value="10">Oct (10)</option>
                                          <option <?=set_select('expiry_month','11');?> value="11">Nov (11)</option>
                                          <option <?=set_select('expiry_month','12');?> value="12">Dec (12)</option>
                                        </select>

                                  <?php echo form_error('expiry_month', '<div class="error">', '</div>'); ?>

                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Expiration Year</label>
                        <div class="controls">
                          <select name="expiry_year"  class="form-control">
                          <option disabled value="">Year</option>
                                              <option <?=set_select('expiry_year','13');?> value="13">2013</option>
                                              <option <?=set_select('expiry_year','14');?> value="14">2014</option>
                                              <option <?=set_select('expiry_year','15');?> value="15">2015</option>
                                              <option <?=set_select('expiry_year','16');?> value="16">2016</option>
                                              <option <?=set_select('expiry_year','17');?> value="17">2017</option>
                                              <option <?=set_select('expiry_year','18');?> value="18">2018</option>
                                              <option <?=set_select('expiry_year','19');?> value="19">2019</option>
                                              <option <?=set_select('expiry_year','20');?> value="20">2020</option>
                                              <option <?=set_select('expiry_year','21');?> value="21">2021</option>
                                              <option <?=set_select('expiry_year','22');?> value="22">2022</option>
                                              <option <?=set_select('expiry_year','23');?> value="23">2023</option>
                                            </select>

                                      <?php echo form_error('expiry_year', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Card CVV </label>
                        <div class="controls">
                          <input type="text"  name="cvv" value="<?php echo set_value('cvv'); ?>" class="form-control" id="field-3" >
                          <?=form_error('cvv', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary">Add Booking</button>
                    </div>

                </form>
               <?php }?>
              </div>

               <?php
                  if(@$this->input->get('booking_status') == 'complete'){
                    echo '<h3 style="color:green;">'.$this->session->flashdata('message').'</h3>';
                  }
                  if(@$this->input->get('booking_status') == 'incomplete'){
                    echo '<h3 style="color:red;">'.$this->session->flashdata('message').'</h3>';
                  }
                 ?>
              </div>
            </div>
        </div>
    </div>
</div>




		<!-- Footer -->

		<!-- /footer -->

	  </div>

		<!-- Footer -->

		<!-- /footer -->

	  </div>
	  <!-- /main content -->

  </div>
  <!-- /main container -->

</div>
<!-- /page container -->


<?php $this->load->view('inc/footer'); ?>

<!--Bootstrap DatePicker-->
<script src="<?php echo base_url('assets'); ?>/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function () {
		

		
		$('#dpd1').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true
		});

		$('#dpd2').datepicker({
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true
		});

		

		
	});
</script>


</body>

</html>
