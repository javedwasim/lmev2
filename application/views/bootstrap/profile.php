<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="main-container">


	<?php include_once("top_nav.php"); ?>
	<div class="padding-md">
		<div class="row">
			<div class="col-md-12 col-sm-3">
				<div class="row">
					<div class="panel-heading profile-heading font-16"><strong>User Profile</strong></div>

					<?php if(isset($profileupdated)){ ?>
						<div class="alert alert-success text-position">
							<strong>User Profile!</strong> Updated Successfully.
						</div>
					<?php } ?>
				</div>
			</div>
			<hr/>
			<?php echo form_open_multipart('home/profileupdated',array('class' => 'form-signin')); ?>
			<?php echo validation_errors('<div class = "alert alert-error">','</div>'); ?>

			<hr/>
			<div class="col-md-6 col-sm-3">
				<div class="row">
					<div class="col-xs-6 col-sm-12 col-md-6 text-center">
						<a href="#">
							<img src="<?php echo base_url(); ?>img/profile/<?php echo $userdata['image']; ?>" alt="User Avatar" class="img-thumbnail">
						</a>
						<div class="seperator"></div>
						<div class="seperator"></div>
					</div><!-- /.col -->
					<div class="col-xs-6 col-sm-12 col-md-6">

						<input class="form-control" type="text" value="<?php echo $userdata['full_name'];?>" name="full_name">
						<div class="seperator"></div>
						<input type="email" class="form-control input-sm" id="exampleInputEmail1" name="email" value="<?php echo $userdata['email'];?>">
						<div class="seperator"></div>
						<div class="upload-file">
							<input type="file" id="upload-demo" name="userfile" class="upload-demo">
							<label data-title="Select file" for="upload-demo">
								<span data-title="<?php if(!empty($userdata['image'])){echo $userdata['image']; }else{echo "select image";} ?> "></span>
							</label>
						</div>
						<div class="seperator"></div>
						<div class="seperator"></div>
						<button type="submit" id="submitbtn" class="btn btn-primary btn-sm"><span>Update Profile <span></span></button>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.col -->
			<div class="col-md-6 col-sm-9">
				<div class="tab-content">
					<div class="tab-pane fade in active" id="overview">
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default fadeInDown animation-delay2 profile-panel-width">
									<div class="panel-heading">
										Notes
									</div>
									<div class="panel-body">
										<textarea class="form-control" rows="11" name = "about"><?php echo $userdata['about'];?></textarea>
									</div>
								</div><!-- /panel -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /tab1 -->
				</div><!-- /tab-content -->
			</div><!-- /.col -->
			<?php echo form_close() ?>
		</div><!-- /.row -->

		<div class="col-md-12 col-sm-3" style = "margin-bottom: 20px;">
			<div class="row">
				<div class="panel-heading profile-heading font-16"><strong>Change Password</strong></div>

				<?php if(isset($passwordchanded)){ ?>
					<div class="alert alert-success text-position">
						<strong>User Password!</strong> Updated Successfully.
					</div>
				<?php } ?>
			</div>

		</div>
		<div class="seperator"></div>
		<div class="seperator"></div>
		<?php echo form_open('home/changepassword',array('class' => 'form-signin')); ?>
		<?php echo validation_errors('<div class = "alert alert-error">','</div>'); ?>
			<div class="col-md-6 col-sm-3">
				<div class="row">
					<div class="form-group">
						<label class="col-lg-2 control-label">Password</label>
						<div class="col-lg-10">
							<input class="form-control" type="password" id="password" name="password"  minlength="8" required>
						</div><!-- /.col -->
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<div class="seperator"></div>
						<div class="seperator"></div>
						<label class="col-lg-2 control-label">Confirm Password</label>
						<div class="col-lg-10">
							<input class="form-control" type="password" id="cpassword" name="cpassword">
						</div><!-- /.col -->
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<label class="col-lg-2 control-label"></label>
						<div class="col-lg-10">
							<button type="submit" id="btnSubmit" class="btn btn-primary btn-sm" style = " margin-top: 10px;"><span>Change Password <span></span></button>
						</div><!-- /.col -->
					</div>
				</div>
			</div>
		<?php echo form_close() ?>
	</div><!-- /.padding-md -->
</div>
<!--Modal-->
<div class="modal fade" id="confirmpassword">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Passowrd not match.</h4>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	$(function () {
		$("#btnSubmit").click(function () {
			var password = $("#password").val();
			var confirmPassword = $("#cpassword").val();
			if (password != confirmPassword) {
				$("#confirmpassword").modal("show");
				return false;
			}
			return true;
		});
	});
</script>