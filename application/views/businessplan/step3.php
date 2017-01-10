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

                    <div class="tool-step">Step #3</div>
                    <div class="tool-title">Find 5 of The Top Products In Your Market</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        One of the best ways to learn about a niche is to study some of the top products that are being sold in that market.  
                        Remember, we’re digital publishers – keep your focus on digital products only.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       Below, I want you to insert the URL of 5 products you find – just put the URL of the main sales page. 
                       This is for your own reference, this way, when you’re ready to move forward, you can come back and study the MODEL of the top 5 products.
                    </p>
                    <p class="font-16">
                        We will be looking for things like:
                    </p>
                   
                    <ul class="text-bold">
			<li>What hooks are they using to sell?</li>
			<li>What media are they using to deliver the product (written, audio or video)?</li>
			<li>What does their sales funnel look like?</li>
			<li>What are the common prices for the product?</li>
			<li>Who are there top promoters and affiliates…</li>
                    </ul>
                    
                    <p class="font-16">
                        Don’t worry about any of that right now. For now, it’s time to focus on just finding the top 5 products.  Also, don’t spend too much time on this. Even if there are 10 or 15 products you like, 
                        just pick 5 that your gut says. We will only be using this for research.
                    </p>
                    
                     <p class="font-16">
                        Top places to search for these products:
                    </p>
                    
                    <ul>
			<li><a href="http://clickbank.com" class="text-bold">www.Clickbank.com</a></li>
			<li><a href="http://jvzoo.com" class="text-bold">www.JVZoo.com</a></li>
			<li class="text-bold">Also spend some time on <a href="http://google.com">www.Google.com</a></li>
                    </ul>
                    <p class="font-16">
                        Find the most common communities in your niche and click around!  
                        You will find tons of the top names.
                    </p>
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Product URL</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php 
                                        if(isset($this->session->userdata['business_plan']['bp_id'])){
                                            $business_id = $this->session->userdata['business_plan']['bp_id'];
                                        }
                                ?>
                            
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getSelectedProdDetail($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step4/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                 
                                 <?php if(isset($product_data[0]->id)){ ?>
                                 <input name="r_s3_url1" required="" type="hidden" value="<?php print_r($product_data[0]->id); ?>" >
                                 <input name="r_s3_url2" required="" type="hidden" value="<?php print_r($product_data[1]->id); ?>" >
                                 <input name="r_s3_url3" required="" type="hidden" value="<?php print_r($product_data[2]->id); ?>" >
                                 <input name="r_s3_url4" required="" type="hidden" value="<?php print_r($product_data[3]->id); ?>" >
                                 <input name="r_s3_url5" required="" type="hidden" value="<?php print_r($product_data[4]->id); ?>" >
                                 <?php } ?>
<!--                                 <p>Please enter Product URL in separate line.</p>                                 
                                 <div class="form-group" ng-class="{'has-error': stepsForm.niche1.$dirty &amp;&amp; stepsForm.niche1.$invalid}">
                                     <textarea class="form-control" rows="3" name="s3_url"><?php print_r($view_data[0]->s3_url); ?>     </textarea>  
                                 </div>-->
                                 
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <input type="text" required="" name="s3_url1" value="<?php  if(isset($product_data[0]->id)){ print_r($product_data[0]->s3_url);} ?>" ng-model="plan.products[0].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter Product #1 URL here">
				</div>
                                 <div class="form-group" data-validated-as="products.1.url">
                                        <input type="text" required="" name="s3_url2" value="<?php if(isset($product_data[1]->id)){print_r($product_data[1]->s3_url);} ?>" ng-model="plan.products[1].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter Product #2 URL here">
				</div>
                                 <div class="form-group" data-validated-as="products.2.url">
                                        <input type="text" required="" name="s3_url3" value="<?php if(isset($product_data[2]->id)){print_r($product_data[2]->s3_url);} ?>" ng-model="plan.products[2].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter Product #3 URL here">
				</div>
                                 <div class="form-group" data-validated-as="products.3.url">
                                        <input type="text" required="" name="s3_url4" value="<?php if(isset($product_data[3]->id)){print_r($product_data[3]->s3_url);} ?>" ng-model="plan.products[3].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter Product #4 URL here">
				</div>
                                 <div class="form-group" data-validated-as="products.4.url">
                                        <input type="text" required="" name="s3_url5" value="<?php if(isset($product_data[4]->id)){print_r($product_data[4]->s3_url);} ?>" ng-model="plan.products[4].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter Product #5 URL here">
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step2/".$business_plan_id ?>">Back</a>  
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