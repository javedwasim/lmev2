<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="main-container">


	<?php include_once("top_nav.php"); ?>
	<div class="padding-md">

		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('search',array('class' => '')); ?>
					<div class="input-group m-bottom-md">
						<input type="text" name="search_module" class="form-control" placeholder="Search here..." value="<?php echo $search_value; ?>">
						<span class="input-group-btn">
							<button class="btn btn-primary" type="submit">Search</button>
						</span>
					</div>
				<?php echo form_close() ?>
				<div class="search-options clearfix">
					<strong style="margin-right:20px;"><?php echo $search_result_count; ?> Record found.</strong>

				</div><!-- /search-option -->
				<?php  foreach($search_module as $row): ?>
					<div class="search-container">
						<div class="panel panel-default">
							<div class="panel-body search_panel">
								<div class="search-header">
									<?php if($TotalModulesToOpen>=$row['module_number']){ ?>
										<a href="<?php echo base_url()."home/module/".$row['module_number']; ?>" class="font-16 inline-block search-color-custom"><?php echo $row['module_title']; ?></a>
									<?php }else{ ?>
										<a href="#" class="font-16 inline-block search-color-custom" onclick="lock_module();"><?php echo $row['module_title']; ?></a>
									<?php } ?>
								</div>

								<p class="m-top-sm">
									<?php if($TotalModulesToOpen>=$row['module_number']){ ?>
										<a href="<?php echo base_url()."home/video/".$row['module_number']."/".$row['video_number']; ?>" class="font-14 inline-block search-color-custom"><img width="32" height="32" src="<?php echo base_url(); ?>/img/video-camera-icon.png"></a>
										 &nbsp; <span class="text-danger"><a href="<?php echo base_url()."home/video/".$row['module_number']."/".$row['video_number']; ?>" class="font-14 inline-block search-color-custom"> <?php echo "Module # ". $row['module_number']." - Video # ".$row['video_number']." ".$row['video_title']; ?></span>
										<a href="<?php echo base_url()."home/video/".$row['module_number']."/".$row['video_number']; ?>" class="btn btn-sm btn-primary search-video-body"><i class="fa fa-save fa-lg"></i>View</a>
									<?php }else{ ?>
										<a href="#" class="font-14 inline-block search-color-custom" onclick="lock_module();"><img width="32" height="32" src="<?php echo base_url(); ?>/img/video-camera-icon.png"></a>
										&nbsp; <span class="text-danger"><a href="#" class="font-14 inline-block search-color-custom" onclick="lock_module();"> <?php echo "Module # ". $row['module_number']." - Video # ".$row['video_number']." ".$row['video_title']; ?></span>
										<a href="#" class="btn btn-sm btn-primary search-video-body" onclick="lock_module();"><i class="fa fa-save fa-lg"></i>View</a>
									<?php } ?>
								</p>

							</div>
						</div><!-- /panel -->
					</div><!-- /search-container -->
				<?php endforeach; ?>


			</div><!-- /.col -->

		</div><!-- /.row -->
	</div><!-- /.padding-sm -->
</div>