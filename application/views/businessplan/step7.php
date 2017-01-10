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

                    <div class="tool-step">Step #7</div>
                    <div class="tool-title">Why Should Someone Buy Your Product?</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Here are some important questions to answer.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       This may take some time to research. Don’t rush it. At the same time, don’t worry – 
                       you can always come back and update or edit what you put here. The main thing to figure out is “WHY” exactly is
                    </p>
                    
                   
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">What’s in it for them?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                                
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProdyctBuyReason($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step8/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <input type="text" required="" name="s7_product_url" value="<?php echo $product_data[0]->s7_product_url ?>" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Find a URL for your product">
				 </div>
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <input type="text" required="" name="s7_product_name" value="<?php echo $product_data[0]->s7_product_name ?>" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="What is the name of your product?">
				 </div>
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <textarea class="form-control" required="" name="s7_product_usp" rows="3" placeholder="What is your USP (Unique Selling Proposition)?"><?php echo $product_data[0]->s7_product_usp ?></textarea>
				 </div>
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <textarea class="form-control" required="" name="s7_product_benifit" rows="3" placeholder="What is the #1 benefit someone will get if they buy and use your product?"><?php echo $product_data[0]->s7_product_benifit ?></textarea>
				 </div>
                                 
                                
                                <div class="separator"></div>
                         </div>
                    </div>
                </div>
           </ui-view>
       </ng-form>
        <div class="seperator"></div>
        <div class="seperator"></div>
        <div class="row ml-100 mr-100 mt-25">
            <div class="col-md-12 text-center">
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step6/".$business_plan_id ?>">Back</a> 
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