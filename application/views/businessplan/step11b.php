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
                        <div class="tool-step">Step #11</div>
                        <div class="tool-title">Your Upsells #3</div>
                    </div>
                </div>
                <div class="seperator"></div> 
                <div class="seperator"></div>
                <div class="row ml-100 mr-100 ng-scope set-form-margin">
                   <div class="row">
                        <div class="col-md-10" >
                            <div class="panel panel-default products" style = "border: 2px solid #c4c3c7;">                                <div class="panel-body">
                                    <?php if(isset($this->session->userdata['business_plan']['bp_id'])){$business_id = $this->session->userdata['business_plan']['bp_id'];}?>

                                    <?php 
                                        $business_plan_id =  $this->uri->segment(3);
                                        $this->load->model('businessplans','',TRUE);
                                        $product_data = $this->businessplans->getProductUpsell($business_plan_id,"step11b");
                                        //print_r($product_data);//die();
                                        $checknextstep = $this->businessplans->getProductUpsell($business_plan_id,"step11c");

                                    ?>
                                    <?php echo form_open_multipart('businessplan/step12/'.$business_plan_id,array('class' => 'ng-pristine ng-valid','id'=>'step1')); ?> 
                                    <input name="bp_id" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                                    <input name="step11upsellno" required="" type="hidden" value="step11b" >
                                    <input name="s11_has_upsell" required="" type="hidden" value="1" >
                                    
                                    <div class="content-action" id="upsell1">
                                        <h1 class="business-form-heading">Upsell #3</h1> 
                                        <div class="separator"></div>
                                        <div class="seperator"></div>
                                        <div class="form-group" data-validated-as="products.0.url">
                                            <input type="text"  name="s11_upsell_prod_name" required="" id="s11_upsell_prod_name" value="<?php if(isset($product_data[0]->s11_upsell_prod_name)){echo $product_data[0]->s11_upsell_prod_name;} ?>" class="form-control input-lg clearvalue" placeholder="Enter Upsell #3 Product Name Here">
                                        </div>
                                        <div class="form-group input-group" data-validated-as="products.0.url">
                                            <span class="input-group-addon">$</span><input type="text" name="s11_upsell_price" required="" id="s11_upsell_price" value="<?php if(isset($product_data[0]->s11_upsell_price)){echo $product_data[0]->s11_upsell_price;} ?>" class="form-control input-lg clearvalue" placeholder="Enter Upsell #3 Price">
                                        </div>
                                        <div class="form-group" data-validated-as="products.0.url">
                                            <textarea class="form-control clearvalue"  name="s11_upsell_detail" required="" id="s11_upsell_detail" rows="3" placeholder="What is the main hook? Why should they buy this upsell #3"><?php if(isset($product_data[0]->s11_upsell_detail)) {echo $product_data[0]->s11_upsell_detail;} ?></textarea>
                                        </div>

                                        <div class="form-group" style="text-align: center;" >
                                             <label class="label-radio inline">
                                                 <input type="radio"  name="s11_upsell_type" required="" class="clearvalue" id="s11_upsell_type" value="written" <?php if(isset($product_data[0]->s11_upsell_type)&&($product_data[0]->s11_upsell_type=='written')){echo "checked";} ?>>
                                                    <span class="custom-radio"></span>
                                                    Written
                                            </label>
                                            <label class="label-radio inline">
                                                <input type="radio"  name="s11_upsell_type" required="" class="clearvalue" id="s11_upsell_type" value="audio" <?php if(isset($product_data[0]->s11_upsell_type)&&($product_data[0]->s11_upsell_type=='audio')){echo "checked";} ?>>
                                                    <span class="custom-radio"></span>
                                                    Audio
                                            </label>
                                            <label class="label-radio inline">
                                                 <input type="radio"  name="s11_upsell_type" required="" class="clearvalue" id="s11_upsell_type" value="video" <?php if(isset($product_data[0]->s11_upsell_type)&&($product_data[0]->s11_upsell_type=='video')){echo "checked";} ?>>
                                                  <span class="custom-radio"></span>
                                                  Video
                                            </label>
                                            <label class="label-radio inline">
                                                 <input type="radio"  name="s11_upsell_type" required="" class="clearvalue" id="s11_upsell_type" value="software" <?php if(isset($product_data[0]->s11_upsell_type)&&($product_data[0]->s11_upsell_type=='software')){echo "checked";} ?>>
                                                  <span class="custom-radio"></span>
                                                  Software
                                            </label>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default products" style = "border: 2px solid #c4c3c7;" id="maindownsell" >
                                <div class="panel-body">
                                    <div class="content-action" id="downsell">
                                        <h1 class="business-form-heading">Are you going to have a DOWNSELL for your UPSELL?</h1> 
                                        <div class="separator"></div>
                                        <div class="seperator"></div>

                                        <div class="form-group" style="text-align: center;" >
                                            <label class="label-radio inline">
                                                <input type="radio"  onclick="showdownsell()" name="s11_has_downsell" value="1" <?php if(isset($product_data[0]->s11_has_downsell) && ($product_data[0]->s11_has_downsell==1)){echo "checked";} ?> >
                                                    <span class="custom-radio"></span>
                                                    Yes
                                            </label>
                                            <label class="label-radio inline">
                                                <input type="radio"  onclick="hidedownsell()" name="s11_has_downsell" value="0" <?php if(isset($product_data[0]->s11_has_downsell) && ($product_data[0]->s11_has_downsell==0)){echo "checked";} ?>>
                                                  <span class="custom-radio"></span>
                                                  No
                                            </label>
                                       </div>
                                    </div>
                                    <div class="content-action" id="downsell1" style="<?php if(isset($product_data[0]->s11_has_downsell)&& ($product_data[0]->s11_has_downsell==0) || !isset($product_data[0]->s11_has_downsell)){echo 'display:none';}?>">
                                        <h1 class="business-form-heading">Downsell #3</h1> 
                                        <div class="separator"></div>
                                        <div class="seperator"></div>
                                        <div class="form-group" data-validated-as="products.0.url">
                                            <input type="text"  name="s11_downsell_prod_name" id="s11_downsell_prod_name" value="<?php if(isset($product_data[0]->s11_downsell_prod_name)){echo $product_data[0]->s11_downsell_prod_name; }?>" class="form-control input-lg clearvalue" placeholder="Enter Downsell #3 Product Name Here">
                                        </div>
                                        <div class="form-group input-group" data-validated-as="products.0.url">
                                            <span class="input-group-addon">$</span><input type="text"  name="s11_downsell_price" id="s11_downsell_price" value="<?php if(isset($product_data[0]->s11_downsell_price)){echo $product_data[0]->s11_downsell_price;} ?>" class="form-control input-lg clearvalue" placeholder="Enter Downsell #3 Price">
                                        </div>
                                        <div class="form-group" data-validated-as="products.0.url">
                                            <textarea class="form-control clearvalue"  name="s11_downsell_detail" id="s11_downsell_detail" rows="3" placeholder="What is the main hook? Why should they buy this downsell #3"><?php if(isset($product_data[0]->s11_downsell_detail)){echo $product_data[0]->s11_downsell_detail;} ?></textarea>
                                        </div>

                                        <div class="form-group" style="text-align: center;" >
                                             <label class="label-radio inline">
                                                 <input type="radio"  name="s11_downsell_type" class="clearvalue" id="s11_downsell_type" value="written" <?php if(isset($product_data[0]->s11_downsell_type) && ($product_data[0]->s11_downsell_type=='written')){echo "checked";} ?> >
                                                    <span class="custom-radio"></span>
                                                    Written
                                            </label>
                                            <label class="label-radio inline">
                                                <input type="radio"  name="s11_downsell_type" class="clearvalue" id="s11_downsell_type" value="audio" <?php if(isset($product_data[0]->s11_downsell_type) && ($product_data[0]->s11_downsell_type=='audio')){echo "checked";} ?> >
                                                    <span class="custom-radio"></span>
                                                    Audio
                                            </label>
                                            <label class="label-radio inline">
                                                 <input type="radio" name="s11_downsell_type" class="clearvalue" id="s11_downsell_type" value="video" <?php if(isset($product_data[0]->s11_downsell_type) && ($product_data[0]->s11_downsell_type=='video')){echo "checked";} ?>>
                                                  <span class="custom-radio"></span>
                                                  Video
                                            </label>
                                            <label class="label-radio inline">
                                                 <input type="radio" name="s11_downsell_type" class="clearvalue" id="s11_downsell_type" value="software" <?php if(isset($product_data[0]->s11_downsell_type) && ($product_data[0]->s11_downsell_type=='software')){echo "checked";} ?>>
                                                  <span class="custom-radio"></span>
                                                  Software
                                            </label>
                                       </div>
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
                        <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step11a/".$business_plan_id ?>">Back</a>
