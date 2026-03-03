<?php

    // Sign In Process is Here

    session_start();
    require "../connection.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember = $_POST["remember"];

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
    }elseif($n == 1){
        $result = $resultset->fetch_assoc();

        if($result["user_status_id"] == 1){
            echo "E1";
        }elseif($result["user_status_id"] == 2){
            if($result["user_type_id"] == 2){
                $_SESSION["academic"] = $result;
                echo "Success";
            }elseif($result["user_type_id"] == 3){
                $_SESSION["teacher"] = $result;
                echo "Success";
            }elseif($result["user_type_id"] == 4){

                $rs = Database::search("SELECT `grade`.`id`,`grade`.`name` AS `year` FROM `user_has_grade` LEFT JOIN `grade` ON `user_has_grade`.`grade_id` = `grade`.`id` WHERE `user_id` = '".$result["id"]."';");
                $uy = $rs->fetch_assoc();

                $res = Database::search("SELECT DATE_ADD(`start_day`, INTERVAL 1 MONTH) AS `final` FROM `student_has_pay` WHERE `user_id` = '".$result["id"]."' AND `grade_id` = '".$uy["id"]."' AND `pay_status_id` != '1';");
                $resn = $res->num_rows;

                if($resn != 0){
                    $resd = $res->fetch_assoc();

                    $final_date = $resd["final"];
                    $today = date('Y-m-d');
                        if($today > $final_date){
                            $_SESSION["paystudent"] = $result;
                            echo "S1"; 
                        }else{
                            $_SESSION["student"] = $result;
                            echo "S1"; 
                        }
                }else{
                    $_SESSION["student"] = $result;
                    echo "Success";   
                }
            }
        }elseif($result["user_status_id"] == 4){
            $_SESSION["admin"] = $result;
            echo "Success";
        }elseif($result["user_status_id"] == 3){
            echo "Your Account is Blocked by Admin";
        }else{
            echo "Your Account is Blocked by Admin";
        }

        if($remember == "true"){
            setcookie("e",$email,time()+(60*60*24*365),"/");
            setcookie("p",$password,time()+(60*60*24*365),"/");
        }else{
            setcookie("e","",-1,"/");
            setcookie("p","",-1,"/");
        }

    }else{
        echo "Your password is Incorrect";
    }
?>