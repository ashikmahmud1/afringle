<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Hotel") {
  redirect("admin/dashboard");
} ?>
<style>
label {
    font-weight: 600;
    display: inherit;
}
</style>

<link href="http://riversidenpr.com/assets/admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css" rel="stylesheet">

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
			<h1 class="page-title">Add New Service</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                  <form method="post" action="<?=base_url('hotel_service/add-service');?>" enctype="multipart/form-data">
 			<div class="col-md-12">

             <div class="form-group">
             <div class="col-md-3">
                 <label class="form-label" for="field-1">Title</label>
             </div>
             <div class="col-md-9">
               <select name="service_id" class="form-control m-bot15">
               <?php if(!empty($services)){
                  foreach($services as $service){?>
                          <option <?php echo set_select('service', $service['service_id']); ?> value="<?=$service['service_id']?>"><?=$service['title']?></option>
                <?php  }
                  }?>
                 </select>

                 <?=form_error('service_id', '<div class="error">', '</div>');?>
             </div>
             <div class="clearfix"></div>
             </div>

             <div class="form-group">
             <div class="col-md-3">
                 <label class="form-label" for="field-1">Description</label>
             </div>
             <div class="col-md-9">
                 <div class="controls">
                      <textarea class="form-control" name="description" cols="5" id="field-6"></textarea>
                      <?=form_error('description', '<div class="error">', '</div>');?>
                 </div>
             </div>
             <div class="clearfix"></div>
             </div>

             <div class="form-group">
             <div class="col-md-3">
                 <label class="form-label" for="field-1">Price</label>
             </div>
             <div class="col-md-9">
                 <div class="controls">
                     <input type="number" name="price" class="form-control" id="field-3" >
                     <?=form_error('price', '<div class="error">', '</div>');?>
                 </div>
             </div>
             <div class="clearfix"></div>
             </div>



             <div class="form-group">
             <div class="col-md-3">
                 <label class="form-label" for="field-1">Status</label>
             </div>
             <div class="col-md-9">
                 <div class="controls">
                     <input type="radio" name="status" value="Published" checked> Public
                     <input type="radio" name="status" value="Awaiting"> Private
                     <?=form_error('status', '<div class="error">', '</div>');?>
                 </div>
             </div>
             <div class="clearfix"></div>
             </div>

             <div class="form-group">
             <div class="col-md-3">
                 <label class="form-label" for="field-1">Tax Type</label>
             </div>


             <div class="col-md-9">
               <select name="tax_type" class="form-control m-bot15">
               <?php if(!empty($TaxType)){
     							foreach($TaxType as $list){?>
      						        <option <?php echo set_select('tax_type', $list['tax_id']); ?> value="<?=$list['tax_id']?>"><?=$list['tax_name'].' ('.$list['tax_percentage'].'%)'?></option>
     						<?php  }
     							}?>
                 </select>
                <?=form_error('tax_type', '<div class="error">', '</div>');?>
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

<script src="http://riversidenpr.com/assets/admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>
<script>
    $(function() {
        $('.action-destroy').on('click', function() {
            $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
        });
        // Live binding of buttons
        $(document).on('click', '.action-placement', function(e) {
            $('.action-placement').removeClass('active');
            $(this).addClass('active');
            $('.icp-opts').data('iconpicker').updatePlacement($(this).text());
            e.preventDefault();
            return false;
        });
        $('.action-create').on('click', function() {
            $('.icp-auto').iconpicker();

            $('.icp-dd').iconpicker({
                //title: 'Dropdown with picker',
                //component:'.btn > i'
            });

          }).trigger('click');


        // Events sample:
        // This event is only triggered when the actual input value is changed
        // by user interaction
        $('.icp').on('iconpickerSelected', function(e) {
            $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
                    e.iconpickerInstance.options.iconBaseClass + ' ' +
                    e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
        });
    });
</script>

</body>

</html>
