<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Teacher Sign In</title>
    <link rel="icon" href="images/image.png" />
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .form-check-input:checked {
            background-color: crimson;
            border-color: crimson;
        }

        .form-check-input:focus {
            border-color: crimson;
            outline: 0;
            box-shadow: 0 0 0 .25rem #ed143d40;
        }

        .bottom-70 {
            bottom: 295px;
        }
    </style>

</head>

<body class="sign_in_bg">
    <!-- Alert Box  -->
    <?php require "alert.php"; ?>
    <!-- Alert Box  -->

    <div class="container-fluid min-vh-100 d-flex align-content-center justify-content-center">
        <div class="row align-content-center">
            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <img class="logoimg" src="images/image.png" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    </div>
                    <div class="col-12">
                        <p class="text-center mb-2 book-title">Welcome Back to</p>
                        <div class="header-title fs-2 p-0 pb-2 text-center"><span class="fw-bold"
                                style="color: crimson;">WAKE TECH</span> WEB PORTRAL</div>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- Content Start-->
            <div class="col-12 px-3">
                <div class="row">
                    <!-- Content Sign In-->
                    <div class="col-10 offset-1 col-lg-8 offset-lg-2">
                        <div class="row border-start border-end border-dark border-3 rounded-3 py-2 h-100">
                            <div class="col-12 h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12">
                                        <div class="row text-center py-2">
                                            <h4 class="form-lable">Sign In to your Account</h4>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-12">
                                                <label class="form-lable">Email</label>
                                                <input id="email" class="form-control" type="text" value="<?php if (isset($_COOKIE["e"])) {
                                                    echo $_COOKIE["e"];
                                                } ?>" />
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-12">
                                                <label class="form-lable">Password</label>
                                                <div class="input-group mb-3">
                                                    <input id="password" class="form-control" type="password" value="<?php if (isset($_COOKIE["p"])) {
                                                        echo $_COOKIE["p"];
                                                    } ?>" />
                                                    <button id="passwordbtn" onclick="viewPassword();"
                                                        class="btn btn-light bi bi-eye"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check d-flex justify-content-center p-0">
                                                    <input class="form-check-input" type="checkbox" id="remember" <?php if (isset($_COOKIE["p"])) {
                                                        echo "checked";
                                                    } ?> />
                                                    <label class="form-check-label ps-2" for="remember">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-lg-6 offset-lg-3 d-grid">
                                                <button onclick="AdminLogin();"
                                                    class="btn btn-outline-success border-3 fw-bold">Sign In</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mt-lg-5">
                        <p class="text-center">&copy; 2022 <a href="https://imeshperera.com"
                                class="fs-6 text-danger">imeshperera.com</a> All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
        <div class="position-fixed bottom-70 start-0 p-3">
            <div class="row">
                <div class="alert-box p-0">
                    <div class="alert alert-info d-flex flex-column align-items-center me-2 mt-2 alerttab" role="alert">
                        <div class="d-flex align-items-center point-none">
                            <div class="bi bi-exclamation-circle fs-4">&nbsp;&nbsp;</div>
                            <div>Login Email & Passwords</div>
                        </div>
                        <div>
                            <hr>
                            <span>Admin | </span><span>manula@gmail.com</span><span> | </span><span>123456</span>
                        </div>
                        <div>
                            <hr>
                            <span>Academic | </span><span>suvi@gmail.com</span><span> | </span><span>123456</span>
                        </div>
                        <div>
                            <hr>
                            <span>Teacher | </span><span>narmada@gmail.com</span><span> | </span><span>123456</span>
                        </div>
                        <div>
                            <hr>
                            <span>Student | </span><span>dilshan@gmail.com</span><span> | </span><span>123456</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
</body>

</html>