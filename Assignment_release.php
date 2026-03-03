<?php
session_start();
require "connection.php";

if (isset($_SESSION["academic"])) {
    $user = $_SESSION["academic"];
}elseif(isset($_SESSION["admin"])){
    $user = $_SESSION["admin"];
}

if(isset($user)){

    if(isset($_GET["id"])){
        $resultset = Database::search("SELECT * FROM `answer_view` WHERE `assignment_id` = '".$_GET["id"]."';");
        $n = $resultset->num_rows;
        if($n != 0){
            $rut = Database::search("SELECT * FROM `assignment_view` WHERE `id` = '".$_GET["id"]."';");
            $ut = $rut->fetch_assoc();
            $cd = Database::search("SELECT COUNT(`id`) AS `idcount` FROM `student_view` WHERE `year` = '2nd Year';");
            $cdata = $cd->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Lessons </title>

    <link rel="icon" href="images/image.png" />
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        td {
            vertical-align: middle;
        }
        
        .bg-primary {
            background-color: #fdf9e3!important;
        }
        .wp-200{
            width: 200px;
        }
    </style>
</head>

<body class="bg-primary">
    <!-- Alert Box  -->
    <?php require "alert.php"; ?>
    <!-- Alert Box  -->
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="row pt-md-3 g-1">
                    <div class="col-12 my-3 text-center">
                        <p class="h2 fw-bold m-0 p-0"><span style="color: crimson;">WAKE TECH Campus</span></p>
                        <p class="h2 fw-bold m-0 p-0">Submitted Assignment</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12 d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title mb-4 mt-2">Subject : <?php echo $ut["subject_name"]; ?></h4>
                                        <span class="card-title my-1">Assignment : <?php echo $ut["assignment_name"]; ?></span><br/>
                                        <span class="card-title my-1">Year : <?php echo $ut["year"]; ?></span><br/>
                                        <span class="card-title my-1">Start Date : <?php echo $ut["start_date"]; ?></span><br/>
                                        <span class="card-title my-1">End Date : <?php echo $ut["end_date"]; ?></span><br/>
                                    </div>
                                    <div class="d-flex flex-column">
                                    <?php
                                    if($ut["status_id"] == 4){
                                        if(isset($_SESSION["academic"])){
                                    ?>
                                        <button onclick='ReleaseNow(<?php echo $ut["id"] ?>);' class="btn w-100 btn-dark">Release Marks</button>
                                    <?php
                                            }else{
                                                ?><label class="btn w-100 btn-success">Wait for Release</label><?php
                                            }
                                    }elseif($ut["status_id"] == 5){
                                    ?>
                                        <label class="btn w-100 btn-success">Released</label>
                                    <?php
                                    }else{
                                        ?>
                                        <label class="btn w-100 btn-primary"><?php echo $ut["status"]; ?></label>
                                        <?php
                                    }
                                        ?>
                                        <label class="btn btn-warning mt-2"><?php echo "Submitted : ".$n; ?>/<?php echo $cdata["idcount"]; ?></label>
                                    </div>
                                </div>
                                <div class="table-responsive admin-box mt-md-3">
                                    <table class="table table-striped">
                                        <thead class="sticky-top bg-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>Download</th>
                                                <th>Marks</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($a = 0; $a < $n; $a++) {
                                                $b = $a+1;
                                                $result = $resultset->fetch_assoc();
                                            ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0" . $b; } else { echo $b; } ?></td>
                                                <td><?php echo $result["user_name"] ?></td>
                                                <td><button class="btn w-100 btn-success" type="submit" onclick='window.open("<?php echo $result["upload"] ?>")'><span>Download</span></button></td>
                                                <td><lable class="btn btn-light w-100"><?php echo $result["marks"]; ?></lable></td>
                                                <td>
                                                <?php 
                                                    if($result["marks"] < '35'){ 
                                                ?>
                                                    <label class="btn w-100 btn-danger"><span>Fail</span></label></td>
                                                <?php
                                                    }else{ 
                                                ?>
                                                    <label class="btn w-100 btn-secondary"><span>Pass</span></label></td>
                                                <?php
                                                    } 
                                                ?>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            ?>
            <script>window.location = "Acadamic_Assignment.php";</script>
            <?php
        }
    }else{
        ?>
        <script>window.location = "signin.php";</script>
        <?php
    }
}
?>