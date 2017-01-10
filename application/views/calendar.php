<!DOCTYPE html>


<div id="main-container">

	

	<?php /*?><div class="grey-container shortcut-wrapper">
		<a href = "<?php echo base_url(); ?>" class="shortcut-link">
			<span class="shortcut-icon">
				<i class="fa fa-home"></i>
			</span>
			<span class="text">Home</span>
		</a>
		<a href="<?php echo base_url()."home/coursemodules"; ?>" class="shortcut-link">
		<span class="shortcut-icon">

			<i class="fa fa-video-camera"></i>

		</span>
			<span class="text">Course Modules</span>
		</a>
		<a href="<?php echo base_url()."home/calendar"; ?>" class="shortcut-link">
			<span class="shortcut-icon">
				<i class="fa fa-calendar"></i>
			</span>
			<span class="text">Events Calender</span>
		</a>
		<a href="<?php echo base_url()."home/support"; ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-question-circle"></i>

		</span>
			<span class="text">Contact Support</span>
		</a>
		<a href = "<?php echo base_url()."/home/profile" ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-user"></i>
		</span>
			<span class="text">My Profile</span>
		</a>
		<a href = "<?php echo base_url()."/home/logout" ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-power-off"></i>
		</span>
			<span class="text">Logout</span>

		</a>
	</div><?php */?><!-- /grey-container -->
<div class="grey-container nav-container">
		<a href = "<?php echo base_url(); ?>" class="shortcut-link">
			<span class="shortcut-icon">
				<i class="fa fa-home"></i>
			</span>
			<span class="text">Home</span>
		</a>
		<a href="<?php echo base_url()."home/coursemodules"; ?>" class="shortcut-link">
		<span class="shortcut-icon">

			<i class="fa fa-video-camera"></i>

		</span>
			<span class="text">Course Modules</span>
		</a>
		<a href="<?php echo base_url()."home/calendar"; ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-calendar"></i>
		</span>
			<span class="text">Events Calender</span>
		</a>
		<a href="<?php echo base_url()."home/support"; ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-question-circle"></i>

		</span>
			<span class="text">Support</span>
		</a>
		<?php /*?><a href = "<?php echo base_url()."home/profile" ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-user"></i>
		</span>
			<span class="text">My Profile</span>
		</a><?php */?>
		<?php /*?><a href = "<?php echo base_url()."home/logout" ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-power-off"></i>
		</span>
			<span class="text">Logout</span>

		</a><?php */?>
    
    <ul class="nav-notification clearfix">
            <li class="profile dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              
                            <div class="detail">
                                <span><?php echo $userdata['full_name']; ?></span>

                               <?php /*?> <p class="grey"><?php echo $userdata['email']; ?></p><?php */?>
                               <img src="<?php echo base_url(); ?>img/profile/<?php echo $userdata['image']; ?>" alt="User Avatar">
                                 <span><i class="fa fa-chevron-down"></i></span>
                            </div>
                              
                    <?php /*?><strong><?php echo "Settings"; ?></strong><?php */?>
                  
                </a>
                <ul class="dropdown-menu">
                    <?php /*?><li>
                        <a class="clearfix" href="#">
                            <img src="<?php echo base_url(); ?>img/profile/<?php echo $userdata['image']; ?>" alt="User Avatar">

                            <div class="detail">
                                <strong><?php echo $userdata['full_name']; ?></strong>

                                <p class="grey"><?php echo $userdata['email']; ?></p>
                            </div>
                        </a>
                    </li><?php */?>
                    
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>home/profile" class="main-link"><i
                                class="fa fa-edit fa-lg"></i> Edit profile</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" class="main-link logoutConfirm_open"
                           href="http://members.launchmyempire.com/home/logout"><i class="fa fa-lock fa-lg"></i> SignOut</a>
                </ul>
            </li>
        </ul>
        
        </div>
		<div class="padding-md">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-lg"></i> Calendar
				</div>
				<div class="panel-body">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
	</div><!-- /main-container -->
</div><!-- /wrapper -->

<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

<!-- Logout confirmation -->
<div class="custom-popup width-100" id="logoutConfirm">
	<div class="padding-md">
		<h4 class="m-top-none"> Do you want to logout?</h4>
	</div>

	<div class="text-center">
		<a class="btn btn-success m-right-sm" href="login.html">Logout</a>
		<a class="btn btn-danger logoutConfirm_close">Cancel</a>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="simpleModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Module is Locked.</h4>
			</div>
			<div class="modal-body">
				<p>You don't have access to view this module.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>

<!-- Jquery UI -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<!-- Full Calender -->
<script src='<?php echo base_url(); ?>js/fullcalendar.min.js'></script>

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

<script>
	$(function	()	{

		// Full calendar
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]
		});
	});
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

</body>
</html>
