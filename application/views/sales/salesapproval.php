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

<div class="page-container">

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
     <h1 class="page-title">Pending Sales List</h1>
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
                         <th>id</th>
                         <th>first name</th>
                         <th>last name</th>
                          <th>email</th>
                         <th>phone</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 <tbody>
              <?php
               foreach($listofsales as $key=>$value){
               ?>

                       <tr role="row" class="odd">
                           <td><?php echo $value['id'];?></td>
                           <td><?php echo $value['firstname'];?></td>
                           <td><?php echo $value['lastname'];?></td>
                           <td><?php echo $value['email'];?></td>
                           <td><?php echo $value['phone'];?></td>
                           <td>
                             <a onclick="return confirm('Are you sure Approve this? #<?php echo $value['username']?>')" href="<?php echo base_url(); ?>sales/approvesales?id=<?php echo $value['id'];?>">Approve</a>
                             &nbsp; &nbsp; &nbsp;
                            <a  onclick="return confirm('Are you sure remove this? #<?php echo $value['username']?>')" href="<?php echo base_url(); ?>/bo/Sales/removesalesperson?id=<?php echo $value['id'];?>"><i class="ui-tooltip fa fa-trash-o" style="margin-right: 14px;color: red;font-size: 22px;" data-original-title="Delete"></i></a>
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


	  </div>

  </div>

</div>

<?php $this->load->view('inc/footer'); ?>


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
