<?php

    // User Image Update is Here

    session_start();
    require "../connection.php";
    
    if(isset($_SESSION["academic"])){
        $user = $_SESSION["academic"];
    }elseif(isset($_SESSION["teacher"])){
        $user = $_SESSION["teacher"];
    }elseif(isset($_SESSION["student"])){
        $user = $_SESSION["student"];
    }


    if(isset($_FILES["uploadfile"])){
        if($_FILES["uploadfile"] != ""){
            $file = $_FILES["uploadfile"]["name"];
            $Filetemp = $_FILES["uploadfile"]["tmp_name"];
            $today = microtime(true);
            $Filename = "userimg//$today.$file";
            $FileLocation = "../".$Filename;
            move_uploaded_file($Filetemp,$FileLocation);

            Database::iud("INSERT INTO `images`(`path`) VALUES ('".$Filename."');");
            $result = Database::search("SELECT * FROM `images` WHERE `path` = '".$Filename."';");
            $set = $result->fetch_assoc();
            Database::iud("UPDATE `user` SET `images_id` = '".$set["id"]."' WHERE `email` = '".$user["email"]."';");
            echo "Success";
        }
    }
