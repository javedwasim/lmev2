<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magazine extends CI_Controller {
    /**
     * index page for magazine controller. 
     */
    function __construct() {
        parent::__construct();
        
        if(!$this->session->userdata('logged_in')){
            redirect('login', 'refresh');
        }
        
        $this->load->helper("url");
        $this->load->model("Issue");
        $this->load->library(array('pagination','image_lib'));
       
    }
    public function index($offset = 0){
   
        if($this->session->userdata('logged_in')){
            $this->load->helper(array('url','form'));
            $this->load->library(array('table','pagination'));
            $this->load->view('bootstrap/header');
            
            $num_rows = $this->Issue->record_count();
            $config['base_url'] = base_url().'index.php/magazine/index';
            $config['total_rows'] = $num_rows;
            $config['per_page'] = 3;
            $config['uri_segment'] = 3;
            $config['num_links'] = 2;
       
            $this->pagination->initialize($config);
            
            $magazines = array();
            $this->load->model(array('Issue','Publication'));
            $issues = $this->Issue->get($config['per_page'],$offset);
            
            foreach ($issues as $issue){
               
                $publication = new Publication();
                $publication->load($issue->publication_id);
                $magazines[] = array(
                    $publication->publication_name,
                    $issue->issue_number,
                    $issue->issue_date_publication,
                    $issue->issue_cover ? 'Y':'N',
                    anchor('magazine/view/'.$issue->issue_id,'View').'|'.
                    anchor('magazine/update/'.$issue->issue_id,'Update').'|'.
                    anchor('magazine/delete/'.$issue->issue_id,'Delete',array('class'=>'selectedpagination', 'onclick'=>'return confirm(\'Are you sure you want to delete this item?\');')),
                );
                $this->image_lib->clear();
            }
            $this->load->view('magazines', array(
                'magazines' => $magazines,
                'username'  => $this->session->userdata['logged_in']['username'],
            ));
            
            $this->load->view('bootstrap/footer');
       }else{
            redirect('login', 'refresh');
       }
    }
    
    public function add() {
        $config = array(
            'upload_path' => 'upload',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 250,
            'max_width' => 1920,
            'max_height' => 1080,
        );
        $this->load->library('upload',$config);
        $this->load->helper('form');
        
        // Populate publications.
        $this->load->view('bootstrap/header');
        $this->load->model('Publication');
        $publications = $this->Publication->get();
        $publication_form_options = array();
        foreach ($publications as $id => $publication) {
            $publication_form_options[$id] = $publication->publication_name;
        }        
        // Validation.
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
           array(
               'field' => 'publication_id',
               'label' => 'Publication',
               'rules' => 'required',
           ),
           array(
               'field' => 'issue_number',
               'label' => 'Issue number',
               'rules' => 'required|is_numeric',
           ),
           array(
               'field' => 'issue_date_publication',
               'label' => 'Publication date',
               'rules' => 'required|callback_date_validation',
           ),
        ));
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $check_file_upload = FALSE;
        if(isset($_FILES['issue_cover']['error'])&&$_FILES['issue_cover']['error']!=4){
            $check_file_upload = TRUE;
        }
        if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('issue_cover'))) {
            $this->load->view('magazine_form', array(
                'publication_form_options' => $publication_form_options, 
            ));
        }
        else {
            $this->load->model('Issue');
            $issue = new Issue();
            $issue->publication_id = $this->input->post('publication_id');
            $issue->issue_number = $this->input->post('issue_number');
            $issue->issue_date_publication = $this->input->post('issue_date_publication');
            $upload_dta = $this->upload->data();
            if(isset($upload_dta['file_name'])){
                $issue->issue_cover = $upload_dta['file_name'];
            }
            $issue->save();
            $this->load->view('magazine_form_success', array(
                'issue' => $issue,
            ));
           
        }
        $this->load->view('bootstrap/footer');
    }
    
    public function date_validation($input) {
        $test_date = explode('-', $input);
        if (!@checkdate($test_date[1], $test_date[2], $test_date[0])) {
            $this->form_validation->set_message('date_validation', 'The %s field must be in YYYY-MM-DD format.');
            return FALSE;
        }
        return TRUE;
    }
    
    public function view($issue_id){
        $this->load->helper('html');
        $this->load->view('bootstrap/header');
        $this->load->model(array('Issue','Publication'));
        $issue =new Issue();
        $issue->load($issue_id);
        if(!$issue->issue_id){
            show_404();
        }
        $publication = new Publication();
        $publication->load($issue->publication_id);
        $this->load->view('magazine',array(
            'issue' => $issue,
            'publication' => $publication,
        ));
        $this->load->view('bootstrap/footer');
    }
    
    public function delete($issue_id){
        $this->load->helper('html');
        $this->load->view('bootstrap/header');
        $this->load->model(array('Issue','Publication'));
        $issue =new Issue();
        $issue->load($issue_id);
        if(!$issue->issue_id){
            show_404();
        }
        $issue->delete();
        $this->load->view('magazine_deleted',array(
            'issue_id' => $issue_id,
        ));
        $this->load->view('bootstrap/footer');
     }
     
     public function update($issue_id){
        $config = array(
            'upload_path' => 'upload',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 250,
            'max_width' => 1920,
            'max_height' => 1080,
        );
        $this->load->library('upload',$config);
        $this->load->helper('form');
        
        // Populate publications.
        $this->load->view('bootstrap/header');
        $this->load->model('Publication');
        $publications = $this->Publication->get();
        $publication_form_options = array();
        foreach ($publications as $id => $publication) {
            $publication_form_options[$id] = $publication->publication_name;
        }        
        
        // Validation.
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
           array(
               'field' => 'publication_id',
               'label' => 'Publication',
               'rules' => 'required',
           ),
           array(
               'field' => 'issue_number',
               'label' => 'Issue number',
               'rules' => 'required|is_numeric',
           ),
           array(
               'field' => 'issue_date_publication',
               'label' => 'Publication date',
               'rules' => 'required|callback_date_validation',
           ),
        ));
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $check_file_upload = FALSE;
        if(isset($_FILES['issue_cover']['error'])&&$_FILES['issue_cover']['error']!=4){
            $check_file_upload = TRUE;
        }
        if (!$this->form_validation->run() || ($check_file_upload && !$this->upload->do_upload('issue_cover'))) {
            $this->load->model(array('Issue','Publication'));
            $issue =new Issue();
            $issue->load($issue_id);
            $this->load->view('magazine_form', array(
                'publication_form_options' => $publication_form_options, 
                'issue' => $issue,
            ));
        }else {
            $this->load->model('Issue');
            $issue = new Issue();
            $issue->publication_id = $this->input->post('publication_id');
            $issue->issue_number = $this->input->post('issue_number');
            $issue->issue_date_publication = $this->input->post('issue_date_publication');
            $upload_dta = $this->upload->data();
            if(isset($upload_dta['file_name'])){
                $issue->issue_cover = $upload_dta['file_name'];
            }
            $this->load->view('magazine_form_success', array(
                'issue' => $issue,
            ));
            $issue->issue_id = $issue_id;
            $issue->save();
        }
        $this->load->view('bootstrap/footer');
     }
     
     function logout(){
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
     }
    
     function createThumbnails(){
        $source_path = $_SERVER['DOCUMENT_ROOT'] . '/codeigniter/upload/sandy_shore_2013_02.jpg';
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/codeigniter/upload/newimg/';
           //your desired config for the resize() function
        $config = array(
        'source_image'      => $source_path, //path to the uploaded image
        'new_image'         => $target_path, //path to
        'maintain_ratio'    => true,
        'width'             => 128,
        'height'            => 128
        );

        //this is the magic line that enables you generate multiple thumbnails
        //you have to call the initialize() function each time you call the resize()
        //otherwise it will not work and only generate one thumbnail
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
  }

}