<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Admin") {
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
			<h1 class="page-title">Add New Room Type</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">


                  <form method="post" action="<?php echo base_url('event/event-edit'); ?>?id=<?php echo $EventData['event_id'] ?>" enctype="multipart/form-data">
                      <div class="col-md-12 col-sm-9 col-xs-10">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Event Name</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="event_name" id="name" value="<?php echo $EventData['event_name'] ?>" />
                                      <input type="hidden" name="event_id" id="name" value="<?php echo $EventData['event_id'] ?>" />
                                        <?=form_error('event_name', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>

                          <div class="clearfix"></div>


                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Event Price</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="event_price" id="name" value="<?php echo $EventData['event_price'] ?>" />
                                        <?=form_error('event_price', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Event Start Date</label>
                                  <div class="controls">
                                      <input type="text" name="event_start_date" class="form-control" value="<?php echo $EventData['event_start_date'] ?>">
                                        <?=form_error('event_start_date', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Event End Date</label>
                                  <div class="controls">
                                      <input type="text" name="event_end_date" class="form-control" value="<?php echo $EventData['event_end_date'] ?>">
                                        <?=form_error('event_end_date', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>



                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Event Locaction</label>
                                  <div class="controls">
                                      <input type="text" name="event_location" class="form-control" value="<?php echo $EventData['event_location'] ?>">
                                        <?=form_error('event_location', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>



                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Event Image</label>
                                  <div class="controls">
                                      <input type="file" name="event_image" class="form-control">
                                      <input type="hidden" name="oldevent_image" class="form-control" value="<?php echo $EventData['event_image'] ?>">

                                        <?=form_error('event_image', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Event Details</label>
                                  <div class="controls">
                                      <input type="text" name="event_details" class="form-control" value="<?php echo $EventData['event_details'] ?>">
                                        <?=form_error('event_details', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>



                         <div class="pull-right">
                              <button type="submit" class="btn btn-primary">Update</button>
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

<!--Load JQuery-->
<?php $this->load->view('inc/footer'); ?>

<!--Float Charts-->
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/functions.js"></script>

</body>

</html>
