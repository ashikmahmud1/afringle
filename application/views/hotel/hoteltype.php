<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role == "Admin" || $role == "Clerk" || $role == "Manager" || $role == "User" ) {
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
			<h1 class="page-title">Add Hotel Type</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
<div class="row">
              <form method="post" action="<?=base_url('hotel/hoteltype-add')?>">
                <div class="col-md-12 col-sm-9 col-xs-10">


				          <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="field-1">Hotel Type</label>
                      <div class="controls">
                        <input type="text" name="hotel_type" value="<?php echo set_value('hotel_type'); ?>" class="form-control" id="field-1">
                        <?=form_error('hotel_type', '<div class="error">', '</div>');?>
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
