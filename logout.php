<?php
    // Log Out Process is Here
    session_start();
    if(isset($_SESSION["academic"])){
        $_SESSION["academic"] = null;
    }elseif(isset($_SESSION["teacher"])){
        $_SESSION["teacher"] = null;
    }elseif(isset($_SESSION["student"])){
        $_SESSION["student"] = null;
    }elseif(isset($_SESSION["admin"])){
        $_SESSION["admin"] = null;
    }
    session_destroy();
?>
<script>window.location = "signin.php";</script>