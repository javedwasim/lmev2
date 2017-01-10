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
<div class="login-wrapper custom-top">
    <div class="text-center">
        <h2 class="fadeInUp animation-delay8" style="font-weight:bold">
            <span class="text-success colorcustomlogin"><img src="<?php echo base_url()."img/MAIN.png"; ?>" width="400" /></span> <span style="color:#ccc; text-shadow:0 1px #fff"></span>
        </h2>
    </div>
    <div class="login-widget animation-delay1">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="pull-left">
                    <i class="fa fa-lock fa-lg"></i> Login
                </div>
            </div>
            <div class="panel-body">
                <?php echo form_open('verifylogin',array('class' => 'form-signin')); ?>
                    <?php echo validation_errors('<div class = "alert alert-error">','</div>'); ?>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="username" name="username" placeholder="Username" class="form-control input-sm bounceIn animation-delay2" >
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4">
                    </div>
                    <div class="form-group">
                        <label class="label-checkbox inline">
                            <input type="checkbox" class="regular-checkbox chk-delete" />
                            <span class="custom-checkbox info bounceIn animation-delay4"></span>
                        </label>
                        Remember me
                    </div>

                    <div class="seperator"></div>
                    <div class="form-group">
                        Forgot your password?<br/>
                        Click <a href="<?php echo base_url()."login/resetpassword" ?>" style="color: #BD3F26;"><strong>here</strong></a> to reset your password
                    </div>

                    <hr/>
                    <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit"><i class="fa fa-sign-in"></i>Sign in</button>
                <?php echo form_close() ?>
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