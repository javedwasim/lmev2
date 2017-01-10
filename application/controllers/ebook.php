<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ebook extends CI_Controller {

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
        $this->load->model('ebookM','',TRUE);
    }

	public function index()
	{
           $data = $this->modules_sidebar();
            
            
            $alleBooks = $this->ebookM->getAllEbooks();
                  
            $this->load->helper('html');
            $this->load->view('common/headerfull',$data);
            $this->load->view('ebook/index',array('myAllEbooksData'=>$alleBooks));
            $this->load->view('common/footerfull');
		
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
        
       

      public function generate(){
          
          //$ebook_id =  $this->uri->segment(3);
          //if(empty($ebook_id)){redirect('ebook/','refresh'); die();}
          
           $data = $this->modules_sidebar();
           $this->load->helper('html');
           $ebookName = $this->input->post('ebookname');
           
           if($ebookName){
                
               $createplane = $this->ebookM->createNewEBook($ebookName);
               
                $ebookid = array('id'=>$createplane);
                $this->load->view('common/headerfull',$data);
                $this->load->view('ebook/generate',$ebookid);
                $this->load->view('common/footerfull');
                
            }else{  
                
                $this->load->view('common/headerfull',$data);
                $this->load->view('ebook/generate',array('id'=>''));
                $this->load->view('common/footerfull');
                
            }   
            
	}
        
        function grabcontent(){
            
            $ebook_id =  $this->uri->segment(3);
            if(empty($ebook_id)){redirect('ebook/','refresh'); die();}
            
            $data = $this->modules_sidebar();
             
            $content_value = $this->input->post('mycustomerhtml2');
            
            $ebook_data = array(
                        'id'=>$ebook_id,
                        'ebookcontent'=>$content_value
                    );
            if(!empty($content_value)){
            
                $this->ebookM->savecontent($ebook_data);
            }
            
            $url = $this->input->post('grabcontent');
            if(isset($url)){
                //$dom = file_get_contents($url);
				$url = rtrim($url,"/");
				$url = $url."/";
				$urlpart1 = "http://members.launchmyempire.com/htmlgrabber/index.php?url=" . $url;
				$ch      = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlpart1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$htmldata = curl_exec($ch);
				curl_close($ch);
				$dom = $htmldata;
				
				
            }else{
                $dom = "";
            }
            //var_dump($dom); die();
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('ebook/generate',array('id'=>$ebook_id,'content'=>$content_value,'grabcontent'=>$dom));
            $this->load->view('common/footerfull');
            
            
            
        }
                
        function savecontent(){
            
            $ebook_id =  $this->uri->segment(3);
            if(empty($ebook_id)){redirect('ebook/','refresh'); die();}
            
             $data = $this->modules_sidebar();
          
            $content_value = $this->input->post('mycustomerhtml2');
            
            $ebook_data = array(
                        'id'=>$ebook_id,
                        'ebookcontent'=>$content_value
                    );
            if(!empty($content_value)){
            
                $this->ebookM->savecontent($ebook_data);
            }
            
            
             $generatepdf = $this->input->post('submitButton');
             $fileDownloadLink="";
             
             if(!empty($generatepdf)){
                 
                 $rawHTML = $content_value;

                $currTimeStap = time();
                $uniqueFileName = "TempFilesDirectory/tempHTML".$currTimeStap.".html";

                $myfile = fopen($uniqueFileName, "w") or die("Unable to open file!");

                fwrite($myfile, $rawHTML);

                fclose($myfile);
                
                $path = "wkhtmltopdf\bin\wkhtmltopdf.exe";
            
                $fixURL = "http://members.launchmyempire.com/";

                $url = $fixURL.$uniqueFileName;
                // echo "URL = " . $url;
                $fileNamePDF = "YourEBook" . $currTimeStap . ".pdf";

                $output_path = "TempFilesDirectory/" . $fileNamePDF;

                $fileDownloadLink = $fixURL.$output_path;

                shell_exec("$path $url $output_path");
                 
             }
            
            $this->load->view('common/headerfull',$data);
            $this->load->view('ebook/generate',array('id'=>$ebook_id,'content'=>$content_value,'downloadlink'=>$fileDownloadLink));
            $this->load->view('common/footerfull');
            
            
            
        }
        
}
