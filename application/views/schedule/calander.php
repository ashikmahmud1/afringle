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
			<h1 class="page-title">Calander</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <h1>Coming Soon</h1>
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
