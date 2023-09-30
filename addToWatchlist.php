<?php 
$id=$_GET["id"];
//echo($id);

session_start();
require "connection.php";


if(isset($_SESSION["u"])){
    $email=$_SESSION["u"]["email"];
    $search_watchlist=Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."' AND `product_id`='".$id."'");
    $search_watchlist_num=$search_watchlist->num_rows;
    if($search_watchlist_num==0){
        Database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES ('".$id."','".$email."')");
        echo("added");
    }else if($search_watchlist_num==1){
        Database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$id."' AND `user_email`='".$email."'");
        echo("deleted");
        //echo("alreadyin");
   
    }

   


}else{
    echo("login");
   
}




?>