<?php $this->load->view('inc/header'); ?>
<link href="<?= base_url('assests') ?>/css/plugins/datatables/jquery.dataTables.css" rel="stylesheet">
<link href="<?= base_url('assests') ?>/js/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">
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
     <h1 class="page-title">Room List</h1>
     &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

     <!-- Breadcrumb -->

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

           <div class="panel-body">
             <div class="table-responsive">
               <?php
            	$ci =&get_instance();
				$ci->load->model('Room_Model');

			?>
               <table class="table table-striped table-bordered table-hover dataTables-example" >
                 <thead>
                   <tr>
                       <th>Title</th>
                       <th>Type</th>
                        <th>Image</th>
                       <th>Person</th>
                       <th>Adult</th>
                       <th>Child</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
               <?php if(!empty($RoomsList)){
         foreach($RoomsList as $list):
         $room = $ci->Room_Model->GetRoomType($list['room_type']);
         ?>

                       <tr role="row" class="odd">
                           <td><?=$list['room_name'];?></td>
                           <td><?=$room['room_type_name'];?></td>
                           <td><img src="<?=base_url('upload/room/'.$list['room_main_image']);?>" style="height:75px; width:80px;"></td>
                           <td><?=$list['max_person'];?></td>
                           <td><?=$list['adult_price'];?></td>
                           <td><?=$list['child_price'];?></td>
                           <td style="text-transform:capitalize;">

             <?php
                           echo $list['status'].'<br>';
             if($list['status'] == 'awaiting'){
               echo '('.$list['start_date'].'-'.$list['end_date'].')';
             }
             ?>

                           </td>
                           <td style="text-align: center;">
                            <a  href="<?=base_url('room/edit-room?id='.$list['room_id']);?>"><i class="ui-tooltip fa fa-pencil info" style="font-size: 22px;margin-right: 15px;color: #3f51b5;" data-original-title="Edit"></i></a>
                           <a  onclick="return confirm('Are you sure remove this? #<?=$list['room_name']?>')" href="<?=base_url('room/delete-room?id='.$list['room_id']);?>"><i class="ui-tooltip fa fa-trash-o" style="margin-right: 14px;color: red;font-size: 22px;" data-original-title="Delete"></i></a>
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

<?php $this->load->view('inc/footer'); ?>

<!--Float Charts-->

<script src="<?= base_url('assests'); ?>/js/functions.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
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
