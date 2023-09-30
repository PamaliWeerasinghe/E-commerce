<?php
require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];
$add1=$_POST["a1"];
$add2=$_POST["a2"];
$city=$_POST["c"];
$vcode=$_POST["v1"];

if(empty($fname)){
    echo("Please enter your First Name");
}else if(strlen($fname)>50){
    echo("First Name should have less than 50 characters");

}else if(empty($lname)){
    echo("Please enter your Last Name");
}else if(strlen($lname)>50){
    echo("Last Name should have less than 50 characters");
}else if(empty($email)){
    echo("Please enter your email");
}else if(strlen($email)>=100){
    echo("Email should have less than 100 characters");
}elseif(empty($vcode)){
    echo("Please Verify your email");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email");
}else if(empty($password)){
    echo("Please enter your Password");
}else if(strlen($password)<5 || strlen($password)>20){
    echo("Password must be between 5-20 characters");

}else if(empty($add1)){
    echo("Please enter your address line 1");
} else if(strlen($add1)>100){
    echo("Address Line 1 should have less than 100 characters");
}else if(empty($add2)){
    echo("Please enter your address line 2");
} else if(strlen($add2)>100){
    echo("Address Line 2 should have less than 100 characters");
}else if(empty($mobile)){
    echo("Please enter your mobile");
}else if(strlen($mobile)!=10){
    echo("Mobile must have 10 characters");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Invalid Mobile !!!");
}else{

$rs=Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
$n=$rs->num_rows;

if($n>0){
    echo("User with the same Email already exists !");
}else{
    $d= new DateTime();
    $tz= new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date=$d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `user`(`email`,`fname`,`lname`,`password`,`mobile`,`joined_date`,`status`,`gender_id`) VALUES ('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','1','".$gender."')");
    echo("success");
    }


}



?>