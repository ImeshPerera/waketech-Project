<?php

    // Year Select Process is here

    session_start();
    require "../connection.php";

    if(isset($_SESSION["admin"])){
        $user = $_SESSION["admin"];  

        $val = $_POST["val"];

        $Darray = Database::search("SELECT * FROM `grade` WHERE `name` LIKE '%".$val."%';");
        $Dnum = $Darray->num_rows;
        for($Dn = 0; $Dn < $Dnum; $Dn ++){
        $Ddata = $Darray->fetch_assoc();
        ?>
            <li><button onclick="ShowAvColor('CId<?php echo $Ddata['id'];?>');" id="CId<?php echo $Ddata["id"];?>" value="<?php echo $Ddata["name"];?>" class="dropdown-item"><?php echo $Ddata["name"];?></button></li>
        <?php
        }
    }
    ?>
