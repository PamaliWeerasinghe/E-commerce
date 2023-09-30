<?php
require "connection.php";
session_start();
$user=$_SESSION["u"]["email"];

$pid=$_POST["pid"];
$fb=$_POST["fb"];

$search=Database::search("SELECT * FROM `feedback` WHERE `product_id`='".$pid."' AND `user_email`='".$user."' AND `feedback`='".$fb."'");
$search_num=$search->num_rows;
if($search_num==1){
    
    echo("Your feedback is already updated!");
}else{
    Database::iud("INSERT INTO `feedback`(`product_id`,`user_email`,`feedback`) VALUES ('".$pid."','".$user."','".$fb."') ");
    echo("success");
}



?>