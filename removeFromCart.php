<?php 
session_start();
require "connection.php";

$email=$_SESSION["u"]["email"];
$pid=$_GET["pid"];

$cart=Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
$product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$cart_data=$cart->fetch_assoc();
$product_data=$product->fetch_assoc();
$cart_qty=$product_data["qty"]+$cart_data["qty"];
Database::iud("DELETE FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
Database::iud("UPDATE `product` SET `qty`='".$cart_qty."' WHERE `id`='".$pid."'");


$recent=Database::search("SELECT * FROM `recent` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
$recent_num=$recent->num_rows;
echo($recent_num);

if($recent_num==0){
    Database::iud("INSERT INTO `recent`(`user_email`,`product_id`) VALUES('".$email."','".$pid."')");
}


?>