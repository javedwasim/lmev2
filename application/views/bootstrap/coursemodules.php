<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="main-container">

	

	<?php include_once("top_nav.php"); ?>
	<div class="padding-md">
		<div class="row">
			<?php $index=1; foreach($modules as $module){ ?>
			<div class="col-md-6">
				<div class="module-image-wrapper <?php if($index%2==0){echo "right";}else{echo "left";} ?>">
					<?php if($TotalModulesToOpen >= $index){ ?>
						<a href = "<?php echo base_url()."home/module/".$module['module_number'] ?>">
							<img src="<?php echo base_url()."img/module/".$module['module_number'].".jpg" ?>" class="module-image shadow"/>
						</a>
					<?php }else{ ?>
						<a href = "#" class="customcolor" onclick="lock_module();">
							<img src="<?php echo base_url()."img/module/".$module['module_number'].".jpg" ?>" class="module-image shadow"/>
						</a>
					<?php } ?>
				</div><!-- /panel -->
				<hr/>
			</div>
		  <?php $index++; } ?>
		</div>
	</div>
</div>
