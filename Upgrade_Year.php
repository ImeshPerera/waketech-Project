<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {
    $user = $_SESSION["admin"];
    if(isset($_GET["yr"])){
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Upgrade Year </title>

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
                        <p class="h2 fw-bold m-0 p-0">Student Management</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="card-title my-2">Admin | <?php echo $user["name"]; ?></h4>
                                            <span><?php echo $user["email"]; ?></span><br>
                                            <span><?php echo $user["mobile"]; ?></span><br>
                                        </div>
                                        <div>
                                            <h5 class="card-title my-2"><?php echo $_GET["yr"] ?></h5>
                                            <button class="btn w-100 btn-dark mt-2" type="button" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Upgrade Year Now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 text-danger">
                                    <p class="m-0">When year up-grade, Only qualified students will pass to the next Batch.</p>
                                    <p class="m-0">Students who not qualified will left in this Batch.</p>
                                    <p class="m-0">Students who Blocked or Not Verified in this batch will left in this Batch also.</p>
                                    <p class="m-0">You can't move them without fullfill the Qualification.</p>
                                    
                                </div>
                                <div class="table-responsive admin-box mt-md-3">
                                    <table class="table table-striped">
                                        <thead class="sticky-top bg-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>mobile</th>
                                                <th>Qualification</th>
                                                <th>Decision</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resu = Database::search("SELECT * FROM `student_view` WHERE `year` = '".$_GET["yr"]."';");
                                            $n = $resu->num_rows;
                                            $b = $n+1;

                                            $nst = Database::search("SELECT COUNT(`id`) AS `all_assignments` FROM `assignment_view` WHERE `year` = '".$_GET["yr"]."' GROUP BY `year`;");
                                            $nstd = $nst->fetch_assoc();                                            
                                            if(($nst->num_rows) == 0){
                                                $nstd["all_assignments"] = 0;
                                            }

                                            for ($a = 0; $a < $n; $a++) {
                                                $b = $b-1;
                                                $resul = $resu->fetch_assoc();
                                                $resultset = Database::search("SELECT * FROM `user_view` WHERE `id` = '".$resul["id"]."';");
                                                $result = $resultset->fetch_assoc();
                                                $rs = Database::search("SELECT COUNT(`id`) AS `submitted_assignment` FROM `user_has_assignment` WHERE `user_id` = '".$result["id"]."' GROUP BY `user_id`;");
                                                $ns = $rs->num_rows;                                            

                                            ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0".$b; } else { echo $b; } ?></td>
                                                <td><?php echo $result["name"] ?></td>
                                                <td><?php echo $result["email"] ?></td>
                                                <td><?php echo $result["mobile"] ?></td>
                                                <td>
                                                    <?php
                                                    if($nstd["all_assignments"] == 0){
                                                        ?>
                                                        <label class="btn w-100 btn-secondary" >No Assignments</label>
                                                        </td>
                                                        <td><label class="btn w-100 btn-warning">Pending</label></td>
                                                        <?php
                                                    }elseif($ns < 1){
                                                        ?>
                                                        <label class="btn w-100 btn-warning">Not Qualified</label>
                                                        </td>
                                                        <td><label class="btn w-100 btn-danger">Stay Here</label></td>
                                                        <?php
                                                    }else{
                                                        $uy = $rs->fetch_assoc();                                            
                                                        if($nstd["all_assignments"] == $uy["submitted_assignment"]){
                                                            ?>
                                                            <label class="btn w-100 btn-success" >Qualified</label></td>
                                                            <td><label class="btn w-100 btn-success">Up Year</label></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <label class="btn w-100 btn-warning">Not Qualified</label>
                                                            </td>
                                                            <td><label class="btn w-100 btn-danger">Stay Here</label></td>
                                                            <?php
                                                        }
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
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Up-Grade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap">
                        <div class="col-12">
                            <div class="dropdown">
                                <input class="form-control dropdown-toggle w-100 text-start text-uppercase" type="text" value="" placeholder="Type to get Grade"
                                    id="dropdownin" onkeyup="Year();" data-bs-toggle="dropdownin" aria-expanded="false"/>
                                <ul id="FillUp" class="dropdown-menu w-100"
                                    aria-labelledby="dropdownin">
                                    <?php
                                    $Darray = Database::search("SELECT * FROM `grade`;");
                                    $Dnum = $Darray->num_rows;
                                    for($Dn = 0; $Dn < $Dnum; $Dn ++){
                                        $Ddata = $Darray->fetch_assoc();
                                        ?>
                                        <li><button onclick="ShowAvColor('CId<?php echo $Ddata['id'];?>');" id="CId<?php echo $Ddata["id"];?>" value="<?php echo $Ddata["name"];?>" class="dropdown-item"><?php echo $Ddata["name"];?></button></li>
                                        <?php
                                        }
                                        ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Enrollment Fee (Rs : )</label>
                            <input id="enroll" type="number" min="1000" class="form-control" placeholder="Enroll Fee"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button onclick='SubmitYear("<?php echo $_GET["yr"] ?>");' type="button" class="btn btn-primary">Up-Grade</button>
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
    }
}else{
    ?><script>window.location = "signin.php";</script><?php
}
?>