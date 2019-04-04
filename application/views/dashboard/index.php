<?php $this->load->view('inc/header'); ?>

<script src="http://portfolio.madehuge.com/animesh/assets/js/jquery.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/bootstrap.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/blockui-master/jquery-ui.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--Float Charts-->
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/flot/jquery.flot.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="http://portfolio.madehuge.com/animesh/assets/js/functions.js"></script>



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
		<?php if( $this->session->userdata['is_logged_admin']['admin_role']  == "Admin") {  ?>


		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">Total Approved User</div>

					</div>
					<!-- panel body -->
					<div class="panel-body" style="text-align: center;">
						<div class="stack-order">
							<h1 class="no-margins"><?php echo count($alluserslist); ?></h1>
						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">Total Story</div>

					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order"  style="text-align: center;">
							<h1 class="no-margins"><?php echo count($ListStory); ?></h1>


						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">Total Tribe</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order"  style="text-align: center;">
							<h1 class="no-margins"><?php echo count($ListService); ?></h1>
						</div>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel minimal panel-default">
					<div class="panel-heading clearfix">
						<div class="panel-title">User This Month</div>
					</div>
					<!-- panel body -->
					<div class="panel-body">
						<div class="stack-order"  style="text-align: center;">
							<h1 class="no-margins"><?php echo count($monthUsersList); ?></h1>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2>New Pending User</h2>
						<ul class="feed-item-list removeable-list">

              <?php foreach($pendingUsersList as $list){ ?>

							<li>
								<div class="feed-element">
									<div class="feed-title"><?php echo $list['username']; ?></div>
								</div>
								<div class="feed-footer" style="float: left;">
      <a  class="btn btn-sm btn-primary" href="<?=base_url('bo/User/pendingapproveUser?id='.$list['id']);?>">APPROVE</a>
      <a  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal<?php echo $list['id']; ?>" href="#">VIEW</a>

								</div>

							</li>
            <?php }  ?>


						</ul>
					</div>
				</div>
			</div>

      <div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2>New Events</h2>
						<ul class="feed-item-list removeable-list">


<?php
$i = 1;
foreach($EventList as $list){
if ($i <= 5) {
?>
							<li>
								<div class="feed-element">
									<div class="feed-title"><?php echo $list['event_name']; ?></div>
								</div>
								<div class="feed-footer">
                  <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>event/event-edit?id=<?php echo $list['event_id']; ?>">View</a>
								</div>
							</li>
<?php } $i++; }  ?>
						</ul>
					</div>
				</div>
			</div>


      <div class="container demo">

      	  <?php foreach($pendingUsersList as $list){ ?>
      	<div class="modal right fade" id="myModal<?php echo $list['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      		<div class="modal-dialog" role="document">
      			<div class="modal-content">

      				<div class="modal-header">
      					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      					<h4 class="modal-title" id="myModalLabel2">Details of <?php echo $list['username'] ;?></h4>
      				</div>

      				<div class="modal-body">
      					<p>Name: <strong><?php echo $list['first_name'].' '.$list['last_name'] ;?></strong></p>
      					<p>Email: <strong><?php echo $list['email'] ;?></strong></p>
      					<p>Gender: <strong><?php echo $list['gender'] ;?></strong></p>
      					<p>Contact: <strong><?php echo $list['contact'] ;?></strong></p>
      					<p>About:  <?php echo $list['description'] ;?></p>
      					<p><img src="<?php echo $list['imageData'] ;?>" alt=""></p>

                <p> <a class="btn btn-sm btn-primary" href="<?php echo $list['documents'] ;?>" download>Download Pay Slip</a> </p>
      				</div>

      			</div><!-- modal-content -->
      		</div><!-- modal-dialog -->
      	</div><!-- modal -->

          <?php }  ?>


      </div><!-- container -->







		</div>













		<?php } ?>

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


<!--ChartJs-->
<script src="<?php echo base_url('assets') ; ?>js/plugins/chartjs/Chart.min.js"></script>


<style>
.modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}

	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

/*Left*/
	.modal.left.fade .modal-dialog{
		left: -320px;
		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, left 0.3s ease-out;
		        transition: opacity 0.3s linear, left 0.3s ease-out;
	}

	.modal.left.fade.in .modal-dialog{
		left: 0;
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
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}

/* ----- v CAN BE DELETED v ----- */
body {
	background-color: #78909C;
}

.demo {
	padding-top: 60px;
	padding-bottom: 110px;
}

.btn-demo {
	margin: 15px;
	padding: 10px 15px;
	border-radius: 0;
	font-size: 16px;
	background-color: #FFFFFF;
}

.btn-demo:focus {
	outline: 0;
}

.demo-footer {
	position: fixed;
	bottom: 0;
	width: 100%;
	padding: 15px;
	background-color: #212121;
	text-align: center;
}

.demo-footer > a {
	text-decoration: none;
	font-weight: bold;
	font-size: 16px;
	color: #fff;
}



/* ----- v CAN BE DELETED v ----- */



</style>

<!-- Modal -->

</body>

</html>
