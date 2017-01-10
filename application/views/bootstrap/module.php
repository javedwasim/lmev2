<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div id="main-container">

	<?php include_once("top_nav.php"); ?>
	<div class="padding-md">

		<div class="module-sec">
			<h3 class="col-md-7"><a href = "<?php echo base_url()."home/module/".$module_number; ?>" class="module-color-custom module-hd"><?php echo $module_title; ?></a></h3>
            <div class="div-center col-md-5">
            <div class="row">
            <h5 class="col-md-7 progress-hd">MODULE PROGRESS</h5>
			<div class="col-md-5">
				<div class="percent">
                
					<p style="display:none;"><span></span><?php echo $moduleProgress."%"; ?></p>
                    
                   
				</div>
			</div>
            </div>
            </div>
		</div>
		

		<?php /*?><div class="row" id="heading">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href = "<?php echo base_url()."home/module/".$module_number; ?>" class="module-color-custom font-16"><?php echo $module_title; ?></a>
					</div>
				</div><!-- /panel -->
			</div>
		</div><?php */?>
 
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-body">
						<?php foreach($module_vides as $video):

							$moduleid = $video['id'];
							$video_link = base_url()."/home/video/".$video['module_number']."/".$video['video_number'];
							$userid = $this->session->userdata['logged_in']['id'];

							if($video['module_number']>$TotalModulesToOpen):

							?>
							<div class="alert alert-danger">
								<strong>You have not access to this module.!</strong> Change a few things up and try submitting again.
							</div>
						<?php   break;  endif; ?>
							<div class="col-md-6 module">
								<div class="panel panel-default">
									<div class="panel-heading font18bold videocustom">
										<a href="#" onclick="UserVideoLink(<?php echo $userid ?>,<?php echo $moduleid; ?>,'<?php echo $video_link; ?>');" class = "videotitlecolor">
											<?php echo "Video # ".$video['video_number']; ?>
										</a>
										<?php if(isset($video['video_watched'])): ?>
                                        	<a href="#" class="status"><img src="<?php echo base_url(); ?>img/completed.png" class="chech-img"></a>
										<?php else: ?>
											<a href="#" class="status"><img src="<?php echo base_url(); ?>img/incomplete.png" class="chech-img"></a>
										<?php endif; ?>
									</div>
									<div class="panel-body">
										<a href="#" onclick="UserVideoLink(<?php echo $userid ?>,<?php echo $moduleid; ?>,'<?php echo $video_link; ?>');">
                                        <div class="tutor-img">
                                        	<img src="<?php echo base_url(); ?>img/tutor-img.png" class="tut-img">
                                            
                                        </div>

									</div>
                                    <div class="video-title">
                                    	<p><?php echo $video['video_title']; ?></p>
                                    </div>
								</div><!-- /panel -->
							</div>

						<?php  endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>