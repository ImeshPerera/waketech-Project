<?php

    // Student Assignment Upload is Here

    session_start();
    require "../connection.php";
    
    if(isset($_SESSION["teacher"])){
        $studentid = $_POST["studentid"];
        $Assignmentid = $_POST["Assignmentid"];
        $mark = $_POST["mark"];

        if($studentid == 0){
            echo "Please Set Student";
        }elseif($Assignmentid == 0){
            echo "Please Set Assignment";
        }elseif(empty($mark)){
            echo "Please give marks to Student";
        }elseif(($mark < 0) | ($mark > 100)){
            echo "Please give correct marks";
        }else{
            Database::iud("UPDATE `user_has_assignment` SET `markS` = '".$mark."' WHERE `user_id` = '".$studentid."' AND `assignment_id` = '".$Assignmentid."';");
            echo "Success";
    }

    }else{
        echo "You have no Permission to do this !";
    }


?>