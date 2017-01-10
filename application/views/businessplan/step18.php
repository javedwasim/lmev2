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

                    <div class="tool-step">Step #18</div>
                    <div class="tool-title">You Have 3 Options – Pick Your Favorite!</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Please focus on <a href="#" class="step-link">Module #5</a> 
                        and get a full detail on every kind of system that exists! You basically have 3 options:
                    </p>
                    <div class="seperator"></div>  
                    <ul>
			<li><b>#1 – Written Sales Letter</b></li>
			<li><b>#2 – Video Sales Letter</b></li>
			<li><b>#3 – Webinars</b></li>
                    </ul>
                        
                    <p class="font-16">
                      Each of them have their own benefits and negatives. They each also have their own complexity or ease of creation. When you create a digital publishing business, 
                      it’s the sales part that can actually take you the longest time and that’s OK!
                    </p>
                    
                     <p class="font-16">
                       continue.................
                     </p>
                    
                  
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Are you going to outsource your copywriting?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                            
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProductCopyWrite($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/finish/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                 <div class="col-lg-10" style="text-align: center">
                                    <label class="label-radio inline">
                                        <input type="radio" required="" name="s18_copywriting" value="no" <?php if($product_data[0]->s18_copywriting == 'no'){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            No, I will write my own copy
                                    </label>
                                    <label class="label-radio inline">
                                        <input type="radio" required="" name="s18_copywriting" value="yes" <?php if($product_data[0]->s18_copywriting == 'yes'){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            Yes, I want to find a writer
                                    </label>
                                     
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step17/".$business_plan_id ?>">Back</a> 
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php echo form_close(); ?>
        
    </div>
</div><!-- /main-container -->   

<script>

function showDiv() {
   document.getElementById('changemind').style.display = "block";
}

function hideDiv() {
   document.getElementById('changemind').style.display = "none";
}
</script>