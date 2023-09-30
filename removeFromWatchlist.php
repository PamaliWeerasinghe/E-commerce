<?php 
session_start();
require "connection.php";

$email=$_SESSION["u"]["email"];
$pid=$_GET["pid"];
//echo($pid);
$watchlist=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
$watchlist_num=$watchlist->num_rows;
if($watchlist_num==1){
    $remove=Database::search("DELETE FROM `watchlist` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
    echo("removed");
    $recent=Database::search("SELECT * FROM `recent` WHERE  `user_email`='".$email."' AND `product_id`='".$pid."'");
    $recent_num=$recent->num_rows;
    if($recent_num==0){
        $add=Database::iud("INSERT INTO `recent`(`user_email`,`product_id`) VALUES ('".$email."','".$pid."')");
        echo ("added to recent");
    }
   
}

?>