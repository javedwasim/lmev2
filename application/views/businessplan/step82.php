<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-container2">
    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="tool-content">
        <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                                
        <?php 
            $business_plan_id =  $this->uri->segment(3);
            $this->load->model('businessplans','',TRUE);
            $product_data = $this->businessplans->getBusinessModules($business_plan_id);
            //echo "<pre>"; print_r($product_data);//die();
            $looplength = count($product_data); 
            if($looplength==0){$looplength =5;}

            $product_type = $this->businessplans->getProductType($business_plan_id);
            $productype = $product_type[0]->s6_product_type;

        ?>
        <ng-form name="stepsForm" class="ng-pristine ng-invalid ng-invalid-required">
            <!-- uiView: undefined -->
            <ui-view class="ng-scope">
                <div class="row ml-100 ng-scope">
                    <div class="step-content">
                        <div class="tool-step">Step #8 Part 2</div>
                        <div class="tool-title">Let’s Dive Into Each Module Now!</div>
                        <div class="seperator"></div>   
                        <p class="font-16">
                            Let’s take the module titles you inserted before and create some bullet points.
                        </p>
                        <div class="seperator"></div>   

                        <p class="font-16">
                           These bullet points are key because they will make the product creation process far easier. If you’re doing a written, audio or video product, they act as an outline to follow. 
                           If you’re doing a video product, they can even each be their own video!
                        </p>
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading"><?php if($productype=='software'){echo "Primary Features";}else{echo "Bullets";} ?></h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                
                                <?php echo form_open_multipart('businessplan/step9/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                 <input name="recordidcount" id="recordidcount" class="recordidcount" required="" type="hidden" value="<?php echo $looplength; ?>" >
                                 <div ng-repeat="(key, module) in plan.modules" class="module-container ng-scope">
                                    <span class="module-name ng-binding">Please enter each bullet on separate line.</span>
                                    <div class="seperator"></div>
                                    <div class="separator"></div>
                                    <ul>
                                        <!-- ngRepeat: bullet in module.bullets track by $index -->
                                        <?php $index = 1; for($j=1;$j<=$looplength;$j++){ ?>
                                            <input name="recordid<?php echo $j; ?>" required="" type="hidden" value="<?php if(isset($product_data[$j-1]->id)){echo $product_data[$j-1]->id;} ?>" >
                                            <li  class="ng-scope" style="list-style: none;">
                                                <strong class="font-16"><?php if(isset($product_data[$j-1]->s8_module_name)){echo $product_data[$j-1]->s8_module_name;} ?></strong>
                                                <div class="form-group">
                                                    
                                                    <textarea class="form-control" required="" name="s8_module_bullets<?php echo $j; ?>" rows="3"><?php if(isset($product_data[$j-1]->s8_module_bullets)){echo $product_data[$j-1]->s8_module_bullets;} ?></textarea>
                                                    <span><a class="delete-bullet" ng-click="deleteBullet(key)"><i class="fa fa-trash"></i></a></span>
                                                    
                                                </div>
                                            </li><!-- end ngRepeat: bullet in module.bullets track by $index -->
                                        <?php } ?>
                                    </ul>
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step8/".$business_plan_id ?>">Back</a>
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php form_close(); ?>
        
    </div>
</div><!-- /main-container -->   

<script>

function showDiv() {
    document.getElementById('changemind1').style.display = "none";
   document.getElementById('changemind').style.display = "block";
   
   
}

function showVideos() {
   document.getElementById('changemind').style.display = "none"; 
   document.getElementById('changemind1').style.display = "block";
   
}

function hideDiv() {
   document.getElementById('changemind').style.display = "none";
    document.getElementById('changemind1').style.display = "none";
}
</script>