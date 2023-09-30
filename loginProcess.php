<?php
$e=$_POST["email"];
$p=$_POST["password"];

require "connection.php";

if(empty($e)){
    echo("Enter the Email");
}else if(empty($p)){
    echo("Enter the Password");
}else{
    $user=Database::search("SELECT * FROM `user` WHERE `email`='".$e."' AND `password`='".$p."'");
$user_num=$user->num_rows;
 
if ($user_num==1){
    echo("loggedIn");
}else{
    echo("Incorrect Email or Password");
}




}


?>