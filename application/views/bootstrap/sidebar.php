<?php
if (isset($this->session->userdata['logged_in']['id'])) {

    $userid = $this->session->userdata['logged_in']['id'];
}

// Quick and dirty navigation.
$menu_item_default = 'index';
$menu_items = array(
    'index' => array(
        'label' => 'Home',
        'desc' => 'A list of all my magazines',
    ),
    'add' => array(
        'label' => 'Add',
        'desc' => 'Add a magazine to my collection',
    ),
);

// Determine the current menu item.
$menu_current = $menu_item_default;
// If there is a query for a specific menu item and that menu item exists...
if (@array_key_exists($this->uri->segment(2), $menu_items)) {
    $menu_current = $this->uri->segment(2);
}


?>
<aside class="skin-2  sidebar">
<div class="menu-logo">
<a href="http://members.launchmyempire.com/home/" class="">
            <img src="<?php echo base_url() . "img/mylogo.png"; ?>"/>
            
        </a>
<div class="toggle"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></div>
</div>
    <div class="sidebar-inner scrollable-sidebar">

        <!-- /user-block -->
        <div class="search-block">
            <div class="input-group">
                <?php echo form_open('search', array('class' => 'form-signin')); ?>
                <input type="text" class="form-control input-sm customwidth" name="search_module"
                       placeholder="Search">
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button>
						</span>
                <?php echo form_close() ?>
            </div>
            <!-- /input-group -->
        </div>
        <!-- /search-block -->
        <div class="main-menu">

            <ul>
            
            	<li class="singel-tab">
                    <a href="#">

						<span class="text sidebar-text">
							Overview / Introduction
						</span>
                    </a>
                </li>
            

                
                <?php
                $this->load->model('modules', '', TRUE);
                $count = 0;
                $module_count = count($modules);

                $TotalModulesToOpen = $unlockModules + 1;
                $CurrentUnlockedModule = 1;

                foreach ($modules as $module) {
                    $module_number = $module['module_number'];
                    $modules_videos = $this->modules->getAllModulesVideos($module_number);
                    $module_videos_count = count($modules_videos);
                    ?>
                    <?php
                    if ($TotalModulesToOpen >= $CurrentUnlockedModule) { ?>
                        <li class="openable open">

                            <a href="#" class="module_link">
                            Module # <?php echo $module['module_number'].""; ?>   
                            <span class="title-count"><?php echo "(".$module_videos_count." videos)"; ?></span>
                                <span class="text sidebar-text" onclick="open_page(<?php echo $module['module_number']; ?>);">
                                     
                                    <span class="title-span"><?php echo $module['module_title'] ?> </span>
                                </span>
                                
                            </a>
                            <?php
                            if ($TotalModulesToOpen >= $CurrentUnlockedModule) {
                                ?>
                                <span class="modulelock"><i class="fa fa-unlock fa-lg"></i></span>
                                <?php
                                $CurrentUnlockedModule += 1;
                            }

                            ?>
                            <ul class="submenu" <?php if ($module['module_number'] == $this->uri->segment(3)) { ?> style="display: block;" <?php } ?>>
                                <?php

                                //echo "<pre>"; print_r($modules_videos); die();
                                foreach ($modules_videos as $video) {
                                    $moduleid = $video['id'];
                                    $video_link = base_url() . "home/video/" . $module_number . "/" . $video['video_number'];
                                    $module_link = base_url() . "home/module/" . $module_number;
                                    ?>
                                    <li>
                                    
                                        <a href="#"
                                           onclick="UserVideoLink(<?php echo $userid ?>,<?php echo $moduleid; ?>,'<?php echo $video_link; ?>');">
                                           <span class="submenu-label">
                                           <img src="<?php echo base_url(); ?>img/play-icon.png" class="img-icon">
                                            
                                                <?php echo $video['video_title'] ?>
                                            </span>
                                        </a>
									
                                    
                                    <span style="float: right" class="check-span">
                                            <input type="checkbox" name="uservideo"
                                                   id="uservideo" <?php if ($video['video_watched'] == $moduleid) echo "checked"; ?>
                                                   value="<?php echo $video['video_watched'] . " " . $video['id']; ?>"
                                                   onclick="UserVideo(<?php echo $userid ?>,<?php echo $moduleid; ?>,'<?php echo $module_link; ?>','');">
                                                   <label for="check-box"></label>
                                            <!--<span class="custom-checkbox"></span>-->
                                        </span>
                                    
                                    </li>
                                <?php } ?>
                            </ul>

                        </li>
                    <?php } else { ?>
                        <li class="openable open">
                            <a href="#" class='expand'>

                            </a>
                            <a href="#" class='module_link'>
                            <span class="text"
                                  onclick="lock_module();">
                            <?php echo $module['module_title']; ?>
                            </span>
                            </a>
                            <span class="modulelock"><i class="fa fa-lock fa-lg"></i></span>
                            <ul class="submenu" <?php if ($module['module_number'] == $this->uri->segment(3)) { ?> style="display: block;" <?php } ?>>
                                <?php
                                $module_number = $module['module_number'];
                                $modules_videos = $this->modules->getAllModulesVideos($module_number);
                                foreach ($modules_videos as $video) { ?>
                                    <li><a href="#" onclick="lock_module();"><span
                                                class="submenu-label"><?php echo $video['video_title'] ?></span></a>
                                    </li>
                                <?php } ?>
                            </ul>

                        </li>


                    <?php }
                } ?>
            </ul>

        </div>
        <!-- /main-menu -->
    </div>
    <!-- /sidebar-inner -->
</aside>