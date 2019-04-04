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
			<h1 class="page-title">Please add your all Education  here </h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <form method="post" action="<?php echo base_url('education/education-add'); ?>">
                        <div class="col-md-12 col-sm-9 col-xs-10">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Put your Education</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="name" id="name" value="" />

                                        <?=form_error('name', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>



                           <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Save Education</button>
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
