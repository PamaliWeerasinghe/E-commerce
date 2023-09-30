<?php 

session_start();
require "connection.php";

$email=$_SESSION["u"]["email"];
$oid=$_GET["oid"];

$status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
$status_data=$status->fetch_assoc();

$status_inative=Database::search("SELECT * FROM `status` WHERE `name`='Deactive'");
$status_inactive_data=$status->fetch_assoc();

$invoice_items=Database::search("SELECT * FROM `invoice_items` WHERE `invoice_order_id`='".$oid."' AND `status_id`='".$status_data["id"]."'");

if($invoice_items->num_rows>=1){
    Database::iud("UPDATE `invoice_items` SET `status_id`='2' WHERE `invoice_order_id`='".$oid."'");
    Database::iud("UPDATE `invoice` SET `status_id`='2' WHERE `order_id`='".$oid."' ");
    echo("success");
}
?>