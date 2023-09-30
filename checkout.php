<?php
session_start();
if(isset($_SESSION["u"])){
    $email=$_SESSION["u"]["email"];
    $id=$_SESSION["p"]["id"];
    require "connection.php";
$uid="";
$payid="";
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
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <link rel="icon" href="resources/logos/logo.gif"/>
    </head>
    <body>
        <?php
        // if (isset($_SESSION["is_login"]) && ($_SESSION["is_login"] == true)) {
            ?>
            <div class="product-nav">
                <table class="tb1-carving">
                <tbody>
                    <tr>
                        <th class="col2_1">
                            <div class="div-logo-outer">
                                <div class="left"></div>
                            </div>
                            <a class="backButton-anchor">
                                <button  onclick="window.location='payment_method.php'"class="backButton">Back</button>
                            </a>
                        </th>
                    </tr>
                </tbody>
            </table>      
            </div>
            <div class="product-box1">
                <div class="box-product-body">
                <?php
                           
                           $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
                           $address_data =$address_rs->fetch_assoc();
                    
                            $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
                            $city_data = $city_rs->fetch_assoc();
                            $district=Database::search("SELECT * FROM `district` WHERE `id`='".$city_data["district_id"]."'");
                            $district_data=$district->fetch_assoc();
                    
                           $delivery=0;
                           
                    
                            $search=Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
                            $search_data=$search->fetch_assoc();
                            if($district_data["id"]=='1'){
                                $delivery = $delivery+$search_data["delivery_fee_colombo"];
                            }else{
                                $delivery = $delivery+$search_data["delivery_fee_other"];
                             }
                            
                           
                          
                           
                           ?>
                  
                        <div class="box-product-body-inner">
                            <div class="product-details">
                                <form class="data-input-form" method="post" action="checkoutAction.php">
                                                                        <br/>
                                                                        <br/>
                                     <span class="name">Hello !<input class="name-session"  name="username" value="<?php echo $_SESSION['u']['email']?>"/></span> 
                                    <br/>
                                    <br/>
                                    <input type="text"  class="user-input-field"  placeholder="Card Holder's Name" id="user-input-field2"name="holder-name"   onfocus="this.placeholder = 'Enter your Holder Name'"  onfocusout="this.placeholder ='Card Holders Name'" autocomplete="off"   onclick="passwordLoginClick();"  required/> <!-- Password  entering input-->
                                    <br/>    
                                    <input type="text"  class="user-input-field"  placeholder="Card Number" id="user-input-field3" name="card-number"  onfocus="this.placeholder = 'Enter your Card Number'" onfocusout="this.placeholder ='Card Number'"  autocomplete="off"   onclick="firstLoginClick();"  required/> <!-- Password  entering input-->
                                    <br/>
                                    <?php 
                                    $id=$_SESSION["p"]["id"];
                                    $search=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$id."'");
                                    $search_data=$search->fetch_assoc();
                                    
                                    ?>
                                    <input type="text" class="user-input-field"  placeholder="LKR <?php echo $_SESSION["p"]["price"]*$search_data["qty"]+$delivery?>.00" id="user-input-field4"  name="address"/>
                                    <br/>
                                    <div class="btns">
                                    <button  type="submit" class="btn-purchase"onclick="window.location='singleProPayment.php'">Pay&nbsp;LKR&nbsp;<?php echo $_SESSION["p"]["price"]*$search_data["qty"]+$delivery?>.00</button>&nbsp;&nbsp;
                                    <button class="btn-purchase" onclick="window.location='bill.php'">VIEW BILL</button>
                                    </div>
                                </form>

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
        <script type="text/javascript" src="back.js"></script>
        <script type="text/javascript" src="checkout_temp.js"></script>
    </body>
    
    
</html>

<?php
}else{
    include "login.php";

}
