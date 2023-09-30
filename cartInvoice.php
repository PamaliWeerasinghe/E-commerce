<?php 
session_start();
if(isset($_SESSION["u"])){
    $email=$_SESSION["u"]["email"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gimmick | Invoice</title>
   
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logos//logo.gif" />
</head>

<body class="mt-2" style="background-color: #f7f7ff;">
<div class=" container-fluid d-flex justify-content-center" style="background-image: url(resources/logos/blob.png);background-repeat: no-repeat;background-size:100%; background-position:500px 220px; background-color: rgb(242, 247, 252); padding-top:45px; padding-bottom:65px;padding-left:155px;padding-right:155px;" >
    <div class="container-fluid">
        <div class="row">
        <i class="bi bi-arrow-left fs-3" onclick="removeFromCart();"></i>
            <?php 

            require "connection.php";
            $search=Database::search("SELECT * FROM `invoice` WHERE `email`='".$_SESSION["u"]["email"]."'");
            $search_num=$search->num_rows;

            if($search_num==0){
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");
                
                Database::iud("INSERT INTO `invoice`(`email`,`dateTime`) VALUES('".$_SESSION["u"]["email"]."','".$date."')");

            }
            
          
          
            ?>

                

                <div class="col-lg-6 col-12 offset-lg-3">
                <div class="alert alert-info text-center fs-5" role="alert">
                        Your payment was successfull!
                </div>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">
                        <?php
                        $cart1=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."'");
                        $cart1_num=$cart1->num_rows;
                        $total=0;
                    for($y=0;$y<$cart1_num;$y++ ){
                $cart1_data=$cart1->fetch_assoc();
                $product1=Database::search("SELECT * FROM `product` WHERE `id`='".$cart1_data["product_id"]."'");
                $product1_data=$product1->fetch_assoc();
                $total=$total+$cart1_data["qty"]*$product1_data["price"];
            }?>

                        <div class="col-6">
                            <div class="ms-5 invoiceHeaderImage"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-primary text-decoration-underline text-end">
                                    <h2>GIMMICK</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Borella,Colombo 7,Sri Lanka.</span><br />
                                    <span>+94 112 005741</span><br />
                                    <span>+94 112 005762</span><br />
                                    <span>gimmick@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">

                            <?php
                         
                            
                            ?>

                                <div class="col-lg-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <h2><?php echo $_SESSION["u"]["fname"];?> <?php echo $_SESSION["u"]["lname"];?></h2>
                                   
                                    <span><?php echo $_SESSION["u"]["email"];?></span>
                                </div>

                                <?php
                                
                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `email`='".$_SESSION["u"]["email"]."'");
                                $invoice_data = $invoice_rs->fetch_assoc();
                                
                                ?>

                                <div class="col-lg-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE (<?php echo $invoice_data["id"]?>)</h1>
                                    <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["dateTime"]?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
                                    $address_data =$address_rs->fetch_assoc();
                                    $cart1=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."'");
                                    $delivery = 0;
                                    for($y=0;$y<$cart1_num;$y++){
                                        $cart1_data=$cart1->fetch_assoc();
                                        $product1=Database::search("SELECT * FROM `product` WHERE `id`='".$cart1_data["product_id"]."'");
                                        $product1_data=$product1->fetch_assoc();


                                        

                                         $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
                                         $city_data = $city_rs->fetch_assoc();
                                         $district=Database::search("SELECT * FROM `district` WHERE `id`='".$city_data["district_id"]."'");
                                         $district_data=$district->fetch_assoc();
                                       
                                      
                                         if($district_data["id"]=='1'){
                                            $delivery = $delivery+$product1_data["delivery_fee_colombo"];
                                         }else{
                                            $delivery = $delivery+$product1_data["delivery_fee_other"];
                                         }




                                        ?>
                                        <tr style="height: 72px;">
                                        <td class="bg-primary text-white fs-3"><?php echo $y+1?></td>
                                        <td>
                                            
                                            <?php
                                            //$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$invoice_data["product_id"]."'");
                                            //$product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold text-primary fs-5 p-2"><?php echo $product1_data["title"]?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs.<?php echo $product1_data["price"]?>  .00</td>
                                        <td class="fw-bold fs-6 text-end pt-3"><?php echo $cart1_data["qty"]?></td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs.<?php echo $product1_data["price"]*$cart1_data["qty"]?> .00</td>
                                    </tr>
                                        
                                        <?php
                                    }
                                    
                                    ?>
                                    
                                </tbody>
                                <tfoot>
                                    <?php
                                    
                                  
                                    ?>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs.<?php echo $total?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                      
                                        <td class="text-end border-primary">Rs. <?php echo $delivery ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">GRAND TOTAL</td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">Rs.<?php echo $total+$delivery?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-info">Thank You !</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-primary rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                    <br />
                                    <label class="form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>

            <?php
           // }

            ?>

            
        </div>
    </div>

   

</div> 
                                </div> 
                                
<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>

</body>
<?php include "footer.php"?>
</html>
<?php
}else{
        include "login.php";
}


?>