<?php

Class businessplans extends CI_Model{
    
    
    public function createBusinessplan($planname){
  
        $createdDate = date("Y-m-d H:i:s");  
        
        $data = array(
            
           'planname' => $planname ,
           'datecreated' => $createdDate,
           'lastupdate' => $createdDate,
           'user_id'=>$this->session->userdata['logged_in']['id']
            
        );
        
        $this->db->insert('businessplan', $data);
        $last_inserted_id = $this->db->insert_id();
        $userid = $this->session->userdata['logged_in']['id'];
        
        $this->db->insert('businessplandetail', array('bp_id'=>$last_inserted_id,'user_id'=>$userid));
        $last_inserted_id = $this->db->insert_id();

        if($last_inserted_id>0){ 
            
             return $last_inserted_id;
             
        }else{
             return false;
        }

        
    }
    
    public function createbusinessplanbonuses($data,$recordidcount){
        
      //echo "<pre>";  print_r($data); echo count($data); //die();
        
        $insertdata = array();
        
        
        for ( $j=1; $j<=count($data);$j++ ){
            
            if (isset($data['s10_bonus_title'.$j])){
                //echo $data['s10_bonus_title'.$j]."<br/>";
                $insertdata['s10_bonus_title'] =  $data['s10_bonus_title'.$j];
            }
            
            if (isset($data['s10_bonus_type'.$j])){
                //echo $data['s10_bonus_type'.$j]."<br/>";
                $insertdata['s10_bonus_type'] =  $data['s10_bonus_type'.$j];
            }
            
             if (isset($data['s10_bonus_type'.$j])&&$data['s10_bonus_title'.$j]){
                 $insertdata['bp_id'] = $data['bp_id'];
              $this->db->insert('businessplanbonuses', $insertdata);
            }
            
            
        }
        
        $last_inserted_id = $this->db->insert_id();
        
        if($last_inserted_id>0){  
            $updatedDate = date("Y-m-d H:i:s");
            $this->db->where('id', $data['bp_id']);
            $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
             return $last_inserted_id;
        }else{
             return false;
        }
        
    }
    
    public function createbusinesmodules($data,$recordidcount){
       
       $postedIds = ''; 
      //echo "<pre>"; print_r($data); die();  //echo count($data);
       
       $allPostedIds = array();
       for ( $j=1; $j<=count($data);$j++ ){
           
           if (isset($data['recordid'.$j]) && $data['recordid'.$j] != "00")
           {
                $allPostedIds[$j] = $data['recordid'.$j];
                $postedIds .= $data['recordid'.$j].',';
           }  
       }
       //$postedIds = substr($postedIds, 0, -1);
       
       //echo "<pre>"; print_r($allPostedIds);  
      
       //remove  last comma (33,44,77,)
       //
       //DELET FROM BUSINESSMODULE WHERE bp_id = 34 AND id NOTIN (33,55,77);
       $this->db->where('bp_id',$data['bp_id']);
       $this->db->where_not_in('id', $allPostedIds);
       $this->db->delete('businessplanmodule'); 
       
        $insertdata =array();
        for ( $j=1; $j<=count($data);$j++ ){
            
            if(isset($data['s8_module_name'.$j])&&empty($data['recordid'.$j])){
                $insertdata['bp_id'] =  $data['bp_id'];
                $insertdata['s8_module_name'] =  $data['s8_module_name'.$j];
                $this->db->insert('businessplanmodule', $insertdata);
            }
            
            
            if (isset($data['recordid'.$j])){
                if ($data['recordid'.$j] == "00"){
                    //insert code
                    //echo 'for insert' . $data['s8_module_name'.$j].'<br/>';
                    $insertdata['bp_id'] =  $data['bp_id'];
                    $insertdata['s8_module_name'] =  $data['s8_module_name'.$j];
                    $this->db->insert('businessplanmodule', $insertdata);
                 }
                else
                {
                    //update                    
                     //echo $allPostedIds[$j]."<br/>";
                     //echo 'for UPDATE' . $data['s8_module_name'.$j].'<br/>';
                     if (isset($data['s8_module_name'.$j])){
                         
                        $this->db->where('id', $allPostedIds[$j]);
                        $this->db->update('businessplanmodule', array('s8_module_name'=>$data['s8_module_name'.$j]));
                     }
                     
                }
            }
         }
         
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
             
    }

    public function createStep2($data){
        
        $this->db->where('bp_id', $data['bp_id']);
        $this->db->update('businessplandetail', $data);
        
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
      public function getAllPlanes(){
        
        $this->db->select('id,planname,datecreated,lastupdate');
        $this->db->from('businessplan');
        $this->db->order_by("lastupdate", "desc");
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getAllPlans($userid){
        
        $this->db->select('id,planname,datecreated,lastupdate');
        $this->db->from('businessplan');
        $this->db->where("user_id",$userid);
        $this->db->order_by("lastupdate", "desc");
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getSelectedPlaneDetail($bp_id){
        
        $this->db->select('*');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getSelectedNiche($bp_id){
        
        $this->db->select('s2_selected_niche');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getUserPlan($bp_id){
        
        $this->db->select('id');
        $this->db->from('businessplan');
        $this->db->where('id', $bp_id);
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
     public function getSelectedProdDetail($bp_id){
        //echo $bp_id;
        $this->db->select('*');
        $this->db->from('businessplanproductdetail');
        $this->db->where('bp_id', $bp_id);
        
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getProductType($bp_id){
        //echo $bp_id; die();
        $this->db->select('s6_product_type,s6_product_type_detail');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function getProdyctBuyReason($bp_id){
        //echo $bp_id; die();
        $this->db->select('s7_product_url,s7_product_name,s7_product_usp,s7_product_benifit');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function getProductAdditional($bp_id){
         
        //echo $bp_id; die();
        $this->db->select('s9_outsourcing,s9_interview');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
        
    }
	
    public function getProductUpsell($bp_id,$stepno){
         
        //echo $bp_id; die();
        $this->db->select('s11_has_upsell,s11_upsell_prod_name,s11_upsell_price,s11_upsell_detail,s11_upsell_type,s11_has_downsell,s11_downsell_prod_name,s11_downsell_price,s11_downsell_detail,s11_downsell_type');
        $this->db->from('upsell');
        $this->db->where('bp_id', $bp_id);
        $this->db->where('s11_step', $stepno);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function cehckProductUpsellExist($bp_id,$stepno){
         
        //echo $bp_id; die();
        $this->db->select('s11_has_upsell,s11_upsell_prod_name,s11_upsell_price,s11_upsell_detail,s11_upsell_type,s11_has_downsell,s11_downsell_prod_name,s11_downsell_price,s11_downsell_detail,s11_downsell_type');
        $this->db->from('upsell');
        $this->db->where('bp_id', $bp_id);
        $this->db->where('s11_step',$stepno);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getProductBounses($bp_id){
         
        //echo $bp_id; die();
        $this->db->select('id,bp_id,s10_bonus_title,s10_bonus_price,s10_bonus_type');
        $this->db->from('businessplanbonuses');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getProductAdditionalUpsell($bp_id){
         
        //echo $bp_id; die();
        $this->db->select('s12_outsourcing,s12_interview');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getProductNextUpsell($bp_id){
         
        //echo $bp_id; die();
        $this->db->select('*');
        $this->db->from('upsell');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getMainPrice($bp_id){
        //echo $bp_id;
        $this->db->select('s5_main_product_price');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getProductSystem($bp_id){
        //echo $bp_id;
        $this->db->select('s13_system');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    
    public function getProductProspect($bp_id){
        //echo $bp_id;
        $this->db->select('s14_autoresponder');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    
    public function getProductPaymentProcess($bp_id){
        //echo $bp_id;
        $this->db->select('s15_payment_process');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getProductCustomerSupport($bp_id){
        //echo $bp_id;
        $this->db->select('s16_customer_support');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
     public function getProductSaleType($bp_id){
        //echo $bp_id;
        $this->db->select('s17_product_type');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getProductCopyWrite($bp_id){
        //echo $bp_id;
        $this->db->select('s18_copywriting');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function getBusinessModules($bp_id){
        //echo $bp_id;
        $this->db->select('id,bp_id,s8_module_name,s8_module_bullets');
        $this->db->from('businessplanmodule');
        $this->db->where('bp_id', $bp_id);
        
        $query = $this->db->get();
        return $query->result();
                
    }
    
    public function updateProductMainPrice($main_price){
        
        //print_r($main_price); die();
        
        $this->db->where('bp_id', $main_price['bp_id']);
        $this->db->update('businessplandetail', array('s5_main_product_price'=>$main_price['s5_main_product_price']));
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $main_price['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateProductSaleType($product_data){
        
        //print_r($main_price); die();
        
        $this->db->where('bp_id', $product_data['bp_id']);
        $this->db->update('businessplandetail', $product_data);
        
    }
    
    public function updateProductNextUpsellStep($bp_id,$stepid,$count){
        
        if($count==0){$stepupdate = 'step11a';}elseif($count==1){$stepupdate = 'step11b';}elseif($count==2){$stepupdate = 'step11c';}
         elseif($count==3){$stepupdate = 'step11d';}

        $this->db->where('bp_id', $bp_id);
        $this->db->where('s11_step', $stepid);
        $this->db->update('upsell',array('s11_step'=>$stepupdate));
        
    }
    
    public function updateProductBouneses($product_data){
        
        //print_r($product_data); die();
        
        $totalrecord = (count($product_data)-2)/3;
        
        $insertdata = array();
        
        for ( $j=1; $j<=3;$j++ ){
           
            $insertdata['bp_id'] =  $product_data['bp_id'];
            
            $insertdata['s10_bonus_title'] =  $product_data['s10_bonus_title'.$j];
            $insertdata['s10_bonus_price'] =  $product_data['s10_bonus_price'.$j];
            $insertdata['s10_bonus_type'] =  $product_data['s10_bonus_type'.$j];
            
            $this->db->where('id', $product_data['recordid'.$j]);
            $this->db->update('businessplanbonuses', $insertdata);
            
        }
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
    }
    
    public function updateBusinessModules($product_data){
        
        //print_r($product_data); die();
        
        $totalrecord = (count($product_data)-2)/3;
        
        $insertdata = array();
        
        for ( $j=1; $j<=5;$j++ ){
           
            $insertdata['bp_id'] =  $product_data['bp_id'];
            $insertdata['s8_module_name'] =  $product_data['s8_module_name'.$j];
            $this->db->where('id', $product_data['recordid'.$j]);
            $this->db->update('businessplanmodule', $insertdata);
            
        }
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateBusinessModulesStep2($product_data,$recordidcount){
        
        //print_r($product_data); die();
        $insertdata = array();
        for ( $j=1; $j<=$recordidcount;$j++ ){
           
            $insertdata['bp_id'] =  $product_data['bp_id'];
            $insertdata['s8_module_bullets'] =  $product_data['s8_module_bullets'.$j];
            $this->db->where('id', $product_data['recordid'.$j]);
            $this->db->update('businessplanmodule', $insertdata);
            
        }
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
    }
    
    public function updateProductCopyWrite($product_data){
        
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_data['bp_id']);
        $this->db->update('businessplandetail', $product_data);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateProductType($product_type){
        $this->db->where('bp_id', $product_type['bp_id']);
        $this->db->update('businessplandetail', $product_type);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_type['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateProductSystem($product_type){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_type['bp_id']);
        $this->db->update('businessplandetail', $product_type);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_type['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateProductPaymentProcess($product_type){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_type['bp_id']);
        $this->db->update('businessplandetail', $product_type);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_type['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
   public function updateProductCustomerSupport($product_type){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_type['bp_id']);
        $this->db->update('businessplandetail', $product_type);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_type['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateUpsellProduct($upsell_data,$step11upsellno){
        //print_r($main_price); die();
        $this->db->where('bp_id', $upsell_data['bp_id']);
        $this->db->where('s11_step', $step11upsellno);
        $this->db->update('upsell', $upsell_data);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $upsell_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function updateProductProspect($product_type){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_type['bp_id']);
        $this->db->update('businessplandetail', $product_type);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_type['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    
    public function updateProductTypeUpsell($product_data){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_data['bp_id']);
        $this->db->update('businessplandetail', $product_data);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
     public function updateProductAddistional($product_data){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_type['bp_id']);
        $this->db->update('businessplandetail', $product_data);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_type['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    
     public function updateProductReason($product_data){
        //print_r($main_price); die();
        $this->db->where('bp_id', $product_data['bp_id']);
        $this->db->update('businessplandetail', $product_data);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $product_data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }

    

    
    public function createStep3($data){
        
        //print_r($data); die();
       
        $this->db->where('bp_id', $data['bp_id']);
        $this->db->update('businessplandetail', array('s2_selected_niche'=>$data['s2_selected_niche']));
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $data['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
     public function createStep4($data){
         
        $this->db->insert('businessplanproductdetail', $data);
        $last_inserted_id = $this->db->insert_id();
        
         if($last_inserted_id>0){   
             $updatedDate = date("Y-m-d H:i:s");
             $this->db->where('id', $data['bp_id']);
             $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
             return $last_inserted_id;
        }else{
             return false;
        }
        
    }
    
    public function createUpsell($upsell_data){
        
        $this->db->insert('upsell',$upsell_data);
        $last_inserted_id = $this->db->insert_id();
        return $last_inserted_id;
    }
    
    
    public function updateProductDetail($product1,$product2,$product3,$product4,$product5){
        
           //print_r($product1); die();
            
            $this->db->where('id', $product1['id']);
            $this->db->where('bp_id', $product1['bp_id']);
            $this->db->update('businessplanproductdetail', $product1);
            
             $this->db->where('id', $product2['id']);
            $this->db->where('bp_id', $product1['bp_id']);
            $this->db->update('businessplanproductdetail', $product2);
            
             $this->db->where('id', $product3['id']);
            $this->db->where('bp_id', $product1['bp_id']);
            $this->db->update('businessplanproductdetail', $product3);
            
            
             $this->db->where('id', $product4['id']);
            $this->db->where('bp_id', $product1['bp_id']);
            $this->db->update('businessplanproductdetail', $product4);
            
            
            $this->db->where('id', $product5['id']);
            $this->db->where('bp_id', $product1['bp_id']);
            $this->db->update('businessplanproductdetail', $product5);
            
            $updatedDate = date("Y-m-d H:i:s");
            $this->db->where('id', $product1['bp_id']);
            $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
            
     
        
    }
    public function updateProductUrls($produsturl1,$produsturl2,$produsturl3,$produsturl4,$produsturl5){
        
         //print_r($produsturl1); die();
        
        $this->db->where('id', $produsturl1['id']);
        $this->db->where('bp_id', $produsturl1['bp_id']);
        $this->db->update('businessplanproductdetail', $produsturl1);
        
        $this->db->where('id', $produsturl2['id']);
        $this->db->where('bp_id', $produsturl2['bp_id']);
        $this->db->update('businessplanproductdetail', $produsturl2);
        
        $this->db->where('id', $produsturl3['id']);
        $this->db->where('bp_id', $produsturl3['bp_id']);
        $this->db->update('businessplanproductdetail', $produsturl3);
        
        
        $this->db->where('id', $produsturl4['id']);
        $this->db->where('bp_id', $produsturl4['bp_id']);
        $this->db->update('businessplanproductdetail', $produsturl4);
        
        
        $this->db->where('id', $produsturl5['id']);
        $this->db->where('bp_id', $produsturl5['bp_id']);
        $this->db->update('businessplanproductdetail', $produsturl5);
        
        $updatedDate = date("Y-m-d H:i:s");
        $this->db->where('id', $produsturl5['bp_id']);
        $this->db->update('businessplan', array('lastupdate'=>$updatedDate));
        
    }
    
    public function getAllNiche(){
        $this->db->select('*');
        $this->db->from('nichecategories');
        $this->db->group_by('niche');
        $query = $this->db->get();
        return $query->result();
        
    }
    
     public function getAllMicroNiche(){
        $this->db->select('*');
        $this->db->from('nichecategories');
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getMicroNiches($parent_id){
        $this->db->select('*');
        $this->db->from('nichecategories');
        $this->db->where('parentid', $parent_id);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getselectedNiches($bp_id){
        $this->db->select('s1_niches_idea1,s1_niches_idea2,s1_niches_idea3,s1_niches_idea4,s1_niches_idea5');
        $this->db->from('businessplandetail');
        $this->db->where('bp_id', $bp_id);
        $query = $this->db->get();
        return $query->result();
        
    }

    
    public function getNichesId($nichename){
        //echo $nichename; die();
        $this->db->select('parentid');
        $this->db->from('nichecategories');
        $this->db->like('niche', "$nichename");
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function getselectedNichesId($nichename){
        //echo $nichename; die();
        $this->db->select('id,niche,microniche');
        $this->db->from('nichecategories');
        $this->db->like('microniche', "$nichename");
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function accesscontrol($business_plan_id){
        
        $userplan = $this->getUserPlan($business_plan_id);
        //print_r($userplan[0]);
        if(empty($userplan[0])){
            $this->session->set_userdata('businessplan_accessdetail',array('accessdetail'=>'You are not authorised to access this plan.'));
            redirect('businessplan/'); 
            die();
        }else{
            return true;
        }
        
    }
    
}

?>