<?php
session_start(); 
require "connection.php";
$pid=$_GET["pid"];
$email=$_SESSION["u"]["email"];



$cart=Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
$product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");

$cart_data=$cart->fetch_assoc();
$product_data=$product->fetch_assoc();

$newcart_qty=$cart_data["qty"]-1;
$newpro_qty=$product_data["qty"]+1;


if($newcart_qty==0){
    Database::iud("UPDATE `cart` SET `qty`='".$newcart_qty."' WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
    //echo("hi");
} else if($newcart_qty>0){
    Database::iud("UPDATE `product` SET `qty`='".$newpro_qty."' WHERE `id`='".$pid."'");
    Database::iud("UPDATE `cart` SET `qty`='".$newcart_qty."' WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
    echo("success");
}











?>