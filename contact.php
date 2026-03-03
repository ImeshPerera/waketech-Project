<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WAKE TECH Campus | Contact Us</title>

    <link rel="icon" href="images/image.png" />
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
    .alert-box {
        justify-content: start;
    }

    .alert-close {
        position: unset;
        margin: 12px -34px;
        z-index: 1;
    }
    </style>
</head>

<body>
    <!-- Alert Box  -->
    <?php require "alert.php"; ?>
    <!-- Alert Box  -->
    <div class="container mt-5 mb-4 bg-smoke">
    <?php require "header.php"; ?>
        <div class="content my-4">
            <div class="left-side">
                <div class="address details">
                    <i class="fa bx bxs-map"></i>
                    <div class="topic">Address</div>
                    <div class="text-one">Maradana, Colombo&nbsp;10</div>
                    <div class="text-two">Sri&nbsp;Lanka</div>
                </div>
                <div class="phone details">
                    <i class="fa bx bxs-phone"></i>
                    <div class="topic">Phone</div>
                    <div class="text-one">+94 11 254 6978</div>
                    <div class="text-two">+94 11 254 6980</div>
                </div>
                <div class="email details">
                    <i class="fa fa-envelope"></i>
                    <div class="topic">Email</div>
                    <div class="text-one">care@waketech.com</div>
                    <div class="text-two">info@waketech.com</div>
                </div>
            </div>
            <div class="right-side">
                <div class="topic-text font-Quicksand">Send us a message</div>
                <p>If you need to join with us or have you any questions about our courses,<br/> you can send us a message here.<br/> Your reply massage will be sent to your given Email.
                    It is our pleasure to help you.</p>
                <div class="input-box">
                    <input id="ContactName" type="text" placeholder="Enter your name">
                </div>
                <div class="input-box">
                    <input id="ContactEmail" type="text" placeholder="Enter your email">
                </div>
                <div class="input-box message-box">
                    <textarea id="ContactMessage" placeholder="Enter your Message"></textarea>
                </div>
                <div class="button">
                    <input onclick="ContactMeMsg();" type="button" value="Send Now">
                </div>
            </div>
        </div>
    </div>
    <?php require "footer.php" ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="bootstrap/bootstrap.bundle.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/main.js"></script>
</body>

</html>