<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Hotel") {
  redirect("admin/dashboard");
} ?>
<style>
label {
    font-weight: 600;
    display: inherit;
}
</style>
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

		<!-- Main content -->
		<div class="main-content">
			<h1 class="page-title">Add New Manager</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                  <form method="post" action="<?=base_url('manager/edit-manager?id='.$ManagerData['id']);?>">
                     <div class="col-md-12 col-sm-9 col-xs-10">
                       <div class="col-md-6">
                         <div class="form-group">
                           <label class="form-label" for="field-1">First Name</label>
                           <div class="controls">
                             <input type="text" name="f_name"  value="<?=$ManagerData['firstname']?>"class="form-control" id="field-1" >
                             <input type="hidden" name="m_id" value="<?=$ManagerData['id']?>">
                             <?=form_error('f_name', '<div class="error">', '</div>');?>
                           </div>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                           <label class="form-label" for="field-1">Last Name</label>
                           <div class="controls">
                             <input type="text" name="l_name" value="<?=$ManagerData['lastname']?>" class="form-control" id="field-1" >
                             <?=form_error('f_name', '<div class="error">', '</div>');?>
                           </div>
                         </div>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-md-12">
                         <div class="form-group">
                           <label class="form-label" for="field-3">Username</label>
                           <div class="controls">
                             <input type="text" disabled name="username" value="<?=$ManagerData['username']?>" class="form-control" id="field-3" >
                             <?=form_error('email', '<div class="error">', '</div>');?>
                           </div>
                         </div>
                       </div>
                       <div class="col-md-12">
                         <div class="form-group">
                           <label class="form-label" for="field-3">Email</label>
                           <div class="controls">
                             <input type="email" disabled name="email" value="<?=$ManagerData['email']?>" class="form-control" id="field-3" >
                             <?=form_error('email', '<div class="error">', '</div>');?>
                           </div>
                         </div>
                       </div>
                       <div class="col-md-12">
                         <div class="form-group">
                           <label class="form-label" for="field-3">Phone</label>
                           <div class="controls">
                             <input type="text"  name="mobile" value="<?=$ManagerData['phone']?>" class="form-control" id="field-3" >
                             <?=form_error('mobile', '<div class="error">', '</div>');?>
                           </div>
                         </div>
                       </div>

                       <div class="col-md-12">
                         <?php
                 $previlageType = ['Booking','Room','Coupon','Facilities','Services','Calander'];

               for($i=0; $i<count($previlageType); $i++ ):
               ?>


               <div class="col-md-12">
                   <label><?=$previlageType[$i];?></label>
                   <div class="checkbox checkbox-replace checkbox-primary">
                     <input type="checkbox" id="checkbox1<?=$i;?>" name="<?=$previlageType[$i];?>_add" <?php if($ManagerData[$previlageType[$i].'_add'] == 1){echo 'checked';}?>   value="1">
                     <label for="checkbox1<?=$i;?>">Add</label>
                   </div>
                   <div class="checkbox checkbox-replace checkbox-success">
                     <input type="checkbox" id="checkbox2<?=$i;?>" name="<?=$previlageType[$i];?>_remove" <?php if($ManagerData[$previlageType[$i].'_remove'] == 1){echo 'checked';}?>  value="1">
                     <label for="checkbox2<?=$i;?>">Remove</label>
                   </div>
                   <div class="checkbox checkbox-replace checkbox-info">
                     <input type="checkbox" id="checkbox3<?=$i;?>" name="<?=$previlageType[$i];?>_edit" <?php if($ManagerData[$previlageType[$i].'_edit'] == 1){echo 'checked';}?>  value="1">
                     <label for="checkbox3<?=$i;?>">Edit</label>
                   </div>

               </div>


                         <?php endfor;?>

                       </div>

                       <div class="pull-right">
                         <button type="submit" class="btn btn-primary">Update</button>
                       </div>
                     </div>
                   </form>



                </div>
            </div>
        </div>
    </div>
</div>




		<!-- Footer -->

		<!-- /footer -->

	  </div>

		<!-- Footer -->

		<!-- /footer -->

	  </div>
	  <!-- /main content -->

  </div>
  <!-- /main container -->

</div>
<!-- /page container -->



<?php $this->load->view('inc/footer'); ?>


</body>

</html>
