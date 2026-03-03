<?php

    // Appoint Teacher to Subject and Batch is Here

    session_start();
    require "../connection.php";

    if(isset($_SESSION["admin"])){
        $user = $_SESSION["admin"];  

        $year = $_POST["year"];
        $subject = $_POST["subject"];
        $teacherid = $_POST["teacherid"];

        $rset = Database::search("SELECT * FROM `teacher_area` WHERE `teacher_id` = '".$teacherid."' AND `subject_id` = '".$subject."' AND `grade_id` = '".$year."';");
        $nset = $rset->num_rows;

        if($nset == 0){
            Database::iud("INSERT INTO `teacher_area`(`teacher_id`,`subject_id`,`grade_id`) VALUES('$teacherid','$subject','$year');");
            echo "Success";
        }else{
            echo "Your appoinment is already available !";
        }
    }
