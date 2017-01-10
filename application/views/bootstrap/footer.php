<!-- Footer
		================================================== -->

		
		<!--Modal-->
		<div class="modal fade" id="newFolder">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Create new folder</h4>
      				</div>
				    <div class="modal-body">
				        <form>
							<div class="form-group">
								<label for="folderName">Folder Name</label>
								<input type="text" class="form-control input-sm" id="folderName" placeholder="Folder name here...">
							</div>
						</form>
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
						<a href="#" class="btn btn-danger btn-sm">Save changes</a>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div><!-- /wrapper -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	
	<!-- Logout confirmation -->
	<div class="custom-popup width-100" id="logoutConfirm">
		<div class="padding-md">
			<h4 class="m-top-none"> Do you want to logout?</h4>
		</div>

		<div class="text-center">
			<a class="btn btn-success m-right-sm" href="<?php echo base_url(); ?>/home/logout">Logout</a>
			<a class="btn btn-danger logoutConfirm_close">Cancel</a>
		</div>
	</div>

<!--Modal-->
<div class="modal fade" id="simpleModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 style="color: #BD3F26;">Module is Locked!</h4>
			</div>
			<div class="modal-body">
				<p>Currently this module is locked in your account.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<!-- Jquery -->
	<script src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>

	<!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
   
	<!-- Flot
	<script src='<?php //echo base_url(); ?>/js/jquery.flot.min.js'></script>-->

	<!-- Morris -->
	<script src='<?php echo base_url(); ?>js/rapheal.min.js'></script>
	<script src='<?php echo base_url(); ?>js/morris.min.js'></script>

	<!-- Gritter -->
	<script src='<?php echo base_url(); ?>js/jquery.gritter.min.js'></script>

	<!-- Google Code Prettify -->
	<script src='<?php echo base_url(); ?>js/uncompressed/run_prettify.js'></script>
	<!-- Colorbox -->
	<script src='<?php echo base_url(); ?>js/jquery.colorbox.min.js'></script>

	<!-- Sparkline -->
	<script src='<?php echo base_url(); ?>js/jquery.sparkline.min.js'></script>

	<!-- Pace -->
	<script src='<?php echo base_url(); ?>js/uncompressed/pace.js'></script>

	<!-- Popup Overlay -->
	<script src='<?php echo base_url(); ?>js/jquery.popupoverlay.min.js'></script>

	<!-- Slimscroll -->
	<script src='<?php echo base_url(); ?>js/jquery.slimscroll.min.js'></script>

	<!-- Modernizr -->
	<script src='<?php echo base_url(); ?>js/modernizr.min.js'></script>

	<!-- Cookie -->
	<script src='<?php echo base_url(); ?>js/jquery.cookie.min.js'></script>

	<!-- Endless
	<script src="/phpapp/js/endless/endless_dashboard.js"></script>-->
	<script src="<?php echo base_url(); ?>js/endless/endless.js"></script>
    <script src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
    
	<!--<script src="<?php echo base_url(); ?>js/slick.min.js"></script>-->
	
	<script src="<?php echo base_url(); ?>js/jQuery.circleProgressBar.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>


  </body>

<script>
	$(function () {
		$('.percent').percentageLoader({
			valElement: 'p',
			strokeWidth: 6,
			bgColor: '#0d1e2d',
			ringColor: '#727df0',
			textColor: '#fff',
			fontSize: '18px',
			fontWeight: 'normal'
		});

	});
</script>
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

</script>
<script>
$('.toggle').on('click', function() {
    $('.sidebar').toggleClass("sidebar-collapsed");
});
$('.toggle').on('click', function() {
	$('#main-container').toggleClass("collide");
});
$('.toggle').on('click', function() {
	$('.nav-container').toggleClass("collide2");
});
</script>
<script>
	$(document).ready(function(){
	  $(".owl-carousel").owlCarousel({
     items : 4,
     margin : 30,
     nav    : true,
     smartSpeed :900,
     navText : ["<i class='fa fa-angle-left'><div class='arrow-txt'>Prev</div></i>","<i class='fa fa-angle-right'><div class='arrow-txt'>Next</div></i>"]
   });
	});
</script>
</html>

