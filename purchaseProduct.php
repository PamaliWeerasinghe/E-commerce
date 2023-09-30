<?php
session_start();
if(isset($_SESSION["u"])){
    $email=$_SESSION["u"]["email"];
    require "connection.php";
    $pid=$_GET["pid"];
$uid="";
$payid="";
$status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
$status_data=$status->fetch_assoc();
//$cart="";
        if(isset($_SESSION["s"]["id"])){$uid=$_SESSION["s"]["id"];}
         if(isset($_GET["one"])){$payid=$_GET["one"];}
        if(isset($_GET["two"])){$payid=$_GET["two"];}
        if(isset($_GET["three"])){$payid=$_GET["three"];}
        if(isset($_GET["four"])){$payid=$_GET["four"];}
        if(isset($_GET["five"])){$payid=$_GET["five"];}
        if(isset($_GET["six"])){$payid=$_GET["six"];}
        if(isset($_GET["seven"])){$payid=$_GET["seven"];}
        if(isset($_GET["eight"])){$payid=$_GET["eight"];}
        if(isset($_GET["nine"])){$payid=$_GET["nine"];}


//$selectConta=Database:: search("SELECT * FROM `student` WHERE `id`='".$uid."'");
//$rowconta=$selectConta->fetch_assoc();
//$rowconta=$resultconta->fetch_assoc();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gimmick | Pay</title>
        <link type="text/css" rel="stylesheet" href="checkout_temp.css"/>
        <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>
    <body>
        <?php
        // if (isset($_SESSION["is_login"]) && ($_SESSION["is_login"] == true)) {
            ?>
            <div class="container-fluid vh-140 " style="background-image: url(resources/logos/blob.png);background-repeat: no-repeat;height:160vh; background-position:500px 220px; background-color: rgb(242, 247, 252); margin:0" >
            <div class="product-nav" style="background-color: transparent;">
                <table class="tb1-carving">
                <tbody>
                    <tr>
                        <th class="col2_1">
                            <div class="div-logo-outer">
                                <div class="left"></div>
                            </div>
                            <a class="backButton-anchor">
                                <button  onclick="backToProductView(<?php echo $pid;?>);"class="backButton">Back</button>
                            </a>
                        </th>
                    </tr>
                </tbody>
            </table>      
            </div>
            <div class="product-box1">
                <div class="box-product-body">
                <?php 
 
       $products=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");
       $products_num=$products->num_rows;
      
       $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
       $address_data =$address_rs->fetch_assoc();

        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
        $city_data = $city_rs->fetch_assoc();
        $district=Database::search("SELECT * FROM `district` WHERE `id`='".$city_data["district_id"]."'");
        $district_data=$district->fetch_assoc();

       $delivery=0;
            $g=0;

        $products_data=$products->fetch_assoc();
        $search1=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
        $search1_data=$search1->fetch_assoc();
        if($district_data["id"]=='1'){
            $delivery = $delivery+$search1_data["delivery_fee_colombo"];
        }else{
            $delivery = $delivery+$search1_data["delivery_fee_other"];
         }
        
         $search_product=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
         $search_product_data=$search_product->fetch_assoc();
         $total=$search1_data["price"]*$search_product_data["qty"];
         $g=$total+$delivery;
    
       
       ?>
                  
                        <div class="box-product-body-inner">
                            <div class="product-details">
                                <div class="data-input-form">
                                                                        <br/>
                                                                        <br/>
                                     <span class="name">Hello !<input class="name-session"  name="username" value="<?php echo $_SESSION['u']['email']?>"/></span> 
                                    <br/>
                                    <br/>
                                    <input type="text"  class="user-input-field"  placeholder="Card Holder's Name" id="user-input-field2"name="holder-name"   onfocus="this.placeholder = 'Enter your name'"  onfocusout="this.placeholder ='Card Holders Name'" autocomplete="off"   onclick="passwordLoginClick();"  required/> <!-- Password  entering input-->
                                    <br/>    
                                    <input type="text"  class="user-input-field"  placeholder="Card Number" id="user-input-field3" name="card-number"  onfocus="this.placeholder = 'Enter your Card Number'" onfocusout="this.placeholder ='Card Number'"  autocomplete="off"   onclick="firstLoginClick();"  required/> <!-- Password  entering input-->
                                    <br/>
                                    
                                    <input type="text" class="user-input-field"  placeholder="LKR <?php echo $g ?>.00"/>
                                    <br/>
                                   
                                    <button type="submit" class="btn-purchase" onclick="buySingleProduct(<?php echo $pid ?>);">Pay&nbsp;&nbsp;LKR&nbsp; <?php echo $g ?>.00</button>&nbsp;&nbsp;
                                    
                                   
                                </div>

                            </div>
                        </div>
                       
                    <br/>
                    <br/>
                  
                </div>
            </div>
            <?php
        // } else {
        //     echo "<script> alert('Please Sign in to continue purchase');location='login_register.php' </script>";
        // }
        ?>
        
            </div>
        
        <script type="text/javascript" src="back.js"></script>
        <script type="text/javascript" src="checkout_temp.js"></script>
        <script src="script.js"></script>
    </body>
    
    
</html>

<?php
}else{
    include "login.php";

}
