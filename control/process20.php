<?php

//Payment Detail Compremise is here

session_start();

require "../connection.php";

if(isset($_SESSION["student"])){
    $user = $_SESSION["student"];
}elseif(isset($_SESSION["paystudent"])){
    $user = $_SESSION["paystudent"];
}

if(isset($user)){
    $OrderId = uniqid();

    $rs = Database::search("SELECT `grade`.`id`,`grade`.`name` AS `year` FROM `user_has_grade` LEFT JOIN `grade` ON `user_has_grade`.`grade_id` = `grade`.`id` WHERE `user_id` = '".$user["id"]."';");
    $uy = $rs->fetch_assoc();
    
    $res = Database::search("SELECT *,DATE_ADD(`start_day`, INTERVAL 1 MONTH) AS `final` FROM `student_has_pay` WHERE `user_id` = '".$user["id"]."' AND `grade_id` = '".$uy["id"]."' AND `pay_status_id` != '1';");
    $resn = $res->num_rows;
    
    if($resn != 0){
        $resd = $res->fetch_assoc();
                
                $UserId = $user["id"];
                $amount = (int)$resd["amount"];
                $name = $user["name"];
                $email = $user["email"];
                $mobile = $user["mobile"];
                $gradeid = $uy["id"];

                $array['OrderId'] = $OrderId;
                $array['id'] = $UserId;
                $array['item'] = "Portral Payment";
                $array['amount'] = $amount;
                $array['name'] = $name;
                $array['email'] = $email;
                $array['mobile'] = $mobile;
                $array['year'] = $gradeid;
                $array['address'] = "default";
                $array['city'] = "default";

                echo json_encode($array);
            
    }else{
        echo "ER1";
    }
}else{
    echo "ER2";
}
?>