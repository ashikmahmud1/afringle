<?php $this->load->view('inc/header'); ?>
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
    <div class="col-xs-12" style="text-align:center">	  <img src="<?= base_url('upload') ?>/other/access.jpg">

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
