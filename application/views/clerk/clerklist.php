<?php $this->load->view('inc/header'); ?>
<?php if ($this->session->userdata('is_logged_admin')['admin_role'] != "Hotel") {
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
     <h1 class="page-title">Clerk List</h1>
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
                     <th>First name</th>
                     <th>Last name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php if(!empty($ClerksList)){
                      foreach($ClerksList as $list):
                      ?>
                           <tr role="row" class="odd">
                               <td><?=$list['firstname'];?></td>
                               <td><?=$list['lastname'];?></td>
                               <td><?=$list['email'];?></td>
                               <td><?=$list['phone'];?></td>
                               <td style="text-align: center;">

                               <a  href="<?=base_url('clerk/edit-clerk?id='.$list['id']);?>"><i class="ui-tooltip fa fa-pencil info" style="font-size: 22px;margin-right: 15px;color: #3f51b5;" data-original-title="Edit"></i></a>
                               <a  onclick="return confirm('Are you sure remove this? #<?=$list['firstname'].' '.$list['lastname']?>')" href="<?=base_url('clerk/delete-clerk?id='.$list['id']);?>"><i class="ui-tooltip fa fa-trash-o" style="margin-right: 14px;color: red;font-size: 22px;" data-original-title="Delete"></i></a>
                               </td>
                           </tr>
                    <?php endforeach; } ?>
                 </tbody>
                 <tfoot>
                   <tr>
                     <th>First name</th>
                     <th>Last name</th>
                     <th>Email</th>
                     <th>Phone</th>
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
