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
			<h1 class="page-title">Please edit your membership plan</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">


                  <form method="post" action="<?php echo base_url('plan/plan-edit'); ?>" enctype="multipart/form-data">
                      <div class="col-md-12 col-sm-9 col-xs-10">


                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="field-1">Membership Plan Name</label>
                                <div class="controls">
                                    <input type="text" class="form-control" name="plan_name" id="name" value="<?php echo $UpdateData['plan_name']; ?>" />
                                    <input type="hidden" class="form-control" name="id" id="name" value="<?php echo $UpdateData['id']; ?>" />
                                      <?=form_error('plan_name', '<div class="error">', '</div>');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-1">Duration ( in days like : 30)</label>
                                <div class="controls">
                                    <input type="number" min="1" max="12" class="form-control" name="plan_time" id="name" value="<?php echo $UpdateData['plan_time']; ?>" />
                                      <?=form_error('plan_time', '<div class="error">', '</div>');?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="field-1">Membership Plan Icon</label>
                                <div class="controls">
                                    <input type="file" class="form-control" name="plan_image" id="name" value="" />
                                    <input type="hidden" class="form-control" name="oldplan_image" value="<?php echo $UpdateData['plan_image']; ?>" />
                                      <?=form_error('plan_image', '<div class="error">', '</div>');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-1">Uploaded Icon</label>
                                <div class="controls">
                                    <img src="<?php echo $UpdateData['plan_image']; ?>" >
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="form-label" for="field-1">Membership Plan Price (Only in digit like 200)</label>
                                <div class="controls">
                                    <input type="number" class="form-control" name="plan_price" id="name" value="<?php echo $UpdateData['plan_price']; ?>" />
                                      <?=form_error('plan_price', '<div class="error">', '</div>');?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="field-1">Membership Plan Description</label>
                                <div class="controls">
                                  <textarea name="plan_description" rows="8" cols="80" class="form-control"><?php echo $UpdateData['plan_description']; ?></textarea>
                                  <?=form_error('plan_description', '<div class="error">', '</div>');?>
                                </div>
                            </div>



                            <div class="col-md-12">
                              <label class="form-label" for="field-1">What setting you want to allow to your users</label>


                    <div class="col-md-12">


                      <?php
                      $data = str_replace('"',"",$UpdateData['plan_services']);
                      $services = explode(",",$data);
                      ?>


                      <div class="checkbox checkbox-replace checkbox-success">
                        <input type="checkbox" id="checkbox16" name="plan_services[]"  value="first_name" <?php if (in_array("first_name", $services)) { echo "checked"; } else { } ?>>
                        <label for="checkbox16">First Name</label>
                      </div>
                      <div class="checkbox checkbox-replace checkbox-success">
                        <input type="checkbox" id="checkbox17" name="plan_services[]" value="last_name" <?php if (in_array("last_name", $services)) { echo "checked"; } else { } ?>>
                        <label for="checkbox17">Last Name</label>
                      </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox1" name="plan_services[]" value="username" <?php if (in_array("username", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox1">Username</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox2" name="plan_services[]" value="email" <?php if (in_array("email", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox2">Email</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox3" name="plan_services[]" value="contact" <?php if (in_array("contact", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox3">Phone</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox4" name="plan_services[]" value="country" <?php if (in_array("country", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox4">Country</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox5" name="plan_services[]" value="isHair" <?php if (in_array("isHair", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox5">Hair Color</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox6" name="plan_services[]" value="profession" <?php if (in_array("profession", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox6">Profession</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox7" name="plan_services[]" value="education" <?php if (in_array("education", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox7">Education</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox8" name="plan_services[]" value="pets" <?php if (in_array("pets", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox8">Pets</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox9" name="plan_services[]" value="personality" <?php if (in_array("personality", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox9">Personality</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox10" name="plan_services[]" value="language" <?php if (in_array("language", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox10">Language</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox11" name="plan_services[]" value="height" <?php if (in_array("height", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox11">Height</label>
                          </div>
                          <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox12" name="plan_services[]" value="longest_relationship" <?php if (in_array("longest_relationship", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox12">Relationship</label>
                          </div>


                            <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox13" name="plan_services[]" value="imageData" <?php if (in_array("imageData", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox13">Profile Pic</label>
                          </div>

                            <div class="checkbox checkbox-replace checkbox-success">
                            <input type="checkbox" id="checkbox14" name="plan_services[]" value="image_gallery" <?php if (in_array("image_gallery", $services)) { echo "checked"; } else { } ?>>
                            <label for="checkbox14">Image gallery</label>
                          </div>




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
