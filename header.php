<div class="row bg-light pt-2 pb-2">
    <div class="col-12">
        <nav class="nav d-block align-content-center Head-nav">
            <div class="ms-md-2 my-2 my-md-0 d-flex justify-content-evenly">
                <button class='btn btn-light mx-md-2 ' <?php if(isset($user)){?> onclick="window.location = 'home.php';"><b>Welcome&nbsp;
                </b><?php echo mb_strimwidth($user["name"], 0, 18, "..");}else{?>' onclick="window.location = 'signin.php';">Sign In<?php } ?></button>
                <a class="btn btn-light mx-md-2" href="contact.php">Help and Contact</a>
                <?php if(isset($user)){?>
                <a href="logout.php" class="btn btn-light mx-md-2">Sign Out</a>
                <?php } ?>
            </div>
            <div class="me-md-2 my-2 my-md-0 d-flex justify-content-evenly">
                <img src="images/image.png" width="80" height="40" class="d-inline-block align-text-top">
            </div>
        </nav>
    </div>
</div>