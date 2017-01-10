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

                    <div class="tool-step">Step #15</div>
                    <div class="tool-title">How Will You Transact Sales & Collect Revenue?</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Please go through the entire <a href="#" class="step-link">Module #4</a> to help you make this decision. 
                        There are again, tons of options. If you’re interested in being fast and have the least headaches – I recommend you go with either of the following!
                    </p>
                    <div class="seperator"></div>  
                    <ul>
			<li><a href="http://www.clickbank.com/" class="step-link">Clickbank</a></li>
			<li><a href="https://www.paypal.com/" class="step-link">Paypal</a></li>
			<li><a href="https://stripe.com/relay" class="step-link">Stripe.com</a></li>
                    </ul>
                        
                    <p class="font-16">
                      These are the most automated systems. However, each can have it’s own limitations. 
                      You also want to make sure that this system works with your Content Management System that you chose before. 
                    </p>
                    
                  
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Which payment processor do you want to use?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                            
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProductPaymentProcess($business_plan_id);
                                    //print_r($product_data);//die();
                                     $splitpaymentprocess = explode("###",$product_data[0]->s15_payment_process);
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step16/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                                    
                                 <div class="form-group" data-validated-as="products.0.url">
                                     <!--<input type="text" required="" name="s15_payment_process" value="<?php print_r($product_data[0]->s15_payment_process); ?>" ng-model="plan.products[0].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter the name of the payment processor you are using here">-->
                                     <select class="form-control" name="s15_payment_process" required="" id="s15_payment_process" onchange="GetSelectedTextValue(this)">
                                         <option value="">Please Select Payment Processor</option>
                                         <option value="Clickbank"<?php if($splitpaymentprocess[0]=='Clickbank'){echo "selected";} ?>>Clickbank</option>
                                         <option value="PayPal"<?php if($splitpaymentprocess[0]=='PayPal'){echo "selected";} ?>>PayPal</option>
                                         <option value="Stripe"<?php if($splitpaymentprocess[0]=='Stripe'){echo "selected";} ?>>Stripe</option>
                                         <option value="SamCart"<?php if($splitpaymentprocess[0]=='SamCart'){echo "selected";} ?>>SamCart</option>
                                         <option value="SWReg"<?php if($splitpaymentprocess[0]=='SWReg'){echo "selected";} ?>>SWReg</option>
                                         <option value="WorldPay"<?php if($splitpaymentprocess[0]=='WorldPay'){echo "selected";} ?>>WorldPay</option>
                                         <option value="SagePay"<?php if($splitpaymentprocess[0]=='SagePay'){echo "selected";} ?>>SagePay</option>
										 <option value="other"<?php if($splitpaymentprocess[0]=='other'){echo "selected";} ?>>Other</option>
                                    </select>
				 </div>
                                 
                                 <div class="form-group"  id="other" <?php if( isset($splitpaymentprocess[1])){echo 'style="display: block"'; }else{echo 'style="display: none"';} ?>>
                                     <input type="text" name="s15_payment_process_other" id="s15_payment_process_other" value="<?php if( isset($splitpaymentprocess[1])){echo $splitpaymentprocess[1];} ?>" class="form-control" placeholder="Please enter other payment process.">
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step14/".$business_plan_id ?>">Back</a>
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php echo form_close(); ?>
        
    </div>
</div><!-- /main-container -->   
<script>

 function GetSelectedTextValue(ddlFruits) {
        var selectedText = s15_payment_process.options[s15_payment_process.selectedIndex].innerHTML;
        var selectedValue = s15_payment_process.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue=='other'){
            document.getElementById('other').style.display = "block";
            document.getElementById("s15_payment_process_other").required = true;
        }else{
            document.getElementById('other').style.display = "none";
            document.getElementById("s15_payment_process_other").required = false;
           $("#s15_payment_process_other").val("");

        }
    }

</script>