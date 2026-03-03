<?php

    // Verify Process is Here

    session_start();
    require "../connection.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    $verify = $_POST["verify"];

    $resultsetem = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."';");
    $emailn = $resultsetem->num_rows;

    $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."';");
    $n = $resultset->num_rows;

    if(empty($email)){
    echo "Please Enter Your Email";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Your Email is not Validated. Type a Correct One";
    }elseif(strlen($email) > 100){
        echo "your email length is exceed the limit.";
    }elseif($emailn != 1){
        echo "Your Email is not Existed";
    }elseif(empty($password)){
        echo "Your Password field is Empty";
    }elseif((strlen($password) <= 5)||(strlen($password) >= 20)){
        echo "Your Password length is not applicable";
    }elseif(empty($verify)){
        echo "Please Enter Your Verification Code";    
    }elseif($n == 1){
        $result = $resultset->fetch_assoc();

        if($result["user_status_id"] == 1){
            if($result["verify"] == $verify){
                $code = uniqid();
                Database::iud("UPDATE user SET `verify` = '".$code."',`user_status_id` = '2' WHERE `email` = '".$email."';");
                echo "Success";
            }else{
                echo "Your Verification Code is Wrong";
            }
        }else{
            echo "Your Account is Blocked or Verified";
        }
            setcookie("e",$email,time()+(60*60*24*365),"/");
            setcookie("p",$password,time()+(60*60*24*365),"/");

    }else{
        echo "Your password is Incorrect";
    }
?>