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
		<a href = "<?php echo base_url()."home/profile" ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-user"></i>
		</span>
			<span class="text">My Profile</span>
		</a>
		<a href = "<?php echo base_url()."home/logout" ?>" class="shortcut-link">
		<span class="shortcut-icon">
			<i class="fa fa-power-off"></i>
		</span>
			<span class="text">Logout</span>

		</a>
	</div><!-- /grey-container --><?php */?>
	
    <div class="grey-container nav-container full-nav">
    <div class="logo col-md-3">
            <a href="http://members.launchmyempire.com/home/" class="brand">
                <img src="<?php echo base_url()."img/mylogo.png"; ?>" style=" margin-top: -6px;" />
            </a>
        </div>
        <div class="menu-links col-md-7 center-menu">
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
        </div>
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
    
    <ul class="nav-notification clearfix col-md-2">
            <li class="profile dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              
                            <div class="detail">
                                <span><?php echo $userdata['full_name']; ?></span>

                               <?php /*?> <p class="grey"><?php echo $userdata['email']; ?></p><?php */?>
                               <img src="<?php echo base_url(); ?>img/profile/<?php echo $userdata['image']; ?>" alt="User Avatar">
                                 <span><i class="fa fa-angle-down"></i></span>
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
        
        </div><!-- /grey-container -->