<?php
session_start();
require "connection.php";

if (isset($_SESSION["teacher"])) {
    $user = $_SESSION["teacher"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Lessons</title>

    <link rel="icon" href="images/image.png" />
    
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
                                <h5 class="card-title mb-0 mt-2">Teacher | <?php echo $user["name"]; ?></h5>
                                <span><?php echo $user["email"]; ?></span><br>
                                <span><?php echo $user["mobile"]; ?></span><br>
                                <button class="btn btn-info mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Add New Lesson</button>
                                <div class="table-responsive admin-box mt-md-3">
                                    <table class="table table-striped">
                                        <thead class="sticky-top bg-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Grade</th>
                                                <th>Subject</th>
                                                <th>Lesson Name</th>
                                                <th>Lecture Date</th>
                                                <th>Lesson Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $resultset = Database::search("SELECT * FROM `teacher_lesson` WHERE `email` = '" . $user["email"] . "' ORDER BY `id` DESC;");
                                                $n = $resultset->num_rows;

                                                for ($a = 0; $a < $n; $a++) {
                                                    $result = $resultset->fetch_assoc();
                                                ?>
                                            <tr>
                                                <td><?php if ($result["id"] < 10) {
                                                                echo "0" . $result["id"];
                                                            } else {
                                                                echo $result["id"];
                                                            } ?></td>
                                                <td><?php echo $result["year"] ?></td>
                                                <td><?php echo $result["subject_name"] ?></td>
                                                <td><?php echo $result["lesson_name"] ?></td>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap">
                    <div class="col-12 col-lg-6">
                            <label class="form-label">Grade</label>
                            <?php
                                $rset = Database::search("SELECT * FROM `teacher_class` WHERE `teacher_id` = '".$user["id"]."' ORDER BY `id` DESC;");
                                $nset = $rset->num_rows;
                            
                                if($nset != 0){                            
                                ?>
                                    <select id="year" class="form-select">
                                        <option value="0" disabled selected>Select Here</option>
                                        <?php

                                        for($b = 0; $b < $nset; $b++){                                            
                                            $dset = $rset->fetch_assoc();
                                        ?>
                                    <option value="<?php echo $dset["grade_id"]; ?>"><?php echo $dset["year"]; ?></option>
                                    <?php
                                    } 
                                ?>
                                </select>
                            <?php
                                }else{

                                }
                            ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Subject</label>
                            <?php
                            $rset = Database::search("SELECT * FROM `teacher_class` WHERE `teacher_id` = '".$user["id"]."' ORDER BY `id` DESC;");
                            $nset = $rset->num_rows;                            
                            if($nset != 0){                            
                                ?>
                                    <select id="year" class="form-select">
                                        <option value="0" disabled selected>Select Here</option>
                                        <?php

                                        for($b = 0; $b < $nset; $b++){                                            
                                            $dset = $rset->fetch_assoc();
                                        ?>
                                    <option value="<?php echo $dset["subject_id"]; ?>"><?php echo $dset["subject_name"]; ?></option>
                                    <?php
                                    } 
                                ?>
                                </select>
                            <?php
                                }else{

                                }
                            ?>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Lesson Name</label>
                            <input id="lessonname" class="form-control" type="text" />
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Lesson Date</label>
                            <input id="lessondate" class="form-control" type="date" />
                        </div>
                        <div class="col-12">
                            <input class="form-control" type="file" id="uploadfile">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="SubmitLesson();" type="button" class="btn btn-primary">Submit Lesson</button>
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