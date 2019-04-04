<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Admin") {
  redirect("admin/dashboard");
} ?>
<link href="<?= base_url('assets'); ?>/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="<?= base_url('assets'); ?>/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
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
     <h1 class="page-title">Order History List</h1>
     &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

     <!-- Breadcrumb -->

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

           <div class="panel-body">
             <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover dataTables-example" >
                 <thead>
                   <tr>
                         <th>Order User Id</th>
                         <th>Order Transsection Number Id</th>
                         <th>Order Status</th>
                         <th>Order Plan Price</th>
                         <th>Order Date</th>
                         <th>Order Type</th>
                         <th>Order Json</th>

                    </tr>
                 </thead>
                 <tbody>
                    <?php if(!empty($ListOfOrderHistory)){


                    foreach($ListOfOrderHistory as $list):
                    ?>

                         <tr role="row" class="gradeA">
                             <td><?=$list['order_user_id'];?></td>
                             <td><?=$list['order_transsection_number_id'];?></td>
                             <td><?=$list['order_status'];?></td>
                             <td><?=$list['order_plan_price'];?></td>
                             <td><?=$list['order_date'];?></td>
                             <td><?=$list['order_type'];?></td>
                             <td><?=$list['event_order_json'];?></td>
                         </tr>


                   <?php  endforeach; }  ?>

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
