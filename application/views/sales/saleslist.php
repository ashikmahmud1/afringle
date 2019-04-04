<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Admin") {
  redirect("admin/dashboard");
} ?>
<link href="<?= base_url('assets') ?>/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="<?= base_url('assets') ?>/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
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
  <!-- Main content -->
  <div class="main-content">
     <h1 class="page-title">Story List</h1>
     &nbsp;&nbsp; <?php $this->session->flashdata('message');?>

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

           <div class="panel-body">
             <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover dataTables-example" >
                 <thead>
                   <tr>
                         <th>id</th>
                         <th>Story Title</th>
                         <th>Story Details</th>
                          <th>Story Image</th>
                         <th>Created Date</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
                   <?php
               foreach($listofsales as $key=>$value){
                 //echo "<pre>";
                 //print_r($listofsales);
               ?>

                       <tr role="row" class="odd">
                           <td><?php echo $value['id'];?></td>
                           <td><?php echo $value['firstname'];?></td>
                           <td><?php echo $value['lastname'];?></td>
                           <td><?php echo $value['email'];?></td>
                           <td><?php echo $value['phone'];?></td>
                           <td>

                             <a  href="<?php echo base_url(); ?>sales/editsales?id=<?php echo $value['id'];?>"><i class="ui-tooltip fa fa-pencil info" style="font-size: 22px;margin-right: 15px;color: #3f51b5;" data-original-title="Edit"></i></a>
                            <a  onclick="return confirm('Are you sure remove this? #<?=$value['username']?>')" href="<?php echo base_url(); ?>/bo/Sales/removesalesperson?id=<?php echo $value['id'];?>">							<i class="ui-tooltip fa fa-trash-o" style="margin-right: 14px;color: red;font-size: 22px;" data-original-title="Delete"></i></a>

                            </td>

                       </tr>

                 <?php } ?>

                 </tbody>

               </table>
             </div>
           </div>
         </div>
       </div>
     </div>



   </div>
   <!-- /main content -->

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

<script src="<?= base_url('assets'); ?>/js/functions.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script>
	$(document).ready(function () {
		$('.dataTables-example').DataTable({
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0, ':visible' ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				'colvis'
			]
		});
	});
</script>
</body>

</html>
