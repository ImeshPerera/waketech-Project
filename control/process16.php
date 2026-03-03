<?php

    // Contact Us Mail Sending Process is Here

require "../connection.php";
use PHPMailer\PHPMailer\PHPMailer; 
 
require 'Exception.php'; 
require 'PHPMailer.php'; 
require 'SMTP.php'; 

$Name = $_POST["Name"];
$Email = $_POST["Email"];
$Message = $_POST["Message"];

if(empty($Name)){
    echo "Please type your Name.";
}elseif(empty($Email)){
    echo "Please type your email address";
}elseif(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
    echo "Your Email is not Validated. Type a Correct One";
}elseif(strlen($Email) > 100){
    echo "your email length is exceed the limit.";    
}elseif(empty($Message)){
    echo "Please type your message";    
}else{
    $mail = new PHPMailer; 
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'education.imeshdilshan@gmail.com'; 
    $mail->Password = 'ceptvcidaokmacvl';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom($Email, 'Contact Us - Phone House'); 
    $mail->addReplyTo($Email, $Name); 
    $mail->addAddress("imeshperera99@gmail.com"); 
    $mail->isHTML(true); 
    $mail->Subject = 'Contact Me From '.$Name; 
    $bodyContent = $Message;
    $mail->Body    = $bodyContent; 
    
    if(!$mail->send()) { 
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    } else { 
        echo 'Message has been sent.'; 
    }             
}