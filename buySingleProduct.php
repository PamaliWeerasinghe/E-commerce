<?php 
require "connection.php";

session_start();
$email=$_SESSION["u"]["email"];
$pid=$_GET["pid"];

$d= new DateTime();
$tz= new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date=$d->format("Y-m-d H:i:s");

$address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
$address_data =$address_rs->fetch_assoc();

 $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
 $city_data = $city_rs->fetch_assoc();
 $district=Database::search("SELECT * FROM `district` WHERE `id`='".$city_data["district_id"]."'");
 $district_data=$district->fetch_assoc();

$delivery=0;
     
$product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
$product_data=$product->fetch_assoc();

 
 if($district_data["id"]=='1'){
     $delivery = $delivery+$product_data["delivery_fee_colombo"];
 }else{
     $delivery = $delivery+$product_data["delivery_fee_other"];
  }
 

$status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
$status_data=$status->fetch_assoc();

$search=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
$search_data=$search->fetch_assoc();


$price=$product_data["price"]*$search_data["qty"];
$total=$price+$delivery;

$invoice=Database::search("SELECT * FROM `invoice` WHERE `date`='".$date."'AND `total`='".$total."' AND `user_email`='".$email."' AND `status_id`='".$status_data["id"]."'");
$invoice_data=$invoice->fetch_assoc();

if($invoice->num_rows==0){
    Database::iud("INSERT INTO `invoice`(`date`,`total`,`user_email`,`status_id`) VALUES('".$date."','".$total."','".$email."','".$status_data["id"]."')");
}

$invoice1=Database::search("SELECT * FROM `invoice` WHERE `date`='".$date."' AND `total`='".$total."' AND `user_email`='".$email."' AND `status_id`='".$status_data["id"]."' ");
$invoice1_data=$invoice1->fetch_assoc();
$invoice_items=Database::search("SELECT * FROM `invoice_items` WHERE `invoice_order_id`='".$invoice1_data["order_id"]."'");
if($invoice_items->num_rows==0){
    Database::iud("INSERT INTO `invoice_items`(`invoice_order_id`,`product_id`,`seller_email`,`qty`,`status_id`) VALUES('".$invoice1_data["order_id"]."','".$pid."','".$product_data["user_email"]."','".$search_data["qty"]."','".$status_data["id"]."')");

}
echo("success");


?>