<?php include('header.php'); ?>
<style>
.nav-pills > li > a {
    padding: 4px 12px;
    background-color: #ff0028;
}
</style>
</head>
<body>

<!-- Page container -->
<div class="page-container">

	<!-- Page Sidebar -->
<?php include('sidebar.php'); ?>

  <!-- /page sidebar -->

  <!-- Main container -->
  <div class="main-container">

	<!-- Main header -->
	<div class="main-header row">
      <div class="col-sm-6 col-xs-7">

		<!-- User info -->
        <ul class="user-info pull-left">
          <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="images/man-3.jpg">John Henderson <span class="caret"></span></a>

			<!-- User action menu -->
            <ul class="dropdown-menu">

              <li><a href="#/"><i class="icon-user"></i>My profile</a></li>
              <li><a href="#/"><i class="icon-mail"></i>Messages</a></li>
              <li><a href="#"><i class="icon-clipboard"></i>Tasks</a></li>
			  <li class="divider"></li>
			  <li><a href="#"><i class="icon-cog"></i>Account settings</a></li>
			  <li><a href="#"><i class="icon-logout"></i>Logout</a></li>
            </ul>
			<!-- /user action menu -->

          </li>
        </ul>
		<!-- /user info -->

      </div>


    </div>
	<!-- /main header -->

	<!-- Main content -->
  <!-- Main content -->
  <div class="main-content">
     <h1 class="page-title">My Profile</h1>
     <!-- Breadcrumb -->

     <div class="row">
       <div class="col-lg-12">
         <div class="panel panel-default">

           <div class="panel-body">
