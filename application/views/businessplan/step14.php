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

                    <div class="tool-step">Step #14</div>
                    <div class="tool-title">How Will You Reach Your Prospects & Customers?</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Please go through the entire <a href="#" class="step-link">Module #4</a> to help you make this decision. There are many options out there, each have their own advantage and disadvantage. 
                        For what it is worth, I am personally a Founder of an autoresponder called SendLane.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       We have built this platform from the ground up and truly feel that it is the best for all digital marketers (especially publishers). We are growing rapidly, adding new features almost 
                       every month and fast becoming the de-facto service for all digital publishers!
                    </p>
                    
                    <p class="font-16">
                       <b>Claim your FREE 90 Day Trial Account:</b>
                       <a href="https://sendlane.com/users/signup/plan/PUBACADEMY" class="step-link" target="_blank">Click Here To Claim Your Free Account</a>     
                    </p>
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Which autoresponder do you want to use?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                            
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getProductProspect($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                    $splitautoresponder = explode("###",$product_data[0]->s14_autoresponder);
                                    //print_r($splitautoresponder); 
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step15/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                                    
                                 <div class="form-group" data-validated-as="products.0.url">
<!--                                 <input type="text" required="" name="s14_autoresponder" value="<?php //print_r($product_data[0]->s14_autoresponder); ?>" ng-model="plan.products[0].url" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter the name of the autoresponder you are using here">-->
                                     <select class="form-control" name="s14_autoresponder" required="" id="s14_autoresponder" onchange="GetSelectedTextValue(this)">
                                         <option value="">Please Select Autoresponder</option>
                                         <option value="Aweber"<?php if($splitautoresponder[0]=='Aweber'){echo "selected";} ?>>Aweber</option>
                                         <option value="MailChimp"<?php if($splitautoresponder[0]=='MailChimp'){echo "selected";} ?>>MailChimp</option>
                                         <option value="SendLane"<?php if($splitautoresponder[0]=='SendLane'){echo "selected";} ?>>SendLane</option>
                                         <option value="GetResponse"<?php if($splitautoresponder[0]=='GetResponse'){echo "selected";} ?>>GetResponse</option>
                                         <option value="iContact"<?php if($splitautoresponder[0]=='iContact'){echo "selected";} ?>>iContact</option>
                                         <option value="ContantContact"<?php if($splitautoresponder[0]=='ContantContact'){echo "selected";} ?>>ContantContact</option>
                                         <option value="SendFree"<?php if($splitautoresponder[0]=='SendFree'){echo "selected";} ?>>SendFree</option>
                                         <option value="MailiGen"<?php if($splitautoresponder[0]=='MailiGen'){echo "selected";} ?>>MailiGen</option>
                                         <option value="ListWire"<?php if($splitautoresponder[0]=='ListWire'){echo "selected";} ?>>ListWire</option>
                                         <option value="QuickTell"<?php if($splitautoresponder[0]=='QuickTell'){echo "selected";} ?>>QuickTell</option>
                                         <option value="OfficeAutoPilot"<?php if($splitautoresponder[0]=='OfficeAutoPilot'){echo "selected";} ?>>OfficeAutoPilot</option>
                                         <option value="other"<?php if($splitautoresponder[0]=='other'){echo "selected";} ?>>Other</option>
                                    </select>
				 </div>
                                 
                                 <div class="form-group" id="other" <?php if( isset($splitautoresponder[1])){echo 'style="display: block"'; }else{echo 'style="display: none"';} ?>>
                                     <input type="text"  name="s14_autoresponder_other" id="s14_autoresponder_other" value="<?php if( isset($splitautoresponder[1])){echo $splitautoresponder[1];} ?>" class="form-control" placeholder="Please enter other autoresponser.">
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step13/".$business_plan_id ?>">Back</a>
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php echo form_close(); ?>
        
    </div>
</div><!-- /main-container -->   

<script>

 function GetSelectedTextValue(ddlFruits) {
        var selectedText = s14_autoresponder.options[s14_autoresponder.selectedIndex].innerHTML;
        var selectedValue = s14_autoresponder.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue=='other'){
            document.getElementById('other').style.display = "block";
            document.getElementById("s14_autoresponder_other").required = true;
        }else{
            document.getElementById('other').style.display = "none";
            document.getElementById("s14_autoresponder_other").required = false;
           $("#s14_autoresponder_other").val("");

        }
    }

</script>