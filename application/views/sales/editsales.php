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
			<h1 class="page-title">Add New Sales</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>
			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">

                  <?php foreach($singlesalespersonId as $key => $value ){
    //print_r($value);
?>

  <form class="" method="post" enctype="multipart/form-data" action="<?php echo base_url('bo/Sales/updatesalesperson_save'); ?>">

<div class="form-group">
  <label for="name" class="cols-sm-2 control-label">First Name</label>
  <div class="cols-sm-10">
    <div class="input-group">
      <input type="text" class="form-control" name="f_name" id="name" value="<?php echo $value['firstname']; ?>" placeholder="Enter First Name" required/>
      <input type="hidden" name="personid" value="<?php echo $value['id']; ?>">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="name" class="cols-sm-2 control-label">Last Name</label>
  <div class="cols-sm-10">
    <div class="input-group">
      <input type="text" class="form-control" name="l_name" id="l_name" value="<?php echo $value['lastname']; ?>"  placeholder="Enter Last Name" required/>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="name" class="cols-sm-2 control-label">Phone Number</label>
  <div class="cols-sm-10">
    <div class="input-group">
      <input type="number" class="form-control" name="phone_number" id="phone_number" value="<?php echo $value['phone']; ?>" placeholder="Phone Number" required/>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="name" class="cols-sm-2 control-label">User ID</label>
  <div class="cols-sm-10">
    <div class="input-group">
      <input type="number" class="form-control" name="user_id" id="user_id" value="<?php echo $value['id']; ?>" placeholder="User ID" required/>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="email" class="cols-sm-2 control-label">Your Email</label>
  <div class="cols-sm-10">
    <div class="input-group">
      <input type="email" class="form-control" name="email_id" id="email" value="<?php echo $value['email']; ?>" placeholder="Enter your Email" required readonly/>
    </div>
  </div>
</div>



<div class="form-group">
  <label for="name" class="cols-sm-2 control-label">Address</label>
  <div class="cols-sm-10">
      <textarea name="address" placeholder="Address" class="form-control"  rows="4" ><?php echo $value['address']; ?></textarea>

  </div>
</div>


<div class="form-group">
  <label for="name" class="cols-sm-2 control-label">Attach Resume</label>
  <div class="cols-sm-10">
  <input type="file" name="attach_resume" class="form-control">

  </div>
</div>



<div class="form-group ">
<input type="submit" name="submit"  class="btn btn-primary btn-lg btn-block login-button" value="Submit Update">

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
