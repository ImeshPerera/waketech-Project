<?php

session_start();
require "connection.php";

if((isset($_SESSION["academic"])) | (isset($_SESSION["teacher"])) | (isset($_SESSION["student"])) | (isset($_SESSION["admin"]))){
    if(isset($_SESSION["academic"])){
        $us = $_SESSION["academic"];
    }elseif(isset($_SESSION["teacher"])){
        $us = $_SESSION["teacher"];
    }elseif(isset($_SESSION["student"])){
        $us = $_SESSION["student"];
    }elseif(isset($_SESSION["admin"])){
        $us = $_SESSION["admin"];
    }
    $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '".$us["email"]."';");
    $user = $resultset->fetch_assoc();
    $rst = Database::search("SELECT `email`,`type`,`path` FROM `user` LEFT JOIN `user_type` ON `user`.`user_type_id` = `user_type`.`id` LEFT JOIN `images` ON `user`.`images_id` = `images`.`id`  WHERE `email` = '".$user["email"]."';");
    $rsts = $rst->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | WAKE TECH Campus</title>

    <link rel="icon" href="images/image.png" />

    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <style>
    .border-end {
        border-right: 1px solid #ffb100 !important;
    }
    </style>
</head>

<body>
    <!-- Alert Box  -->
    <?php require "alert.php"; ?>
    <!-- Alert Box  -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row pt-md-3 g-1">
                    <div class="col-12 my-3 text-center">
                        <p class="h2 fw-bold m-0 p-0"><span style="color: crimson;">WAKE TECH Campus</span></p>
                        <p class="h2 fw-bold m-0 p-0">User Profile</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3 border-end">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-0 py-lg-5">
                            <img class="rounded-circle round-image mt-2 mt-sm-3 mt-md-4" id="UserImage"
                                src="<?php echo $rsts["path"]; ?>" width="150px" height="150px" />
                            <span class="fw-bold mt-2"><?php echo $user["name"]; ?></span>
                            <span class="text-black-50"><?php echo $user["email"]; ?></span>
                            <input class="d-none" type="file" id="Userprofileimg" accept="img/*" />
                            <label class="btn btn-warning mt-3" onclick="UserImage();" for="Userprofileimg">Update
                                Profile Image</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-9 border-end">
                        <div class="p-3 py-2">
                            <div class="row mb-3">
                                <h4>Profile Settings</h4>
                            </div>
                            <div class="row mt-0 mt-md-2 g-2">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control" placeholder="Name"
                                        value="<?php echo $user["name"]; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">User Type</label>
                                    <input type="text" class="form-control" value="<?php echo $rsts["type"]; ?>"
                                        disabled readonly />
                                </div>
                            </div>
                            <div class="row mt-2 g-2">
                                <div class="col-md-6">
                                    <label class="form-label">Mobile Number</label>
                                    <input id="mobile" type="text" class="form-control" placeholder="Mobile Number"
                                        value="<?php echo $user["mobile"]; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <input id="password" class="form-control" type="password" placeholder="Password"
                                            value="<?php echo $user["password"]; ?>" />
                                        <button id="passwordbtn" onclick="viewPassword();"
                                            class="btn btn-light bi bi-eye"></button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Email Address</label>
                                    <input id="email" type="text" class="form-control" placeholder="Email Address"
                                        value="<?php echo $user["email"]; ?>" />
                                </div>
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button onclick="UserDetailUpdate();" class="btn btn-warning mt-4">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
    </div>
    <script src="bootstrap/bootstrap.bundle.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
</body>

</html>
<?php
}else{
    ?><script>window.location = "signin.php";</script><?php
}
?>