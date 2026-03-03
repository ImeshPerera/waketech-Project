<?php

    // New User Invite is Here

    session_start();
    require "../connection.php";
    use PHPMailer\PHPMailer\PHPMailer; 
 
    require 'Exception.php'; 
    require 'PHPMailer.php'; 
    require 'SMTP.php'; 


    if(isset($_SESSION["academic"])){
        $user = $_SESSION["academic"];
    }elseif(isset($_SESSION["admin"])){
        $user = $_SESSION["admin"];    

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $typeid = $_POST["typeid"];
    $code = uniqid();

    $resultsetem = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."';");
    $datain = $resultsetem->num_rows;

    if(empty($name)){
        echo "Please Enter Name";
    }elseif(empty($email)){
    echo "Please Enter Email";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Email is not Validated. Type a Correct One";
    }elseif(strlen($email) > 100){
        echo "Email length is exceed the limit.";
    }elseif(empty($password)){
        echo "Password field is Empty";
    }elseif((strlen($password) <= 5)||(strlen($password) >= 20)){
        echo "Password length is not applicable";
    }elseif($datain != 0){
        echo "Email is already in Use. Request Rejected";
    }elseif(($typeid < 2) | ($typeid > 4)){
        echo "Your Invite Group is Not Available. Request Rejected";
    }else{
        Database::iud("INSERT INTO `user`(`name`,`email`,`password`,`user_type_id`,`user_status_id`,`verify`) VALUES ('".$name."','".$email."','".$password."','".$typeid."','1','".$code."');");
        $re = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."';");
        $rst = $re->fetch_assoc();
        if($typeid == 4){
            Database::iud("INSERT INTO `user_has_grade`(`grade_id`,`user_id`) VALUES ('5','".$rst["id"]."');");
        }

        $mail = new PHPMailer; 
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'education.imeshdilshan@gmail.com'; 
        $mail->Password = 'ceptvcidaokmacvl';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('education.imeshdilshan@gmail.com', 'Wake Tech Campus'); 
        $mail->addReplyTo('education.imeshdilshan@gmail.com', 'Wake Tech Campus'); 
        $mail->addAddress($email); 
        $mail->isHTML(true); 
        $mail->Subject = 'Login Details for Wake Tech Campus Web Portral'; 
        $bodyContent = '<span style="color: crimson; font-style: italic;">WAKE&nbsp;TECH</span><span style="font-style: italic;"> CAMPUS </span><br/> Login details For Your Account in Wake Tech Campus Web Portral as a Student. <br/><h2>Your Login Email :</h2><h1 style="color:blue;text-decoration: none;"> '.$email.'</h1><br/><h2>Your Login Password :</h2><h1 style="color:red;"> '.$password.'</h1><br/><h2>Your Verification Code :</h2><h1 style="color:red;"> '.$code.'</h1>';
        $mail->Body    = $bodyContent; 
        
        if(!$mail->send()) { 
            echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
        } else { 
            echo "Success";
        }             

    }
}
?>