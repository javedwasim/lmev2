<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>/css/font-awesome.min.css" rel="stylesheet">

    <!-- Endless -->
    <link href="<?php echo base_url(); ?>/css/endless.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">

</head>

<body style="background: #BD3F26;">
<div class="login-wrapper" >
    <div class="text-center">
        <h2 class="fadeInUp animation-delay8" style="font-weight:bold">
            <span style="color: #FFF;">Reset Your Password.</span> <span style="color:#ccc; text-shadow:0 1px #fff"></span>
        </h2>
    </div>

    <div class="login-widget animation-delay1">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php if(isset($passwordchanged)&&($passwordchanged==1)): ?>
                    <div class="alert alert-success">
                        <strong>Password Changed!</strong> Please check your mail to view updated password.
                    </div>
                <?php endif; ?>
                <?php echo form_open('verifylogin/resetpassword',array('class' => 'form-signin')); ?>
                    <?php echo validation_errors('<div class = "alert alert-error">','</div>'); ?>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input type="text" id="email" name="email" placeholder="Please enter your email." class="form-control input-sm bounceIn animation-delay2" value="<?php if(isset($email)){echo $email;} ?>">
                    </div>
                    <hr/>
                    <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit"><i class="fa fa-sign-in"></i>Reset Password</button>
                <?php echo form_close() ?>
                <hr/>
                <div>
                    <a href="<?php echo base_url()."home/index"; ?>" class="btn btn-primary" style="width: 366px;  height: 38px; align-content: center;"><i class="fa fa-chevron-left"></i> Back to Home</a>
                </div>
            </div>
        </div><!-- /panel -->
    </div><!-- /login-widget -->
</div><!-- /login-wrapper -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="<?php echo base_url(); ?>/js/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>/bootstrap/js/bootstrap.min.js"></script>

<!-- Modernizr -->
<script src='<?php echo base_url(); ?>/js/modernizr.min.js'></script>

<!-- Pace -->
<script src='<?php echo base_url(); ?>/js/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='<?php echo base_url(); ?>/js/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='<?php echo base_url(); ?>/js/jquery.slimscroll.min.js'></script>

<!-- Cookie -->
<script src='<?php echo base_url(); ?>/js/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="<?php echo base_url(); ?>/js/endless/endless.js"></script>
</body>
</html>