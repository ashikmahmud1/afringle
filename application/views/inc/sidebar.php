	<div class="page-sidebar">
<?php
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);

$ci =&get_instance();
$ci->load->model('Permissions');

$sndata = $this->session->userdata('is_logged_admin');
 ?>
		<!-- Site header  -->
		<header class="site-header">
		  <div class="site-logo" style=" width: 80%;" ><a href="<?=base_url('admin/dashboard')?>"><img src="<?=base_url('assets')?>/images/slidelogo.png" alt="Mouldifi" title="Mouldifi"></a></div>
		  <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
		  <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
		</header>
		<!-- /site header -->





	<?php if( $this->session->userdata['is_logged_admin']['admin_role']  == "Admin") {  ?>

		<!-- Main navigation -->
		<ul id="side-nav" class="main-menu navbar-collapse collapse">

		<!-- Dashboard -->

			<li class="<?php if($uri2=='dashboard'){echo 'active';}?>"><a href="<?=base_url('admin/dashboard')?>"><i class="icon-gauge"></i><span class="title">Dashboard</span></a></li>
		<!-- Dashboard -->

<!------------------------------------ Admin USER LOGIN MENU HERE ------------------------------------------>

	<!-- Hotel -->
		<li class="has-sub"><a href="#"><i class="icon-user"></i><span class="title">All Users</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('user/user-list')?>"><span class="title">Users List</span></a></li>
				<li><a href="<?=base_url('user/user-pending')?>"><span class="title">Pending Users</span></a></li>
				<li><a href="<?=base_url('user/add-user')?>"><span class="title">Add Exclusive Members</span></a></li>
			</ul>
		</li>
	<!-- Hotel -->


	<!-- Sales -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-user"></i><span class="title">Our Sucsess Stories</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('Story/addStory')?>"><span class="title">Add New Story</span></a></li>
				<li><a href="<?=base_url('Story/Storylist')?>"><span class="title">All Stories</span></a></li>
			</ul>
		</li>
	<!-- Sales -->

	<!-- Body Type -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-user"></i><span class="title">Body Type</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('bodytype/bodytype-add')?>"><span class="title">Add Body Type</span></a></li>
				<li><a href="<?=base_url('bodytype/bodytype-list')?>"><span class="title">All Body Type</span></a></li>
			</ul>
		</li>
	<!-- Body Type -->

	<!-- Eye Color -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-user"></i><span class="title">Eye Color</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('eyecolor/eyecolor-add')?>"><span class="title">Add Eye Color</span></a></li>
				<li><a href="<?=base_url('eyecolor/eyecolor-list')?>"><span class="title">All Eye Color</span></a></li>
			</ul>
		</li>
	<!-- Eye Color -->

	<!-- Profession-->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-user"></i><span class="title">Profession</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('profession/profession-add')?>"><span class="title">Add Profession</span></a></li>
				<li><a href="<?=base_url('profession/profession-list')?>"><span class="title">All Profession</span></a></li>
			</ul>
		</li>
	<!-- Profession -->

	<!-- Education-->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-user"></i><span class="title">Education</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('education/education-add')?>"><span class="title">Add Education</span></a></li>
				<li><a href="<?=base_url('education/education-list')?>"><span class="title">All Education</span></a></li>
			</ul>
		</li>
	<!-- Education -->

	<!-- Room Type -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-camera"></i><span class="title">Manage Events</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('event/event-add')?>"><span class="title">Add New Event</span></a></li>
				<li><a href="<?=base_url('event/event-list')?>"><span class="title">Events list</span></a></li>
			</ul>
		</li>
	<!-- Room Type -->


	<!-- Services -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-box"></i><span class="title">Manage Tribes</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('tribe/add-tribe')?>"><span class="title">Add New Tribe</span></a></li>
				<li><a href="<?=base_url('tribe/tribelist')?>"><span class="title">Tribes List</span></a></li>
			</ul>
		</li>
	<!-- Services -->

	<!-- Events -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-box"></i><span class="title">Hair Colors</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('hair/hair-add')?>"><span class="title">Add New Hair Color</span></a></li>
				<li><a href="<?=base_url('hair/hair-list')?>"><span class="title">All Hair Colors</span></a></li>
			</ul>
		</li>
	<!-- Events -->

	<!-- Height -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-box"></i><span class="title">Manage Heights</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('height/height-add')?>"><span class="title">Add New Height</span></a></li>
				<li><a href="<?=base_url('height/height-list')?>"><span class="title">Heights List</span></a></li>
			</ul>
		</li>
	<!-- Height -->

	<!-- Height -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-box"></i><span class="title">Membership Plans</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('plan/plan-add')?>"><span class="title">Add New Plan</span></a></li>
				<li><a href="<?=base_url('plan/plan-list')?>"><span class="title">All Plans List</span></a></li>
			</ul>
		</li>
	<!-- Height -->

	<!-- Facilities -->
		<li class="has-sub"><a href="collapsed-sidebar.html"><i class="icon-sound"></i><span class="title">Manage Chemistry</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('Chemistry/Chemistry-add')?>"><span class="title">Add Chemistry Q/A</span></a></li>
				<li><a href="<?=base_url('Chemistry/Chemistry-list')?>"><span class="title">Chemistry List</span></a></li>
			</ul>
		</li>

		<li ><a href="<?=base_url('send-email-to')?>"><i class="icon-box"></i><span class="title">Send Mail</span></a></li>
	<!-- Facilities -->

<li><a href="<?=base_url('slip/pay-slip')?>"><i class="icon-box"></i><span class="title">Manage Pay Slip Content</span></a></li>
<!-- Logout -->
	<li ><a href="<?=base_url('admin-logout')?>"><i class="icon-logout"></i><span class="title">Logout</span></a></li>
<!-- Logout -->

		</ul>


		<?php } else { ?>

		<!-- Main navigation -->
		<ul id="side-nav" class="main-menu navbar-collapse collapse">

		<!-- Dashboard -->

			<li class="<?php if($uri2=='dashboard'){echo 'active';}?>"><a href="<?=base_url('admin/dashboard')?>"><i class="icon-gauge"></i><span class="title">Dashboard</span></a></li>
		<!-- Dashboard -->

<!------------------------------------ Admin USER LOGIN MENU HERE ------------------------------------------>

	<!-- Hotel -->
		<li class="has-sub"><a href="#"><i class="icon-user"></i><span class="title">All Users</span></a>
			<ul class="nav collapse">
				<li><a href="<?=base_url('user/user-list')?>"><span class="title">Users List</span></a></li>
			</ul>
		</li>
	<li ><a href="<?=base_url('admin-logout')?>"><i class="icon-logout"></i><span class="title">Logout</span></a></li>

		</ul>

		<?php } ?>

		<!-- main navigation -->
  </div>
