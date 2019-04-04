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
			<h1 class="page-title">Add New Tax</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
              <div class="row">
                      <div class="col-md-12 col-sm-9 col-xs-10">



                        <form method="post" action="<?=base_url('tax/edit-tax?id='.$RowData['tax_id']);?>">
  			<div class="col-md-12">

              <div class="form-group">
              <div class="col-md-3">
                  <label class="form-label" for="field-1">Tax Name</label>

              </div>
              <div class="col-md-9">
                 <input type="text" name="tax_name" class="form-control" value="<?=$RowData['tax_name'];?>" id="field-3" >
                  <?=form_error('tax_name', '<div class="error">', '</div>');?>
              </div>
              <div class="clearfix"></div>
              </div>



              <div class="form-group">
              <div class="col-md-3">
                  <label class="form-label" for="field-1">Tax %</label>
              </div>
              <div class="col-md-9">
                  <div class="controls">
                      <input type="number" name="tax_percentage" value="<?=$RowData['tax_percentage'];?>"  class="form-control" id="field-3" >
                      <?=form_error('tax_percentage', '<div class="error">', '</div>');?>
                  </div>
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

<!--Float Charts-->
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/functions.js"></script>

</body>

</html>
