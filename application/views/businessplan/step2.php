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

                    <div class="tool-step">Step #2</div>
                    <div class="tool-title">Finalize the Niche to Build</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Early in <a href="#" class="step-link">Module #1</a>, 
                        we get into the details of what to look for when conducting Niche analysis.  Please make sure to go through each and every step before choosing your niche.  I also highly recommend taking a look at our resources.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                       We have gone ahead and professionally researched many niches already. We also keep adding to this list every single month. All the data you need may already exist!
                    </p>
                    <p>
                        <a href="https://members.publishacademy.com/user/pick-niche" class="step-link">Click here to access our research reports…</a>
                    </p>
                   
                    <p class="font-16">
                         Remember one last point.  There is no right or wrong niche.  In the end if two or three look great from a data perspective, then simply 
                         choose the one that you “like” the most.  There are literally hundreds of amazing niches online, what makes the difference is how you market to them  
                         (something you’re going to master soon anyways).
                    </p>
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">So, what’s it going to be?</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php 
                                        if(isset($this->session->userdata['business_plan']['bp_id'])){
                                            $business_id = $this->session->userdata['business_plan']['bp_id'];
                                        }
                                 ?>
                                <?php $business_plan_id =  $this->uri->segment(3); ?>
                                <?php 
                                    $business_plan_id =  $this->uri->segment(3);
                                    $this->load->model('businessplans','',TRUE);
                                    $product_data = $this->businessplans->getSelectedNiche($business_plan_id);
                                    //print_r($product_data);//die();
                                    
                                    $niches = $this->businessplans->getAllNiche();
                                    $microniches = $this->businessplans->getAllMicroNiche();

                                    $selectedniche = $this->businessplans->getselectedNiches($business_plan_id);
                                    //print_r($selectedniche[0]); die();
                                    if(isset($selectedniche[0]->s1_niches_idea1)){

                                        $splitselectedniche = explode("###",$selectedniche[0]->s1_niches_idea1);
                                        $selectednicheid = $this->businessplans->getNichesId($splitselectedniche[0]);
                                        $niche1  = $selectednicheid[0]->parentid;

                                    }else{
                                        $niche1 ="testval";

                                    }
                                    
                                ?>
                                <?php echo form_open_multipart('businessplan/step3/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?>  
                                 <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                 <?php if(isset($product_data[0]->s2_selected_niche)) {$selected_value = $product_data[0]->s2_selected_niche;}else{$selected_value='';}?>
                                 <div class="form-group ng-scope">
                                    <label class="label-radio">
                                        <input type="radio"  id="s2_selected_niche" name="s2_selected_niche" onclick="hideDiv()" value="<?php echo $view_data['s1_niches_idea1'] ?>" <?php if( $view_data['s1_niches_idea1']==$selected_value){echo "checked";} ?>>
                                        <span class="custom-radio"></span>
                                        <?php echo str_replace("###","> ",$view_data['s1_niches_idea1']); ?>
                                    </label>
                                     <div class="seperator"></div> 
                                     <div class="seperator"></div> 
                                    <label class="label-radio">
                                        <input type="radio"  id="s2_selected_niche" name="s2_selected_niche" onclick="hideDiv()" value="<?php echo $view_data['s1_niches_idea2'] ?>" <?php if( $view_data['s1_niches_idea2']==$selected_value){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            <?php echo str_replace("###","> ",$view_data['s1_niches_idea2']); ?>
                                    </label>
                                     <div class="seperator"></div> 
                                     <div class="seperator"></div> 
                                     <label class="label-radio">
                                         <input type="radio"  id="s2_selected_niche" name="s2_selected_niche" onclick="hideDiv()" value="<?php echo $view_data['s1_niches_idea3'] ?>" <?php if( $view_data['s1_niches_idea3']==$selected_value){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            <?php echo str_replace("###","> ",$view_data['s1_niches_idea3']); ?>
                                    </label>
                                     <div class="seperator"></div> 
                                     <div class="seperator"></div> 
                                     <label class="label-radio">
                                         <input type="radio"  id="s2_selected_niche" name="s2_selected_niche" onclick="hideDiv()" value="<?php echo $view_data['s1_niches_idea4'] ?>" <?php if( $view_data['s1_niches_idea4']==$selected_value){echo "checked";} ?>>
                                            <span class="custom-radio"></span>
                                            <?php echo str_replace("###","> ",$view_data['s1_niches_idea4']); ?>
                                    </label>
                                     <div class="seperator"></div> 
                                     <div class="seperator"></div> 
                                    <label class="label-radio">
                                        <input type="radio"  name="s2_selected_niche" onclick="hideDiv()" value="<?php echo $view_data['s1_niches_idea5'] ?>" <?php if( $view_data['s1_niches_idea5']==$selected_value){echo "checked";} ?>>
                                        <span class="custom-radio"></span>
                                        <?php echo str_replace("###","> ",$view_data['s1_niches_idea5']); ?>
                                    </label>
                                </div>
                                <div class="separator"></div>
                                <?php 
                                        if((
                                             $selected_value == $view_data['s1_niches_idea1'] ||
                                             $selected_value == $view_data['s1_niches_idea2'] ||
                                             $selected_value == $view_data['s1_niches_idea3'] ||
                                             $selected_value == $view_data['s1_niches_idea4'] ||
                                             $selected_value == $view_data['s1_niches_idea5']
                                                
                                          )){
                                            
                                            $flag = false;
                                          }else{
                                              $flag = true;
                                          }
                                 ?>
                                 <div class="text-bold mb-5 orc font-16"><strong>OR</strong></div>
                                 <div class="form-group">
                                    <label class="label-radio mind_changed font-16">
                                        <input type="radio" name="s2_selected_niche" onclick="showDiv()" <?php if($flag && !empty($selected_value)){echo "checked";} ?>>
                                        <span class="custom-radio"></span>
                                        <strong>I changed my mind</strong>
                                    </label>
                                </div>
                                 
                                 <div class="form-group ng-scope" style="<?php if($flag && !empty($selected_value)){echo 'display:block';}else{echo 'display:none';} ?>" id="changemind">
                                    <div class="row">
                                       <div class="col-md-6">
                                           <select class="form-control" id="parent_cat1" required>
                                                <option>Select Niche</option>
                                                <?php foreach($niches as $niche): ?>
                                                    <option value="<?php if(isset($niche->parentid)){echo $niche->parentid;} ?>" <?php if(isset($niche->parentid)&&($niche->parentid==$niche1)){echo "selected";} ?>><?php if(isset($niche->niche)){echo $niche->niche;} ?></option>
                                                <?php  endforeach; ?>  
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="change_mind" id="sub_cat1">
                                                <option value="">Please Select Micro Niche</option>
                                                <?php foreach($microniches as $niche): ?>
                                                    <option value="<?php echo $niche->niche."###".$niche->microniche; ?>" <?php if(isset($selectedniche[0]->s1_niches_idea1)&&($niche->niche."###".$niche->microniche == $selected_value)){echo "selected";} ?>><?php echo $niche->microniche; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                    </div>
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
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step1/".$business_plan_id ?>">Back</a>  
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php form_close(); ?>
        
    </div>
</div><!-- /main-container -->   

<script>
document.getElementById("s2_selected_niche").required = true;
function showDiv() {
    //alert();
   document.getElementById("s2_selected_niche").required = false;
   document.getElementById("sub_cat1").required = true;
   document.getElementById('changemind').style.display = "block";
   
}

function hideDiv() {
   document.getElementById('changemind').style.display = "none";
   document.getElementById("s2_selected_niche").required = true;
   document.getElementById("sub_cat1").required = false;
}
</script>
<script type="text/javascript">
$(document).ready(function() {
        $("#parent_cat1").change(function() {
        $.blockUI({ message: null });     
        $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat1").html(data);
            setTimeout($.unblockUI, 1000);
        });	
    });
    
 });   
 </script>