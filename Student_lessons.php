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

    <title>WAKE TECH Campus | Lessons</title>

    <link rel="icon" href="images/New Tech Logo.png" />
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
    td {
        vertical-align: middle;
    }

    .bg-primary {
        background-color: #fdf9e3 !important;
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
                        <p class="h2 fw-bold m-0 p-0">Lessons Center</p>
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
                                                <th>Lesson Name</th>
                                                <th>Lecturer</th>
                                                <th>Lecture Date</th>
                                                <th>Lesson Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $resultset = Database::search("SELECT * FROM `teacher_lesson` WHERE `grade_id` = '".$uy["id"]."' ORDER BY `id` DESC;");
                                                $n = $resultset->num_rows;

                                                for ($a = 0; $a < $n; $a++) {
                                                    $b = $a+1;
                                                    $result = $resultset->fetch_assoc();
                                                ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0" . $b;} else { echo $b; } ?></td>
                                                <td><?php echo $result["subject_name"] ?></td>
                                                <td><?php echo $result["lesson_name"] ?></td>
                                                <td><?php echo $result["teacher"] ?></td>
                                                <td><?php echo $result["lesson_date"] ?></td>
                                                <td><button class="btn w-100 btn-outline-success" type="submit" onclick='window.open("<?php echo $result["upload"] ?>")'>Download</button></td>
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
    ?><script>window.location = "signin.php";</script><?php
}
?>