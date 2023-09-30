<?php 
session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["pid"])){
        $pid=$_GET["pid"];
        $email=$_SESSION["u"]["email"];

        $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
        $product_num=$product->num_rows;
        $product_data=$product->fetch_assoc();
        if($product_num!=1){
            echo("Check your product");
        }else{
            
            $check1=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
            $check_num=$check1->num_rows;
            if($check_num==0){
                Database::iud("INSERT INTO `cart`(`user_email`,`product_id`,`qty`) VALUES ('".$email."','".$pid."','1')");
                //$new_qty=$product_data["qty"];
                $check1_data=$check1->fetch_assoc();
                $cartqty=$check1_data["qty"];
                $check2=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
                $check2_data=$check2->fetch_assoc();
                $searchProductqty=$check2_data["qty"];
                $qty=$cartqty+$searchProductqty;
                Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
                //Database::iud("UPDATE `search_product` SET `qty`='0' WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
                echo("success");


            }else if($check_num==1){
                $check2=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
                $check2_data=$check2->fetch_assoc();
                $searchProductqty=$check2_data["qty"];
                Database::iud("UPDATE `cart` SET `qty`='".$searchProductqty."' WHERE `product_id`='".$pid."' AND `user_email`='".$email."' ");
                
                //Database::iud("UPDATE `search_product` SET `qty`='0' WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
                echo("success");
            }
        }
    }
}

?>