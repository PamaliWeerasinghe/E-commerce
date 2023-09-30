<?php 
require "connection.php";
session_start();
$user=$_SESSION["u"]["email"];
$msg=$_GET["msg"];

$d= new DateTime();
$tz= new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date=$d->format("Y-m-d H:i:s");

$status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
$status_data=$status->fetch_assoc();

Database::iud("INSERT INTO `chat`(`content`,`date_time`,`from`,`status_id`) VALUES('".$msg."','".$date."','".$user."','".$status_data["id"]."')");
echo("success");

?>