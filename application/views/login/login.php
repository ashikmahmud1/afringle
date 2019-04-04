
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
<title>AFRINGLE</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets'); ?>/images/favicon.ico' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="<?php echo base_url('assets'); ?>/css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="<?php echo base_url('assets'); ?>/css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="<?php echo base_url('assets'); ?>/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="<?php echo base_url('assets'); ?>/css/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="<?php echo base_url('assets'); ?>/css/mouldifi-forms.css" rel="stylesheet">

<link rel="stylesheet" href="<?php echo base_url('assets'); ?>/css/app.min.css" />

</head>
<body class="page-loading">

<div class="pageload">
<div class="pageload-inner">
<div class="sk-rotating-plane"></div>
</div>
</div>

<div class="app signin v2 usersession">
<div class="session-wrapper">
<div class="session-carousel slide" data-ride="carousel" data-interval="3000">

<div class="carousel-inner" role="listbox">
<div class="item active" style="background-image:url(<?php echo base_url('assets'); ?>/images/slide1.jpg);background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
</div>
<div class="item" style="background-image:url(<?php echo base_url('assets'); ?>/images/slide2.jpg);background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
</div>
<div class="item" style="background-image:url(<?php echo base_url('assets'); ?>/images/slide1.jpg);background-size:cover;background-repeat: no-repeat;background-position: 50% 50%;">
</div>
</div>
</div>
<div class="card bg-gray no-border">
<div class="card-block">
<form role="form" class="form-layout" role="form" action="admin-login" method="post">
<div class="text-center m-b">
<img src="<?php echo base_url('assets'); ?>/images/logo.png">

</div>
	<div class="">
                <div class="form-group">
                    <input type="text" class="form-control username" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>" size="20">
                    <p><?php echo form_error('username'); ?></p>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" size="20">
                    <p><?php echo form_error('password'); ?></p>
                </div>
                <?php if(!empty($message)){echo '<p>'.$message.'</p>';}?>
                <?php if($this->session->flashdata('message')){ echo '<p>'.$this->session->flashdata('message').'</p>';};?>

				 </div>



                <button id="login" class="btn btn-primary btn-block btn-lg m-b" data-style="zoom-in">Login</button>

               <p><small class="response"></small></p>

                <!--<p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>-->
            </form>

</div>
</div>
<div class="push"></div>
</div>
</div>
<script src="<?php echo base_url('assets'); ?>/js/app.min.js"></script>










</body>
</html>
