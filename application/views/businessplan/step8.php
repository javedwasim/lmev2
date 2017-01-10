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

                    <div class="tool-step">Step #8</div>
                    <div class="tool-title">Let’s Get a Detailed Idea of What’s Inside Your Product</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        This is one of the most important steps. I also think this step is about 90% of the battle.
                        Once you get this step down – it’s going to be far easier from here.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       Remember, don’t stress. You can always come back and edit it later as you get more ideas!
                    </p>
                   </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
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
                            <h1 class="business-form-heading"><?php if($productype=='software'){echo "Primary Features";}else{echo "Modules";} ?></h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                            
                            <?php echo form_open_multipart('businessplan/step82/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                             <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                             <input name="recordidcount" id="recordidcount" class="recordidcount" required="" type="hidden" value="<?php echo $looplength; ?>" >
                     
                             <?php $index = 1; 
                            for($j=1;$j<=$looplength;$j++)
                            { ?>
                                <div class="seperator"></div>
                                <div class="separator"></div> 
                                <div class="form-group" style="margin-top: 10px;">
                                    <input type="text" required="" name="s8_module_name<?php echo $j; ?>" id="s8_module_name<?php echo $j; ?>" value="<?php if(isset($product_data[$j-1]->s8_module_name)){echo $product_data[$j-1]->s8_module_name;} ?>" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter <?php if($productype=='software'){echo "Feature";}else{echo "Module";} ?> #<?php echo $j; ?> title here">
                                    
                                    <input type="hidden" name="recordid<?php echo $j; ?>" value="<?php if(isset($product_data[$j-1]->id)){echo $product_data[$j-1]->id;} ?>"/>
                                    
                                    <a id="myrow<?php echo $j; ?>" href="javascript:removediv('myrow<?php echo $j; ?>');" class="remove_button" title="Remove field" style="margin: -35px -20px 0 0;">
                                     <i class="fa fa-trash-o fa-lg"></i></a>
                                </div>
                             <?php 
                             $index++; 
                             
                                    } ?>
                                
                                
                             <div class="seperator"></div>
                             <div class="separator"></div>    
                             <div class="field_wrapper"></div>
                             <div style="margin-top: 10px;">
                                <span class="text-bold add-input"><a href="javascript:void(0);" class="add_button" title="Add field">+ Add <?php if($productype=='software'){echo "Feature";}else{echo "Module";} ?></a></span>
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step7/".$business_plan_id ?>">Back</a>
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php form_close(); ?>
        
    </div>
</div><!-- /main-container -->   
<script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	
        var x = <?php  echo $looplength+1; ?>; //Initial field counter is 1
        
	$(addButton).click(function(){ //Once add button is clicked
              
          var fieldHTML = '<div class="form-group" style="margin-top: 10px;">\n\
                            <input type="text" required="" name="s8_module_name'+x+'" value="" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter module #'+x+' title here">\n\
                            <input type="hidden" name="recordid'+x+'" value="00"/>\n\
                            <a href="javascript:void(0);" class="remove_button" title="Remove field" style="margin: -35px -20px 0 0;">\n\
                            <i class="fa fa-trash-o fa-lg"></i></a></div>\n\
                            '; //New input field html 
                if(x < maxField){ //Check maximum number of input fields
                        $(".recordidcount").val(x)
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); // Add field html

                }
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
                <?php  $index--; ?>
                x--; //Decrement field counter
                $(".recordidcount").val(x-1);
	});
});
</script>
<script>
    
    function removediv(btn){
        
        $('#'+btn).parent('div').remove();
       var currentCount = $(".recordidcount").val();
        currentCount = currentCount - 1;
        $(".recordidcount").val(currentCount);
        
    }

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