<?php
session_start();
require "connection.php";

if (isset($_SESSION["academic"])) {
    $user = $_SESSION["academic"];
}elseif(isset($_SESSION["admin"])){
    $user = $_SESSION["admin"];
}

if(isset($user)){

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Assignment </title>

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
                        <p class="h2 fw-bold m-0 p-0">Assignments</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title my-2">Academic Officer | <?php echo $user["name"]; ?></h4>
                                <span><?php echo $user["email"]; ?></span><br>
                                <span><?php echo $user["mobile"]; ?></span><br>
                                <div class="table-responsive admin-box mt-md-3">
                                    <table class="table table-striped">
                                        <thead class="sticky-top bg-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>assignment&nbsp;name</th>
                                                <th>Lecturer</th>
                                                <th>Year</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resultset = Database::search("SELECT * FROM `assignment_view` ORDER BY `id` DESC;");
                                            $n = $resultset->num_rows;
                                            $b = $n+1;
                                            for ($a = 0; $a < $n; $a++) {
                                                $b = $b-1;
                                                $result = $resultset->fetch_assoc();
                                            ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0".$b; } else { echo $b; } ?></td>
                                                <td><?php echo $result["subject_name"] ?></td>
                                                <td><?php echo $result["assignment_name"] ?></td>
                                                <td><?php echo $result["teacher"] ?></td>
                                                <td><?php echo $result["year"] ?></td>
                                                <td>
                                                <?php if($result["status_id"] == 4){
                                                ?>
                                                    <button onclick='window.location = "Assignment_release.php?id=<?php echo $result["id"] ?>";' class="btn w-100 btn-warning">To Release</button>
                                                <?php
                                                    }elseif($result["status_id"] == 5){
                                                ?>
                                                    <button onclick='window.location = "Assignment_release.php?id=<?php echo $result["id"] ?>";' class="btn w-100 btn-success">Released</button>
                                                <?php
                                                    }else{     
                                                ?>
                                                    <label class="btn w-100 <?php if($result["status_id"] == 4){echo "btn-warning";}else{echo "btn-secondary";} ?> "><span><?php echo $result["status"] ?></span></label>
                                                <?php
                                                    }     
                                                ?>
                                                </td>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Invite New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap">
                        <div class="col-12 col-lg-6">
                            <label class="form-label">User Name</label>
                            <input id="name" class="form-control" type="text" />
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Password</label>
                            <input id="password" class="form-control" type="text" />
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input id="email" class="form-control" type="text" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick="InviteStudent();" type="button" class="btn btn-primary">Send Invitation</button>
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