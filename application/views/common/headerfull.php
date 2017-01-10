<?php
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Launch My Empire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">

    <!-- Pace -->
    <link href="<?php echo base_url(); ?>css/pace.css" rel="stylesheet">

    <!-- Color box -->
    <link href="<?php echo base_url(); ?>css/colorbox/colorbox.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo base_url(); ?>css/morris.css" rel="stylesheet"/>
    <!-- Full Calendar -->
    <link href='<?php echo base_url(); ?>css/fullcalendar.css' rel='stylesheet' />
    
    <!-- Datatable -->
    <link href="<?php echo base_url(); ?>css/jquery.dataTables_themeroller.css" rel="stylesheet">
    
    <!-- Endless -->
    <link href="<?php echo base_url(); ?>css/endless.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/endless-skin.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

</head>

<body class="overflow-hidden">
<!-- Overlay Div -->
<!--<div id="overlay" class="transparent"></div>-->

<!--<a href="" id="theme-setting-icon"><i class="fa fa-cog fa-lg"></i></a>-->
<div id="theme-setting">
    <div class="title">
        <strong class="no-margin">Skin Color</strong>
    </div>
    <div class="theme-box">
        <a class="theme-color" style="background:#323447" id="default"></a>
        <a class="theme-color" style="background:#efefef" id="skin-1"></a>
        <a class="theme-color" style="background:#a93922" id="skin-2"></a>
        <a class="theme-color" style="background:#3e6b96" id="skin-3"></a>
        <a class="theme-color" style="background:#635247" id="skin-4"></a>
        <a class="theme-color" style="background:#3a3a3a" id="skin-5"></a>
        <a class="theme-color" style="background:#495B6C" id="skin-2"></a>
    </div>
    <div class="title">
        <strong class="no-margin">Sidebar Menu</strong>
    </div>
    <div class="theme-box">
        <label class="label-checkbox">
            <input type="checkbox" checked id="fixedSidebar">
            <span class="custom-checkbox"></span>
            Fixed Sidebar
        </label>
    </div>
</div><!-- /theme-setting -->

<div id="wrapper" class="preload">
    <?php /*?><div id="top-nav" class="fixed skin-2 gradient-navbar">
        <a href="http://members.launchmyempire.com/home/" class="brand">
            <img src="<?php echo base_url()."img/mylogo.png"; ?>" style=" margin-top: -6px;" />
            <span class="text-toggle"> </span>
        </a><!-- /brand -->
        <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <ul class="nav-notification clearfix">
            <li class="profile dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <strong><?php echo "Settings";  ?></strong>
                    <span><i class="fa fa-chevron-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="clearfix" href="#">
                            <img src="<?php echo base_url(); ?>img/profile/<?php echo $userdata['image']; ?>" alt="User Avatar">
                            <div class="detail">
                                <strong><?php echo $userdata['full_name']; ?></strong>
                                <p class="grey"><?php echo $userdata['email']; ?></p>
                            </div>
                        </a>
                    </li>
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>home/profile" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" class="main-link logoutConfirm_open" href="http://members.launchmyempire.com/home/logout"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
                </ul>
            </li>
        </ul>
    </div><?php */?><!-- /top-nav-->
    

