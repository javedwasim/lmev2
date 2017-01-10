<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-container2">
    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="tool-content">

        <ng-form name="stepsForm" class="ng-pristine ng-invalid ng-invalid-required">
            <!-- uiView: undefined -->
            <ui-view class="ng-scope">
                <div class="row ml-100 ng-scope">
                    <div class="step-content">

                    <div class="tool-step">Step #6</div>
                    <div class="tool-title">Determine The Type of Product You Will Create</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        There are just 3 main choices to be had.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       Depending on your decision, there may be a couple of more “sub-decisions” to make as well. Please make sure to look at the type of product that is common in your market.  
                       Try to stick in the same trend. Also, remember, the price you chose will largely influence the type of product you create!
                    </p>
                    <p class="font-16">
                        Remember, you can always change this later too – so don’t worry too much.
                    </p>
                    
                    <p class="font-16"> Also – you can definitely do a combination of all or part of the below. However, for now, I just want you to
                        think about what the <strong>MAIN</strong> media will be that you use.
                    </p>
                    
                    <div class="col-md-8 col-lg-offset-2 mt-25">
                        <div class="col-md-12 text-center">
                            <span class="text-bold recomandation">My Recommendation</span>
                            <span class="blue-bg-button-like" ng-show="plan.main_product.price > 100">Video (or at least have video elements)</span>      <span class="italic recomandationp">** Our recommendation is purely determined by the price point you have decided to make your product. However, please recognize that any combination is possible and this is not written in stone. There are many exceptions to these standard rules!</span>
                        </div>
                    </div>
                   
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">So, what’s it going to be?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                                
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProductType($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step7/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                 <div class="form-group ng-scope" style="text-align: center;">
                                     
                                    <label class="label-radio inline">
                                        <input type="radio" name="s6_product_type" id="s6_product_type" onclick="hideDiv()" value="written" <?php if($product_data[0]->s6_product_type=='written'){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            Written
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" name="s6_product_type" id="s6_product_type" onclick="showDiv()" value="audio" <?php if($product_data[0]->s6_product_type=='audio'){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            Audio
                                    </label>
                                    <label class="label-radio inline">
                                         <input type="radio" name="s6_product_type" id="s6_product_type" onclick="showVideos()" value="video" <?php if($product_data[0]->s6_product_type=='video'){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            Video
                                    </label>
                                     
                                     <label class="label-radio inline">
                                         <input type="radio" name="s6_product_type" id="s6_product_type" onclick="showSoftwate()" value="software" <?php if($product_data[0]->s6_product_type=='software'){echo "checked";} ?>>
                                          <span class="custom-radio"></span>
                                           Software
                                    </label>
                                </div>
                                <div class="separator"></div>
                                
                                 
                                 <div class="form-group ng-scope" <?php if($product_data[0]->s6_product_type=='audio'){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?> id="changemind">
                                     <hr/>
                                     
                                     <div style="text-align:center">
                                        <span class="content-action-title-small"><strong>Select Audio Type</strong></span>    
                                        <label class="label-radio inline">
                                            <input type="radio" name="s6_audio_type_detail" id="s6_audio_type_detail" value="self create" <?php if($product_data[0]->s6_product_type_detail=='self create'){echo 'checked';}?>>
                                               <span class="custom-radio"></span>
                                               Self Create Recordings
                                       </label>
                                        <label class="label-radio inline">
                                            <input type="radio" name="s6_audio_type_detail" id="s6_audio_type_detail" value="Mostly interview experts for content" <?php if($product_data[0]->s6_product_type_detail=='Mostly interview experts for content'){echo 'checked';}?>>
                                               <span class="custom-radio"></span>
                                                Mostly interview experts for content  
                                       </label>
                                    </div>
                                 </div>
                                
                                <div class="form-group ng-scope" <?php if($product_data[0]->s6_product_type=='software'){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?> id="changemind2">
                                    <hr/>

                                    <div style="text-align:center">
                                       <span class="content-action-title-small"><strong>Select Software Type</strong></span>    
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_softwate_type_detail" id="s6_softwate_type_detail" value="plugin" <?php if($product_data[0]->s6_product_type_detail=='plugin'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                              Plugin
                                      </label>
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_softwate_type_detail" id="s6_softwate_type_detail" value="web_app" <?php if($product_data[0]->s6_product_type_detail=='web_app'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                               Web Application
                                      </label>
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_softwate_type_detail" id="s6_softwate_type_detail" value="desktop_app" <?php if($product_data[0]->s6_product_type_detail=='desktop_app'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                               Desktop Application
                                      </label>
                                       
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_softwate_type_detail" id="s6_softwate_type_detail" value="mobile_app" <?php if($product_data[0]->s6_product_type_detail=='mobile_app'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                               Mobile App
                                      </label>
                                    </div>
                               </div>
                                
                                <div class="form-group ng-scope" <?php if($product_data[0]->s6_product_type=='video'){echo 'style="display: block;"';}else{echo 'style="display: none;"';} ?> id="changemind1">
                                    <hr/>

                                    <div style="text-align:center">
                                       <span class="content-action-title-small"><strong>Select Video Type</strong></span>    
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_video_type_detail" id="s6_video_type_detail" value="face-camera" <?php if($product_data[0]->s6_product_type_detail=='face-camera'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                              Face to face camera
                                      </label>
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_video_type_detail" id="s6_video_type_detail" value="Screen-Capture" <?php if($product_data[0]->s6_product_type_detail=='Screen-Capture'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                               Screen Capture
                                      </label>
                                       <label class="label-radio inline">
                                           <input type="radio" name="s6_video_type_detail" id="s6_video_type_detail" value="video-created" <?php if($product_data[0]->s6_product_type_detail=='video-created'){echo 'checked';}?>>
                                              <span class="custom-radio"></span>
                                               Record audio first, get video created
                                      </label>
                                    </div>
                               </div>
                                
                         </div>
                    </div>
                </div>
           </ui-view>
       </ng-form>
        <div class="seperator"></div>
        <div class="seperator"></div>
        <div class="row ml-100 mr-100 mt-25">
            <div class="col-md-12 text-center">
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step5/".$business_plan_id ?>">Back</a> 
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php form_close(); ?>
        
    </div>
</div><!-- /main-container -->   

<script>
document.getElementById("s6_product_type").required = true;
function showDiv() {
   document.getElementById("s6_product_type").required = false;   
   document.getElementById("s6_video_type_detail").required = false;
   document.getElementById("s6_audio_type_detail").required = true;
   document.getElementById("s6_softwate_type_detail").required = false;
   
   document.getElementById('changemind1').style.display = "none";
   document.getElementById('changemind').style.display = "block";
   document.getElementById('changemind2').style.display = "none";
   
   
}

function showVideos() {
    
   document.getElementById("s6_product_type").required = false;   
   document.getElementById("s6_video_type_detail").required = true;
   document.getElementById("s6_audio_type_detail").required = false;
   document.getElementById("s6_softwate_type_detail").required = false;
    
   document.getElementById('changemind').style.display = "none"; 
   document.getElementById('changemind1').style.display = "block";
   document.getElementById('changemind2').style.display = "none";
   
}
function showSoftwate(){
   document.getElementById("s6_product_type").required = false;   
   document.getElementById("s6_video_type_detail").required = false;
   document.getElementById("s6_audio_type_detail").required = false;
   document.getElementById("s6_softwate_type_detail").required = true;
   
   
   document.getElementById('changemind2').style.display = "block";
   document.getElementById('changemind').style.display = "none"; 
   document.getElementById('changemind1').style.display = "none";
   
   
}
function hideDiv() {
    
   document.getElementById("s6_product_type").required = true;   
   document.getElementById("s6_video_type_detail").required = false;
   document.getElementById("s6_audio_type_detail").required = false;
   document.getElementById("s6_softwate_type_detail").required = false;
    
   document.getElementById('changemind').style.display = "none";
   document.getElementById('changemind1').style.display = "none";
   document.getElementById('changemind2').style.display = "none";
}
</script>