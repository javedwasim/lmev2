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

                    <div class="tool-step">Step #16</div>
                    <div class="tool-title">How Will You Take Great Care of Your Customers?</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Please go through the entire <a href="#" class="step-link">Module #4</a> to help you make this decision. 
                        There are again, tons of options. I recommend going with an option that is less expensive and automated.
                    </p>
                    <div class="seperator"></div>  
                        
                    <p class="font-16">
                      Even consider just getting an Email address and setting it up with Google Apps and using that. It’s free, fast and good enough for now.
                      As you grow and start getting more customers, you can look into getting to a support system.
                    </p>
                    
                     <p class="font-16">
                         Either way, we wanted to show you the options and let you make that decision!
                     </p>
                    
                  
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Which customer support system do you want to use?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                            
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProductCustomerSupport($business_plan_id);
                                    //print_r($product_data);//die();
                                    $splitcustomersupport = explode("###",$product_data[0]->s16_customer_support);
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step17/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                                    
                                 <div class="form-group">
                                     <!--<input type="text" required="" name="s16_customer_support" value="<?php //print_r($product_data[0]->s16_customer_support); ?>" ng-model="plan.products[0].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter the name of the customer support system you are using here">-->
                                     <select class="form-control" name="s16_customer_support" id="s16_customer_support" onchange="GetSelectedTextValue(this)" required="">
                                         <option value="">Please Customer Support</option>
                                         <option value="Zendesk"<?php if($splitcustomersupport[0]=='Zendesk'){echo "selected";} ?>>Zendesk</option>
                                         <option value="Freshdesk"<?php if($splitcustomersupport[0]=='Freshdesk'){echo "selected";} ?>>Freshdesk</option>
                                         <option value="Deskro"<?php if($splitcustomersupport[0]=='Deskro'){echo "selected";} ?>>Deskro</option>
                                         <option value="Desk"<?php if($splitcustomersupport[0]=='Desk'){echo "selected";} ?>>Desk</option>
										 <option value="Kana"<?php if($splitcustomersupport[0]=='Kana'){echo "selected";} ?>>Kana</option>
										 <option value="Kayako"<?php if($splitcustomersupport[0]=='Kayako'){echo "selected";} ?>>Kayako</option>
										 <option value="UserVoice"<?php if($splitcustomersupport[0]=='UserVoice'){echo "selected";} ?>>UserVoice</option>
										 <option value="Helprace"<?php if($splitcustomersupport[0]=='Helprace'){echo "selected";} ?>>Helprace</option>
                                         <option value="other"<?php if($splitcustomersupport[0]=='other'){echo "selected";} ?>>Other</option>
                                    </select>
				 </div>
                                 
                                 <div class="form-group" id="other" <?php if( isset($splitcustomersupport[1])){echo 'style="display: block"'; }else{echo 'style="display: none"';} ?>>
                                     <input type="text" name="s16_customer_support_other" id="s16_customer_support_other" value="<?php if( isset($splitcustomersupport[1])){echo $splitcustomersupport[1];} ?>" class="form-control" placeholder="Please enter other customer support system.">
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step15/".$business_plan_id ?>">Back</a>
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php echo form_close(); ?>
        
    </div>
</div><!-- /main-container -->   
<script>

 function GetSelectedTextValue(ddlFruits) {
        var selectedText = s16_customer_support.options[s16_customer_support.selectedIndex].innerHTML;
        var selectedValue = s16_customer_support.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue=='other'){
            document.getElementById('other').style.display = "block";
            document.getElementById("s16_customer_support_other").required = true;
        }else{
            document.getElementById('other').style.display = "none";
            document.getElementById("s16_customer_support_other").required = false;
           $("#s16_customer_support_other").val("");

        }
    }

</script>