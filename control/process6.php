<?php

    // New Assignment Upload is Here

    session_start();
    require "../connection.php";
    
    $user = $_SESSION["teacher"];
    $year = $_POST["year"];
    $subject = $_POST["subject"];
    $assiname = $_POST["assiname"];
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];

    if($year == 0){
        echo "Please Select Grade";
    }elseif($subject == 0){
        echo "Please Select Subject";
    }elseif(empty($assiname)){
        echo "Please Enter Assignment name";
    }elseif(empty($startdate)){
        echo "Please Select Start date";
    }elseif(empty($enddate)){
        echo "Please Select End date";
    }elseif(isset($_FILES["uploadfile"])){
        if($_FILES["uploadfile"] != ""){
            $file = $_FILES["uploadfile"]["name"];
            $Filetemp = $_FILES["uploadfile"]["tmp_name"];
            $today = microtime(true);
            $Filename = "assignments//$today.$file";
            $FileLocation = "../".$Filename;
            move_uploaded_file($Filetemp,$FileLocation);

            Database::iud("INSERT INTO `assignment`(`teacher_id`,`grade_id`,`subject_id`,`assignment_name`,`assignment_status_id`,`start_date`,`end_date`,`file`) VALUES ('".$user["id"]."','".$year."','".$subject."','".$assiname."','1','".$startdate."','".$enddate."','".$Filename."');");

            echo "Success";
        }
    }else{
        echo "Please Select a File";
    }


?>