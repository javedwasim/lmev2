<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class VerifyLogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }
 
 function index(){

       //This method will have the credentials validation
       $this->load->library('form_validation');
       $this->load->helper('security');
       $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

       if($this->form_validation->run() == FALSE)
       {
         //Field validation failed.  User redirected to login page
           $this->load->helper('url');
           $this->load->view('login_view');
       }
       else
       {
         //Go to private area
         redirect('home', 'refresh');

       }

 }

function resetpassword(){

    //This method will have the credentials validation
    $this->load->library('form_validation');
    $this->load->helper('security');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_email');


    if($this->form_validation->run() == FALSE){
        //Field validation failed.  User redirected to login page
        $email = $this->input->post('email');
        $data = array("email"=>$email);
        $this->load->helper('url');
        $this->load->view('resetpassword',$data);
    }
    else{

        require_once("imail/PHPMailer-master/PHPMailerAutoload.php");

        $email = $this->input->post('email');
        $randomPwd =  $this->user->randomPassword();
        $passowrd = MD5($randomPwd);

        $data =  array(
            'password' => $passowrd,
        );
        $result = $this->user->updatepassword($email,$data);

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
        $mail->AddAddress($email);
        $mail->SetFrom('support@designprofitacademy.com', 'DWC Support');
        $mail->Subject = "Digital Wealth Creation Academy - Your New Password";

        $messageBody =  '
						Hello,
						<br/><br/>
						Your password has been reset, your new password is:
						<br/><br/>
					    <b>'.$randomPwd.'</b>
						<br/><br/>
						Thank you,
						<br/>
						Digital Wealth Creation Academy Support
						';
        $mail->MsgHTML($messageBody);

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //echo 'Message has been sent';
        }

        $data = array(
            "passwordchanged"=>'1',
            "email"=>$email
        );

        $this->load->helper(array('form'));
        $this->load->helper('url');
        $this->load->view('resetpassword',$data);

    }

}

function check_email(){

    $email = $this->input->post('email');
    $result = $this->user->loginemail($email);

    if($result){
       return true;
    }
    else{
        $this->form_validation->set_message('check_email', 'Unable to access user with given email!');
        return false;
    }

}

 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
 
   //query the database
   $result = $this->user->login($username, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username,
		 'created_date'=>$row->created_date
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>