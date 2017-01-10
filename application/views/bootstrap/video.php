<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="main-container">
    <?php include_once("top_nav.php"); ?>
    <?php

    if (isset($video_number_n) && ($video_number_n >= $module_videos_count)) {
        $module_number_n += 1;
        $video_number_n = 0;
    }

    if ($video_number == 1) {
        $module_number -= 1;
        $video_number = $countPrevModuleVideos + 1;
    }

    if (isset($user_id)) {
        $userid = $user_id;
    } else {
        $userid = '';
    }

    if (isset($module_id)) {
        $moduleid = $module_id;
    } else {
        $moduleid = '';
    }

    if (isset($selected_video[0])) {

        $video_link = base_url() . "home/video/" . $this->uri->segment(3) . "/" . $selected_video[0]['video_number'];
    } else {
        $video_link = '';
    }

    $module_link = base_url() . "home/module/" . $module_number_n;

    ?>

    <div class="padding-md">
        <div class="row">
            <div class="col-md-12">
                <div class="module-sec">
                    <div class="col-md-7">
                        <h4>MODULE # <?php echo $selected_video[0]['module_number']." ".$selected_video[0]['video_title']; ?></h4>
                        <p class="check-span2"><input type="checkbox" name="uservideo" id="uservideo"
                            <?php if(isset($selected_video[0]['video_watched']) && !empty($selected_video[0]['video_watched']) ) echo "checked"; ?>
                              onclick="UserVideo(<?php echo $userid ?>,<?php echo $moduleid; ?>,
                                  '<?php echo $module_link; ?>','<?php echo $video_link; ?>');">
                            <!--<span class="custom-checkbox"></span>-->
                            <label for="check-box"></label>
                            <span><?php echo "Video # " . $this->uri->segment(4); ?></span></p>
                    </div>
                    <div class="div-center col-md-5">
                        <div class="row">
                            <h5 class="col-md-7 progress-hd">MODULE PROGRESS</h5>

                            <div style="float: right;" class="col-md-5">
                                <div class="percent">
                                    <p style="display:none;"><?php echo $moduleProgress . "%"; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <!-- Owl Carousel -->

                    <?php if ($TotalModulesToOpen >= $this->uri->segment(3)) { ?>
                        <div class="panel-body">

                            <?php if (isset($selected_video[0])) echo $selected_video[0]['video_filename'] ?>

                            <div class="owl-carousel">
                                <?php foreach ($module_videos as $v): $video_links = base_url() . "home/video/" . $v->module_number . "/" . $v->video_number; ?>
                                    <a href="#" title="<?php echo $v->video_title; ?>"
                                       class="image-wrapper gallery-zoom"
                                       onclick="UserVideoLink(<?php echo $userid ?>,<?php echo $v->id; ?>,'<?php echo $video_links; ?>');">
                                        <div class="video-thumb">
                                            <div class="title">Lesson # <?php echo $v->video_number; ?></div>
                                            <img src="<?php echo $v->video_wistia_id; ?>"/>

                                            <div class="img-over">
                                                <h4><?php echo $v->video_title; ?></h4>
                                                <img src="<?php echo base_url(); ?>img/thumb-play.png" class="img-play"/>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <hr/>
                            <div id="container">
                                <div style="float: right;"><a
                                        href="<?php echo base_url(); ?>home/video/<?php echo $module_number_n ?>/<?php echo $video_number_n + 1; ?>"
                                        class="btn btn-primary">Next <i class="fa fa-chevron-right"></i></a></div>
                                <div style="float: left;"><a
                                        href="<?php echo base_url(); ?>home/video/<?php echo $module_number ?>/<?php echo $video_number -
                                            1; ?>"
                                        class="btn btn-primary" <?php if (($module_number == 0)) {
                                        echo "disabled";
                                    } ?>><i class="fa fa-chevron-left"></i> Prev</a></div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="panel-body">
                            <div class="alert alert-danger">
                                <strong>Module is Locked!.!</strong> Currently this module is locked in your account.
                            </div>
                            <hr/>
                            <div id="container">
                                <div style="float: right;"><a
                                        href="<?php echo base_url(); ?>home/video/<?php echo $module_number_n ?>/<?php echo $video_number_n + 1; ?>"
                                        class="btn btn-primary" <?php if ($module_number_n > $module_count) {
                                        echo "disabled";
                                    } ?>>Next <i class="fa fa-chevron-right"></i></a></div>
                                <div style="float: left;"><a
                                        href="<?php echo base_url(); ?>home/video/<?php echo $module_number; ?>/<?php echo $video_number - 1; ?>"
                                        class="btn btn-primary"><i class="fa fa-chevron-left"></i> Prev</a></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="buttons-ul">
                                <li><img src="<?php echo base_url(); ?>img/download-icon.png" class="down-icon">
                                    PRESENTATION
                                </li>
                                <li><img src="<?php echo base_url(); ?>img/download-icon.png" class="down-icon"> CHEAT
                                    SHEET
                                </li>
                                <li><img src="<?php echo base_url(); ?>img/download-icon.png" class="down-icon">
                                    TRANSCRIPT
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php if (isset($selected_video[0])) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center">
                                    <?php if (!empty($selected_video[0]['resource1'])): ?>
                                        <a href="<?php echo $selected_video[0]['resource1']; ?>" target="_blank"
                                           class="btn btn-danger quick-btn"><i class="fa fa-envelope"></i><span>Resource 1</span></a>
                                    <?php endif; ?>
                                    <?php if (!empty($selected_video[0]['resource2'])): ?>
                                        <a href="<?php echo $selected_video[0]['resource2']; ?>" target="_blank"
                                           class="btn btn-success quick-btn"><i
                                                class="fa fa-music"></i><span>Resource 2</span></a>
                                    <?php endif; ?>
                                    <?php if (!empty($selected_video[0]['resource3'])): ?>
                                        <a href="<?php echo $selected_video[0]['resource3']; ?>" target="_blank"
                                           class="btn btn-info quick-btn"><i class="fa fa-picture-o"></i><span>Resource 3</span></a>
                                    <?php endif; ?>
                                    <?php if (!empty($selected_video[0]['resource4'])): ?>
                                        <a href="<?php echo $selected_video[0]['resource4']; ?>" target="_blank"
                                           class="btn btn-warning quick-btn"><i class="fa fa-picture-o"></i><span>Resource 4</span></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="lesson-ul">
                                <h4>Lesson # 1: Time Stamps</h4>
                                <li><img src="<?php echo base_url(); ?>img/clock-icon.png"
                                         class="clock"><span>0:34</span> - What is a Niche
                                </li>
                                <li><img src="<?php echo base_url(); ?>img/clock-icon.png"
                                         class="clock"><span>0:34</span> - What is a Niche
                                </li>
                                <li><img src="<?php echo base_url(); ?>img/clock-icon.png"
                                         class="clock"><span>0:34</span> - What is a Niche
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /panel -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">jssor_1_slider_init();</script>
