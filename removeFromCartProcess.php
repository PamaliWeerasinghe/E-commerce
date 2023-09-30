<?php 
session_start();
require "connection.php";

$email=$_SESSION["u"]["email"];

Database::search("DELETE FROM `cart` WHERE `user_email`='".$email."'");

echo("success");




?>