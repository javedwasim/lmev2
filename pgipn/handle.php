<?php

	$file = 'log.txt';
	// Open the file to get existing content
	$current = file_get_contents($file);


	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "launchmyempire";

	$error="";
	$msg="";
	
	/* 	$servername = "localhost";
	$username = "lMEDbUser987";
	$password = "159LME**!232";
	$dbname = "launchmyempire"; */

	$conn=mysqli_connect($servername,$username,$password,$dbname);
	// Check connection
	if (mysqli_connect_errno()){
		$error .= "Failed to connect to MySQL: " . mysqli_connect_error().PHP_EOL;
		// Write the contents back to the file
		file_put_contents($file, $error." ".$msg);
	}

	//$json = file_get_contents('php://input');
	//$obj = json_decode($json);
	$postdata = '{"CFName": "javed","CLName": "wasim","CEmail":"javedafaq@gmail.com"}';

	$obj = json_decode($postdata);
	$firstName = $obj->CFName;
	$lastName = $obj->CLName;
	$email = $obj->CEmail;
	$fullName = $firstName." ".$lastName;

	$sQuery = "select * from users where email= '$email'";
	$result = $conn->query($sQuery);
	$rowcount=mysqli_num_rows($result);

	if($rowcount>0){

		$error.="email already exist";
		// Write the contents back to the file
		file_put_contents($file, $error." ".$msg);
		die();

	}

	//print_r($rowcount=mysqli_num_rows($result));
	//die();

	$randomPassword = randomPassword();
	$randPwd = md5($randomPassword);
	$createddate = date("Y-m-d h:i:s");

	$query  = 'INSERT INTO `users`(`email`, `username`, `password`, `created_date`, `is_active`,`full_name`,`image`,`about`) VALUES ("'.$email.'","'.$email.'","'.$randPwd.'","'.$createddate.'",1,"'.$fullName.'","","")';

	if ($conn->query($query) === TRUE) {
		$msg .= "New record created successfully".PHP_EOL;
	} else {
		$error .=  "Error: " . $sql . "<br>" . $conn->error.PHP_EOL;

	}


	if(empty($error)){




	include("imail/PHPMailer-master/PHPMailerAutoload.php");

		try{

			$mail = new PHPMailer(true);

			//Send mail using gmail
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPAuth = true; // enable SMTP authentication
			//$mail->SMTPSecure = "tls"; // sets the prefix to the servier
			$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
			$mail->Port = 465; // set the SMTP port for the GMAIL server
			$mail->Username = "javedafaq@gmail.com"; // GMAIL username
			$mail->Password = "polkmn-manjum"; // GMAIL password @@WELCOME@@777@@tds
			$mail->SMTPSecure = "ssl";

			//Typical mail data
			$mail->AddReplyTo('javedafaq@gmail.com',"Javed Wasim");
			$mail->AddAddress($email);
			$mail->SetFrom('javedafaq@gmail.com', 'Javed Wasim');
			$mail->Subject = "Registration Successful";
			//echo $_POST['subject'];

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
				//echo 'Message could not be sent.';
				$error.= 'Mailer Error: ' . $mail->ErrorInfo.PHP_EOL;
			}else{
				$msg.= 'email sent successfully'.PHP_EOL;
			}

		}catch (phpmailerException $e) {
			$error.= $e->errorMessage().PHP_EOL; //Pretty error messages from PHPMailer


		}catch (Exception $e) {
			$error.= $e->errorMessage().PHP_EOL; //Pretty error messages from PHPMailer

		}




	}

	// Write the contents back to the file
	file_put_contents($file, $error." ".$msg);

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