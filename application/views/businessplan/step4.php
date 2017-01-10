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

                    <div class="tool-step">Step #4</div>
                    <div class="tool-title">Look For Common Trends In Your Market</div>
                    <div class="seperator"></div>   
                    <p class="font-16">
                        We’re going to do some research now.
                    </p>
                    <div class="seperator"></div>   

                    <p class="font-16">
                      There are some common things I want you to make a note of about the Top 5 Products you just found in your market. 
                      Fill in these blanks and your research will start happening on it’s own!
                    </p>
                    
                    </div>
                </div>
                <div class="seperator"></div>
                <div class="padding-md ml-100">
                    
        <div class="row">
            <?php 
            
            if(isset($this->session->userdata['business_plan']['bp_id'])){
                $business_id = $this->session->userdata['business_plan']['bp_id'];
            }
            
            $business_plan_id =  $this->uri->segment(3);
            $this->load->model('businessplans','',TRUE);
            $product_data = $this->businessplans->getSelectedProdDetail($business_plan_id);
         
            ?>
            <?php for($j=1;$j<=5;$j++){ ?>
            <div class="col-md-6 ">
                
                <div class="panel-body products">
                    
                    <?php echo form_open_multipart('businessplan/step5/'.$business_plan_id,array('class' => '')); ?> 
                    <input name="bp_id<?php echo $j; ?>" required="" type="hidden" value="<?php echo $business_plan_id; ?>" >
                    <input name="recordid<?php echo $j; ?>" required="" value="<?php echo $product_data[$j-1]->id; ?>"  type="hidden">
                      <h1 class="business-form-heading">Product # <?php echo $j; ?></h1>
                        <div class="form-group">
                            
                            <label for="exampleInputEmail1">&nbsp</label>
                            <input name="url<?php echo $j; ?>" required="" value="<?php echo $product_data[$j-1]->s3_url; ?>" ng-model="product.url" type="text" class="form-control input-lg ng-pristine ng-valid ng-valid-required ng-touched" placeholder="Enter Product URL here">
                            <div class="seperator"></div>
                            <div class="input-group">
                                <span class="input-group-addon">$</span><input name="price<?php echo $j; ?>" required="" value="<?php echo $product_data[$j-1]->s4_price; ?>"  ng-model="product.price" type="text" class="form-control input-lg ng-pristine ng-valid ng-valid-required ng-touched" placeholder="Enter Price here">
                            </div>
                            <div class="seperator"></div>
                            <input name="type<?php echo $j; ?>" required="" value="<?php echo $product_data[$j-1]->s4_type; ?>"   ng-model="product.type" type="text" class="form-control input-lg ng-pristine ng-valid ng-valid-required ng-touched" placeholder="What type of product is this?">
                            <div class="seperator"></div>
<!--                            <input name="s4_platform<?php echo $j; ?>" required="" value="<?php echo $product_data[$j-1]->s4_platform; ?>"  ng-model="product.sold_on" type="text" class="form-control input-lg ng-pristine ng-valid ng-valid-required ng-touched" placeholder="What platform is being sold on?">-->
                            <select class="form-control" name="s4_platform<?php echo $j; ?>" required>
                                <option value="">Select platform on which it will be sold?</option>
                                <option value="Clickbank" <?php if($product_data[$j-1]->s4_platform=='Clickbank'){echo "selected";}?>>Clickbank</option>
                                <option value="ClickSure"<?php if($product_data[$j-1]->s4_platform=='ClickSure'){echo "selected";}?>>ClickSure</option>
                                <option value="JVZoo"<?php if($product_data[$j-1]->s4_platform=='JVZoo'){echo "selected";}?>>JVZoo</option>
                                <option value="SWReg"<?php if($product_data[$j-1]->s4_platform=='SWReg'){echo "selected";}?>>SWReg</option>
                                <option value="Stripe"<?php if($product_data[$j-1]->s4_platform=='Stripe'){echo "selected";}?>>Stripe</option>
                                <option value="WarriorPayments"<?php if($product_data[$j-1]->s4_platform=='WarriorPayments'){echo "selected";}?>>WarriorPayments</option>
                                <option value="2Checkout"<?php if($product_data[$j-1]->s4_platform=='2Checkout'){echo "selected";}?>>2Checkout</option>
                                <option value="CJ (Conversant)"<?php if($product_data[$j-1]->s4_platform=='CJ (Conversant)'){echo "selected";}?>>CJ (Conversant)</option>
                                <option value="ShareASale"<?php if($product_data[$j-1]->s4_platform=='ShareASale'){echo "selected";}?>>ShareASale</option>
                                <option value="ClickBooth"<?php if($product_data[$j-1]->s4_platform=='ClickBooth'){echo "selected";}?>>ClickBooth</option>
                                <option value="Click2Sell"<?php if($product_data[$j-1]->s4_platform=='Click2Sell'){echo "selected";}?>>Click2Sell</option>
                                <option value="LinkShare"<?php if($product_data[$j-1]->s4_platform=='LinkShare'){echo "selected";}?>>LinkShare</option>
                                <option value="Other"<?php if($product_data[$j-1]->s4_platform=='Other'){echo "selected";}?>>Other</option>
                            </select>
                            <div class="seperator"></div>
                            <label class="label-radio inline">
                                    <input type="radio" name="s4_network<?php echo $j; ?>"  value="network" <?php if($product_data[$j-1]->s4_network == 'network'){echo 'checked';} ?> required="required">
                                    <span class="custom-radio"></span>
                                    Network
                            </label>
                            <label class="label-radio inline">
                                    <input type="radio" name="s4_network<?php echo $j; ?>" value="private" <?php if($product_data[$j-1]->s4_network == 'private'){echo 'checked';} ?> required="required">
                                    <span class="custom-radio"></span>
                                    Private
                            </label>
                            <div class="seperator"></div>
                            <span class="help-block">Choose Network if the product is sold using a third party service like Clickbank or JV Zoo.</span>
                            <div class="seperator"></div>
                            <span class="help-block">Choose Private if the product is privately sold (e.g. a launch like Publish Academy.)</span>
                            <div class="seperator"></div>
                            <textarea class="form-control" required="" rows="3" placeholder="What is the main hook being used?" name="s4_main_hook<?php echo $j; ?>"><?php echo $product_data[$j-1]->s4_main_hook; ?></textarea>
                            <div class="seperator"></div>
                            <textarea class="form-control" required=""  rows="3" placeholder="What does this product promise the provide?" name="s4_product_promise<?php echo $j; ?>"><?php echo $product_data[$j-1]->s4_product_promise; ?></textarea>
                                
                        </div><!-- /form-group -->
                   
                </div>
            </div>
            
            <?php } ?>
            <div class="row ml-100 mr-100 mt-25">
                <div class="col-md-12 text-center">
                    <a class="btn btn-primary" href="<?php echo  base_url()."businessplan/step3/".$business_plan_id ?>">Back</a>
                    <input type="submit" id="submitButton"  name="submitButton" value="Save&Continue" class="btn btn-primary">   
                    <a class="btn btn-primary" href="<?php echo  base_url()."businessplan"?>">Exit</a>  
                </div>
            </div>
            <?php echo form_close(); ?>
            
        </div>
    </div>
               
</ui-view>
</ng-form>
          
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