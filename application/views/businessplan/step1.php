<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
    $this->load->model('businessplans','',TRUE);
    $business_plan_id =  $this->uri->segment(3);
    if(!isset($business_plan_id)){$business_plan_id = $this->session->userdata['business_plan']['bp_id'];}
    $this->businessplans->accesscontrol($business_plan_id);
    
?>
<div id="main-container2">
    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="tool-content">
        
        <ng-form name="stepsForm" class="ng-pristine ng-invalid ng-invalid-required">
            <!-- uiView: undefined -->
            <ui-view class="ng-scope">
                <div class="row ml-100 ng-scope">
                    <div class="step-content">

                    <div class="tool-step">Step # 1</div>
                    <div class="tool-title">Create a List of Possible Niches</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        Please be sure to go through <a href="/course/module-lessons/courseId/1/moduleId/2" class="step-link">Module #1</a> of Publish Academy where we get into the details of choosing a niche. The first step to choosing your niche is to make a list of at least 5 ideas that you feel will qualify.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                        Remember, we are looking for a niche that matches at least the following criteria:
                    </p>
                    <ul class="bolded-list">
                        <li>Many users</li>
                        <li>Consistent demand for new Information</li>
                        <li>Existing proof that Information products are selling</li>
                        <li>Existing competition</li>
                    </ul>
                    <p class="font-16">
                        Just take your best guess and write a few ideas down.
                    </p>
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                    <div class="col-md-10 col-lg-offset-1 step-form">
                        <div class="content-action">
                            <h1 class="business-form-heading">Niches and  Micro Niches</h1>  
                            <div class="seperator"></div>
                            <div class="seperator"></div>
                            <div class="separator"></div>
                                <?php $business_id = $this->session->userdata['business_plan']['bp_id']?>
                                <?php echo form_open_multipart('businessplan/step2/'.$business_id,array('class' => 'form-horizontal no-margin form-border','id'=>'step1')); ?>
                                <?php 
                                        
                                        
                                        $niches = $this->businessplans->getAllNiche();
                                        $microniches = $this->businessplans->getAllMicroNiche();
                                        
                                        $selectedniche = $this->businessplans->getselectedNiches($business_plan_id);
                                        //print_r($selectedniche[0]); die();
                                        if(isset($selectedniche[0]->s1_niches_idea1)){
                                            
                                            $splitselectedniche = explode("###",$selectedniche[0]->s1_niches_idea1);
                                            $selectednicheid = $this->businessplans->getNichesId($splitselectedniche[0]);
                                            $niche1  = $selectednicheid[0]->parentid;

                                            $splitselectedniche2 = explode("###",$selectedniche[0]->s1_niches_idea2);
                                            $selectednicheid2 = $this->businessplans->getNichesId($splitselectedniche2[0]);
                                            $niche2  = $selectednicheid2[0]->parentid;

                                            $splitselectedniche3 = explode("###",$selectedniche[0]->s1_niches_idea3);
                                            $selectednicheid3 = $this->businessplans->getNichesId($splitselectedniche3[0]);
                                            $niche3  = $selectednicheid3[0]->parentid;

                                            $splitselectedniche4 = explode("###",$selectedniche[0]->s1_niches_idea4);
                                            $selectednicheid4 = $this->businessplans->getNichesId($splitselectedniche4[0]);
                                            $niche4  = $selectednicheid4[0]->parentid;

                                            $splitselectedniche5 = explode("###",$selectedniche[0]->s1_niches_idea5);
                                            $selectednicheid5 = $this->businessplans->getNichesId($splitselectedniche5[0]);
                                            $niche5  = $selectednicheid5[0]->parentid;
                                            
                                        }else{
                                            $niche1 ="testval";
                                            $niche2="testval";
                                            $niche3="testval";
                                            $niche4="testval";
                                            $niche5="testval";
                                            
                                        }
                                         //print_r($selectedniche[0]->s1_niches_idea1);
                                      
                                 ?>
                                <input name="bp_id" required="" type="hidden" value="<?php  echo $business_id;?>" >
                                
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-6">
                                           <select class="form-control" id="parent_cat1" required>
                                                <option>Select Niche</option>
                                                <?php foreach($niches as $niche): ?>
                                                    <option value="<?php if(isset($niche->parentid)){echo $niche->parentid;} ?>" <?php if(isset($niche->parentid)&&($niche->parentid==$niche1)){echo "selected";} ?>><?php if(isset($niche->niche)){echo $niche->niche;} ?></option>
                                                <?php  endforeach; ?>  
                                            </select>
                                        </div>
                                        <div class="col-md-6" >
                                            <select class="form-control" name="s1_niches_idea1" id="sub_cat1" required>
                                                <option value="">Please Select Micro Niche</option>
                                                <?php foreach($microniches as $niche): ?>
                                                    <option value="<?php echo $niche->niche."###".$niche->microniche; ?>" <?php if(isset($selectedniche[0]->s1_niches_idea1)&&($niche->niche."###".$niche->microniche == $selectedniche[0]->s1_niches_idea1)){echo "selected";} ?>><?php echo $niche->microniche; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-6">
                                           <select class="form-control" id="parent_cat2" required>
                                                <option>Select Niche</option>
                                                <?php foreach($niches as $niche): ?>
                                                    <option value="<?php echo $niche->parentid; ?>" <?php if($niche->parentid==$niche2){echo "selected";} ?>><?php echo $niche->niche; ?></option>
                                                <?php  endforeach; ?>  
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="s1_niches_idea2" id="sub_cat2" required>
                                                <option value="">Please Select Micro Niche</option>
                                                <?php foreach($microniches as $niche): ?>
                                                    <option value="<?php echo $niche->niche."###".$niche->microniche; ?>" <?php if(isset($selectedniche[0]->s1_niches_idea2)&&($niche->niche."###".$niche->microniche == $selectedniche[0]->s1_niches_idea2)){echo "selected";} ?>><?php echo $niche->microniche; ?></option>
                                                <?php endforeach; ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-6">
                                           <select class="form-control" id="parent_cat3" required>
                                                <option>Select Niche</option>
                                                <?php foreach($niches as $niche): ?>
                                                    <option value="<?php echo $niche->parentid; ?>" <?php if($niche->parentid==$niche3){echo "selected";} ?>><?php echo $niche->niche; ?></option>
                                                <?php  endforeach; ?>  
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="s1_niches_idea3" id="sub_cat3" required>
                                                <option value="">Please Select Micro Niche</option>
                                                <?php foreach($microniches as $niche): ?>
                                                    <option value="<?php echo $niche->niche."###".$niche->microniche; ?>" <?php if(isset($selectedniche[0]->s1_niches_idea3)&&($niche->niche."###".$niche->microniche == $selectedniche[0]->s1_niches_idea3)){echo "selected";} ?>><?php echo $niche->microniche; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-6">
                                           <select class="form-control" id="parent_cat4" required>
                                                <option>Select Niche</option>
                                                <?php foreach($niches as $niche): ?>
                                                    <option value="<?php echo $niche->parentid; ?>" <?php if($niche->parentid==$niche4){echo "selected";} ?>><?php echo $niche->niche; ?></option>
                                                <?php  endforeach; ?>  
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="s1_niches_idea4" id="sub_cat4" required>
                                                <option value="">Please Select Micro Niche</option>
                                                <?php foreach($microniches as $niche): ?>
                                                    <option value="<?php echo $niche->niche."###".$niche->microniche; ?>" <?php if(isset($selectedniche[0]->s1_niches_idea4)&&($niche->niche."###".$niche->microniche == $selectedniche[0]->s1_niches_idea4)){echo "selected";} ?>><?php echo $niche->microniche; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-6">
                                           <select class="form-control" id="parent_cat5" required>
                                                <option>Select Niche</option>
                                                <?php foreach($niches as $niche): ?>
                                                    <option value="<?php echo $niche->parentid; ?>" <?php if($niche->parentid==$niche5){echo "selected";} ?>><?php echo $niche->niche; ?></option>
                                                <?php  endforeach; ?>  
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" name="s1_niches_idea5" id="sub_cat5" required>
                                                <option value="">Please Select Micro Niche</option>
                                                <?php foreach($microniches as $niche): ?>
                                                    <option value="<?php echo $niche->niche."###".$niche->microniche; ?>" <?php if(isset($selectedniche[0]->s1_niches_idea5)&&($niche->niche."###".$niche->microniche == $selectedniche[0]->s1_niches_idea5)){echo "selected";} ?>><?php echo $niche->microniche; ?></option>
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
<!--            <input type="submit" id="submitButton"  name="submitButton" value="Save" class="btn btn-primary"> -->
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Back</a> 
                <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
            </div>
        </div>
        <?php form_close(); ?>
        
    </div>
</div><!-- /main-container -->   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        
        $("#parent_cat1").change(function() {
        $.blockUI({ message: null });     
        $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat1").html(data);
            setTimeout($.unblockUI, 1000); 
        });	
    });
    
    $("#parent_cat2").change(function() {
        $.blockUI({ message: null }); 
        $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat2").html(data);
            setTimeout($.unblockUI, 1000);
                
        });	
    });
    
    
    $("#parent_cat3").change(function() {
        $.blockUI({ message: null }); 
        $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat3").html(data);
            setTimeout($.unblockUI, 1000);
        });	
    });
    
    $("#parent_cat4").change(function() {
        $.blockUI({ message: null }); 
         $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat4").html(data);
            setTimeout($.unblockUI, 1000);
        });	
    });
    
    $("#parent_cat5").change(function() {
        $.blockUI({ message: null }); 
        $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat5").html(data);
            setTimeout($.unblockUI, 1000);
        });	
    });
    
    $("#parent_cat6").change(function() {
        $.blockUI({ message: null }); 
        $.post('<?php echo base_url(); ?>businessplan/loadmicroniches/' + $(this).val(), function(data) {
            $("#sub_cat6").html(data);
            setTimeout($.unblockUI, 1000);
        });	
    });
 
});
</script>