<div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-body">
                                <ul id="userTab" class="nav nav-tabs">
                                    <li class="active"><a href="#overview" data-toggle="tab">Overview</a>
                                    </li>
                                    <li class=""><a href="#profile-settings" data-toggle="tab">Update Profile</a>
                                    </li>
                                </ul>
                                <div id="userTabContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="overview">

                                        <div class="row">
                                            <div class="col-lg-2 col-md-3">
                                                <a href="#">
                                                    <span class="profile-edit">Edit</span>
                                                </a>
                                                <img class="img-responsive img-profile" src="img/profile-full.jpg" alt="">
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active">Overview</a>
                                                    <a href="#" class="list-group-item">Messages<span class="badge green">4</span></a>
                                                    <a href="#" class="list-group-item">Alerts<span class="badge orange">9</span></a>
                                                    <a href="#" class="list-group-item">Tasks<span class="badge blue">10</span></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-5">
                                                <h1>John Smith</h1>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam placerat nunc ut tellus tristique, non posuere neque iaculis.</p>
                                                <ul class="list-inline">
                                                    <li><i class="fa fa-map-marker fa-muted"></i> Bayville, FL</li>
                                                    <li><i class="fa fa-user fa-muted"></i> Administrator</li>
                                                    <li><i class="fa fa-group fa-muted"></i> Sales, Marketing, Management</li>
                                                    <li><i class="fa fa-trophy fa-muted"></i> Top Seller</li>
                                                    <li><i class="fa fa-calendar fa-muted"></i> Member Since: 5/13/11</li>
                                                </ul>
                                                <h3>Recent Sales</h3>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>6:14 PM</td>
                                                                <td>$12.07</td>
                                                                <td><a class="btn btn-xs btn-orange disabled"><i class="fa fa-clock-o"></i> Pending</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>6:02 PM</td>
                                                                <td>$5.32</td>
                                                                <td><a class="btn btn-xs btn-orange disabled"><i class="fa fa-clock-o"></i> Pending</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>5:56 PM</td>
                                                                <td>$6.58</td>
                                                                <td><a class="btn btn-xs btn-green"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>5:12 PM</td>
                                                                <td>$15.61</td>
                                                                <td><a class="btn btn-xs btn-green"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>5:02 PM</td>
                                                                <td>$9.89</td>
                                                                <td><a class="btn btn-xs btn-green"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>4:47 PM</td>
                                                                <td>$2.21</td>
                                                                <td><a class="btn btn-xs btn-red"><i class="fa fa-warning"></i> Error</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1/31/14</td>
                                                                <td>4:32 PM</td>
                                                                <td>$5.17</td>
                                                                <td><a class="btn btn-xs btn-default"><i class="fa fa-arrow-circle-right"></i> Special Order</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <h3>Contact Details</h3>
                                                <p><i class="fa fa-globe fa-muted fa-fw"></i>  <a href="#">http://www.website.com</a>
                                                </p>
                                                <p><i class="fa fa-phone fa-muted fa-fw"></i> 1+(234) 555-2039</p>
                                                <p><i class="fa fa-building-o fa-muted fa-fw"></i> 8516 Market St.
                                                    <br>Bayville, FL 55555</p>
                                                <p><i class="fa fa-envelope-o fa-muted fa-fw"></i>  <a href="#">j.smith@website.com</a>
                                                </p>
                                                <ul class="list-inline">
                                                    <li><a class="facebook-link" href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                                                    </li>
                                                    <li><a class="twitter-link" href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                                                    </li>
                                                    <li><a class="linkedin-link" href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                                                    </li>
                                                    <li><a class="google-plus-link" href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="profile-settings">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <ul id="userSettings" class="nav nav-pills nav-stacked">
                                                    <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Basic Information</a>
                                                    </li>
                                                    <li><a href="#profilePicture" data-toggle="tab"><i class="fa fa-picture-o fa-fw"></i> Profile Picture</a>
                                                    </li>
                                                    <li><a href="#changePassword" data-toggle="tab"><i class="fa fa-lock fa-fw"></i> Change Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-9">
                                                <div id="userSettingsContent" class="tab-content">
                                                    <div class="tab-pane fade in active" id="basicInformation">
                                                        <form role="form">
                                                            <h4 class="page-header">Personal Information:</h4>
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control" value="John">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" class="form-control" value="Smith">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input type="tel" class="form-control" value="1+(234) 555-2039">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" value="8516 Market St.">
                                                            </div>
                                                            <div class="form-inline">
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input type="text" class="form-control" value="Bayville">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="text" class="form-control" value="FL">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>ZIP</label>
                                                                    <input type="text" class="form-control" value="55555">
                                                                </div>
                                                            </div>
                                                            <h4 class="page-header">Contact Details:</h4>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-envelope-o fa-fw"></i> Email Address</label>
                                                                <input type="email" class="form-control" value="jsmith@website.com">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-globe fa-fw"></i> Website</label>
                                                                <input type="url" class="form-control" value="http://www.website.com">
                                                            </div>
                                                            <h4 class="page-header">Profile Information:</h4>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-info fa-fw"></i> About</label>
                                                                <textarea class="form-control" rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam placerat nunc ut tellus tristique, non posuere neque iaculis.</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-building-o fa-fw"></i> Departments</label>
                                                                <select multiple="" class="form-control">
                                                                    <option>Accounting</option>
                                                                    <option>Customer Support</option>
                                                                    <option>Human Resources</option>
                                                                    <option selected="">Management</option>
                                                                    <option selected="">Marketing</option>
                                                                    <option>Production</option>
                                                                    <option>Quality Assurance</option>
                                                                    <option selected="">Sales</option>
                                                                </select>

                                                            </div>
                                                            <h4 class="page-header">Social Profiles:</h4>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-facebook fa-fw"></i> Facebook Profile URL</label>
                                                                <input type="url" class="form-control" value="http://www.facebook.com/john.smith9324">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-linkedin fa-fw"></i> LinkedIn Profile URL</label>
                                                                <input type="url" class="form-control" value="http://www.linkedin.com/u/john.smith923">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-google-plus fa-fw"></i> Google+ Profile URL</label>
                                                                <input type="url" class="form-control" value="http://plus.google.com/john-smith9993">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-twitter fa-fw"></i> Twitter Username</label>
                                                                <input type="text" class="form-control" value="@JohnSmith">
                                                            </div>
                                                            <button type="submit" class="btn btn-default">Update Profile</button>
                                                            <button class="btn btn-green">Cancel</button>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="profilePicture">
                                                        <h3>Current Picture:</h3>
                                                        <img class="img-responsive img-profile" src="img/profile-full.jpg" alt="">
                                                        <br>
                                                        <form role="form">
                                                            <div class="form-group">
                                                                <label>Choose a New Image</label>
                                                                <input type="file">
                                                                <p class="help-block"><i class="fa fa-warning"></i> Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG</p>
                                                                <button type="submit" class="btn btn-default">Update Profile Picture</button>
                                                                <button class="btn btn-green">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade in" id="changePassword">
                                                        <h3>Change Password:</h3>
                                                        <form role="form">
                                                            <div class="form-group">
                                                                <label>Old Password</label>
                                                                <input type="password" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>New Password</label>
                                                                <input type="password" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Re-Type New Password</label>
                                                                <input type="password" class="form-control" value="">
                                                            </div>
                                                            <button type="submit" class="btn btn-default">Update Password</button>
                                                            <button class="btn btn-green">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->


                    </div>
                    <!-- /.col-lg-12 -->
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
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="js/plugins/blockui-master/jquery-ui.js"></script>
<script src="js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--Float Charts-->

<script src="js/functions.js"></script>
<script src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="js/plugins/datatables/jszip.min.js"></script>
<script src="js/plugins/datatables/pdfmake.min.js"></script>
<script src="js/plugins/datatables/vfs_fonts.js"></script>
<script src="js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
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
