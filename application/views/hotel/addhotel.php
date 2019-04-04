<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role == "Hotel" || $role == "Clerk" || $role == "Manager" ) {
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
			<h1 class="page-title">Add New Hotel</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
<div class="row">
              <form method="post" action="<?=base_url('hotel/hotel-add')?>">
                <div class="col-md-12 col-sm-9 col-xs-10">
				          <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Hotel Name</label>
                      <div class="controls">
                        <input type="text" name="hotel_name" value="<?php echo set_value('hotel_name'); ?>" class="form-control" id="field-1">
                        <?=form_error('hotel_name', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
				          <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Hotel Contact</label>
                      <div class="controls">
                        <input type="number" name="hotel_contact" value="<?php echo set_value('hotel_contact'); ?>" class="form-control" id="field-1">
                        <?=form_error('hotel_contact', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Hotel Type</label>
                      <div class="controls">
            					  <select name="hotel_type" class="form-control m-bot15" value="<?php echo set_value('hotel_name'); ?>">
            							<option value="" selected="">Select Type</option>
            							<option value="1">Type-1</option>
            							<option value="2">Type-2</option>
            							<option value="3">Type-3</option>
            					  </select>
                        <?=form_error('hotel_type', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
				           <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-3">Select Images</label>
                      <div class="controls">
                        <input type="file" name="hotel_image" class="form-control" id="field-3" multiple="" >
                        <?=form_error('hotel_image', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
				          <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Hotel Address</label>
                      <div class="controls">
					              <input type="text" name="hotel_address" value="" class="form-control" id="field-1" value="<?php echo set_value('hotel_address'); ?>">
                        <?=form_error('hotel_address', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
				          <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label" for="field-1">City</label>
                      <div class="controls">
					                <input type="text" name="city" value="" class="form-control" id="field-1" value="<?php echo set_value('city'); ?>">
                          <?=form_error('city', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                  </div>
				          <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label" for="field-1">State</label>
                      <div class="controls">
					               <input type="text" name="state" value="" class="form-control" id="field-1" value="<?php echo set_value('state'); ?>">
                         <?=form_error('state', '<div class="error">', '</div>');?>
                       </div>
                    </div>
                  </div>
				          <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Country</label>
                      <div class="controls">
					               <input type="text" name="country" value="" class="form-control" id="field-1" value="<?php echo set_value('country'); ?>">
                         <?=form_error('country', '<div class="error">', '</div>');?>
                       </div>
                    </div>
                  </div>
				          <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Zip Code</label>
                      <div class="controls">
					                <input type="number" name="zipcode" value="" class="form-control" id="field-1" value="<?php echo set_value('zipcode'); ?>">
                          <?=form_error('zipcode', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                  </div>
				          <div class="clearfix"></div>
				          <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Hotel Description</label>
                      <div class="controls">
					                <textarea name="hotel_description" value="" class="form-control" id="field-1" rows="5" value="<?php echo set_value('hotel_description'); ?>"></textarea>
                          <?=form_error('hotel_description', '<div class="error">', '</div>');?>
                        </div>
                    </div>
                  </div>

				          <h4 class="title pull-left">Hotel Owner Details</h4>
				          <div class="clearfix"></div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="field-1">First Name</label>
                      <div class="controls">
                        <input type="text" name="firstname" value="" class="form-control" id="field-1" value="<?php echo set_value('firstname'); ?>">
                        <?=form_error('firstname', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Last Name</label>
                      <div class="controls">
                        <input type="text" name="lastname" value="" class="form-control" id="field-1" value="<?php echo set_value('lastname'); ?>">
                        <?=form_error('lastname', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
				          <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-3">Profile Image</label>
                      <div class="controls">
                        <input type="file" name="image" class="form-control" id="field-3">
                        <?=form_error('image', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-3">Email</label>
                      <div class="controls">
                        <input type="email" name="email" value="" class="form-control" id="field-3" value="<?php echo set_value('email'); ?>">
                        <?=form_error('email', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-3">Phone</label>
                      <div class="controls">
                        <input type="text" name="mobile" value="" class="form-control" id="field-3" value="<?php echo set_value('mobile'); ?>">
                        <?=form_error('mobile', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
				          <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-3">Username</label>
                      <div class="controls">
                        <input type="text" name="username" value="" class="form-control" id="field-3" value="<?php echo set_value('username'); ?>">
                        <?=form_error('username', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-2">Password</label>
                      <div class="controls">
                        <input type="password" name="password" value="" class="form-control" id="field-2" value="<?php echo set_value('password'); ?>">
                        <?=form_error('password', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-2">Confirm Password</label>
                      <div class="controls">
                        <input type="password" name="c_password" value="" class="form-control" id="field-2" value="<?php echo set_value('c_password'); ?>">
                        <?=form_error('c_password', '<div class="error">', '</div>');?>
                      </div>
                    </div>
                  </div>


                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Create</button>
                  </div>
                </div>
              </form>
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

</body>

</html>
