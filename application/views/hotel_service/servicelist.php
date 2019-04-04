<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Hotel") {
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
     <h1 class="page-title">Service List</h1>
     &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

     <!-- Breadcrumb -->

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

           <div class="panel-body">
             <div class="table-responsive">
               <?php
            	$ci =&get_instance();
				$ci->load->model('Tax_Model');

			?>

               <table class="table table-striped table-bordered table-hover dataTables-example" >
                 <thead>
                   <tr>
                          <th>Title</th>
                          <th>Description</th>
                           <th>Price</th>
                           <th>Status</th>
                           <th>Tax Type</th>
                           <th>Create Date</th>
                          <th>Action</th>
                      </tr>
                 </thead>
                 <tbody>
                   <?php if(!empty($ListServices)){
   					foreach($ListServices as $list):
   					$tax = $ci->Tax_Model->GetTaxName($list['tax_type']);
   					?>

                           <tr role="row" class="gradeA">
                               <td><?=$list['title'];?></td>
                               <td><?=$list['description'];?></td>
                               <td><?=$list['price'];?></td>
                               <td><?=$list['status'];?></td>
                               <td><?=$tax['tax_name'].' ('.$tax['tax_percentage'].'%)';?></td>

                               <td><?=$list['created_date'];?></td>
                                <td style="text-align: center;">
                                <a  href="<?=base_url('hotel_service/edit-service?id='.$list['id']);?>"><i class="ui-tooltip fa fa-pencil info" style="font-size: 22px;margin-right: 15px;color: #3f51b5;" data-original-title="Edit"></i></a>
                               <a  onclick="return confirm('Are you sure remove this? #<?=$list['title'];?>')" href="<?=base_url('hotel_service/delete-service?id='.$list['id']);?>"><i class="ui-tooltip fa fa-trash-o" style="margin-right: 14px;color: red;font-size: 22px;" data-original-title="Delete"></i></a>
                               </td>
                           </tr>


                     <?php endforeach; } ?>

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
