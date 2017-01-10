<?php
require_once("PHPMailer-master/PHPMailerAutoload.php");
    $mail = new PHPMailer(true);

    //Send mail using gmail
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 587; // set the SMTP port for the GMAIL server
    $mail->Username = "asif.chuhan2001@gmail.com"; // GMAIL username
    $mail->Password = "fisa@2015##"; // GMAIL password

    //Typical mail data
    $mail->AddAddress('asif.chuhan2001@gmail.com',"Khan");
    $mail->SetFrom('jwanjum@gmail.com', 'asif');
    $mail->Subject = "This is a test message";
    $mail->Body = "An email for test";

    try{
        $mail->Send();
        echo "Thanks. Bug report successfully sent.
              We will get in touch if we have any more questions!";
    } catch(Exception $e){
        //Something went bad
        echo "Mailer Error: - " . $mail->ErrorInfo;
    }
