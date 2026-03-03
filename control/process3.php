<?php

    // New Lesson Upload is Here

    session_start();
    require "../connection.php";
    
    $user = $_SESSION["teacher"];
    $year = $_POST["year"];
    $subject = $_POST["subject"];
    $lessonname = $_POST["lessonname"];
    $lessondate = $_POST["lessondate"];

    if($year == 0){
        echo "Please Select Grade";
    }elseif($subject == 0){
        echo "Please Select Subject";
    }elseif(empty($lessonname)){
        echo "Please Enter Lesson name";
    }elseif(empty($lessondate)){
        echo "Please Select Lesson date";
    }elseif(isset($_FILES["uploadfile"])){
        if($_FILES["uploadfile"] != ""){
            $file = $_FILES["uploadfile"]["name"];
            $Filetemp = $_FILES["uploadfile"]["tmp_name"];
            $today = microtime(true);
            $Filename = "lessonnote//$today.$file";
            $FileLocation = "../".$Filename;
            move_uploaded_file($Filetemp,$FileLocation);

            Database::iud("INSERT INTO `lesson`(`teacher_id`,`grade_id`,`subject_id`,`lesson_name`,`upload`,`lesson_date`) VALUES ('".$user["id"]."','".$year."','".$subject."','".$lessonname."','".$Filename."','".$lessondate."');");

            echo "Success";
        }
    }else{
        echo "Please Select a File";
    }


?>