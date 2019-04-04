<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Admin" ) {
  redirect("admin/dashboard");
} ?>
<link href="<?=base_url('assets')?>/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="<?=base_url('assets')?>/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
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
     <h1 class="page-title">User Pending List</h1>
     <p style="color: green;"><?=$this->session->flashdata('message');?></p>
     <!-- Breadcrumb -->

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

           <div class="panel-body">
             <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover dataTables-example" >
                 <thead>
                   <tr>
                       <th>User Name</th>
                       <th>User Address</th>
                       <th>User Phone</th>
                       <th>User Enail</th>
                       <th>User Plan</th>
                       <th>User TRibe</th>
                       <th>User Image</th>
                       <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                   foreach($HotelsList as $list){
                     ?>

                           <tr role="row" class="odd">
                               <td><?=$list['hotel_name'];?></td>
                               <td><?=$list['hotel_address'];?></td>
                               <td><?=$list['hotel_contact'];?></td>
                               <td><?=$list['description'];?></td>
                               <td><?=$list['hotel_type'];?></td>
                               <td><?=$list['city'];?>, <?=$list['state'];?>, <?=$list['country'];?>, <?=$list['zipcode'];?></td>
                               <td><?=$list['images'];?></td>
                               <td> <a href="<?php echo base_url(); ?>bo/Hotel/approveHotel?h_id=<?php echo $list['hotel_id'];?>">Approve</a>
                                  / <a href="<?php echo base_url(); ?>hotel/update-hotel?h_id=<?php echo $list['hotel_id'];?>">edit</a>
                                  / <a href="<?php echo base_url(); ?>bo/Hotel/removehotel?h_id=<?php echo $list['hotel_id'];?>">delete</a></td>
                           </tr>


                     <?php }  ?>

                 </tbody>
                 <tfoot>
                   <tr>
                       <th>User Name</th>
                       <th>User Address</th>
                       <th>User Phone</th>
                       <th>User Enail</th>
                       <th>User Plan</th>
                       <th>User TRibe</th>
                       <th>User Image</th>
                       <th>Action</th>
                   </tr>
                 </tfoot>
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

<script src="<?=base_url('assets')?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/jszip.min.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/pdfmake.min.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/vfs_fonts.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?=base_url('assets')?>/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
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