<!--                        <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   -->
                        <?php if(isset($checknextstep[0]) && !empty($checknextstep[0])){ ?>
                            <input type='submit'  id="step11c" name="step11c" value='Save Changes' class="btn btn-primary" onclick='this.form.action="<?php echo base_url()."businessplan/step11c/".$business_plan_id; ?>";' />
                        <?php }else{ ?>
                            <a  class="btn btn-primary" href="#" onclick="lock_module();">Save Changes</a>
                        <?php } ?>
                          
                        <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/"?>">Exit</a>  
                        <?php if(!empty($product_data[0])): ?>
                        <a class="btn btn-danger" style="margin-left:50px;" href="<?php echo  base_url()."businessplan/deletupsell/step11b/".$business_plan_id ?>">Delete Upsell</a>  
                        <?php endif; ?>
                    </div>
                </div>
                 <div class="seperator"></div>
                <div class="seperator"></div>
                <!-- Logout confirmation -->
                <!--Modal-->
                <div class="modal fade" id="upsell">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 style="color: #BD3F26;">Do you want to add another upsell?</h4>
                            </div>
                         
                            <div class="modal-footer">
                                <div style="text-align: center;">
                                <input type="submit" id="submitButton"  name="submitButton" value="No" class="btn btn-primary">
                                
                                <input type='submit'  id="step11c" name="step11c" value='Yes' class="btn btn-primary" onclick='this.form.action="<?php echo base_url()."businessplan/step11c/".$business_plan_id; ?>";' />
