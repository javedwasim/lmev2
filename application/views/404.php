<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Endless Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">

	<!-- Endless -->
	<link href="<?php echo base_url(); ?>css/endless.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/endless-skin.css" rel="stylesheet">

</head>

<body>
<div id="wrapper">
	<div class="padding-md" style="margin-top:50px;">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
				<div class="h5">Oops, This Page Could Not Be Found!</div>
				<h1 class="m-top-none error-heading">404</h1>
				<a class="btn btn-primary m-bottom-sm" href="<?php echo base_url()."home/"; ?>"><i class="fa fa-home"></i> Back to Home</a>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.padding-md -->
</div><!-- /wrapper -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<!-- Modernizr -->
<script src='<?php echo base_url(); ?>js/modernizr.min.js'></script>

<!-- Pace -->
<script src='<?php echo base_url(); ?>js/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='<?php echo base_url(); ?>js/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='<?php echo base_url(); ?>js/jquery.slimscroll.min.js'></script>

<!-- Cookie -->
<script src='<?php echo base_url(); ?>js/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="<?php echo base_url(); ?>js/endless/endless.js"></script>

</body>
</html>
