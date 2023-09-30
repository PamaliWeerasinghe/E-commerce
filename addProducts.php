<?php
    session_start();
    require "connection.php";
    $email=$_SESSION["u"]["email"];
    
    $category=$_POST["c"];
    $brand=$_POST["brand"];
    $model=$_POST["m"];
    $title=$_POST["t"];
    $condition=$_POST["condition"];
    $colour=$_POST["colour"];
    $qty=$_POST["qty"];
    $cost=$_POST["cost"];
    $delcol=$_POST["delcol"];
    $delout=$_POST["delout"];
    $desc=$_POST["desc"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    $status=1;

    if($category=="0"){
        echo("Select a Category");
    }else if($brand=="0"){
        echo("Select a Brand");

    }else if($model=="0"){
        echo("Select a Model");

    }else if(empty($title)){
        echo("Please Enter a title");

    }else if(strlen($title)>100){
        echo("Title should have less than 100 characters");

    }else if ($condition == "0"){
        echo ("Please select a Condition");
    }else if ($colour == "0"){
        echo ("Please select a Colour");
    }else if(empty($qty)){
        echo ("Please add the Quantity");
    }else if($qty == "0" | $qty < 0){
        echo ("Invalid value for field Quantity");
    }else if(empty($cost)){
        echo ("Please add the Cost");
    }else if(!is_numeric($cost)){
        echo ("Invalid value for field Cost Per Item");
    }else if(empty($delcol)){
        echo ("Please add the Cost for Delivery inside Colombo");
    }else if(!is_numeric($delcol)){
        echo ("Invalid value for field Delivery cost within Colombo");
    }else if(empty($delout)){
        echo ("Please add the Cost for Delivery outside Colombo");
    }else if(!is_numeric($delout)){
        echo ("Invalid value for field Delivery cost out of Colombo");
    }else if(empty($desc)){
        echo ("Please add the Description");
    }else{
        $brand_has_model=Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'");
        $brand_has_model_rows=$brand_has_model->num_rows;
        if($brand_has_model_rows==1){
            $brand_has_model_data=$brand_has_model->fetch_assoc();
            $brandid1=$brand_has_model_data["id"];
            Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,
            `user_email`,`category_id`,`condition_id`,`colour_id`,`status_id`,`brand_has_model_id`) VALUES
            ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$delcol."','".$delout."','".$email."','".$category."',
            '".$condition."','".$colour."','".$status."','".$brandid1."')");
            //echo ("success");

        }else{
            Database::iud("INSERT INTO `brand_has_model`(`brand_id`,`model_id`) VALUES ('".$brand."','".$model."')");
            //$brandid2=Database::search("SELECT `id` FROM `brand_has_model` WHERE `brand_id`='".$brand."' AND `model_id`='".$model."'");
            $id=Database::$connection->insert_id;
            Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,
            `user_email`,`category_id`,`condition_id`,`colour_id`,`status_id`,`brand_has_model_id`) VALUES
            ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$delcol."','".$delout."','".$email."','".$category."',
            '".$condition."','".$colour."','".$status."','".$id."')");
    
            // $brandid3=$brandid2->fetch_assoc();
            // $brandid1=$brandid3["id"];
            //echo ("success");
        }



         $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if($length <= 3 && $length > 0){

        $allowed_image_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0;$x < $length;$x++){
            if(isset($_FILES["image".$x])){

                $image_file = $_FILES["image".$x];
                $file_extention = $image_file["type"];

                if(in_array($file_extention,$allowed_image_extentions)){

                    $new_img_extention;

                    if($file_extention =="image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention =="image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention =="image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention =="image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $file_name = "mobiles/".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($image_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images`(`path`,`product_id`) VALUES ('".$file_name."','".$product_id."')");
                    
                }else{
                    echo ("Not an allowed image type");
                }

            }
        }

        echo ("Product images saved successfully");

    }else{
        echo ("Invalid Image Count");
    }


       

        
       
    }
        

    

?>