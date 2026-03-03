<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {
    $user = $_SESSION["admin"];
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
                        <p class="h2 fw-bold m-0 p-0">Teacher Management</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title my-2">Admin | <?php echo $user["name"]; ?></h4>
                                <span><?php echo $user["email"]; ?></span><br>
                                <span><?php echo $user["mobile"]; ?></span><br>
                                <button class="btn btn-dark mt-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Invite New Teacher</button>
                                <div class="table-responsive admin-box mt-md-3">
                                    <table class="table table-striped">
                                        <thead class="sticky-top bg-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Appointment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $resultset = Database::search("SELECT * FROM `user_view` WHERE `user_type_id` = '3' ORDER BY `id` DESC;");
                                            $n = $resultset->num_rows;
                                            $b = $n+1;
                                            for ($a = 0; $a < $n; $a++) {
                                                $b = $b-1;
                                                $result = $resultset->fetch_assoc();
                                            ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0".$b; } else { echo $b; } ?></td>
                                                <td><?php echo $result["name"] ?></td>
                                                <td><?php echo $result["mobile"] ?></td>
                                                <td><?php echo $result["email"] ?></td>
                                                <td><button class="btn w-100 btn-primary" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop2">Appoint Now</button></td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Appoint Teacher to class</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row row-gap">
                                                                            <div class="col-12">
                                                                                <label class="form-label">Teacher Name</label>
                                                                                <label class="form-control"><?php echo $result["name"] ?></label>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6">
                                                                                <label class="form-label">Select Grade</label>
                                                                                <?php
                                                                                $yeardata = Database::search("SELECT * FROM `grade` ORDER BY `id` DESC;");
                                                                                $yn = $yeardata->num_rows;
                                                                                ?>
                                                                                <select id="year" class="form-select">
                                                                                    <option value="0" disabled selected>Select Here</option>
                                                                                    <?php 
                                                                                    for($b = 0; $b < $yn; $b++){
                                                                                    $yd = $yeardata->fetch_assoc();
                                                                                ?>
                                                                                    <option value="<?php echo $yd["id"]; ?>"><?php echo $yd["name"]; ?></option>
                                                                                    <?php
                                                                                    } 
                                                                                ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6">
                                                                                <label class="form-label">Select Subject</label>
                                                                                <?php
                                                                                $sdata = Database::search("SELECT * FROM `subject`;");
                                                                                $sn = $sdata->num_rows;
                                                                                ?>
                                                                                <select id="subject" class="form-select">
                                                                                    <option value="0" disabled selected>Select Here</option>
                                                                                    <?php 
                                                                                    for($b = 0; $b < $sn; $b++){
                                                                                    $sd = $sdata->fetch_assoc();
                                                                                ?>
                                                                                    <option value="<?php echo $sd["id"]; ?>"><?php echo $sd["name"]; ?></option>
                                                                                    <?php
                                                                                    } 
                                                                                ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label class="form-label">Already appointed classes</label>
                                                                                <?php 
                                                                                    $rset = Database::search("SELECT * FROM `teacher_class` WHERE `teacher_id` = '".$result["id"]."' ORDER BY `id` DESC;");
                                                                                    $nset = $rset->num_rows;

                                                                                    if($nset != 0){
                                                                                        for($c = 0; $c < $nset; $c++){
                                                                                            $dset = $rset->fetch_assoc();
                                                                                            ?>
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <label class="form-control"><?php echo $dset["subject_name"] ?></label>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <label class="form-control"><?php echo $dset["year"] ?></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <?php
                                                                                        }
                                                                                    }else{
                                                                                    ?>
                                                                                        <label class="form-control">Not Appointed Yet !</label>
                                                                                    <?php
                                                                                    }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button onclick='NewAppointed(<?php echo $result["id"]; ?>);' type="button" class="btn btn-primary">Apply Class</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                <td><label class="btn w-100 <?php if($result["user_status_id"] == 2){echo "btn-success";}elseif($result["user_status_id"] == 1){echo "btn-secondary";}else{echo "btn-danger";} ?> "><span><?php echo $result["status"] ?></span></label>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($result["user_status_id"] == 2){
                                                            ?>
                                                                <button onclick='UserStatus(3,<?php echo $result["id"]; ?>,3);' class="btn w-100 btn-danger">Block</button>
                                                            <?php
                                                        }elseif($result["user_status_id"] == 3){
                                                            ?>
                                                                <button onclick='UserStatus(3,<?php echo $result["id"]; ?>,2);' class="btn w-100 btn-warning">Unblock</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Invite New Teacher</h5>
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
                    <button onclick="InviteNew(3);" type="button" class="btn btn-primary">Send Invitation</button>
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