<?php
$pid=$_GET["pid"];

require "connection.php";

$search=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$search_data=$search->fetch_assoc();

if($search_data["status_id"]==1){
    $search_data["status_id"]=2;
    Database::iud("UPDATE `product` SET `status_id`='".$search_data["status_id"]."' WHERE `id`='".$pid."'");
    echo("success2");
}else if($search_data["status_id"]==2){
    $search_data["status_id"]=1;
    Database::iud("UPDATE `product` SET `status_id`='".$search_data["status_id"]."' WHERE `id`='".$pid."'");
    echo("success1");
}


?>