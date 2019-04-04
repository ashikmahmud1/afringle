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
                  <form method="post" action="<?=base_url('roomtype/edit-room-type?id='.$RoomTypeData['room_type_id']);?>" enctype="multipart/form-data">
  			<div class="col-md-12">

              <div class="form-group">
              <div class="col-md-3">
                  <label class="form-label" for="field-1">Room Type</label>
              </div>
              <div class="col-md-9">
                  <input type="text" name="room_type_name" value="<?=$RoomTypeData['room_type_name'];?>" required class="form-control m-bot15">
                   <?=form_error('room_type_name', '<div class="error">', '</div>');?>
              </div>
              <div class="clearfix"></div>
              </div>



              <div class="form-group">
              <div class="col-md-3">
                  <label class="form-label" for="field-1">Room Main Image</label>
              </div>
              <div class="col-md-9">
                  <div class="controls">
                      <input name="room_type_file" type="file">
                      <?php //echo form_error('room_type_file', '<div class="error">', '</div>');?>
                      <?=$this->session->flashdata('messageError');?>
                  </div>
              </div>
              </div>

             <div class="form-group">
              <div class="col-md-3">
                  <label class="form-label" for="field-1">Room Old Image</label>
              </div>
              <div class="col-md-9">
                  <div class="controls">

                  <img src="<?=base_url('uploads/roomType/'.$RoomTypeData['room_type_file']);?>" style="height:90px; width:80px;">
                  </div>

              </div>

              </div>
              <div class="clearfix"></div>
              </div>



              </div>

              <div class="pull-right">
              <button type="submit" class="btn btn-primary">Update</button>
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
