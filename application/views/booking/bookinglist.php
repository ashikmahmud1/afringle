<?php $this->load->view('inc/header'); ?>
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
     <h1 class="page-title">Booking List</h1>
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
                     <th>BookingId</th>
                     <th>Client Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Status</th>
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                 $ci =&get_instance();
                 $ci->load->model('Booking_model');

                   if(!empty($BookingList)){

                        foreach($BookingList as $list):

                          $client = $ci->Booking_model->GetClientDetail($list['client_id']);


                        ?>
                                   <?php
                       $datacode = $list['booking_id'] ;


                       ?>
                                   <tr role="row" class="odd">
                                     <td><?=$list['booking_id'];?></td>
                                     <td><?=$client[0]['first_name']." ".$client[0]['last_name'];?></td>
                                     <td><?=$list['client_email'];?></td>
                                     <td><?=$client[0]['phone_number'];?></td>
                                     <td><?=$list['booking_start_date'];?></td>
                                     <td><?=$list['booking_end_date'];?></td>
                                     <td><?php
                              if($list['status'] == 1){

                                if( strtotime($list['booking_end_date']) < strtotime(date('Y-m-d')) ){
                                  echo '<span class="label label-success">Complete</span>';
                                }else{
                                  echo '<span class="label label-info">Running</span>';
                                }

                              }else if($list['status'] == 0){
                                echo '<span class="label label-warning">Cancle</span>';
                              }
                              ?></td>
                                     <td>

                                      <button type="submit" class="btn btn-success" onClick="mybookingdata('<?=$list['booking_id'];?>')"><i class="fa fa-eye"></i></button></td>
                                   </tr>
                                   <?php



                        endforeach;



                      }

                        ?>
                 </tbody>
                 <tfoot>
                   <tr>
                     <th>BookingId</th>
                     <th>Client Name</th>
                     <th>Email</th>
                     <th>Mobile</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Status</th>
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



<!-- modal Start -->
<!-- modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2" style=" color: #fff; font-weight: 600; text-transform: uppercase; ">Full Booking Data</h4>
      </div>
      <div class="modal-body" id="modaldata">


      </div>



    </div>
    <!-- modal-content -->
  </div>
  <!-- modal-dialog -->
</div>
<!-- modal -->

<!-- modal end -->

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


<style>
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 35%;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}

	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}


/*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}

	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}



	.modal-header {
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    min-height: 60px;
    background: #4CAF50;
}

</style>
<script>
function mybookingdata(bookingid)
{
   $.ajax({
 					type : "post",
					data : { id : bookingid },
					url:"<?=base_url('booking/booking-view');?>",
					success:function(data)
					{
 						$('#myModal2').modal('show');
						$('#modaldata').html(data);

					}
				});

}

</script>
</body>

</html>
