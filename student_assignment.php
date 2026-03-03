<?php
session_start();
require "connection.php";

if (isset($_SESSION["student"])) {
    $user = $_SESSION["student"];
    $rs = Database::search("SELECT `grade`.`id`,`grade`.`name` AS `year` FROM `user_has_grade` LEFT JOIN `grade` ON `user_has_grade`.`grade_id` = `grade`.`id` WHERE `user_id` = '".$user["id"]."';");
    $uy = $rs->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Assignment</title>

    <link rel="icon" href="images/New Tech Logo.png" />
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
                        <p class="h2 fw-bold m-0 p-0">Assignment Center</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title mb-0 mt-2">Student | <?php echo $user["name"]; ?></h5>
                                <span><?php echo $user["email"]; ?></span><br>
                                <span><?php echo $user["mobile"]; ?></span><br>
                                <span class="fw-bolder text-primary"><?php echo $uy["year"] ?></span><br>
                                <div class="table-responsive admin-box mt-md-3">
                                    <table class="table table-striped">
                                        <thead class="sticky-top bg-light">
                                        <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>Assignment Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Download</th>
                                                <th>Upload</th>
                                                <th>Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php
                                                $resultset = Database::search("SELECT * FROM `assignment_view` WHERE `year` = '".$uy["year"]."' AND `status` != 'Listed' ORDER BY `id` DESC;");
                                                $n = $resultset->num_rows;
                                                $b = $n+1;

                                                for ($a = 0; $a < $n; $a++) {
                                                    $b = $b-1;
                                                    $result = $resultset->fetch_assoc();
                                                    $rt = Database::search("SELECT * FROM `user_has_assignment` WHERE `user_id` = '".$user["id"]."' AND `assignment_id` = '".$result["id"]."';");
                                                    $nst = $rt->num_rows;   
                                                ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0".$b; } else { echo $b; } ?></td>
                                                <td><?php echo $result["subject_name"] ?></td>
                                                <td><?php echo $result["assignment_name"] ?></td>
                                                <td><?php echo $result["start_date"] ?></td>
                                                <td><?php echo $result["end_date"] ?></td>
                                                <td><button class="btn w-100 btn-outline-success" type="submit" onclick='window.open("<?php echo $result["file"] ?>")'>Download</button></td>
                                                <td>
                                                <?php 
                                                    $today = date("Y-m-d");
                                                    $expire = $result["end_date"];
                                                    
                                                    $today_time = strtotime($today);
                                                    $expire_time = strtotime($expire);
                                                    
                                                    if ($expire_time >= $today_time) {
                                                        if($nst > 0){
                                                            ?>
                                                            <label class="btn w-100 btn-dark">Submitted</label>
                                                            <?php 
                                                        }else{
                                                        ?>
                                                            <input class="form-control d-none" type="file" id="uploadfile">
                                                            <label onclick='NewAssignment(<?php echo $result["id"]; ?>);' for="uploadfile" class="btn w-100 btn-success">Upload</label>
                                                        <?php
                                                        }
                                                        }else{ 
                                                        ?>  
                                                        <label class="btn w-100 btn-warning">Time Up</label>  
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($result["status_id"] == 5){
                                                            $db = Database::search("SELECT `marks` FROM `answer_view` WHERE `assignment_id` = '".$result["id"]."' AND `user_id` = '".$user["id"]."';");
                                                            $nr = $db->num_rows;
                                                            if($nr > 0){
                                                            $dbs = $db->fetch_assoc();
                                                    ?>
                                                            <lable class="btn w-100 btn-success"><?php echo $dbs["marks"]; if($dbs["marks"] > 35){echo "&nbsp;Pass";}else{echo "&nbsp;Fail";} ?></lable></td>
                                                    <?php
                                                            }else{
                                                                ?>
                                                            <lable class="btn w-100 btn-danger">Not Submitted</lable></td>
                                                                <?php
                                                            }
                                                        }elseif($result["status_id"] == 2){
                                                    ?>
                                                            <lable class="btn w-100 btn-info"><?php echo $result["status"] ?></lable></td>
                                                    <?php
                                                        }elseif($result["status_id"] > 2){
                                                    ?>
                                                            <lable class="btn w-100 btn-info">Wait for Mark</lable></td>
                                                    <?php
                                                        }else{

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
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
</body>

</html>
<?php
}else{
    ?><script>window.location = "signin.php";</script><?php
}
?>