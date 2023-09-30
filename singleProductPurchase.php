<?php 
       $total=0;
       $products=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `status_id`='".$status_data["id"]."'");
       $products_num=$products->num_rows;
      
       $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
       $address_data =$address_rs->fetch_assoc();

        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
        $city_data = $city_rs->fetch_assoc();
        $district=Database::search("SELECT * FROM `district` WHERE `id`='".$city_data["district_id"]."'");
        $district_data=$district->fetch_assoc();

       $delivery=0;
       $g=0;

       for($x=0;$x<$products_num;$x++){
        $products_data=$products->fetch_assoc();
        $search=Database::search("SELECT * FROM `product` WHERE `id`='".$products_data["product_id"]."'");
        $search_data=$search->fetch_assoc();
        if($district_data["id"]=='1'){
            $delivery = $delivery+$search_data["delivery_fee_colombo"];
        }else{
            $delivery = $delivery+$search_data["delivery_fee_other"];
         }
        
        $total=$total+$search_data["price"]*$products_data["qty"];
        $g=$total+$delivery;
       }
       
?>