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
			<h1 class="page-title">Please add your membership plans (Only Fifth Number Membership Plan will be for exclusive members)</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <form method="post" action="<?php echo base_url('plan/plan-add'); ?>" enctype="multipart/form-data">
                        <div class="col-md-12 col-sm-9 col-xs-10">


                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Membership Plan Name</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="plan_name" id="name" value="" />
                                        <?=form_error('plan_name', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Duration (in days Like : 25)</label>
                                  <div class="controls">
                                      <input type="number" min="1" max="12" class="form-control" name="plan_time" id="name" value="" />
                                        <?=form_error('plan_time', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Membership Plan Icon</label>
                                  <div class="controls">
                                      <input type="file" class="form-control" name="plan_image" id="name" value="" />
                                        <?=form_error('plan_image', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Membership Plan Price (in USD only digit like: 250)</label>
                                  <div class="controls">
                                      <input type="number" class="form-control" name="plan_price" id="name" value="" />
                                        <?=form_error('plan_price', '<div class="error">', '</div>');?>
                                  </div>
                              </div>


                              <div class="form-group">
                                  <label class="form-label" for="field-1">Membership Plan Description</label>
                                  <div class="controls">
                                    <textarea name="plan_description" class="form-control" rows="8" cols="80"></textarea>
                                    <?=form_error('plan_description', '<div class="error">', '</div>');?>
                                  </div>
                              </div>



                              <div class="col-md-12">
                                <label class="form-label" for="field-1">What setting you want to allow to your users in this plan</label>


                      <div class="col-md-12">



                        <div class="checkbox checkbox-replace checkbox-success">
                          <input type="checkbox" id="checkbox16" name="plan_services[]" value="first_name">
                          <label for="checkbox16">First Name</label>
                        </div>
                        <div class="checkbox checkbox-replace checkbox-success">
                          <input type="checkbox" id="checkbox17" name="plan_services[]" value="last_name">
                          <label for="checkbox17">Last Name</label>
                        </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox1" name="plan_services[]" value="username">
                              <label for="checkbox1">Username</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox2" name="plan_services[]" value="email">
                              <label for="checkbox2">Email</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox3" name="plan_services[]" value="contact">
                              <label for="checkbox3">Phone</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox4" name="plan_services[]" value="country">
                              <label for="checkbox4">Country</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox5" name="plan_services[]" value="isHair">
                              <label for="checkbox5">Hair Color</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox6" name="plan_services[]" value="profession">
                              <label for="checkbox6">Profession</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox7" name="plan_services[]" value="education">
                              <label for="checkbox7">Education</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox8" name="plan_services[]" value="pets">
                              <label for="checkbox8">Pets</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox9" name="plan_services[]" value="personality">
                              <label for="checkbox9">Personality</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox10" name="plan_services[]" value="language">
                              <label for="checkbox10">Language</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox11" name="plan_services[]" value="height">
                              <label for="checkbox11">Height</label>
                            </div>
                            <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox12" name="plan_services[]" value="longest_relationship">
                              <label for="checkbox12">Relationship</label>
                            </div>

                             <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox13" name="plan_services[]" value="imageData">
                              <label for="checkbox13">Profile Pic</label>
                            </div>

                             <div class="checkbox checkbox-replace checkbox-success">
                              <input type="checkbox" id="checkbox14" name="plan_services[]" value="image_gallery">
                              <label for="checkbox14">Image Gallery</label>
                            </div>




                      </div>
                    </div>
                  </div>


                           <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Make New Membership</button>
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
