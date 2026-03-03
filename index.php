<?php

session_start();
require "connection.php";

    if(isset($_SESSION["academic"])){
        $user = $_SESSION["academic"];
        $typeid = 2;
    }elseif(isset($_SESSION["teacher"])){
        $user = $_SESSION["teacher"];
        $typeid = 3;
    }elseif(isset($_SESSION["student"])){
        $user = $_SESSION["student"];
        $typeid = 4;
    }elseif(isset($_SESSION["admin"])){
        $user = $_SESSION["admin"];
        $typeid = 1;
    }else{
        $typeid = 5;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Welcome</title>
    <link rel="icon" href="images/image.png" />
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
<style>
    .mtm-5{
        margin-top: 80px;
    }
    @media (min-width: 767px) {
        .mtm-md-5{
            margin-top: 0px;
        }
        .mtm-lg-5{
            margin-top: 80px;
        }
    }
    @media (min-width: 992px) {
        .mtm-lg-5{
            margin-top: 0px;
        }
        .mtm-xl-5{
            margin-top: 80px;
        }
    }
    @media (min-width: 992px) {
        .mtm-lg-5{
            margin-top: 0px;
        }
    }
</style>
</head>

<body class="sign_in_bg">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="images/image.png" width="200" height="95" class="d-inline-block align-text-top">
                    </a>
                    <div>
                    <?php 
                    if(isset($user)){
                         ?><button class="btn btn-light"><?php echo $user["name"] ?></button><?php 
                    }else{
                        ?><a href="signin.php" class="btn btn-outline-light text-dark">Sign In</a> <?php 
                    } ?>
                        <a href="contact.php" class="btn btn-outline-light text-dark">Contact Us</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 main-image-bg">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-5">
                <div class="row d-flex justify-content-around">
                <?php if(($typeid == 4) | ($typeid == 5)){ ?>
                    <div class="col-12 col-md-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'userprofile.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-person-fill fs-1"></div>
                                    <div>
                                        <h4>MY PROFILE</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-md-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'student_lessons.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-book-half fs-1 fw-bold"></div>
                                    <div>
                                        <h4>MY LESSONS</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'student_assignment.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-file-earmark-binary-fill fs-1"></div>
                                    <div>
                                        <h4>MY ASSIGNMENT</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($user)){ ?>
                        <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                            <div class="row">
                                <div onclick="window.location = 'logout.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                    <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                        <div class="bi bi-lock-fill fs-1"></div>
                                        <div>
                                            <h4>LOG OUT</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                            <div class="row">
                                <div onclick="window.location = 'signin.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                    <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                        <div class="bi bi-unlock-fill fs-1"></div>
                                        <div>
                                            <h4>SIGN IN</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php }elseif($typeid == 1){ ?>
                    <div class="col-12 col-md-5 col-lg-4">
                        <div class="row">
                            <div onclick="window.location = 'Admin_manage_student.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-people-fill fs-1"></div>
                                    <div>
                                        <h4>MANAGE STUDENT</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-md-5 col-lg-4">
                        <div class="row">
                            <div onclick="window.location = 'Admin_manage_teacher.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-person-video3 fs-1"></div>
                                    <div>
                                        <h4>MANAGE TEACHER</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-4">
                        <div class="row">
                            <div onclick="window.location = 'Admin_manage_academic.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-person-badge fs-1 fw-bold"></div>
                                    <div>
                                        <h4>MANAGE ACADEMIC</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-xl-5 col-lg-4">
                        <div class="row">
                            <div onclick="window.location = 'Acadamic_Assignment.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                <div class="bi bi-file-earmark-binary-fill fs-1"></div>
                                    <div>
                                        <h4>ASSIGNMENTS</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-xl-5 col-lg-4">
                        <div class="row">
                            <div onclick="window.location = 'userprofile.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-person-fill fs-1"></div>
                                    <div>
                                        <h4>MY PROFILE</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-xl-5 col-lg-4">
                        <div class="row">
                            <div onclick="window.location = 'logout.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-lock-fill fs-1"></div>
                                    <div>
                                        <h4>LOG OUT</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }elseif($typeid == 2){?>
                    <div class="col-12 col-md-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'userprofile.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-person-fill fs-1"></div>
                                    <div>
                                        <h4>MY PROFILE</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-md-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'Acadamic_manage_student.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-people-fill fs-1 fw-bold"></div>
                                    <div>
                                        <h4>MANAGE STUDENT</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'Acadamic_Assignment.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-file-earmark-binary-fill fs-1"></div>
                                    <div>
                                        <h4>ASSIGNMENTS</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'logout.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-lock-fill fs-1"></div>
                                    <div>
                                        <h4>LOG OUT</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }elseif($typeid == 3){?>
                    <div class="col-12 col-md-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'userprofile.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-person-fill fs-1"></div>
                                    <div>
                                        <h4>MY PROFILE</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-md-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'Teacher_lessons.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-journals fs-1 fw-bold"></div>
                                    <div>
                                        <h4>MY LESSONS</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'Teacher_assignment.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-file-earmark-binary-fill fs-1"></div>
                                    <div>
                                        <h4>ASSIGNMENTS</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mtm-5 mtm-lg-5 col-lg-3">
                        <div class="row">
                            <div onclick="window.location = 'logout.php';" class="col-10 offset-1 c0 sub-bg border border-1 border-secondary rounded-pill">
                                <div class="d-flex justify-content-center h-100 align-items-center flex-column">
                                    <div class="bi bi-lock-fill fs-1"></div>
                                    <div>
                                        <h4>LOG OUT</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    require "footer.php";
    ?>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/bootstrap.bundle.js"></script>
</body>
</html>