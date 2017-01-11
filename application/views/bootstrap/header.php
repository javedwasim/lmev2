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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Launch My Empire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <style>

        .jssorb03 {
            position: absolute;
        }
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
            position: absolute;
            /* size of bullet elment */
            width: 21px;
            height: 21px;
            text-align: center;
            line-height: 21px;
            color: white;
            font-size: 12px;
            background: url('<?php echo base_url(); ?>img/b03.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }


        .jssora03l, .jssora03r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('<?php echo  base_url(); ?>img/a03.png') no-repeat;
            overflow: hidden;
        }
        .jssora03l { background-position: -3px -33px; }
        .jssora03r { background-position: -63px -33px; }
        .jssora03l:hover { background-position: -123px -33px; }
        .jssora03r:hover { background-position: -183px -33px; }
        .jssora03l.jssora03ldn { background-position: -243px -33px; }
        .jssora03r.jssora03rdn { background-position: -303px -33px; }
        .jssora03l.jssora03lds { background-position: -3px -33px; opacity: .3; pointer-events: none; }
        .jssora03r.jssora03rds { background-position: -63px -33px; opacity: .3; pointer-events: none; }

    </style>

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
    <link href='<?php echo base_url(); ?>css/fullcalendar.css' rel='stylesheet'/>

    <!-- Endless -->
    <link href="<?php echo base_url(); ?>css/endless.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/endless-skin.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	
    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/owl.theme.default.css" rel="stylesheet">
	<!--<link href="<?php echo base_url(); ?>css/slick.css" rel="stylesheet" media="screen">-->
    <!-- Favicon-->
    <link rel="icon" href="<?= base_url() ?>/favicon.ico" type="image/ico">
    <link rel="icon" href="<?= base_url() ?>/circle.css" type="image/ico">
    
    


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
</div>
<!-- /theme-setting -->

<div id="wrapper" class="preload">
    <!-- /top-nav-->
    <script charset="ISO-8859-1" src="//fast.wistia.com/assets/external/E-v1.js" async></script>
    <script src="<?php echo base_url(); ?>js/jssor.slider-22.0.15.min.js" type="text/javascript" data-library="jssor.slider" data-version="22.0.15"></script>

    <script>
        function open_page(pageNumber) {
            window.location = "<?php echo base_url(); ?>home/module/" + pageNumber;
            return false;
        }

        function lock_module() {
            $("#simpleModal").modal("show");
        }

        function UserVideo(user_id, module_id, url,videoLink) {
            var BASE_URL = "<?php echo base_url();?>";

            $.ajax({

                type: "POST",
                url: BASE_URL + "home/uservideos",
                data: {module_id: module_id, user_id: user_id},
                dataType: "text",
                cache: false,
                success: function (data) {

                    if(videoLink == ''){
                        window.location.href = url;
                    }else{

                        window.location.href = videoLink;
                    }

                }
            });// you have missed this bracket
            return false;
        }


        function UserVideoLink(user_id, module_id, url) {
            var BASE_URL = "<?php echo base_url();?>";

            $.ajax({

                type: "POST",
                url: BASE_URL + "home/uservideolink",
                data: {module_id: module_id, user_id: user_id},
                dataType: "text",
                cache: false,
                success: function (data) {

                    window.location.href = url;
                }
            });
            return false;
        }

    </script>

