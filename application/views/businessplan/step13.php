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

                    <div class="tool-step">Step #13</div>
                    <div class="tool-title">Which Technology Do You Want To use?</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Please go through the entire <a href="#" class="step-link">Module #4</a> to help you make this decision. 
                        There are many options out there, each have their own advantage and disadvantage. In over 10 years of being a digital publisher, I am yet to see the “perfect” solution.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       Please don’t spend time searching for the perfect one right now. Simply find the one that has the most
                       features you want and is the <b>EASIEST</b> for you to launch – go from there!
                    </p>
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Which system do you want to use to build your classroom?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                            
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProductSystem($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step14/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                                    
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <input type="text" required="" name="s13_system" value="<?php print_r($product_data[0]->s13_system); ?>" ng-model="plan.products[0].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter System here">
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step12/".$business_plan_id ?>">Back</a> 
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