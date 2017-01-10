<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="main-container">
	
	
	<?php include_once("top_nav.php"); ?>
	<div class="padding-md">


		<div class="row">
			<div class="col-md-7">
				<h4>We'd Love to Hear From You, Lets Get In Touch!</h4>
				<?php if(!empty($mailsent)){?>
					<div class="alert alert-success">
						<strong>Mail Sent!</strong> at support@launchmyempire.com.
					</div>
				<?php } ?>
				<?php echo form_open('home/supportmail',array('class' => 'form-signin')); ?>
					<div class="form-group">
						<label for="exampleInputPassword1">Name</label>
						<input type="text" class="form-control" id="exampleInputPassword1" name="name" placeholder="Name" required>
					</div><!-- /form-group -->
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="supportemail" placeholder="Email Address" required>
					</div><!-- /form-group -->
					<div class="form-group">
						<label for="exampleInputEmail1">Quick Message</label>
						<textarea class="form-control" rows="7" placeholder="Message" name="message" required></textarea>
					</div><!-- /form-group -->
					<button type="submit" class="btn btn-sm btn-primary">Submit</button>
				<?php echo form_close() ?>
			</div><!-- /.col -->
			<div class="col-md-4 col-md-offset-1">
				<h4>Contact info</h4>

				<address>
					<strong>Email : <span class="theme-font">support@launchmyempire.com</span></strong>
				</address>

				<hr/>

				<h4>Get Social</h4>
				<a href="<?php echo base_url()."home/fbredirect"; ?>" target="_blank" class="social-connect tooltip-test facebook-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo base_url()."home/twitredirect"; ?>" target="_blank" class="social-connect tooltip-test twitter-hover pull-left m-right-xs" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>

			</div><!-- /.col -->
		</div><!-- /.row -->
</div><!-- /.padding-md -->
</div><!-- /main-container -->