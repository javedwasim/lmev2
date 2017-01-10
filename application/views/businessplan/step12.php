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

                    <div class="tool-step">Step #12</div>
                    <div class="tool-title">Are You Going To Want Some Additional Help For Upsells?</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        This is a quick step. I just need you to decide whether you are going to want any additional help creating your product. 
                        This is good for you to know so that you can start that process soon!
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                      <a href="#">Module #2</a> 
                      goes into great detail about how to find and properly use outsourcing!</p>
                    </p>
                    
                   
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="row">
                        <div class="col-md-6" >
                            <div class="panel panel-default products" style = "border: 2px solid #c4c3c7;">
                                <h2 class="business-form-heading">Will you use outsourcing?</h2>  
                                <div class="panel-body">
                                    <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                                
                                    <?php 
                                        $business_plan_id =  $this->uri->segment(3);
                                        $this->load->model('businessplans','',TRUE);
                                        $product_data = $this->businessplans->getProductAdditionalUpsell($business_plan_id);
                                        //print_r($product_data);//die();

                                    ?>
                                    <?php echo form_open_multipart('businessplan/step13/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?> 
                                        <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">&nbsp;</label>
                                            <div class="col-lg-10">
                                                <label class="label-radio inline paddgin-right">
                                                    <input type="radio" name="s12_outsourcing" value="yes" <?php if($product_data[0]->s12_outsourcing=='yes'){echo "checked";} ?>>
                                                        <span class="custom-radio"></span>
                                                        Yes
                                                </label>
                                                <label class="label-radio inline">
                                                    <input type="radio" name="s12_outsourcing" value="no" <?php if($product_data[0]->s12_outsourcing=='no'){echo "checked";} ?>>
                                                        <span class="custom-radio"></span>
                                                        No
                                                </label>
                                            </div><!-- /.col -->
                                        </div>    
                                </div>
                            </div><!-- /panel -->
                        </div><!-- /.col -->
                        <div class="col-md-6" >
                            <div class="panel panel-default products" style = "border: 2px solid #c4c3c7; ">
                                <h2 class="business-form-heading">Will you use expert interviews?</h2>  
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">&nbsp;</label>
                                        <div class="seperator"></div>
                                        
                                        <div class="col-lg-10">
                                            <label class="label-radio inline paddgin-right">
                                                <input type="radio" name="s12_interview" value="yes" <?php if($product_data[0]->s12_interview=='yes'){echo "checked";} ?>>
                                                    <span class="custom-radio"></span>
                                                    Yes
                                            </label>
                                            <label class="label-radio inline">
                                                <input type="radio" name="s12_interview" value="no" <?php if($product_data[0]->s12_interview=='no'){echo "checked";} ?>>
                                                    <span class="custom-radio"></span>
                                                    No
                                            </label>
                                            <div class="seperator"></div>
                                        </div><!-- /.col -->
                                    </div>    
                                </div>
                            </div><!-- /panel -->
                        </div><!-- /.col -->
                    </div>    
                </div>
           </ui-view>
       </ng-form>
        <div class="seperator"></div>
        <div class="seperator"></div>
        <div class="row ml-100 mr-100 mt-25">
            <div class="col-md-12 text-center">
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step11/".$business_plan_id ?>">Back</a> 
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