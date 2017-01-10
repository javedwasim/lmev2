<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class businessplan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
         
    function __construct() {
        parent::__construct();
		if(!$this->session->userdata('logged_in')){
            redirect('login', 'refresh');
        }
        $this->load->helper(array('form', 'url'));
        $this->load->model('user','',TRUE);
        $this->load->model('businessplans','',TRUE);
    }

	public function index(){
            $data = $this->modules_sidebar();
            
            if(isset($this->session->userdata['businessplan_accessdetail'])){
                
                $businessplanaccess_detail = $this->session->userdata['businessplan_accessdetail']['accessdetail'];
                
            }else{
                
                $businessplanaccess_detail="";
                
            }
            
            //$allplanes = $this->businessplans->getAllPlanes();
            $userid = $this->session->userdata['logged_in']['id'];
            $allplanes = $this->businessplans->getAllPlans($userid);
                       
            
            $this->load->helper('html');
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step',array('allplanes'=>$allplanes,'accessdetail'=>$businessplanaccess_detail));
            $this->load->view('common/footerfull');
            
            $this->session->unset_userdata('businessplan_accessdetail');
		
	}


        public function step1(){
            
            $data = $this->modules_sidebar();
            $this->load->helper('html');
            $planname = $this->input->post('planname');
            
            $createplane = "";
            if($planname){
                
                 $createplane = $this->businessplans->createBusinessplan($planname);
                 $view_data = $this->businessplans->getSelectedPlaneDetail($createplane);
                 
                 
                 $businessplanarray= array();
                 foreach($view_data as $row){
                    
                     $businessplanarray =array(
                         'id'=>$row->id,
                         'bp_id'=>$row->bp_id,
                         
                         
                     );
                     
                 }
                 
                 
                 $this->session->set_userdata('business_plan',$businessplanarray);
                 $businessplan = $this->session->userdata['business_plan']; 
                
                 $step1_view_data = array(
                    'view_data' => $view_data,
                     'bp_id'=>$businessplan
                 );

                 $this->load->view('common/headerfull',$data);
                 $this->load->view("businessplan/step1", $step1_view_data);
                 $this->load->view('common/footerfull');
                 
            }else{
                
                $plan_number =  $this->uri->segment(3); 
                if(!empty($plan_number)){
                    
                    $view_data = $this->businessplans->getSelectedPlaneDetail($plan_number);
                    
                    $this->session->set_userdata('business_plan',array('bp_id'=>$plan_number));
                    
                    $step1_view_data = array(
                                            'view_data' => $view_data,
                                            'bp_id'=>$plan_number
                                        );
                    
                     //print_r($step1_view_data); die();
                    
                    
                }else{
                
                    $businessplan = $this->session->userdata['business_plan'];
                    //print_r($businessplan); die();
                    $view_data = $this->businessplans->getSelectedPlaneDetail($businessplan['bp_id']);
                    $step1_view_data = array(
                                         'view_data' => $view_data,
                                         'bp_id'=>$businessplan
                                        );
                   // print_r($step1_view_data); die();
                }
                
                $this->load->view('common/headerfull',$data);
                $this->load->view('businessplan/step1',$step1_view_data);
                $this->load->view('common/footerfull');
                
            }
                
            
	}
        
        public function step2()
	{
            $business_plan_id =  $this->uri->segment(3);
            
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
            
            
           $formSubmit = $this->input->post('submitButton');
           
            $data = $this->modules_sidebar();
            
            $this->load->helper('html');
            
            $plandata = array();
            
            //update user profile form fields
            $formvalues =  array('s1_niches_idea1', 's1_niches_idea2','s1_niches_idea3', 's1_niches_idea4','s1_niches_idea5','bp_id');

            foreach($formvalues as $field) {
                if (!empty($_POST[$field])) {
                        $plandata[$field] = $_POST[$field];
                }
            }
            //echo "<pre>";  print_r($plandata); die();
           
            if(!empty($plandata)){
            
                 $createstep2 = $this->businessplans->createStep2($plandata);
                 $viewdata = array(
                    'view_data'=>$plandata
                );
                 
            }else{
            
                if(isset($this->session->userdata['business_plan']['bp_id'])){
                    $bp_id = $this->session->userdata['business_plan']['bp_id'];
                }
                
                $selected_plan = $this->businessplans->getSelectedPlaneDetail($business_plan_id);
                //print_r($selected_plan) ;         die();     
                 foreach($selected_plan as $plan){
                    
                     $plandata['s1_niches_idea1'] = $plan->s1_niches_idea1;
                     $plandata['s1_niches_idea2'] = $plan->s1_niches_idea2;
                     $plandata['s1_niches_idea3'] = $plan->s1_niches_idea3;
                     $plandata['s1_niches_idea4'] = $plan->s1_niches_idea4;
                     $plandata['s1_niches_idea5'] = $plan->s1_niches_idea5;
                     $plandata['s2_selected_niche'] = $plan->s2_selected_niche;
                     $plandata['bp_id'] = $plan->bp_id;
                    
                     
                 }
                 
                 $viewdata = array(
                    'view_data'=>$plandata
                );
           
            }
            
            $this->load->view('common/headerfull',$data);
            if($formSubmit=='Save'){
                redirect("businessplan/step1/$business_plan_id", 'refresh');
                
            }else{
                $this->load->view('businessplan/step2',$viewdata);
            }
            $this->load->view('common/footerfull');
           
           
	}
        
        public function step3(){
            
            $business_plan_id =  $this->uri->segment(3);
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
           
           $formSubmit = $this->input->post('submitButton');
           $data = $this->modules_sidebar();
           
           if(isset($this->session->userdata['business_plan']['bp_id'])){
                $bp_id_prod = $this->session->userdata['business_plan']['bp_id'];
           }
           
           $userid = $this->session->userdata['logged_in']['id'];
           $this->load->helper('html');
            
           $bp_id = $this->input->post('bp_id'); 
            $selectedVal = $this->input->post('s2_selected_niche'); 
            if(empty($selectedVal) || ($selectedVal == 'on') ){
                $selectedVal = $this->input->post('change_mind'); 
            }
             $plandata = array(
                 'bp_id'=>$bp_id,
                 's2_selected_niche'=>$selectedVal,
             );
             
            //print_r($plandata); die();
             if(!empty($plandata)){
   
                $this->businessplans->createStep3($plandata);
             }
            
            $productUrls =  $this->businessplans->getSelectedProdDetail($business_plan_id);
            $prodUrls = array();
            foreach($productUrls as $url){
                $prodUrls[$url->id] = $url->s3_url;
               
            }
            
            //print_r($prodUrls); die();
                   
            $this->load->view('common/headerfull',$data);
            if($formSubmit=='Save'){
                redirect('businessplan/step2/'.$business_plan_id, 'refresh');
            }else{
                $this->load->view('businessplan/step3');
            }
            $this->load->view('common/footerfull');
           
           
	}
        
        public function step4()
	{
            $business_plan_id =  $this->uri->segment(3);
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
            
            $data = $this->modules_sidebar();
         
            $proddetails = $this->businessplans->getSelectedProdDetail($business_plan_id);
            $prodUrls = array();
            foreach($proddetails as $prod){
                $prodUrls[$prod->id] = $prod->s3_url;

            }
            $formSubmit = $this->input->post('submitButton');  
            
            if(isset($this->session->userdata['business_plan']['bp_id'])){
                $bp_id = $this->session->userdata['business_plan']['bp_id'];
            }
            
            $userid = $this->session->userdata['logged_in']['id'];

            //$s3_url = $this->input->post('s3_url');
            //print_r($_POST); die();
            $plan_exist = $this->businessplans->getSelectedProdDetail($business_plan_id);
            
            if(!empty($plan_exist)){
                
                //echo "here"; die();
                $s3_url1 = $this->input->post('s3_url1');
                $s3_url2 = $this->input->post('s3_url2');
                $s3_url3 = $this->input->post('s3_url3');
                $s3_url4 = $this->input->post('s3_url4');
                $s3_url5 = $this->input->post('s3_url5');
                
                $r_s3_url1 = $this->input->post('r_s3_url1');
                $r_s3_url2 = $this->input->post('r_s3_url2');
                $r_s3_url3 = $this->input->post('r_s3_url3');
                $r_s3_url4 = $this->input->post('r_s3_url4');
                $r_s3_url5 = $this->input->post('r_s3_url5');
                
                
                $produsturl1 = array('s3_url' => $s3_url1,'bp_id'=>$business_plan_id,'id'=>$r_s3_url1);
                $produsturl2 = array('s3_url' => $s3_url2,'bp_id'=>$business_plan_id,'id'=>$r_s3_url2);
                $produsturl3 = array('s3_url' => $s3_url3,'bp_id'=>$business_plan_id,'id'=>$r_s3_url3);
                $produsturl4 = array('s3_url' => $s3_url4,'bp_id'=>$business_plan_id,'id'=>$r_s3_url4);
                $produsturl5 = array('s3_url' => $s3_url5,'bp_id'=>$business_plan_id,'id'=>$r_s3_url5);
                
                
                $this->businessplans->updateProductUrls($produsturl1,$produsturl2,$produsturl3,$produsturl4,$produsturl5);
                
                
            }else{
                
                for($j=1; $j<=5; $j++){

                     $s3_url = $this->input->post('s3_url'.$j);
                     $proddata = array(
                                    'bp_id' => $business_plan_id,
                                    'user_id' => $userid,
                                    's3_url' => $s3_url,
                                   );
                     $this->businessplans->createStep4($proddata);

                }
                
            }
            
            $this->load->view('common/headerfull',$data);
             if($formSubmit=='Save'){
                 redirect('businessplan/step3/'.$business_plan_id, 'refresh');
             }else{
                 $this->load->view('businessplan/step4',array('prodUrls'=>$prodUrls));
             }
             $this->load->view('common/footerfull');
          
      }
      
      public function step5(){
          
            $business_plan_id =  $this->uri->segment(3);
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
            
            $data = $this->modules_sidebar();
            $product1 = array(
                'bp_id'=>$this->input->post('bp_id1'),
                's3_url'=>$this->input->post('url1'),
                's4_price'=>$this->input->post('price1'),
                's4_type'=>$this->input->post('type1'),
                's4_platform'=>$this->input->post('s4_platform1'),
                's4_network'=>$this->input->post('s4_network1'),
                's4_main_hook'=>$this->input->post('s4_main_hook1'),
                's4_product_promise'=>$this->input->post('s4_product_promise1'),
                'id'=>$this->input->post('recordid1')
                
             );
            
            $product2 = array(
                'bp_id'=>$this->input->post('bp_id2'),
                's3_url'=>$this->input->post('url2'),
                's4_price'=>$this->input->post('price2'),
                's4_type'=>$this->input->post('type2'),
                's4_platform'=>$this->input->post('s4_platform2'),
                's4_network'=>$this->input->post('s4_network2'),
                's4_main_hook'=>$this->input->post('s4_main_hook2'),
                's4_product_promise'=>$this->input->post('s4_product_promise2'),
                'id'=>$this->input->post('recordid2')
                
             );
            
            $product3 = array(
                'bp_id'=>$this->input->post('bp_id3'),
                's3_url'=>$this->input->post('url3'),
                's4_price'=>$this->input->post('price3'),
                's4_type'=>$this->input->post('type3'),
                's4_platform'=>$this->input->post('s4_platform3'),
                's4_network'=>$this->input->post('s4_network3'),
                's4_main_hook'=>$this->input->post('s4_main_hook3'),
                's4_product_promise'=>$this->input->post('s4_product_promise3'),
                'id'=>$this->input->post('recordid3')
                
             );
            
            $product4 = array(
                'bp_id'=>$this->input->post('bp_id4'),
                's3_url'=>$this->input->post('url4'),
                's4_price'=>$this->input->post('price4'),
                's4_type'=>$this->input->post('type4'),
                's4_platform'=>$this->input->post('s4_platform4'),
                's4_network'=>$this->input->post('s4_network4'),
                's4_main_hook'=>$this->input->post('s4_main_hook4'),
                's4_product_promise'=>$this->input->post('s4_product_promise4'),
                'id'=>$this->input->post('recordid4')
                
             );
            
            $product5 = array(
                'bp_id'=>$this->input->post('bp_id5'),
                's3_url'=>$this->input->post('url5'),
                's4_price'=>$this->input->post('price5'),
                's4_type'=>$this->input->post('type5'),
                's4_platform'=>$this->input->post('s4_platform5'),
                's4_network'=>$this->input->post('s4_network5'),
                's4_main_hook'=>$this->input->post('s4_main_hook5'),
                's4_product_promise'=>$this->input->post('s4_product_promise5'),
                'id'=>$this->input->post('recordid5')
                
             );
            
            $this->businessplans->updateProductDetail($product1,$product2,$product3,$product4,$product5);
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step5');
            $this->load->view('common/footerfull');
            
      }
      
      public function step6(){
            
            $business_plan_id =  $this->uri->segment(3);
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
          
            $data = $this->modules_sidebar();
            $main_price = array(
              's5_main_product_price'=>$this->input->post('s5_main_product_price'),
               'bp_id'=>$this->input->post('bp_id'),
           );
            
            $this->businessplans->updateProductMainPrice($main_price);
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step6');
            $this->load->view('common/footerfull');
            
      }
      
       public function step7(){
            
            $business_plan_id =  $this->uri->segment(3);
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
          
            $data = $this->modules_sidebar();
            $product_type = array(
              's6_product_type'=>$this->input->post('s6_product_type'),
               'bp_id'=>$business_plan_id,
             );
            
            $prodType  = $this->input->post('s6_product_type');
            $video_type_detail = $this->input->post('s6_video_type_detail');
            $audio_type_detail = $this->input->post('s6_audio_type_detail');
            $audio_type_detail = $this->input->post('s6_softwate_type_detail');
            
            if(!empty($video_type_detail) && ($prodType=='video') ){
                
                $product_type['s6_product_type_detail'] = $video_type_detail;
                
            }elseif(!empty($audio_type_detail) && ($prodType=='audio') ){
                
                $product_type['s6_product_type_detail'] = $audio_type_detail;
                
            }elseif(!empty($audio_type_detail) && ($prodType=='software') ){
                
                $product_type['s6_product_type_detail'] = $audio_type_detail;
                
            }
            //print_r($product_type); die();
            if(!empty($product_type['s6_product_type'])){
                $this->businessplans->updateProductType($product_type);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step7');
            $this->load->view('common/footerfull');
            
      }
      
      public function step8(){
            
            $business_plan_id =  $this->uri->segment(3);
            if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
          
            $data = $this->modules_sidebar();
            
            $s7_product_url = $this->input->post('s7_product_url');
            $s7_product_name = $this->input->post('s7_product_name');
            $s7_product_usp = $this->input->post('s7_product_usp');
            $s7_product_benifit = $this->input->post('s7_product_benifit');
            $s7_bp_id = $this->input->post('bp_id');
            
            $product_data = array(
              's7_product_url'=>$s7_product_url,
              's7_product_name'=>$s7_product_name,
              's7_product_usp'=>$s7_product_usp,
              's7_product_benifit'=>$s7_product_benifit,
              'bp_id'=>$s7_bp_id,
             );
          
            //print_r($product_data); die();
            if(!empty($product_data['bp_id'])){
                $this->businessplans->updateProductType($product_data);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step8');
            $this->load->view('common/footerfull');
            
      }
      
      
      
      public function step82(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
        
        $formSubmit = $this->input->post('submitButton');
        
        $post = array();
        foreach ( $_POST as $key => $value ){
            $post[$key] = $this->input->post($key);
            
        }
        //print_r($post); die();
        $productBoouneses =  $this->businessplans->getBusinessModules($business_plan_id);
        
       //print_r($productBoouneses); die();
       
        if(!empty($formSubmit)){
           $recordidcount = $this->input->post('recordidcount');
           $this->businessplans->createbusinesmodules($post,$recordidcount);
        }
        
        
        
        $data = $this->modules_sidebar();

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step82');
        $this->load->view('common/footerfull');
      
      }
      
      
      public function step9(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}
        
        $formSubmit = $this->input->post('submitButton');
        
        $post = array();
        foreach ( $_POST as $key => $value ){
            $post[$key] = $this->input->post($key);
            
        }
        $recordidcount = $this->input->post('recordidcount');
        if((!empty($formSubmit))){
        
            $this->businessplans->updateBusinessModulesStep2($post,$recordidcount);
        }
        $data = $this->modules_sidebar();

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step9');
        $this->load->view('common/footerfull');
      
      }
      
      
      public function step10(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s9_outsourcing = $this->input->post('s9_outsourcing');
         $s9_interview = $this->input->post('s9_interview');
         $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's9_outsourcing'=>$s9_outsourcing,
          's9_interview'=>$s9_interview,
          'bp_id'=>$bp_id,
         );
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductType($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step10');
        $this->load->view('common/footerfull');
      
      }
      
       public function deletbounes(){
            
            $id =  $this->uri->segment(3);
            $bp_id =  $this->uri->segment(4);
            if(empty($id)){redirect('businessplan/','refresh'); die();}
            
            $this->db->delete('businessplanbonuses', array('id' => $id)); 
            
            $data = $this->modules_sidebar();
            
            redirect('businessplan/step10/'.$bp_id, 'refresh');

      }
      
      public function deletemodule(){
        
        $id =  $this->uri->segment(3);
        $bp_id =  $this->uri->segment(4);
        if(empty($id)){redirect('businessplan/','refresh'); die();}

        $this->db->delete('businessplanmodule', array('id' => $id)); 

        $data = $this->modules_sidebar();

        redirect('businessplan/step8/'.$bp_id, 'refresh');
      }
      
      public function deletemodulebullets(){
        
        $id =  $this->uri->segment(3);
        $bp_id =  $this->uri->segment(4);
        if(empty($id)){redirect('businessplan/','refresh'); die();}

        $this->db->delete('businessplanmodule', array('id' => $id)); 

        $data = $this->modules_sidebar();

        redirect('businessplan/step82/'.$bp_id, 'refresh');
      }

      
      
      
      public function step11(){
          
        $business_plan_id =  $this->uri->segment(3);
        $formSubmit = $this->input->post('submitButton');
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
       $post = array();
        foreach ( $_POST as $key => $value ){
            
            $post[$key] = $this->input->post($key);
            
        }
   
        //echo "<pre>";print_r($post); echo count($_POST); die();
        
        $productBoouneses =  $this->businessplans->getProductBounses($business_plan_id);
        
        
        if(!empty($productBoouneses[0]->bp_id)&&(!empty($formSubmit))){
            
           
            $this->db->delete('businessplanbonuses', array('bp_id' => $business_plan_id));
            
        }
        
        
        
        $recordidcount = $this->input->post('recordidcount');
        $this->businessplans->createbusinessplanbonuses($post,$recordidcount);
        
        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step11');
        $this->load->view('common/footerfull');
      
      }
      
      public function step11a(){
          
        $formSubmit = $this->input->post('step11a');  
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        $s11_has_upsell = $this->input->post('s11_has_upsell');
        $step11upsellno = $this->input->post('step11upsellno');
        
        $upsell_data = array(
          's11_has_upsell'=>$s11_has_upsell,
          'bp_id'=>$business_plan_id,
          's11_step'=>$step11upsellno
         );
        
        //print_r($upsell_data); die();
        if(isset($formSubmit)){
        if($s11_has_upsell == 0){
            
            $upsell_data['s11_upsell_prod_name'] = "";
            $upsell_data['s11_upsell_price'] = "";
            $upsell_data['s11_upsell_detail'] = "";
            $upsell_data['s11_upsell_type'] = "";
            
            $upsell_data['s11_has_downsell'] = "";
            
            
            $upsell_data['s11_downsell_prod_name'] = "";
            $upsell_data['s11_downsell_price'] = "";
            $upsell_data['s11_downsell_detail'] = "";
            $upsell_data['s11_downsell_type'] = "";
            
            
            $product_data = $this->businessplans->getProductUpsell($business_plan_id);

            if(empty($product_data)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                $this->businessplans->createUpsell($upsell_data);
            }else{
                
                $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step12');
            $this->load->view('common/footerfull');
            
            
        }else{
        
            if($s11_has_upsell == 1){

                $s11_upsell_prod_name = $this->input->post('s11_upsell_prod_name');
                $s11_upsell_price = $this->input->post('s11_upsell_price');
                $s11_upsell_detail = $this->input->post('s11_upsell_detail');
                $s11_upsell_type = $this->input->post('s11_upsell_type'); 

                $upsell_data['s11_upsell_prod_name'] = $s11_upsell_prod_name;
                $upsell_data['s11_upsell_price'] = $s11_upsell_price;
                $upsell_data['s11_upsell_detail'] = $s11_upsell_detail;
                $upsell_data['s11_upsell_type'] = $s11_upsell_type;

            }

            $s11_has_downsell = $this->input->post('s11_has_downsell');

            $upsell_data['s11_has_downsell'] = $s11_has_downsell;

            if($s11_has_downsell == 1){

                $s11_downsell_prod_name = $this->input->post('s11_downsell_prod_name');
                $s11_downsell_price = $this->input->post('s11_downsell_price');
                $s11_downsell_detail = $this->input->post('s11_downsell_detail');
                $s11_downsell_type = $this->input->post('s11_downsell_type'); 

                $upsell_data['s11_downsell_prod_name'] = $s11_downsell_prod_name;
                $upsell_data['s11_downsell_price'] = $s11_downsell_price;
                $upsell_data['s11_downsell_detail'] = $s11_downsell_detail;
                $upsell_data['s11_downsell_type'] = $s11_downsell_type;

            }else{
                $upsell_data['s11_downsell_prod_name'] = "";
                $upsell_data['s11_downsell_price'] = "";
                $upsell_data['s11_downsell_detail'] = "";
                $upsell_data['s11_downsell_type'] = "";
            }

            //print_r($upsell_data); die();
            
            
            
            if($step11upsellno=='step11'){
                $product_data = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                
                if(empty($product_data)){
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
                
            }elseif($step11upsellno=='step11a'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }
            
          }
         
        }


            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11a');
            $this->load->view('common/footerfull');
          
      }
      
      public function step11b(){
          
        $formSubmit = $this->input->post('step11b');  
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        $s11_has_upsell = $this->input->post('s11_has_upsell');
        $step11upsellno = $this->input->post('step11upsellno');
        
        $upsell_data = array(
          's11_has_upsell'=>$s11_has_upsell,
          'bp_id'=>$business_plan_id,
          's11_step'=>$step11upsellno
         );
        
        //print_r($upsell_data); die();
        if(isset($formSubmit)){
        if($s11_has_upsell == 0){
            
            $upsell_data['s11_upsell_prod_name'] = "";
            $upsell_data['s11_upsell_price'] = "";
            $upsell_data['s11_upsell_detail'] = "";
            $upsell_data['s11_upsell_type'] = "";
            
            $upsell_data['s11_has_downsell'] = "";
            
            
            $upsell_data['s11_downsell_prod_name'] = "";
            $upsell_data['s11_downsell_price'] = "";
            $upsell_data['s11_downsell_detail'] = "";
            $upsell_data['s11_downsell_type'] = "";
            
            
            $product_data = $this->businessplans->getProductUpsell($business_plan_id);

            if(empty($product_data)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                $this->businessplans->createUpsell($upsell_data);
            }else{
                
                $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11b');
            $this->load->view('common/footerfull');
            
            
        }else{
        
            if($s11_has_upsell == 1){

                $s11_upsell_prod_name = $this->input->post('s11_upsell_prod_name');
                $s11_upsell_price = $this->input->post('s11_upsell_price');
                $s11_upsell_detail = $this->input->post('s11_upsell_detail');
                $s11_upsell_type = $this->input->post('s11_upsell_type'); 

                $upsell_data['s11_upsell_prod_name'] = $s11_upsell_prod_name;
                $upsell_data['s11_upsell_price'] = $s11_upsell_price;
                $upsell_data['s11_upsell_detail'] = $s11_upsell_detail;
                $upsell_data['s11_upsell_type'] = $s11_upsell_type;

            }

            $s11_has_downsell = $this->input->post('s11_has_downsell');

            $upsell_data['s11_has_downsell'] = $s11_has_downsell;

            if($s11_has_downsell == 1){

                $s11_downsell_prod_name = $this->input->post('s11_downsell_prod_name');
                $s11_downsell_price = $this->input->post('s11_downsell_price');
                $s11_downsell_detail = $this->input->post('s11_downsell_detail');
                $s11_downsell_type = $this->input->post('s11_downsell_type'); 

                $upsell_data['s11_downsell_prod_name'] = $s11_downsell_prod_name;
                $upsell_data['s11_downsell_price'] = $s11_downsell_price;
                $upsell_data['s11_downsell_detail'] = $s11_downsell_detail;
                $upsell_data['s11_downsell_type'] = $s11_downsell_type;

            }else{
                $upsell_data['s11_downsell_prod_name'] = "";
                $upsell_data['s11_downsell_price'] = "";
                $upsell_data['s11_downsell_detail'] = "";
                $upsell_data['s11_downsell_type'] = "";
            }

            //print_r($upsell_data); die();
            
            
            
            if($step11upsellno=='step11'){
                $product_data = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                
                if(empty($product_data)){
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
                
            }elseif($step11upsellno=='step11a'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }
            
            }
         }


            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11b');
            $this->load->view('common/footerfull');
          
      }
      
      public function step11c(){
          
        $formSubmit = $this->input->post('step11c');  
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        $s11_has_upsell = $this->input->post('s11_has_upsell');
        $step11upsellno = $this->input->post('step11upsellno');
        
        $upsell_data = array(
          's11_has_upsell'=>$s11_has_upsell,
          'bp_id'=>$business_plan_id,
          's11_step'=>$step11upsellno
         );
        
        //print_r($upsell_data); die();
        if(isset($formSubmit)){
        if($s11_has_upsell == 0){
            
            $upsell_data['s11_upsell_prod_name'] = "";
            $upsell_data['s11_upsell_price'] = "";
            $upsell_data['s11_upsell_detail'] = "";
            $upsell_data['s11_upsell_type'] = "";
            
            $upsell_data['s11_has_downsell'] = "";
            
            
            $upsell_data['s11_downsell_prod_name'] = "";
            $upsell_data['s11_downsell_price'] = "";
            $upsell_data['s11_downsell_detail'] = "";
            $upsell_data['s11_downsell_type'] = "";
            
            
            $product_data = $this->businessplans->getProductUpsell($business_plan_id);

            if(empty($product_data)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                $this->businessplans->createUpsell($upsell_data);
            }else{
                
                $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11b');
            $this->load->view('common/footerfull');
            
            
        }else{
        
            if($s11_has_upsell == 1){

                $s11_upsell_prod_name = $this->input->post('s11_upsell_prod_name');
                $s11_upsell_price = $this->input->post('s11_upsell_price');
                $s11_upsell_detail = $this->input->post('s11_upsell_detail');
                $s11_upsell_type = $this->input->post('s11_upsell_type'); 

                $upsell_data['s11_upsell_prod_name'] = $s11_upsell_prod_name;
                $upsell_data['s11_upsell_price'] = $s11_upsell_price;
                $upsell_data['s11_upsell_detail'] = $s11_upsell_detail;
                $upsell_data['s11_upsell_type'] = $s11_upsell_type;

            }

            $s11_has_downsell = $this->input->post('s11_has_downsell');

            $upsell_data['s11_has_downsell'] = $s11_has_downsell;

            if($s11_has_downsell == 1){

                $s11_downsell_prod_name = $this->input->post('s11_downsell_prod_name');
                $s11_downsell_price = $this->input->post('s11_downsell_price');
                $s11_downsell_detail = $this->input->post('s11_downsell_detail');
                $s11_downsell_type = $this->input->post('s11_downsell_type'); 

                $upsell_data['s11_downsell_prod_name'] = $s11_downsell_prod_name;
                $upsell_data['s11_downsell_price'] = $s11_downsell_price;
                $upsell_data['s11_downsell_detail'] = $s11_downsell_detail;
                $upsell_data['s11_downsell_type'] = $s11_downsell_type;

            }else{
                $upsell_data['s11_downsell_prod_name'] = "";
                $upsell_data['s11_downsell_price'] = "";
                $upsell_data['s11_downsell_detail'] = "";
                $upsell_data['s11_downsell_type'] = "";
            }

            //print_r($upsell_data); die();
            
            
            
            if($step11upsellno=='step11'){
                $product_data = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                
                if(empty($product_data)){
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
                
            }elseif($step11upsellno=='step11a'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }elseif($step11upsellno=='step11b'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }
            
            
            
          }
            
         }


            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11c');
            $this->load->view('common/footerfull');
          
      }
      
      public function step11d(){
          
        $formSubmit = $this->input->post('step11d');  
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        $s11_has_upsell = $this->input->post('s11_has_upsell');
        $step11upsellno = $this->input->post('step11upsellno');
        
        $upsell_data = array(
          's11_has_upsell'=>$s11_has_upsell,
          'bp_id'=>$business_plan_id,
          's11_step'=>$step11upsellno
         );
        
        //print_r($upsell_data); die();
        if(isset($formSubmit)){
        if($s11_has_upsell == 0){
            
            $upsell_data['s11_upsell_prod_name'] = "";
            $upsell_data['s11_upsell_price'] = "";
            $upsell_data['s11_upsell_detail'] = "";
            $upsell_data['s11_upsell_type'] = "";
            
            $upsell_data['s11_has_downsell'] = "";
            
            
            $upsell_data['s11_downsell_prod_name'] = "";
            $upsell_data['s11_downsell_price'] = "";
            $upsell_data['s11_downsell_detail'] = "";
            $upsell_data['s11_downsell_type'] = "";
            
            
            $product_data = $this->businessplans->getProductUpsell($business_plan_id);

            if(empty($product_data)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                $this->businessplans->createUpsell($upsell_data);
            }else{
                
                $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11b');
            $this->load->view('common/footerfull');
            
            
        }else{
        
            if($s11_has_upsell == 1){

                $s11_upsell_prod_name = $this->input->post('s11_upsell_prod_name');
                $s11_upsell_price = $this->input->post('s11_upsell_price');
                $s11_upsell_detail = $this->input->post('s11_upsell_detail');
                $s11_upsell_type = $this->input->post('s11_upsell_type'); 

                $upsell_data['s11_upsell_prod_name'] = $s11_upsell_prod_name;
                $upsell_data['s11_upsell_price'] = $s11_upsell_price;
                $upsell_data['s11_upsell_detail'] = $s11_upsell_detail;
                $upsell_data['s11_upsell_type'] = $s11_upsell_type;

            }

            $s11_has_downsell = $this->input->post('s11_has_downsell');

            $upsell_data['s11_has_downsell'] = $s11_has_downsell;

            if($s11_has_downsell == 1){

                $s11_downsell_prod_name = $this->input->post('s11_downsell_prod_name');
                $s11_downsell_price = $this->input->post('s11_downsell_price');
                $s11_downsell_detail = $this->input->post('s11_downsell_detail');
                $s11_downsell_type = $this->input->post('s11_downsell_type'); 

                $upsell_data['s11_downsell_prod_name'] = $s11_downsell_prod_name;
                $upsell_data['s11_downsell_price'] = $s11_downsell_price;
                $upsell_data['s11_downsell_detail'] = $s11_downsell_detail;
                $upsell_data['s11_downsell_type'] = $s11_downsell_type;

            }else{
                $upsell_data['s11_downsell_prod_name'] = "";
                $upsell_data['s11_downsell_price'] = "";
                $upsell_data['s11_downsell_detail'] = "";
                $upsell_data['s11_downsell_type'] = "";
            }

            //print_r($upsell_data); die();
            
            
            
            if($step11upsellno=='step11'){
                $product_data = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                
                if(empty($product_data)){
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
                
            }elseif($step11upsellno=='step11a'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }elseif($step11upsellno=='step11b'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }elseif($step11upsellno=='step11c'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }
            
            
            
          }
            
         }


            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step11d');
            $this->load->view('common/footerfull');
          
      }
      
       public function step12(){
           
        $formSubmit = $this->input->post('submitButton');  
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        $s11_has_upsell = $this->input->post('s11_has_upsell');
        $step11upsellno = $this->input->post('step11upsellno');
        
        $upsell_data = array(
          's11_has_upsell'=>$s11_has_upsell,
          'bp_id'=>$business_plan_id,
          's11_step'=>$step11upsellno
         );
        
        //print_r($upsell_data); die();
        if(isset($formSubmit)){
        if($s11_has_upsell == 0){
            
            $upsell_data['s11_upsell_prod_name'] = "";
            $upsell_data['s11_upsell_price'] = "";
            $upsell_data['s11_upsell_detail'] = "";
            $upsell_data['s11_upsell_type'] = "";
            
            $upsell_data['s11_has_downsell'] = "";
            
            
            $upsell_data['s11_downsell_prod_name'] = "";
            $upsell_data['s11_downsell_price'] = "";
            $upsell_data['s11_downsell_detail'] = "";
            $upsell_data['s11_downsell_type'] = "";
            
            
            $product_data = $this->businessplans->getProductUpsell($business_plan_id);

            if(empty($product_data)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                $this->businessplans->createUpsell($upsell_data,$step11upsellno);
            }else{
                
                $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
            }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step12');
            $this->load->view('common/footerfull');
            
            
        }else{
        
            if($s11_has_upsell == 1){

                $s11_upsell_prod_name = $this->input->post('s11_upsell_prod_name');
                $s11_upsell_price = $this->input->post('s11_upsell_price');
                $s11_upsell_detail = $this->input->post('s11_upsell_detail');
                $s11_upsell_type = $this->input->post('s11_upsell_type'); 

                $upsell_data['s11_upsell_prod_name'] = $s11_upsell_prod_name;
                $upsell_data['s11_upsell_price'] = $s11_upsell_price;
                $upsell_data['s11_upsell_detail'] = $s11_upsell_detail;
                $upsell_data['s11_upsell_type'] = $s11_upsell_type;

            }

            $s11_has_downsell = $this->input->post('s11_has_downsell');

            $upsell_data['s11_has_downsell'] = $s11_has_downsell;

            if($s11_has_downsell == 1){

                $s11_downsell_prod_name = $this->input->post('s11_downsell_prod_name');
                $s11_downsell_price = $this->input->post('s11_downsell_price');
                $s11_downsell_detail = $this->input->post('s11_downsell_detail');
                $s11_downsell_type = $this->input->post('s11_downsell_type'); 

                $upsell_data['s11_downsell_prod_name'] = $s11_downsell_prod_name;
                $upsell_data['s11_downsell_price'] = $s11_downsell_price;
                $upsell_data['s11_downsell_detail'] = $s11_downsell_detail;
                $upsell_data['s11_downsell_type'] = $s11_downsell_type;

            }else{
                $upsell_data['s11_downsell_prod_name'] = "";
                $upsell_data['s11_downsell_price'] = "";
                $upsell_data['s11_downsell_detail'] = "";
                $upsell_data['s11_downsell_type'] = "";
            }

            //print_r($upsell_data); die();
            
            
            
            if($step11upsellno=='step11'){
                $product_data = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                
                if(empty($product_data)){
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
                
            }elseif($step11upsellno=='step11a'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }elseif($step11upsellno=='step11b'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }elseif($step11upsellno=='step11c'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }elseif($step11upsellno=='step11d'){
               
                $stepupsellstage = $this->businessplans->cehckProductUpsellExist($business_plan_id,$step11upsellno);
                if(empty($stepupsellstage)){
                //$this->businessplans->updateUpsellProduct($upsell_data);
                    $this->businessplans->createUpsell($upsell_data);
                }else{
                   
                    $this->businessplans->updateUpsellProduct($upsell_data,$step11upsellno);
                }
            }
        }
     }


            $this->load->view('common/headerfull',$data);
            $this->load->view('businessplan/step12');
            $this->load->view('common/footerfull');
            
        
        
        
            
      }
      
      public function step13(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s9_outsourcing = $this->input->post('s12_outsourcing');
         $s9_interview = $this->input->post('s12_interview');
         $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's12_outsourcing'=>$s9_outsourcing,
          's12_interview'=>$s9_interview,
          'bp_id'=>$bp_id,
         );
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductType($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step13');
        $this->load->view('common/footerfull');
      
      }
      
      
      public function step14(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s13_system = $this->input->post('s13_system');
          $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's13_system'=>$s13_system,
          'bp_id'=>$bp_id,
         );
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductSystem($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step14');
        $this->load->view('common/footerfull');
      
      }
      
      
      public function step15(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s14_autoresponder = $this->input->post('s14_autoresponder');
         $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's14_autoresponder'=>$s14_autoresponder,
          'bp_id'=>$bp_id
         );
        
         $s14_autoresponder_other = $this->input->post('s14_autoresponder_other');
        
        if(!empty($s14_autoresponder_other)){
            
            $product_data = array('s14_autoresponder'=>$s14_autoresponder."###".$s14_autoresponder_other,'bp_id'=>$bp_id);
            
        }
        
       // echo "<pre>";print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductSystem($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step15');
        $this->load->view('common/footerfull');
      
      }
      
      
      public function step16(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s15_payment_process = $this->input->post('s15_payment_process');
          $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's15_payment_process'=>$s15_payment_process,
          'bp_id'=>$bp_id,
         );
        
        $s15_payment_process_other = $this->input->post('s15_payment_process_other');
        
        if(!empty($s15_payment_process_other)){
            
            $product_data = array('s15_payment_process'=>$s15_payment_process."###".$s15_payment_process_other,'bp_id'=>$bp_id);
            
        }
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductPaymentProcess($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step16');
        $this->load->view('common/footerfull');
      
      }
      
      public function step17(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s16_customer_support = $this->input->post('s16_customer_support');
          $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's16_customer_support'=>$s16_customer_support,
          'bp_id'=>$bp_id,
         );
        
        $s16_customer_support_other = $this->input->post('s16_customer_support_other');
        
        if(!empty($s16_customer_support_other)){
            
            $product_data = array('s16_customer_support'=>$s16_customer_support."###".$s16_customer_support_other,'bp_id'=>$bp_id);
            
        }
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductPaymentProcess($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step17');
        $this->load->view('common/footerfull');
      
      }
      
      public function step18(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s17_product_type = $this->input->post('s17_product_type');
          $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's17_product_type'=>$s17_product_type,
          'bp_id'=>$bp_id,
         );
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductSaleType($product_data);
        }

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/step18');
        $this->load->view('common/footerfull');
      
      }
      
      
      public function finish(){
          
        $business_plan_id =  $this->uri->segment(3);
        if(empty($business_plan_id)){redirect('businessplan/','refresh'); die();}

        $data = $this->modules_sidebar();
        
        
         $s18_copywriting = $this->input->post('s18_copywriting');
          $bp_id = $this->input->post('bp_id');
         
        $product_data = array(
          's18_copywriting'=>$s18_copywriting,
          'bp_id'=>$bp_id,
         );
        
        //print_r($product_data); die();
        if(!empty($product_data['bp_id'])){
            $this->businessplans->updateProductCopyWrite($product_data);
        }
        
        $downloadLink = $this ->GenerateBusinesPLanPDF($product_data['bp_id']);
        $linkData = array(
          'pdfDownloadLink'=>$downloadLink          
         );

        $this->load->view('common/headerfull',$data);
        $this->load->view('businessplan/finish',$linkData);
        $this->load->view('common/footerfull');
      
      }
      

     

	function getUserDetail($userinfo){

		$userdetail = array(
			'userinfo'=>$userinfo
		);

		$userdata = array();

		foreach($userdetail as $user){
			$userdata['id'] = $user[0]->id;
			$userdata['email'] = $user[0]->email;
			$userdata['username'] = $user[0]->username;
			$userdata['created_date'] = $user[0]->created_date;
			$userdata['lastlogin_date'] = $user[0]->lastlogin_date;
			$userdata['is_active'] = $user[0]->is_active;
			$userdata['full_name'] = $user[0]->full_name;
			$userdata['image'] = $user[0]->image;
			$userdata['about'] = $user[0]->about;
		}

		return $userdata;
	}

	


	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}



	function modules_sidebar(){

		$this->load->model('modules','',TRUE);
		$modules = $this->modules->getAllModules();

		$x = 3;
		$user_data = $this->session->all_userdata();
		$created_date = $this->session->userdata['logged_in']['created_date'];
		$id = $this->session->userdata['logged_in']['id'];
		$query = $this->user->userRecord($id);
		foreach($query as $row){ $aDate = date('Y-m-d',strtotime($row->created_date)); }

		$this->load->model('DateMathClass','',TRUE);
		$diff = $this->DateMathClass->DifferenceInDays($aDate);
		$unlockModules = floor($diff/$x);

		$userid = $this->session->userdata['logged_in']['id'];
		$userinfo = $this->user->userRecord($userid);
		$userdata = $this->getUserDetail($userinfo);


		$data = array(
			'unlockModules' => $unlockModules,
			'modules' => $modules,
			'userdata'=>$userdata

		);

		return $data;

	}

	function fbredirect(){
		/*Load the URL helper*/
		$this->load->helper('url');

		/*Redirect the user to some site*/
		redirect('https://www.facebook.com');
		die();
	}

	function twitredirect(){
		/*Load the URL helper*/
		$this->load->helper('url');

		/*Redirect the user to some site*/
		redirect('https://twitter.com/');
		die();
	}
        
        public function GenerateBusinesPLanPDF($businesPlanId){
            //$fileDownloadLink = "http://www.google.com";
          $url = "http://members.launchmyempire.com/htmlToPdf/index.php?p_id=".$businesPlanId;

          $ch      = curl_init();

          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

          $fileDownloadLink = curl_exec($ch);
          curl_close($ch);


            return $fileDownloadLink;
        }
        
        public function deleteplan(){
            
            $bp_id =  $this->uri->segment(3);
            if(empty($bp_id)){redirect('businessplan/','refresh'); die();}
            
            $this->db->delete('businessplan', array('id' => $bp_id)); 
            $this->db->delete('businessplanproductdetail', array('bp_id' => $bp_id)); 
            $this->db->delete('businessplanmodule', array('bp_id' => $bp_id)); 
            $this->db->delete('businessplandetail', array('bp_id' => $bp_id)); 
            $this->db->delete('businessplanbonuses', array('bp_id' => $bp_id)); 
            $this->db->delete('upsell', array('bp_id' => $bp_id)); 

            redirect('businessplan', 'refresh');

        }
        
        public function deletupsell(){
            
            $step_id =  $this->uri->segment(3);
            $bp_id =  $this->uri->segment(4);
            
            if(empty($bp_id) || empty($step_id)){redirect('businessplan/','refresh'); die();}
            
            
            
            $steparray =  array('step11a','step11b','step11c','step11d');
            //print_r($steparray); die();
            $this->db->where('bp_id', $bp_id);
            $this->db->where('s11_step', $step_id);
            $this->db->delete('upsell');
            
            $additionalUpsells = $this->businessplans->getProductNextUpsell($bp_id);
            
            $count =0;
            
            foreach ($additionalUpsells as $upsell){
                //echo "<pre>"; print_r($upsell->s11_step);
                if(($upsell->s11_step != 'step11')){
                   
                    $stepid = $upsell->s11_step;
                    $this->businessplans->updateProductNextUpsellStep($bp_id,$stepid,$count);
                    $count++;
                    
                }
                   
            }
            
            redirect('businessplan/step11/'.$bp_id);

        }
        
        
        public function loadmicroniches(){
            
            $parent_id =  $this->uri->segment(3);
            $this->load->model('businessplans','',TRUE);
            $microNiches  = $this->businessplans->getMicroNiches($parent_id);
            
            $selectedniche = $this->businessplans->getselectedNiches($business_plan_id);
            ?>
            <option value="">Please Select MicroNiche</option>    
            <?php foreach($microNiches as $niche ){?>
                
                <option value="<?php echo $niche->niche."###".$niche->microniche ?>"><?php echo $niche->microniche; ?></option>
           <?php }
            
        }
    
}
?>