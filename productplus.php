<?php
 session_start();
 require "connection.php";

 $pid=$_GET["pid"];
 if(isset($_SESSION["u"])){
 $email=$_SESSION["u"]["email"];
 $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
 $product_data=$product->fetch_assoc();
 $qty=$product_data["qty"];
 
 if($qty>0){
   
   $viewqty=Database::search("SELECT * FROM `search_product` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
   $viewqty_data=$viewqty->fetch_assoc();
   $vqty=intval($viewqty_data["qty"])+1;
   Database::iud("UPDATE `search_product` SET `qty`='".$vqty."' WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
   $qty=$qty-1;
   Database::iud("UPDATE `product` SET `qty`='".$qty."' WHERE `id`='".$pid."' ");
  //echo($qty." Items Available");

 }else if($qty==0){
   echo("0 Items Available");

 }
}
?>