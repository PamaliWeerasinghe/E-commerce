<?php 
require "connection.php";
session_start();
$email=$_SESSION["u"]["email"];
$total=$_GET["t"];

$status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
$status_data=$status->fetch_assoc();

$inactive=Database::search("SELECT * FROM `status` WHERE `name`='Deactive'");
$inactive_data=$inactive->fetch_assoc();
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$cart_active=Database::search("SELECT * FROM `cart` INNER JOIN `status` ON `cart`.`status_id`=`status`.`id` WHERE `status`.`name`='Active' AND `user_email`='".$email."'");
for($x=0;$x<$cart_active->num_rows;$x++){
    $cart_active_data=$cart_active->fetch_assoc();
    $seller=Database::search("SELECT * FROM `product` WHERE `id`='".$cart_active_data["product_id"]."'");
    $seller_data=$seller->fetch_assoc();
    $invoice=Database::search("SELECT * FROM `invoice` WHERE `date`='".$date."' AND `user_email`='".$email."' AND `total`='".$total."' AND `status_id`='".$status_data["id"]."'" );
    if($invoice->num_rows==0){
        Database::iud("INSERT INTO `invoice`(`date`,`total`,`user_email`,`status_id`) VALUES ('".$date."','".$total."','".$email."','".$status_data["id"]."')");

    }

    $order_id=Database::search("SELECT * FROM `invoice` WHERE `date`='".$date."' AND `user_email`='".$email."' AND `total`='".$total."' ");
    $order_id_data=$order_id->fetch_assoc();

    Database::iud("INSERT INTO `invoice_items`(`invoice_order_id`,`product_id`,`qty`,`status_id`,`seller_email`) VALUES('".$order_id_data["order_id"]."','".$cart_active_data["product_id"]."','".$cart_active_data["qty"]."','".$status_data["id"]."','".$seller_data["user_email"]."')");
    Database::iud("UPDATE `cart` SET `status_id`='".$inactive_data["id"]."' WHERE `product_id`='".$cart_active_data["product_id"]."' ");


}

echo("success");



?>