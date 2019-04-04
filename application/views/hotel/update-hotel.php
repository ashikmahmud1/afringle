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
			<h1 class="page-title">Update Hotel</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->


<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">

  <?php foreach($hotelId as $key=>$value){ ?>

    <form method="post" action="<?php echo base_url('bo/Hotel/UpdateHoteldata'); ?>">
      <div class="col-md-12 col-sm-9 col-xs-10">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="field-1">Hotel Name</label>
            <div class="controls">
              <input type="text" name="hotel_name" value="<?php echo $value['hotel_name']; ?>" class="form-control" id="field-1" required>
              <input type="hidden" name="hotel_id" value="<?php echo $value['id']; ?>">

            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="field-1">Hotel Address</label>
            <div class="controls">
              <input type="text" name="hotel_address" value="<?php echo $value['hotel_address']; ?>" class="form-control" id="field-1" required>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="field-3">Hotel Description</label>
            <div class="controls">
              <input type="text"  name="description" value="<?php echo $value['description']; ?>" class="form-control" id="field-3" required>
              </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="field-2">Hotel Contact</label>
            <div class="controls">
              <input type="text" name="hotel_contact" value="<?php echo $value['hotel_contact']; ?>" class="form-control" id="field-2" required>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="field-2">Hotel City</label>
            <div class="controls">
              <input type="text" name="city" value="<?php echo $value['city']; ?>" class="form-control" id="field-2" required>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label" for="field-2">Hotel State</label>
            <div class="controls">
              <input type="text" name="state" value="<?php echo $value['state']; ?>" class="form-control" id="field-2" required>
            </div>
          </div>
        </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-label" for="field-2">Hotel Country</label>
          <div class="controls">
            <input type="text" name="country" value="<?php echo $value['country']; ?>" class="form-control" id="field-2" required>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-label" for="field-2">Hotel Zipcode</label>
          <div class="controls">
            <input type="text" name="zipcode" value="<?php echo $value['zipcode']; ?>" class="form-control" id="field-2" required>
          </div>
        </div>
      </div>


        <div class="pull-right">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  <?php } ?>

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
