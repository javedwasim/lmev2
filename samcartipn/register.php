<?php 
	
	$servername = "localhost";
	$username = "lMEDbUser987";
	$password = "159LME**!232";
	$dbname = "launchmyempire";

	$conn=mysqli_connect($servername,$username,$password,$dbname);
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	
	
	$inputData = json_decode(file_get_contents('php://input')); 
	$odertype = $inputData->{'type'};
	$email = $inputData->{'customer'}->{'email'};
	$firstName = $inputData->{'customer'}->{'first_name'}; 
	$lastName = $inputData->{'customer'}->{'last_name'}; 
	$fullName = $firstName." ".$lastName;
	
	
	
	if($odertype == 'Order'){
		//$email = 'test@test.com';
		
		$randomPassword = randomPassword();
		$randPwd = md5($randomPassword);
		$createddate = date("Y-m-d h:i:s"); 
	   
		$query  = 'INSERT INTO `users`(`email`, `username`, `password`, `created_date`, `is_active`,`full_name`,`image`,`about`) VALUES ("'.$email.'","'.$email.'","'.$randPwd.'","'.$createddate.'",1,"'.$fullName.'","","")'; 
		
		$result = $conn->query($query);
		
		include("imail/PHPMailer-master/PHPMailerAutoload.php");
		
	   $mail = new PHPMailer(true);

		//Send mail using gmail
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth = true; // enable SMTP authentication
		//$mail->SMTPSecure = "tls"; // sets the prefix to the servier
		$mail->Host = "mail.launchmyempire.com"; // sets GMAIL as the SMTP server
		$mail->Port = 25; // set the SMTP port for the GMAIL server
		$mail->Username = "noreply@launchmyempire.com"; // GMAIL username
		$mail->Password = "NOreply@789"; // GMAIL password @@WELCOME@@777@@tds
		//$mail->SMTPSecure = "ssl";

		//Typical mail data
		$mail->AddReplyTo('info@launchmyempire.com',"Launch My Empire");
		$mail->AddAddress($email);
		$mail->SetFrom('info@launchmyempire.com', 'Launch My Empire');
		$mail->Subject = "Launch My Empire - Members Area Access";

		$messageBody =  '
							Dear '.$firstName.' '.$lastName.',
							<br/><br/>
							Thank you for your purchase of Launch My Empire and welcome to the family. 
							<br/><br/>
							Please make note of the following login information:
							<br/><br/>
							Username:<b> '.$email.'</b>
							<br/>
							Password: <b>'.$randomPassword.'</b>
							<br/><br/>
							You can use these logins to access the  members area.
							<br/><br/>
							Members Area Login URL: http://members.launchmyempire.com/
							<br/><br/>
							Should you have any questions or queries please do not hesitate to contact our support on: info@launchmyempire.com
							<br/><br/>
							Thank you,
							<br/>
							Launch My Empire Support	
							';
		$mail->MsgHTML($messageBody);

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
			
	}else{
		
		$query =  'UPDATE `users` SET `is_active`= 0 WHERE `email` = "'.$email.'" ';
		$result = $conn->query($query);
	}
	
	$conn->close();
	
	function randomPassword() {
		
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
  
?>