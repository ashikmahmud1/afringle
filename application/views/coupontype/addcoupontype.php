<?php $this->load->view('inc/header'); ?>
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
			<h1 class="page-title">Add Coupon Type</h1>
        <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
              <div class="row">
                  <div class="col-md-12 col-sm-9 col-xs-10">
                    <form method="post" action="<?=base_url('couponcode/couponcode-add')?>">
              			<div class="col-md-12">

                          <div class="form-group">
                          <div class="col-md-3">
                              <label class="form-label" for="field-1">Coupon Name</label>
                          </div>
                          <div class="col-md-9">
                             <input type="text" name="coupon_name" class="form-control" value="<?php echo set_value('coupon_name'); ?>" id="field-3">
                             <?=form_error('coupon_name', '<div class="error">', '</div>');?>
                          </div>
                          <div class="clearfix"></div>
                          </div>
                           </div>

                          <div class="pull-right">
                          <button type="submit" class="btn btn-primary">Submit</button>
                          </div>

                          </form>

                      </div>
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

</body>

</html>
