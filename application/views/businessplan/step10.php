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

                    <div class="tool-step">Step #10</div>
                    <div class="tool-title">Your Bonus Titles & Information</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                       Data and tests prove that all digital product should have bonuses.
                        A strong set of bonuses can drastically increase your conversions on the product.
                        They are also not hard to create. If you want more information and ideas on how to create bonuses, please go to <a class="text-bold" href="/course/module-lessons/courseId/1/moduleId/4">Module #3</a>!
                    </p>
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="row">
                        <div class="col-md-10" >
                            <div class="panel panel-default products" style = "border: 2px solid #c4c3c7;">
                                <h1 class="business-form-heading">Your Bonuses</h1>  
                                <div class="panel-body">
                                    <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>
                                
                                    <?php 
                                        $business_plan_id =  $this->uri->segment(3);
                                        $this->load->model('businessplans','',TRUE);
                                        $product_data = $this->businessplans->getProductBounses($business_plan_id);
                                        //print_r($product_data);//die();
                                        $looplength = count($product_data); 
                                        if($looplength==0){$looplength =3;}
                                    ?>
                                    <?php echo form_open_multipart('businessplan/step11/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?> 
                                        <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                        <input name="recordidcount" id="recordidcount" class="recordidcount" required="" type="hidden" value="<?php echo $looplength; ?>" >
                                        <?php $index = 1; for($j=1;$j<=$looplength;$j++){ ?>
                                            
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="seperator"></div>
                                                <input type="text" required=""  s10_bonus_title1 name="s10_bonus_title<?php echo $j; ?>" value="<?php if(isset($product_data[$j-1]->s10_bonus_title)){echo $product_data[$j-1]->s10_bonus_title; } ?>" class="form-control input-lg ng-pristine ng-valid ng-touched" placeholder="Enter bonus #<?php echo $j; ?> title here">
                                                <div class="seperator"></div>
                                                <label class="label-radio inline">
                                                    <input type="radio" required="" name="s10_bonus_type<?php echo $j; ?>" value="written" <?php if(isset($product_data[$j-1]->s10_bonus_title)&&($product_data[$j-1]->s10_bonus_type =='written')){echo "checked"; } ?>>
                                                    <span class="custom-radio"></span>
                                                    Written
                                                </label>
                                                <label class="label-radio inline">
                                                    <input type="radio" required="" required="" name="s10_bonus_type<?php echo $j; ?>" value="audio" <?php if(isset($product_data[$j-1]->s10_bonus_title)&&($product_data[$j-1]->s10_bonus_type =='audio')){echo "checked"; } ?>>
                                                    <span class="custom-radio"></span>
                                                    Audio
                                                </label>
                                                <label class="label-radio inline">
                                                    <input type="radio" required="" name="s10_bonus_type<?php echo $j; ?>" value="video" <?php if(isset($product_data[$j-1]->s10_bonus_title)&&($product_data[$j-1]->s10_bonus_type =='video')){echo "checked"; } ?>>
                                                    <span class="custom-radio"></span>
                                                    Video
                                                    
                                                </label>
                                                
                                                <label class="label-radio inline">
                                                    <input type="radio" required="" name="s10_bonus_type<?php echo $j; ?>" value="software" <?php if(isset($product_data[$j-1]->s10_bonus_title)&&($product_data[$j-1]->s10_bonus_type =='software')){echo "checked"; } ?>>
                                                    <span class="custom-radio"></span>
                                                    Software
                                                    
                                                </label>
                                                <input type="hidden" name="recordid<?php echo $j; ?>" value="<?php if(isset($product_data[$j-1]->id)){echo $product_data[$j-1]->id;} ?>"/>
                                                <a id="myrow<?php echo $j; ?>" href="javascript:removediv('myrow<?php echo $j; ?>');" class="remove_button" title="Remove field" style="margin: -35px -20px 0 0;">
                                                <i class="fa fa-trash-o fa-lg"></i></a>
                                             </div>
                                            <div class="seperator"></div>
                                            <!--<div class="col-sm-4"><input type="text" required="" name="s10_bonus_price<?php //echo $j; ?>" value="<?php //if(isset($product_data[$j-1]->s10_bonus_price)){echo $product_data[$j-1]->s10_bonus_price; } ?>" class="form-control input-lg ng-pristine ng-valid ng-touched" ng-model="plan.bonuses[$index].price" placeholder="Bonus price"></div>-->
                                            <?php $index++; } ?>
                                           <div class="field_wrapper"></div>
                                            
                                </div>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <label class="label-radio inline"><a href="javascript:void(0);" class="add_button" title="Add field">+ Add Bonus</a></label>
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step9/".$business_plan_id ?>">Back</a>
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php form_close(); ?>
        
    </div>
</div><!-- /main-container -->   

<script type="text/javascript">
function removediv(btn){
        
    $('#'+btn).parent('div').remove();
   var currentCount = $(".recordidcount").val();
    currentCount = currentCount - 1;
    $(".recordidcount").val(currentCount);

}    
    
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
        var recordid = $('.recordid'); //Input field wrapper
	
        var x = $(".recordidcount").val(); //Initial field counter is recordidcount
        x++;
        
	$(addButton).click(function(){ //Once add button is clicked
           
          var fieldHTML = '<div class="col-sm-10 col-sm-offset-1">\n\
                            <div class="seperator"></div>\n\
                            <input type="text" required=""  id = "s10_bonus_title'+x+'" name="s10_bonus_title'+x+'" value="" class="form-control input-lg ng-pristine ng-valid ng-touched"  placeholder="Enter bonus #'+x+' title here">\n\
                            <div class="seperator"></div>\n\
                            <label class="label-radio inline">\n\
                            <input type="radio" required="" name="s10_bonus_type'+x+'" value="written">\n\
                            <span class="custom-radio"></span>Written</label>\n\
                            <label class="label-radio inline">\n\
                            <input type="radio" required="" required="" name="s10_bonus_type'+x+'" value="audio" >\n\
                            <span class="custom-radio"></span>Audio</label>\n\
                            <label class="label-radio inline">\n\
                            <input type="radio" required="" name="s10_bonus_type'+x+'" value="video" >\n\
                            <span class="custom-radio"></span>Video\n\
                            </label>\n\
                            <label class="label-radio inline">\n\
                            <input type="radio" required="" name="s10_bonus_type'+x+'" value="software" >\n\
                            <span class="custom-radio"></span>Software\n\
                            </label>\n\
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
                //alert(x);
		e.preventDefault();
		$(this).parent('div').remove(); //Remove field html
                <?php  $index--; ?>
                x--; //Decrement field counter
                $("#price"+x+"").remove();
                $(".recordidcount").val(x-1);
	});
});
</script>
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