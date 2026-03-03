<?php

session_start();
require "connection.php";

if(isset($_SESSION["student"])){
    $user = $_SESSION["student"];
}elseif(isset($_SESSION["paystudent"])){
    $user = $_SESSION["paystudent"];
}

if(isset($user)){
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

</head>
<body>
    <!-- Alert Box  -->
    <?php require "alert.php"; ?>
    <!-- Alert Box  -->
    <div class="container mt-5 mb-4 bg-smoke">
    <?php require "header.php"; ?>
        <div class="content my-4">
            <?php
            $rs = Database::search("SELECT `grade`.`id`,`grade`.`name` AS `year` FROM `user_has_grade` LEFT JOIN `grade` ON `user_has_grade`.`grade_id` = `grade`.`id` WHERE `user_id` = '".$user["id"]."';");
            $uy = $rs->fetch_assoc();
            
            $res = Database::search("SELECT *,DATE_ADD(`start_day`, INTERVAL 1 MONTH) AS `final` FROM `student_has_pay` WHERE `user_id` = '".$user["id"]."' AND `grade_id` = '".$uy["id"]."' AND `pay_status_id` != '1';");
            $resn = $res->num_rows;
            
            if($resn != 0){
                $resd = $res->fetch_assoc();
            
                $final_date = $resd["final"];
                $today = date('Y-m-d');
                    
                if($today > $final_date){
                        echo "S1"; 
                }else{ ?>
                    <h5 class="card-title mb-0 mt-2">Student | <?php echo $user["name"]; ?></h5>
                    <span><?php echo $user["email"]; ?></span><br>
                    <span><?php echo $user["mobile"]; ?></span><br>
                    <span class="fw-bolder text-primary"><?php echo $uy["year"] ?></span>
                    <br>
                    <br>
                <div class="text-center">
                    <span class="fw-bolder text-danger">You have successfully passed to the new grade</span><br>
                    <span class="fw-bolder text-success">You have to pay following Enrollment Pay</span><br>
                    <div class="d-flex align-items-center flex-column">
                        <button class="btn btn-warning w-50 my-2">Rs : <?php echo $resd["amount"];?>.00</button>
                    </div>
                    <br/>
                    <div class="d-flex justify-content-center col-gap">
                        <?php if(isset($_SESSION["student"])){?>
                            <button type="submit" id="payhere-payment" onclick='PayNowHere();' class="btn btn-success w-25 my-2">Pay Now</button>
                            <a href="index.php" class="btn btn-dark w-25 my-2">Pay Later</a>
                            <!-- <button type="submit" id="payhere-payment" >PayHere Pay</button> -->
                        <?php }else{ ?>
                            <button type="submit" id="payhere-payment" onclick='PayNowHere();' class="btn btn-success w-50 my-2">Pay Now</button>
                        <?php } ?>
                    </div>

                </div>
                <?php
                }
            }else{

            }
?>            
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>
<?php
}else{
    ?><script>window.location = "signin.php";</script><?php
}
?>