<?php

    // Marks for Release is Here

    session_start();
    require "../connection.php";
    
    if(isset($_SESSION["academic"])){
        $Assignmentid = $_POST["Assignmentid"];

        if($Assignmentid == 0){
            echo "Please Set Assignment";
        }else{
            Database::iud("UPDATE `assignment` SET `assignment_status_id` = '5' WHERE `id` = '".$Assignmentid."';");
            echo "Success";
    }

    }else{
        echo "You have no Permission to do this !";
    }


?>