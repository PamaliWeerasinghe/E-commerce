<?php 
$pid=$_GET["id"];
session_start();
$email=$_SESSION["u"]["email"];
require "connection.php";

$gift=Database::search("SELECT * FROM `gift_box` INNER JOIN `status` 
ON `status`.`id`=`gift_box`.`status_id` 
WHERE `product_id`='".$pid."' AND `user_email`='".$email."' AND `status`.`name`='Active'");

$invoice1=Database::search("SELECT * FROM `gift_box_invoice` INNER JOIN `status` 
ON `status`.`id`=`gift_box_invoice`.`status_id` 
WHERE `user_email`='".$email."' AND `status`.`name`='Active'");
$invoice1_data=$invoice1->fetch_assoc();

$status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
$active=$status->fetch_assoc();

if($invoice1->num_rows==0){
    Database::iud("INSERT INTO `gift_box_invoice`(`status_id`,`user_email`) VALUES ('".$active["id"]."','".$email."')");
    $invoice=Database::search("SELECT * FROM `gift_box_invoice` INNER JOIN `status` 
    ON `status`.`id`=`gift_box_invoice`.`status_id` 
    WHERE `user_email`='".$email."' AND `status`.`name`='Active'");
    $invoice_data=$invoice->fetch_assoc();

    $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data=$product->fetch_assoc();
    $qty=$product_data["qty"];

    $newQty=$qty-1;

    
    Database::iud("INSERT INTO `gift_box`(`user_email`,`product_id`,`qty`,`gift_box_invoice_id`,`status_id`)VALUES('".$email."','".$pid."','1','".$invoice_data["id"]."','".$active["id"]."')");

    Database::iud("UPDATE `product` SET `qty`='".$newQty."' WHERE `id`='".$pid."'");
    
}else if($invoice1->num_rows==1){
    $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data=$product->fetch_assoc();
    $qty=$product_data["qty"];

    $newQty=$qty-1;

    //echo($invoice1_data["id"]);
    Database::iud("INSERT INTO `gift_box`(`user_email`,`product_id`,`qty`,`gift_box_invoice_id`,`status_id`)VALUES('".$email."','".$pid."','1','".$invoice1_data["id"]."','1')");

    Database::iud("UPDATE `product` SET `qty`='".$newQty."' WHERE `id`='".$pid."'");
    
}




?>