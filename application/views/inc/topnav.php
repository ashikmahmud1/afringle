

<div class="main-header row">

    <div class="col-sm-6 col-xs-7">



  <!-- User info -->

  <?php

  $userData = $this->session->userdata['is_logged_admin'];

   ?>

      <ul class="user-info pull-left">

        <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="<?php //echo base_url('upload/profile').'/'.$userData['admin_image']; ?><?=base_url('assets')?>/images/man-3.jpg"><?php echo $userData['admin_name']; ?><span class="caret"></span></a>

    <!-- User action menu -->

          <ul class="dropdown-menu">



            <li><a href="<?=base_url('admin-logout')?>"><i class="icon-logout"></i>Logout</a></li>
            <li><a href="#"><i class="icon-key"></i>Change Password</a></li>

          </ul>

    <!-- /user action menu -->

        </li>

      </ul>

  <!-- /user info -->

    </div>

</div>

