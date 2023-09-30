<?php 
require "connection.php";
$e=$_GET["e"];

$search=Database::search("SELECT * FROM `user` WHERE `email`='".$e."'");
$search_data=$search->fetch_assoc();


if($search_data["status"]=='1'){
    $status='2';
    Database::iud("UPDATE `user` SET `status`='".$status."' WHERE `email`='".$e."'");
    echo("success2");

}else if($search_data["status"]=='2'){
    $status='1';
    Database::iud("UPDATE `user` SET `status`='".$status."' WHERE `email`='".$e."'");
    echo("success1");
}


?>