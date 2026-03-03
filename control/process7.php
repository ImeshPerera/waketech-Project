<?php

    // Student Assignment Upload is Here

    session_start();
    require "../connection.php";
    
    if(isset($_SESSION["student"])){
        $user = $_SESSION["student"];
        $rs = Database::search("SELECT `grade`.`id`,`grade`.`name` AS `year` FROM `user_has_grade` LEFT JOIN `grade` ON `user_has_grade`.`grade_id` = `grade`.`id` WHERE `user_id` = '".$user["id"]."';");
        $uy = $rs->fetch_assoc();
    
        $Assignmentid = $_POST["Assignmentid"];

        if(isset($_FILES["uploadfile"])){
            if($_FILES["uploadfile"] != ""){
                $file = $_FILES["uploadfile"]["name"];
                $Filetemp = $_FILES["uploadfile"]["tmp_name"];
                $today = microtime(true);
                $Filename = "assignment_upload//$today.$file";
                $FileLocation = "../".$Filename;
                move_uploaded_file($Filetemp,$FileLocation);
    
                Database::iud("INSERT INTO `user_has_assignment`(`user_id`,`assignment_id`,`upload`,`grade_id`) VALUES ('".$user["id"]."','".$Assignmentid."','".$Filename."','".$uy["id"]."');");
                echo "Success";
            }
        }    
    }else{
        echo "You have no Permission to do this !";
    }

?>
