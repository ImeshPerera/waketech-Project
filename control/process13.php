<?php

    // Student Grade Update is Here

    session_start();
    require "../connection.php";

    if(isset($_SESSION["admin"])){
        $user = $_SESSION["admin"];    
        
        $yearold = $_POST["yearold"];
        $year = $_POST["year"];
        $enroll = $_POST["enroll"];

        if(empty($year)){
            echo "Your Upgraded Year is Empty";
        }elseif(empty($enroll)){
            echo "Please enter enrollment fee for students";
        }elseif($enroll < 1000){
            echo "minimum Enrollment fee is Rs: 1000";
        }else{
        
            $resu = Database::search("SELECT * FROM `student_view` WHERE `year` = '".$yearold."';");
            $n = $resu->num_rows;
            $ya = Database::search("SELECT * FROM `grade` WHERE `name` = '".$year."';");
            $yad = $ya->num_rows;
            
            if($yad < 1){
                Database::iud("INSERT INTO `grade`(`name`) VALUES('".$year."');");
            }

            if($n != 0){
                for($a = 0; $a < $n; $a++){
                $resud = $resu->fetch_assoc();

                $nst = Database::search("SELECT COUNT(`id`) AS `all_assignments` FROM `assignment_view` WHERE `year` = '".$yearold."' GROUP BY `year`;");
                $nrst = $nst->num_rows;

                    if($nrst != 0){
                        $nstd = $nst->fetch_assoc();


                        $rs = Database::search("SELECT `grade`.`id`,`grade`.`name` AS `year` FROM `user_has_grade` LEFT JOIN `grade` ON `user_has_grade`.`grade_id` = `grade`.`id` WHERE `user_id` = '".$resud["id"]."';");
                        $uy = $rs->fetch_assoc();
                        
                        $rs = Database::search("SELECT COUNT(`id`) AS `submitted_assignment` FROM `user_has_assignment` WHERE `user_id` = '".$resud["id"]."' AND `grade_id` = '".$uy["id"]."' GROUP BY `user_id`;");
                        $ns = $rs->num_rows;
                        
                        if($ns != 0){
                            $rsd = $rs->fetch_assoc();

                            if($nstd["all_assignments"] == $rsd["submitted_assignment"]){
                                

                                    $yar = Database::search("SELECT * FROM `grade` WHERE `name` = '".$year."';");
                                    $yard = $yar->fetch_assoc();
                                    $today = date('Y/m/d');
                                    Database::iud("UPDATE `user_has_grade` SET `grade_id` = '".$yard["id"]."' WHERE `user_id` = '".$resud["id"]."';");
                                    Database::iud("INSERT INTO `student_has_pay`(`user_id`,`start_day`,`grade_id`,`amount`,`pay_status_id`) VALUES('".$resud["id"]."','".$today."','".$yard["id"]."','$enroll','2');");
                                    echo "Success";
                            }else{

                            }
                        }
                    }else{
                        $yar = Database::search("SELECT * FROM `grade` WHERE `name` = '".$year."';");
                        $yard = $yar->fetch_assoc();
                        $today = date('Y/m/d');
                        Database::iud("UPDATE `user_has_grade` SET `grade_id` = '".$yard["id"]."' WHERE `user_id` = '".$resud["id"]."';");
                        Database::iud("INSERT INTO `student_has_pay`(`user_id`,`start_day`,`grade_id`,`amount`,`pay_status_id`) VALUES('".$resud["id"]."','".$today."','".$yard["id"]."','$enroll','2');");
                        echo "S1";
                    }

                }
            }else{
                echo "There has no Students to Up-Grade";
            }
        }
    }