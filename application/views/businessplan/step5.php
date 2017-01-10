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

                        <div class="tool-step">Step #5</div>
                        <div class="tool-title">Determine Your Price</div>
                        <div class="seperator"></div>   
                        <p class="font-16">
                            You’ve seen what others in your market are doing. You’ve seen what is popular.
                        </p>
                        <div class="seperator"></div>   

                        <p class="font-16">
                           It’s time to determine what you want to price your <b>MAIN</b> product at. This does not include any upsells or downsells, just the price of the main product.
                        </p>
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading"> Main Product (Front End / Basic / OTO1) Price</h1>  
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
                                    $product_data = $this->businessplans->getMainPrice($business_plan_id);
                                   // print_r($product_data);//die();
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step6/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >

                                 <div class="form-group input-group" data-validated-as="products.0.url">
                                     <span class="input-group-addon">$</span><input type="text" required="" name="s5_main_product_price" value="<?php echo $product_data[0]->s5_main_product_price; ?>"  class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter Main Product price here">
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step4/".$business_plan_id ?>">Back</a>
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