<?php
require "connection.php";

$merchant_id         = $_POST['merchant_id'];
$order_id             = $_POST['order_id'];
$payhere_amount     = $_POST['payhere_amount'];
$email            = $_POST["email"];
$User_id         = $_POST["custom_1"];
$Year_id         = $_POST["custom_2"];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig                = $_POST['md5sig'];
$merchant_secret = '4eZQzn3zujp4OTcrezSbMR4vUnrvLJO258RiH6EKke2C'; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)
$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );
if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
    
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d");
    Database::iud("UPDATE `student_has_pay` SET `pay_day` = '".$date."',`pay_status_id` = '1' WHERE `user_id` = '".$User_id."' AND `grade_id` = '".$Year_id."';");
}