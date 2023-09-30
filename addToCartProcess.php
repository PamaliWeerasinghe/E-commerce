<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["pid"])){
        $pid=$_GET["pid"];
        $email=$_SESSION["u"]["email"];
        $status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
        $status_data=$status->fetch_assoc();

        $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
        $product_num=$product->num_rows;
        $product_data=$product->fetch_assoc();
        if($product_num!=1){
            echo("Check your Product");
        }else{
            
            $check=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `product_id`='".$pid."' AND `status_id`='".$status_data["id"]."'");
            $check_num=$check->num_rows;
            if($check_num==0){
                $new_qty=$product_data["qty"]-1;
                if($new_qty>=0){
                    Database::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$pid."'");
                    
                }else{
                    Database::iud("UPDATE `product` SET `qty`='0' WHERE `id`='".$pid."'");
                }
                
    
                Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`,`status_id`) VALUES('".$pid."','".$email."','1','".$status_data["id"]."')");
    
    
                echo("success");

            }else{
                echo("Product already in the cart");
            }
          
        }
    }else{
        echo("Something went wrong");

    }
}else{
    echo("Please login or register");
}



?>