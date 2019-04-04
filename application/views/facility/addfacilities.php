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
			<h1 class="page-title">Add New Chemistry Test</h1>
      <p style="color: green;"><?=$this->session->flashdata('message');?></p>
			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
              <div class="row">
                  <form method="post" action="<?=base_url('Chemistry/Chemistry-submit');?>" >
                      <div class="col-md-12 col-sm-9 col-xs-10">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Main Question Title</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title'); ?>" placeholder="Enter Question Title" required/>
                                        <?=form_error('title', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <br>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Question - 1</label>
                                  <div class="controls">
                                    <input type="text" class="form-control" name="question1" id="question1" value="<?php echo set_value('question1'); ?>" placeholder="Enter Question - 1" required/>
                                    <?=form_error('question1', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Question - 2</label>
                                  <div class="controls">
                                    <input type="text" class="form-control" name="question2" id="question1" value="<?php echo set_value('question2'); ?>" placeholder="Enter Question - 2" required/>
                                      <?=form_error('question2', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="form-label" for="field-3">Question - 3</label>
                                  <div class="controls">
                                    <input type="text" class="form-control" name="question3" id="question3" value="<?php echo set_value('question3'); ?>" placeholder="Enter Question - 3" required/>
                                      <?=form_error('question3', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                          </div>

                          <div class="pull-right">
                              <button type="submit" class="btn btn-primary">Save Chemistry Question</button>
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



    function submitF(){
    	var title = $('#title').val();
    	var question1 = $('#question1').val();
    	var question2 = $('#question2').val();
    	var question3 = $('#question3').val();

    	if(title == ''){
    		$('.errorFN').html('<div class="error">The Facilitie Title field is required.</div>');
    	}else if(question1 == ''){
    		$('.errorFI').html('<div class="error">The Facilitie Icon field is required.</div>');
    	}else{

    		$.ajax({
    				dataType : "json",
    				type : "post",
    				data : { facilitie_name : title , facilitie_icon : question1 , type : 'Insert' },
    				url:"<?=base_url('facility/facilitie-ajax_submit');?>",
    				success:function(data)
    				{
    					if(data.status == 1){
    						 alert(data.message);
    						 window.location.replace(data.redirectURL);
    					}else{
    						alert(data.message);
    					}
    				}
    			});

    	}
    }
</script>

</body>

</html>
