<?php

    // Profile Update Process is Here

    session_start();
    require "../connection.php";

    if(isset($_SESSION["academic"])){
        $user = $_SESSION["academic"];
    }elseif(isset($_SESSION["teacher"])){
        $user = $_SESSION["teacher"];
    }elseif(isset($_SESSION["student"])){
        $user = $_SESSION["student"];
    }elseif(isset($_SESSION["admin"])){
        $user = $_SESSION["admin"];
    }

    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $resultsetem = Database::search("SELECT * FROM `user` WHERE `name` = '".$name."' AND `mobile` = '".$mobile."' AND `email` = '".$email."' AND `password` = '".$password."';");
    $datain = $resultsetem->num_rows;

    $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `id` != '".$user["id"]."';");
    $n = $resultset->num_rows;

    if(empty($name)){
        echo "Please Enter Your Name";
    }elseif(empty($mobile)){
        echo "Your Mobile Field is Empty";
    }elseif(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)==0){
        echo "Your Mobile Number is not applicable";
    }elseif(strlen($mobile) != 10){
        echo "Your Mobile Number length is not applicable";
    }elseif(empty($email)){
    echo "Please Enter Your Email";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Your Email is not Validated. Type a Correct One";
    }elseif(strlen($email) > 100){
        echo "your email length is exceed the limit.";
    }elseif(empty($password)){
        echo "Your Password field is Empty";
    }elseif((strlen($password) <= 5)||(strlen($password) >= 20)){
        echo "Your Password length is not applicable";
    }elseif($datain == 1){
        echo "Your details are Same. Details Updade Rejected";
    }elseif($n == 0){
        Database::iud("UPDATE `user` SET `name` = '".$name."',`mobile` = '".$mobile."',`email` = '".$email."',`password` = '".$password."' WHERE `email` = '".$user["email"]."';");
        
        $re = Database::search("SELECT * FROM `user` WHERE `name` = '".$name."' AND `mobile` = '".$mobile."' AND `email` = '".$email."' AND `password` = '".$password."';");
        $redata = $re->fetch_assoc();
        if(isset($_SESSION["academic"])){
            $_SESSION["academic"] = $redata;
        }elseif(isset($_SESSION["teacher"])){
            $_SESSION["teacher"] = $redata;
        }elseif(isset($_SESSION["student"])){
            $_SESSION["student"] = $redata;
        }elseif(isset($_SESSION["admin"])){
            $_SESSION["admin"] = $redata;
        }
            echo "Success";
    }else{
        echo "Your new email is already in Use";
    }
?>