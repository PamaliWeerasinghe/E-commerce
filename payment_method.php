<?php
//session_start();
//require "connection.php";

//echo("success");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Payment Method</title>
        <link type="text/css" rel="stylesheet" href="paymentMethod.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <link rel="shortcut icon" href="school.png"/>
        <link rel="icon" href="resources/logos/logo.gif"/>
        <?php
        $uid="";
        ?>
    </head>
    <body>
    
        <?php include "headerTop.php"?>
        <br/>
        <?php
        //if(isset($_SESSION["u"])){$uid=$_SESSION["u"]["id"];}
        
            ?>
            <div class="product-box1" style="margin-top: -13vh;">
                <div class="box-product-body">
                    <div class="box-product-body-inner">
                        <form class="product-details" method="get" action="checkout.php">
                            <div class="payment-heading-div-outer">
                                <div class="payment-method-logo">
                                    <div class="payment-method-logo-inner"></div>
                                </div>
                                <div class="payment-method-desc">
                                    <br/>
                                    
                                    <span class="saying"><?php echo $_SESSION["p"]["title"]; ?></span>
                                    <span class="sell_price">LKR <?php echo $_SESSION["p"]["price"]; ?>.00</span>
                                </div>
                            </div>
                            <div class="payment-options-div-outer">
                                <span class="select-pay-sp">Select a payment Method</span>
                                <br/>
                                <br/>
                                <span class="payment-type-one">Credit/Debit Card</span>
                                <div class="payment-methods">
                                    <input class="one" name="one" id="one" type="submit" value="visa"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="two" name="two" type="submit" value="mastercard"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="three" name="three" type="submit" value="americanexpress"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="four" name="four" type="submit" value="discover"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="five" name="five" type="submit" value="dinnersclub"/>
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                                <br/>
                                <br/>
                                <span class="payment-type-one">Mobile Wallet</span>
                                <div class="payment-methods">
                                    <input class="six" name="six" type="submit" value="paypal"/>
                                    &nbsp;&nbsp;&nbsp;
                                     <input class="seven" name="seven" type="submit" value="bbb"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="eight" name="eight" type="submit" value="worldpay"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="nine" name="nine" type="submit" value="hsbc"/>
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        </form>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="row">
                        <?php include "footer.php"?>
                    </div>
                </div>
            </div>
        <script type="text/javascript" src="back.js"></script>
    </body>
</html>

