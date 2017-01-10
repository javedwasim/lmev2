<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ipn extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
   require_once("imail/PHPMailer-master/PHPMailerAutoload.php");
 }
 
 function index()
 {

   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
   $userimage =  $this->input->post('image');
   $aboutuser =  $this->input->post('about');
   $useremail =  $this->input->post('email');

    $user_info =  array(
        'username' => $username,
        'image' => $userimage,
        'about' => $aboutuser,
        'email'=> $useremail,
        'lastlogin_date'=>'0000-00-00 00:00:00'
    );

   //query the database
   $result = $this->user->register($user_info);

   //$username = $result['email'];
   $username = $result['username'];
   $randomPwd = $result['password'];
   
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
	$mail->Subject = "Digital Wealth Creation Academy - Members Area Access";

	$messageBody =  '
						Hello,
						<br/><br/>
						Thank you for your purchase of Digital Wealth Creation Academy and welcome to the family. 
						<br/><br/>
						Please make note of the following login information:
						<br/><br/>
						Username:<b> '.$username.'</b>
						<br/>
						Password: <b>'.$randomPwd.'</b>
						<br/><br/>
						You can use these logins to access the DPA members area.
						<br/><br/>
						Members Area Login URL: http://qwcacademy.com/Account/Login
						<br/><br/>
						Should you have any questions or queries please do not hesitate to contact our support on: support@dwcacademy.com
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
		echo 'Message has been sent';
	}
   
   redirect('login', 'refresh');
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