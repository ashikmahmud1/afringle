<?php $this->load->view('inc/header'); ?>
<style>
label {
    font-weight: 600;
    display: inherit;
}
.daterangepicker {
    color: #984eff !important;
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
			<h1 class="page-title">Add Coupon</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
              <div class="row">
                            <div class="col-xs-12">
                             <form method="post" action="<?=base_url('coupon/coupon-add')?>">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="col-md-3">
                                      <label class="form-label" for="field-1">Coupon Type Name</label>
                                    </div>
                                    <div class="col-md-9">
                                      <select name="type" class="form-control m-bot15">
                                        <?php if(!empty($CopuonType)){
                             foreach($CopuonType as $list){?>
                                     <option <?php echo set_select('type', $list['coupon_name']); ?> value="<?=$list['coupon_name']?>"><?=$list['coupon_name']?></option>
                           <?php  }
                             }?>
						                          </select>
                                      <?=form_error('type', '<div class="error">', '</div>');?>
                                    </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-md-3">
                                      <label class="form-label" for="field-1">Coupon Code</label>
                                    </div>
                                    <div class="col-md-9">
                                      <input type="text" class="form-control" name="code" value="<?=set_value('code')?>"  id="field-1" >
                                       <?=form_error('code', '<div class="error">', '</div>');?>
                                    </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-md-3">
                                      <label class="form-label" for="field-1">Coupon Discount %</label>
                                    </div>
                                    <div class="col-md-9">
                                      <input type="number" class="form-control" name="discount" value="<?=set_value('discount')?>"  id="field-1" >
                                       <?=form_error('discount', '<div class="error">', '</div>');?>
                                    </div>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-md-3">
                                      <label class="form-label" for="field-1">Start/End Date</label>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="controls">
                                       <input name="start_end_dates" type="text" id="daterangepicker" class="form-control daterange" data-format="MM-DD-YYYY" data-start-date="<?=date('m-d-Y');?>" data-end-date="<?=date('m-d-Y', strtotime("+30 days"));?>" data-separator=",">
                                      <?=form_error('start_end_dates', '<div class="error">', '</div>');?>
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

<?php $this->load->view('inc/footer'); ?>


<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<script>
$('#daterangepicker').daterangepicker();

</script>
</body>

</html>
