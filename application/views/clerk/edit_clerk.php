<?php $this->load->view('inc/header'); ?>
<?php if ($this->session->userdata('is_logged_admin')['admin_role'] != "Hotel") {
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
<?php include('sidebar.php'); ?>
<?php $this->load->view('inc/sidebar'); ?>
  <!-- /page sidebar -->

  <!-- Main container -->
  <div class="main-container">

	<!-- Main header -->
	<?php $this->load->view('inc/topnav'); ?>
	<!-- /main header -->

	<!-- Main content -->
		<div class="main-content">
			<h1 class="page-title">Edit Clerk</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
              <div class="row">
                <form method="post" action="<?=base_url('clerk/edit-clerk?id='.$ManagerData['id']);?>">
                  <div class="col-md-12 col-sm-9 col-xs-10">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-1">First Name</label>
                        <div class="controls">
                          <input type="text" name="f_name"  value="<?=$ManagerData['firstname']?>"class="form-control" id="field-1" required>
                          <?=form_error('f_name', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="field-1">Last Name</label>
                        <div class="controls">
                          <input type="text" name="l_name" value="<?=$ManagerData['lastname']?>" class="form-control" id="field-1" required>
                          <?=form_error('f_name', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Email</label>
                        <div class="controls">
                          <input type="email" disabled name="email" value="<?=$ManagerData['email']?>" class="form-control" id="field-3" >
                          <?=form_error('email', '<div class="error">', '</div>');?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="field-3">Phone</label>
                        <div class="controls">
                          <input type="number"  name="mobile" value="<?=$ManagerData['phone']?>" class="form-control" id="field-3" required>
                          <?=form_error('mobile', '<div class="error">', '</div>');?>
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

<?php $this->load->view('inc/footer'); ?>

</body>

</html>
