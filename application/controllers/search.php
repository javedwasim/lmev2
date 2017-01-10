<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller{
    function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')){
            redirect('login', 'refresh');
        }

        $this->load->helper("url");
        $this->load->model('searchmodules','',TRUE);
        $this->load->model('user','',TRUE);
    }
    function index(){

         $data = $this->modules_sidebar();

        $module_count = count($data['modules']);
        $unlockModules = $data['unlockModules'];
        $TotalModulesToOpen = $unlockModules+1;

        $search = $this->input->post('search_module');
		$this->load->helper(array('form'));
        $this->load->helper('url');

        $search_module = $this->searchmodules->getSearchedModules($search);
        $search_result_count = count($search_module);

        $search_module = array(
            'search_module' => $search_module,
            'search_value' => $search,
            'search_result_count'=>$search_result_count,
            'module_count' => $module_count,
            'unlockModules' =>$unlockModules,
            'TotalModulesToOpen'=>$TotalModulesToOpen

        );

        $this->load->helper('html');
        $this->load->view('bootstrap/header',$data);
        $this->load->view('bootstrap/searchmodules',$search_module);
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

	
	function register(){
		
		$this->load->helper(array('form'));
        $this->load->helper('url');
        $this->load->view('register');

    }
}


?>