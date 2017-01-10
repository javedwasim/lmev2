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
<aside class="skin-2 sidebar">
<div class="menu-logo">
<a href="http://members.launchmyempire.com/home/" class="">
            <img src="<?php echo base_url() . "img/mylogo.png"; ?>"/>
            
        </a>
<div class="toggle"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></div>
</div>
    <div class="sidebar-inner scrollable-sidebar">
        <?php /*?><div class="user-block clearfix">
            <img src="<?php echo base_url(); ?>img/profile/<?php echo $userdata['image'] ?>" alt="User Avatar">

            <div class="detail">
                <strong><?php echo "Welcome " . $userdata['full_name']; ?></strong>
                <ul class="list-inline">
                    <li><?php echo $userdata['email']; ?></li>
                </ul>
            </div>
        </div><?php */?>
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
                <li class="">
                    <a href="<?php echo base_url() . "home/"; ?>">
						<!--<span class="menu-icon">
							<i class="fa fa-home fa-lg"></i>
						</span>-->
						<span class="text">
							Home
						</span>
                        <!--<span class="menu-hover"></span>-->
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo base_url() . "businessplan/"; ?>">
						<!--<span class="menu-icon">
							<i class="fa fa-signal fa-lg"></i>
						</span>-->
						<span class="text">
							Business Plan Creator Tool
						</span>
                        <!--<span class="menu-hover"></span>-->
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo base_url() . "ebook/"; ?>">
						<!--<span class="menu-icon">
							<i class="fa fa-book fa-lg"></i>
						</span>-->
						<span class="text">
							E-Book Generator Tool
						</span>
                        <!--<span class="menu-hover"></span>-->
                    </a>
                </li>

            </ul>

        </div>
        <!-- /main-menu -->
    </div>
    <!-- /sidebar-inner -->
</aside>