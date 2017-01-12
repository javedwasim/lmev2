<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

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

	
	public $userid;
         
    function __construct() {
        parent::__construct();
		if(!$this->session->userdata('logged_in')){
            redirect('login', 'refresh');
			die();
        }
		$this->userid = $this->session->userdata['logged_in']['id'];

		$this->load->helper(array('form', 'url'));
        $this->load->model('user','',TRUE);
    }

	public function index()
	{
		$data = $this->modules_sidebar();

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/asidebar',$data);
		$this->load->view('bootstrap/body');
		$this->load->view('bootstrap/footer');
		
	}

	public function support()
	{
		$data = $this->modules_sidebar();

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/asidebar',$data);
		$this->load->view('bootstrap/support');
		$this->load->view('bootstrap/footer');

	}

	function coursemodules(){

		$data = $this->modules_sidebar();

		$module_count = count($data['modules']);
		$unlockModules = $data['unlockModules'];
		$TotalModulesToOpen = $unlockModules+1;

		$this->load->model('modules','',TRUE);
		$modules = $this->modules->getAllModules();

		$modules = array(
			'modules' =>$modules,
			'module_count' => $module_count,
			'unlockModules' =>$unlockModules,
			'TotalModulesToOpen'=>$TotalModulesToOpen
		);

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/asidebar',$data);
		$this->load->view('bootstrap/coursemodules',$modules);
		$this->load->view('bootstrap/footer');


	}

	function uservideolink(){

		$this->load->model('modules','',TRUE);

		$user_id = $this->input->post('user_id');
		$module_id = $this->input->post('module_id');


		$this->modules->userVideosLink($user_id,$module_id);
	}


	function uservideos(){

		$this->load->model('modules','',TRUE);

		$user_id = $this->input->post('user_id');
	 	$module_id = $this->input->post('module_id');


		$this->modules->userVideos($user_id,$module_id);
	}

	function module(){

		$module_number =  $this->uri->segment(3);

		$data = $this->modules_sidebar();

		$module_count = count($data['modules']);
		$unlockModules = $data['unlockModules'];
		$TotalModulesToOpen = $unlockModules+1;

		$this->load->model('modules','',TRUE);
		if($module_number>0) {
			$selectedModule = $this->modules->getSelectedModule($module_number);
		}else{
			$selectedModule = $this->modules->getAllModules();
		}

		$getAllModuleVideos = $this->modules->getAllModulesVideos($module_number);
		$module_videos_count = count($getAllModuleVideos);
		//echo "<pre>"; print_r($getAllModuleVideos); die();
		$moduleWatchedVideoCount = $this->moduleWatchedVideos($module_number);
		$moduleProgress = ($moduleWatchedVideoCount/$module_videos_count)*100;

		$module_number = array(
						'module_number' => $module_number,
						'module_title' =>$selectedModule[0]['module_title'],
						'module_vides' =>$getAllModuleVideos,
						'module_count' => $module_count,
						'unlockModules' =>$unlockModules,
						'TotalModulesToOpen'=>$TotalModulesToOpen,
						'moduleProgress'=>$moduleProgress
		);

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/sidebar',$data);
		$this->load->view('bootstrap/module',$module_number);
		$this->load->view('bootstrap/footer');

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

	function do_upload()
	{
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			print_r($data); die();

			$this->load->view('upload_success', $data);
		}
	}

	function supportmail(){

		$supportemail = $this->input->post('supportemail');
		$name = $this->input->post('name');
		$message = $this->input->post('message');

		if(!empty($supportemail)){

			$username = $supportemail;

			require_once("imail/PHPMailer-master/PHPMailerAutoload.php");

			$mail = new PHPMailer(true);

			//Send mail using gmail
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPAuth = true; // enable SMTP authentication
			//$mail->SMTPSecure = "tls"; // sets the prefix to the servier
			$mail->Host = "mail.designprofitacademy.com"; // sets GMAIL as the SMTP server
			$mail->Port = 25; // set the SMTP port for the GMAIL server
			$mail->Username = "support@designprofitacademy.com"; // GMAIL username
			$mail->Password = "MjfN4!t6oj%ER7C"; // GMAIL password

			//Typical mail data
			$mail->AddReplyTo('support@designprofitacademy.com',"DWC Support");
			$mail->AddAddress($username);
			$mail->SetFrom('support@designprofitacademy.com', 'DWC Support');
			$mail->Subject = "Email From Launch My Empire";

			$messageBody = 'Hello <br/><br/>';
			$messageBody .=  $message;
			$mail->MsgHTML($messageBody);

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}

		}

		$data = $this->modules_sidebar();

		$support = array(
			'mailsent'=>'1'
		);

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/support',$support);
		$this->load->view('bootstrap/footer');

	}

	function changepassword(){

		$updateProfileValues = array();
		$randomPwd = $this->input->post('password');
		if(!empty($randomPwd)){
			$password = md5($randomPwd);
			$updateProfileValues['password'] = $password;
		}

		$userid = $this->session->userdata['logged_in']['id'];
		$this->load->model('user','',TRUE);
		$this->user->updateUserPassword($updateProfileValues,$userid);

		$data = $this->modules_sidebar();
		$userinfo = $this->user->userRecord($userid);
		$userdata = $this->getUserDetail($userinfo);



		$user_detail = array(
			'userdata' => $userdata,
			'passwordchanded'=>'1'
		);



		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/profile',$user_detail);
		$this->load->view('bootstrap/footer');


	}

	function profileupdated(){

		$config['upload_path'] = './img/profile/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$image_name = "";

		}
		else
		{
			$image_data = array('upload_data' => $this->upload->data());
			$image_name = $image_data['upload_data']['file_name'];
		}



		//update user profile form fields
		$formvalues =  array('full_name', 'email','about', 'password');

		$updateProfileValues = array();

		foreach($formvalues as $field) {
			if (!empty($_POST[$field])) {
				$updateProfileValues[$field] = $_POST[$field];
			}
		}

		if(!empty($image_name)){
			$updateProfileValues['image'] = $image_name;
		}

		$userid = $this->session->userdata['logged_in']['id'];
		$this->load->model('user','',TRUE);
		$this->user->updateUserProfile($updateProfileValues,$userid);

		//load updated view and email in case of password updated

		$data = $this->modules_sidebar();
		$userinfo = $this->user->userRecord($userid);
		$userdata = $this->getUserDetail($userinfo);

		$user_detail = array(
			'userdata' => $userdata,
			'profileupdated'=>'1'
		);



		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/asidebar',$data);
		$this->load->view('bootstrap/profile',$user_detail);
		$this->load->view('bootstrap/footer');


	}

	function profile(){

		$data = $this->modules_sidebar();

		$userid = $this->session->userdata['logged_in']['id'];
		$userinfo = $this->user->userRecord($userid);

		$userdata = $this->getUserDetail($userinfo);
		$user_detail = array(
			'userdata' => $userdata,
		);

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/asidebar',$data);
		$this->load->view('bootstrap/profile',$user_detail);
		$this->load->view('bootstrap/footer');

	}

	function calendar(){

		$data = $this->modules_sidebar();

		$userid = $this->session->userdata['logged_in']['id'];
		$userinfo = $this->user->userRecord($userid);

		$userdata = $this->getUserDetail($userinfo);
		$user_detail = array(
			'userdata' => $userdata,
		);

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/asidebar',$data);
		$this->load->view('calendar',$user_detail);

	}

	function moduleWatchedVideos($module_number){
		$moduleVideos = $this->modules->getAllModulesVideos($module_number);

		$watchedVideos = 0;
		foreach($moduleVideos as $v){

			if(!empty($v['video_watched'])){
				$watchedVideos++;
			}
		}

		return $watchedVideos;
	}

	function video(){

		$this->load->model('modules','',TRUE);

		$data = $this->modules_sidebar();
		//echo "<pre>"; print_r($data['modules'][0]['id']); die();
		$module_count = count($data['modules']);
		$unlockModules = $data['unlockModules'];
		$TotalModulesToOpen = $unlockModules+1;

		$module_number =  $this->uri->segment(3);
		$previous_module_number = $module_number-1;
		$video_number =  $this->uri->segment(4);

		$module_videos_count = $this->modules->countModuleVideos($module_number);
		$module_videos = $this->modules->getModuleVideos($module_number);
		$selectedModuleVideo = $this->modules->getSelectedModuleVideo($module_number,$video_number);
		$countLastModuleVideos = $this->modules->countLastModuleVideos($module_count);
		$countPrevModuleVideos = $this->modules->countLastModuleVideos($previous_module_number);

		$moduleWatchedVideoCount = $this->moduleWatchedVideos($module_number);
		$moduleProgress = ($moduleWatchedVideoCount/$module_videos_count)*100;

		$json = $selectedModuleVideo[0]['video_time_stamp'];
		$VideoTimeStamp = json_decode($json);

		$userid = $this->session->userdata['logged_in']['id'];


		$module_id = $selectedModuleVideo[0]['id'];

		$uri_data = array(

			'video_number' => $video_number,
			'video_number_n' => $video_number,
			'module_number_n' => $module_number,
			'module_number' => $module_number,
			'selected_video' => $selectedModuleVideo,
			'module_count' => $module_count,
			'unlockModules' =>$unlockModules,
			'TotalModulesToOpen'=>$TotalModulesToOpen,
			'module_videos_count' =>$module_videos_count,
			'countLastModuleVideos'=>$countLastModuleVideos,
			'countPrevModuleVideos'=>$countPrevModuleVideos,
			'user_id'=>$userid,
			'module_id'=>$module_id,
			'module_videos'=>$module_videos,
			'moduleProgress'=>$moduleProgress,
			'VideoTimeStamp'=>$VideoTimeStamp


		);

		$this->load->helper('html');
		$this->load->view('bootstrap/header',$data);
		$this->load->view('bootstrap/sidebar',$data);
		$this->load->view('bootstrap/video',$uri_data);
		$this->load->view('bootstrap/footer');

	}


	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}



	function modules_sidebar(){

		$this->load->model('modules','',TRUE);
		$modules = $this->modules->getAllModules();
		//echo "<pre>"; print_r($modules); die();
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
         

    
}
