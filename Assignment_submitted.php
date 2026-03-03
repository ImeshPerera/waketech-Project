<?php
session_start();
require "connection.php";

if (isset($_SESSION["teacher"])) {
    $user = $_SESSION["teacher"];

    if(isset($_GET["id"])){
        $resultset = Database::search("SELECT * FROM `answer_view` WHERE `assignment_id` = '".$_GET["id"]."';");
        $n = $resultset->num_rows;
        $rut = Database::search("SELECT * FROM `assignment_view` WHERE `id` = '".$_GET["id"]."';");
        $ut = $rut->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Lessons </title>

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
                                        <span class="card-title my-1">Start Date : <?php echo $ut["start_date"]; ?></span><br/>
                                        <span class="card-title my-1">End Date : <?php echo $ut["end_date"]; ?></span><br/>
                                    </div>
                                    <div>
                                    <?php
                                    if($ut["status_id"] == 3){
                                    ?>
                                        <button onclick='ReleaseReady(<?php echo $_GET["id"]; ?>);' class="btn btn-info">Submit for Release Marks</button>
                                    <?php
                                    }elseif($ut["status_id"] == 4){
                                    ?>
                                        <label class="btn btn-warning">Wait to Release</label>
                                    <?php
                                    }elseif($ut["status_id"] == 5){
                                    ?>
                                        <label class="btn btn-success">Released</label>
                                    <?php
                                    }elseif($ut["status_id"] == 2){
                                    ?>
                                        <label class="btn btn-primary">On Going</label>
                                    <?php
                                    }
                                    ?>
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
                                                <th>Submit</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($a = 0; $a < $n; $a++) {
                                                $b = $a+1;
                                                $result = $resultset->fetch_assoc();
                                                //<?php echo $result[""]
                                            ?>
                                            <tr>
                                                <td><?php if ($b < 10) { echo "0" . $b; } else { echo $b; } ?></td>
                                                <td><?php echo $result["user_name"] ?></td>
                                                <td><button class="btn w-100 btn-success" type="submit" onclick='window.open("<?php echo $result["upload"] ?>")'><span>Download</span></button></td>
                                                <td class="wp-200"><input id='mark<?php echo $result["user_id"]; ?>' type="number" class="form-control border-danger border-2" placeholder="<?php if(isset($result["marks"])){ echo $result["marks"];}else{ echo "00";} ?>" value="<?php if($result["marks"] != 0){ echo $result["marks"];}else{} ?>" <?php if($result["marks"] != 0){ echo "disabled readonly";} ?>></td>
                                                <td>
                                                    <?php if($result["marks"] != 0){ 
                                                        ?>
                                                        <button class="btn w-100 btn-dark"><span>Submitted</span></button>
                                                        <?php
                                                    }else{ 
                                                        ?>
                                                        <button onclick='marksubmit("<?php echo $result["user_id"]; ?>","<?php echo $result["id"]; ?>");' class="btn w-100 btn-warning"><span>Submit</span></button>
                                                        <?php
                                                    } ?>
                                                </td>
                                                <td>
                                                <?php if($result["marks_state"] == 'On Marking'){ 
                                                        ?>
                                                        <label class="btn w-100 btn-info"><span><?php echo $result["marks_state"]; ?></span></label></td>
                                                        <?php
                                                    }else{ 
                                                        ?>
                                                        <label class="btn w-100 btn-secondary"><span><?php echo $result["marks_state"]; ?></span></label></td>
                                                        <?php
                                                    } ?>
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
    }
}else{
    ?><script>window.location = "signin.php";</script><?php
}
?>