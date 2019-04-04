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
			<h1 class="page-title">Please send email to Exclusive Member</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                  <form action="<?=base_url('send-email-to');?>" method="post">

 			                <div class="col-md-12">
                         <div class="form-group">
                           <div class="col-md-3">
                               <label class="form-label" for="field-1">Member</label>
                           </div>
                           <div class="col-md-9">
                             <select class="form-control" class="" name="sendmailto">
                               <?php foreach ($ExclusiveMember as $member) { ?>
                               <option value="<?php echo $member['email'] ?>"><?php echo $member['first_name'].' '.$member['last_name']; ?></option>
                            <?php } ?>

                             </select>
                               <div class="errorFN"></div>
                           </div>
                           <div class="clearfix"></div>
                         </div>

                         <div class="form-group">
                           <div class="col-md-3">
                               <label class="form-label" for="field-1">Subject</label>
                           </div>
                           <div class="col-md-9">
                              <input class="form-control" type="text" name="subject" value="">
                               <div class="errorFN"></div>
                           </div>
                           <div class="clearfix"></div>
                         </div>

                         <div class="form-group">
                           <div class="col-md-3">
                          <label class="form-label" for="field-1">Message</label>
                           </div>
                           <div class="col-md-9">
                           <textarea class="form-control" name="message"></textarea>
                          <div class="errorFN"></div>
                           </div>
                           <div class="clearfix"></div>
                         </div>

                         <div class="form-group">
                           <div class="col-md-3">
                               <label class="form-label" for="field-1">Attachment</label>
                           </div>
                           <div class="col-md-9">
                            <input class="form-control" type="file" name="attachment" value="">
                               <div class="errorFN"></div>
                           </div>
                           <div class="clearfix"></div>
                         </div>
                      </div>
                     <div class="pull-right">
                       <button type="submit" class="btn btn-primary">Send</button>
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
<script src="http://riversidenpr.com/assets/admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.js"></script>

</body>

</html>
