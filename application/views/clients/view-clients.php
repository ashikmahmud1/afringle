<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role == "Hotel" || $role == "Clerk" || $role == "Manager" ) {
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
     <h1 class="page-title">Client Info</h1>

     <!-- Breadcrumb -->
<?php
$sid = $this->session->userdata('is_logged_admin');
$user_id = $sid['admin_id'];
foreach($Clientinfo as $key=>$value){ ?>

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

   <div class="panel-body">
     <div class="col-sm-5 col-md-5" style=" margin-bottom: 50px; ">
      <div class="contact-module">
        <div class="col-sm-3 col-md-3">

          <?php if($value['image']){ ?>
          <img src="<?php echo base_url('upload/profile'); ?>/<?php echo $value['image']; ?>" class="img-responsive">
          <?php }else{ ?>
          <img src="<?php echo base_url('upload/profile'); ?>/default-avatar.gif" class="img-responsive">
          <?php } ?>

        </div>
        <div class="col-sm-9 col-md-9">
          <div class="profile-modulehead">
            <div class="profile-moduleCance2">
              <a href="#SoftP1" data-toggle="collapse" aria-expanded="true" aria-controls="collapseExample" class="">
              <input class="form-control columnData" id="usr" value="<?php echo $value['username']; ?>" name="f_name" placeholder="<?php echo $value['username']; ?>" type="text">
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="listdrop">
        <div class="panel panel-flat aboutcont">

          <div class="panel-body">
            <form method="post" action="<?php echo base_url('bo/Clients/UpdateClient'); ?>" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label>First Name</label>
                  </div>
                  <div class="col-sm-8">
                    <input class="form-control columnData" name="firstname" id="Name" value="<?php echo $value['firstname']; ?>" placeholder="<?php echo $value['firstname']; ?>" type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label>Last Name</label>
                  </div>
                  <div class="col-sm-8">
                    <input class="form-control columnData"  id="Name" value="<?php echo $value['lastname']; ?>" name="lastname" placeholder="<?php echo $value['lastname']; ?>" type="text">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label>Email</label>
                  </div>
                  <div class="col-sm-8">
                    <input readonly class="form-control columnData" id="Email" value="<?php echo $value['email']; ?>" name="email" placeholder="<?php echo $value['email']; ?>" type="Email">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label>Contact Number</label>
                  </div>
                  <div class="col-sm-8">
                    <input class="form-control columnData" id="Name" value="<?php echo $value['phone']; ?>" name="phone" placeholder="<?php echo $value['phone']; ?>" type="text">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label>Address</label>
                  </div>
                  <div class="col-sm-8">
                    <input class="form-control columnData" id="Name" value="<?php echo $value['address']; ?>" name="address" placeholder="<?php echo $value['address']; ?>" type="text">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <label>About</label>
                  </div>
                  <div class="col-sm-8">
                    <textarea class="form-control columnData" name="txtComments" id="Name" placeholder="Client Details Here"><?php echo $value['details']; ?></textarea>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="form-group">
                  <div class="col-sm-4">
                    <input type="submit" class="btn btn-default" name="submit" value="Update" />
                  </div>

                </div>
              </div>

            </form>
          </div>
        </div>



    </div>
  </div>



  <div class="col-sm-7 col-md-7">
      <div class="amineshtabbableas">
  <div class="amineshpanelbody">
    <div class="tabbable">
<p style="color: green;"><?=$this->session->flashdata('message');?></p>

<a target="_blank" href="#">View Track Data Manager</a>
&nbsp;&nbsp;
<a target="_blank" href="#">View Track Data Employee</a>


      <ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component nav-justified" style=" background: #545c5f; ">
        <li class=""><a href="#newnote" data-toggle="tab" aria-expanded="false">
          <h5 class="rightsidetab" style=" font-size: 12px; font-weight: 600; "><i style=" padding-right: 5px; font-size: 12px; " class=" icon-notebook"></i>NOTE</h5>
          </a></li>
      </ul>


      <div class="tab-content">
        <div class="tab-pane active" id="newnote">
          <!-- CKEditor default -->
          <div class="panel panel-flat">
            <div class="panel-body" style="padding: 0px !important">


              <form id="note" action="<?php echo base_url('bo/Clients/UpdateNotes'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $value['id']; ?>" name="client_id" />
                <input type="hidden" value="<?php echo $user_id; ?>" name="sales_id" />
                <textarea class="form-control columnData" name="txtMessage" id="Name" placeholder="Add task Here"></textarea>
                <div class="text-left" style=" padding: 10px; ">
                  <button type="submit" class="btn bg-green-400 summernoteBTN">Save Note <i class="icon-arrow-right14 position-right"></i></button>
                  <button type="button" class="btn bg-danger-400">Discard <i class="icon-arrow-right14 position-right"></i></button>
                </div>
              </form>

              <ul class="notesList">
                <?php

                foreach($Clientnotes as $notes){ ?>
                <li> <?php echo $notes['notes_text']; ?></li>
              <?php } ?>
              </ul>

            </div>
          </div>
          <!-- /CKEditor default -->
        </div>


<div class="timeline timeline-left content-group latest_note" style="width:100%">


</div>

      </div>





    </div>
  </div>
  <!-- Timeline -->
  <div class="timeline timeline-left content-group latest_note" style="width:100%">

    <div class="timeline-container" id="latest_note_5">



	 </div>

  </div>

</div></div>


           </div>

         </div>
       </div>
     </div>

<?php } ?>

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
