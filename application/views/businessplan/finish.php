<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-container2">
    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="padding-md">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Congratulations!</h1>
            </div>
            <div class="panel-body" style="text-align: center;">
                
                    <h4>Your Business Plan is Complete!</h4>
                    <h4>This Is a Key Part of Ensuring Your Product Sells!</h4>
                
				<div>
				
				<br/><br/>
				<a class="btn btn-info" target="_blank" href="<?php echo $pdfDownloadLink;?>">
					<i class="fa fa-cloud-download fa-lg"></i> 
					Download Business Plan
				</a>
				<br/><br/><br/><br/><br/><br/>
				<a class="btn btn-success"  href="http://members.launchmyempire.com/businessplan/">
					<i class="fa fa-signal fa-lg"></i> 
					Create Another Busines Plan
				</a>
				<a class="btn btn-primary "  href="http://members.launchmyempire.com/home/">
					<i class="fa fa-home fa-lg"></i> 
					Back To Members Area
				</a>
				
				</div>
            </div>
        </div><!-- /panel -->
  </div><!-- /.padding-md -->
</div><!-- /main-container -->
