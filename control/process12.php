<?php

    // New User Invite is Here

    session_start();
    require "../connection.php";

if(isset($_SESSION["admin"])){
    $user = $_SESSION["admin"];    

    $userid = $_POST["userid"];
    $statusid = $_POST["statusid"];

    $resultsetem = Database::search("SELECT * FROM `user` WHERE `id` = '".$userid."';");
    $datain = $resultsetem->num_rows;

    if(empty($userid)){
        echo "Please Select User";
    }elseif(($statusid < 2) | ($statusid > 3)){
        echo "Status Cannot Change. Request Rejected";
    }elseif($userid < 1){
        echo "Your User is Not Available. Request Rejected";
    }else{
        Database::iud("UPDATE `user` SET  `user_status_id` = '".$statusid."' WHERE `id` = '".$userid."';");
        echo "Success";
    }
}
?>