<!--                                <button class="btn btn-sm btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>-->
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                

                <?php form_close(); ?>
    </div>
</div><!-- /main-container -->  


<script>
function lock_module(){
    $("#upsell").modal("show");
}    
function showDownsell() {
   document.getElementById('maindownsell').style.display = "block";
   document.getElementById('upsell1').style.display = "block";
   
   document.getElementById("s11_upsell_prod_name").required = true;
   document.getElementById("s11_upsell_price").required = true;
   document.getElementById("s11_upsell_detail").required = true;
   document.getElementById("s11_upsell_type").required = true;
   
}


function hideDiv() {
   
   document.getElementById('maindownsell').style.display = "none";
   document.getElementById('upsell1').style.display = "none";
   
   document.getElementById("s11_upsell_prod_name").required = false;
   document.getElementById("s11_upsell_price").required = false;
   document.getElementById("s11_upsell_detail").required = false;
   document.getElementById("s11_upsell_type").required = false;
   
   document.getElementById("s11_downsell_prod_name").required = false;
   document.getElementById("s11_downsell_price").required = false;
   document.getElementById("s11_downsell_detail").required = false;
   document.getElementById("s11_downsell_type").required = false;
   
   
   
}

function hidedownsell(){
   document.getElementById('downsell1').style.display = "none";
    
   document.getElementById("s11_downsell_prod_name").required = false;
   document.getElementById("s11_downsell_price").required = false;
   document.getElementById("s11_downsell_detail").required = false;
   document.getElementById("s11_downsell_type").required = false;
}

function showdownsell(){
   
   document.getElementById('downsell1').style.display = "block";
    
   document.getElementById("s11_downsell_prod_name").required = true;
   document.getElementById("s11_downsell_price").required = true;
   document.getElementById("s11_downsell_detail").required = true;
   document.getElementById("s11_downsell_type").required = true;

}
</script>