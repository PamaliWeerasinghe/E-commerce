
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gimmick Shopping Cart</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link type="text/css" rel="stylesheet" href="paymentMethod.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
</head>
<body>
   <div class="container-fluid">
    <div class="row">

         <?php include "headerTop.php";
         $status_id=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
         $status_id_data=$status_id->fetch_assoc();?>
       
    <h1 class="cart1">Shopping Cart</h1>
    <div class="row">
        <div class="col-lg-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </nav>
        </div>
        <?php
        if(isset($_SESSION["u"])){

            $email=$_SESSION["u"]["email"];
        
            //$email=$_SESSION["u"]["email"];
            $buyCart=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `status_id`='".$status_id_data["id"]."' ");
            $buyCart_data= $buyCart->fetch_assoc();
            $_SESSION["c"]=$buyCart_data;
            //$proArray = array();
            //$qtyArray=array();
            $total=0;
            $cart1=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `status_id`='".$status_id_data["id"]."'");
            $cart1_num=$cart1->num_rows;
            for($y=0;$y<$cart1_num;$y++ ){
                $cart1_data=$cart1->fetch_assoc();
                $product1=Database::search("SELECT * FROM `product` WHERE `id`='".$cart1_data["product_id"]."'");
                $product1_data=$product1->fetch_assoc();
                $total=$total+$cart1_data["qty"]*$product1_data["price"];
            }?>
            
            
            <?php 
            if($cart1_num>0){
                ?>
                <div class="col-lg-1 offset-lg-4"><label class="form-label fs-5">TOTAL :</label></div>
                <div class="col-lg-2 mb-2"><input type="text" class="form-control " placeholder="Rs. <?php echo $total?>.00" id="qty" disabled/></div>
                <div class="col-lg-2 "><button class="btn btn-secondary d-grid col-12" onclick="cartPay();" >Purchase Cart</button></div>
                <?php
            }else{
                ?>
                <div class="col-lg-1 offset-lg-6"><label class="form-label fs-5">TOTAL :</label></div>
                <div class="col-lg-2 mb-2"><input type="text" class="form-control " placeholder="Rs. <?php echo $total?>.00" id="total" disabled/></div>
                
                <?php

            }
           

        }else{
            ?>

            <div class="col-lg-1 offset-lg-6"><label class="form-label fs-5">TOTAL :</label></div>
            <div class="col-lg-2 mb-2 d-grid"><input type="text" class="form-control " placeholder="Rs. 0.00" disabled/></div>
           
            <?php
        }

        ?>

        
    </div>
   

    <?php
    if(isset($_SESSION["u"])){
        $email=$_SESSION["u"]["email"];
        $products=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `status_id`='".$status_id_data["id"]."'");
        $products_num=$products->num_rows;

        // if(isset($_GET["page"])){
        //     $pageno=$_GET["page"];
        // }else{
        //     $pageno=1;
        // }
        
        // $results_per_page=4;
        // $number_of_pages=ceil($products_num/$results_per_page);

        // $page_results=($pageno-1)*$results_per_page;

        // $selected_rs=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");
        // $selected_num=$selected_rs->num_rows;
        if($products_num>=1){
            for($z=0;$z<$products_num;$z++){
                
                $product_data=$products->fetch_assoc();
                $image=Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["product_id"]."'");
                $image_data=$image->fetch_assoc();
                $desc=Database::search("SELECT * FROM `product` WHERE `id`='".$image_data["product_id"]."'");
                $desc_data=$desc->fetch_assoc();
                $cart=Database::search("SELECT * FROM `cart` WHERE `user_email`='".$email."' AND `product_id`='".$desc_data["id"]."' AND `status_id`='".$status_id_data["id"]."'");
                $cart_data=$cart->fetch_assoc();
                if($desc_data["qty"]>=0){
                    ?>
                    <div class="col-lg-3 mb-4" >
                    
                    <div class="card" style="width: 18rem; height:69vh;" id="cartProduct(<?php echo $desc_data['id']?>)">
                    <div class="row mb-3 mt-1">
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" style="margin-left:85% ;" onclick="removeFromcart(<?php echo $desc_data['id']?>);"></button>
                    </div>
                        
                        <img src="<?php echo $image_data["path"]?>" class="card-img-top image1"style="width:80%"/>
                            <div class="card-body">
                                <p class="card-text text-center fw-bold fs-5"><?php echo $desc_data["title"]?></p>
                                <p class="card-text"><?php echo $desc_data["description"]?></p>

                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <button class="btn fs-2" style="border:none;color:red" id="minus" onclick="minus(<?php echo $image_data['product_id'];?>);">-</button>
                                </div>
                                <div class="col-5 ">
                                    
                                
                                <input type="text" class="form-control text-center" style="margin-top: 2vh;" placeholder="<?php echo $cart_data["qty"];?>" id="displayAmount<?php echo $product_data["product_id"] ?>" disabled/>
                                </div>
                                <div class="col-3">
                                    <button class="btn fs-2" style="border:none; color:green" id="plus" onclick="plus(<?php echo $desc_data['id'];?>);">+</button>
                                </div>
                            </div>
                    </div>
                  
              

                </div>
                    
                    <?php
                }
               
                
               
                ?>
             
            <?php
            }
            

        }else{
            ?>
            <h2 style="margin-top:17vh; margin-left:30%">You don't have any items in your cart. Let's get shopping!</h2>
            <a href="index.php"class="btn btn-primary fs-3 mb-5" style="height:7vh ; border-radius:15px; margin-left:35%; width:30%;">Start Shopping</a>
            <?php

        }
        $products_data=$products->fetch_assoc();


    }else{
       include "midlogin.php";
    }
    ?>
    



    <!-- <div class="row">
        <div class="col-12">
            <div class="col-lg-4 offset-lg-5 mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link fw-bold" href="
                            <?php if($pageno<=1){
                                echo("#");
                            }else{
                                echo"?page=".($pageno-1);
                            }?>
                            " aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for($x=1;$x<=$number_of_pages;$x++){
                            if($x==$pageno){
                                ?>
                                <li class="page-item">
                                    <a class="page-link fw-bold" href="<?php echo "?page=".($x); ?>"><?php echo $x; ?></a>
                                </li>
                                <?php
                            }else{
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=".($x); ?>"><?php echo $x; ?></a>
                                </li>
                                <?php
                            }
                        }

                        ?>
                        <li class="page-item">
                            <a class="page-link" href="
                                <?php if ($pageno >= $number_of_pages) {
                                    echo ("#");
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        } ?>
                                        " aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </div>
    </div>



    </div> -->
    
        
    <?php include "footer.php" ?>
   </div>
       <!-- modal -->
       <?php 
       $total=0;

       $products=Database::search("SELECT * FROM `cart` INNER JOIN `status` ON `status`.`id`=`cart`.`status_id` WHERE `user_email`='".$email."' AND `status`.`name`='Active'");
       $products_num=$products->num_rows;
       for($x=0;$x<$products_num;$x++){
        $products_data=$products->fetch_assoc();
        $search=Database::search("SELECT * FROM `product` WHERE `id`='".$products_data["product_id"]."'");
        $search_data=$search->fetch_assoc();
        
        $total=$total+$search_data["price"]*$products_data["qty"];
       }
       
       ?>
       <div class="modal" tabindex="-1" id="cartPayModal" style="height:90vh;overflow-y:hidden">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header " style="background-color:navy;color:aliceblue;">
                            <h2>GIMMICK | PAY</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        <div class="modal-body">
                        <div class="modal-body product-box1">
                <div class="box-product-body">
                    <div class="box-product-body-inner">
                        <form class="product-details" action="cartCheckout.php">
                            <div class="payment-heading-div-outer">
                                <div class="payment-method-logo">
                                    <div class="payment-method-logo-inner"></div>
                                </div>
                                <div class="payment-method-desc">
                                    <br/>
                                    
                                    
                                    <span class="sell_price">LKR <span style="font-size:45px;" id="price"><?php echo $total ?></span>.00</span>
                                </div>
                            </div>
                            <div class="payment-options-div-outer">
                                <span class="select-pay-sp">Select a payment Method</span>
                                <br/>
                                <br/>
                                <span class="payment-type-one">Credit/Debit Card</span>
                                <div class="payment-methods">
                                    <input class="one" name="one" type="submit" onclick="window.location='cartCheckout.php'" />
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="two"  name="two" type="submit" onclick="window.location='cartCheckout.php'" />
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="three" name="three" type="submit" onclick="window.location='cartCheckout.php'"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="four" name="four" type="submit" value="discover" onclick="window.location='cartCheckout.php'" />
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="five" name="five" type="submit" value="dinnersclub" onclick="window.location='cartCheckout.php'"/>
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                                <br/>
                                <br/>
                                <span class="payment-type-one">Mobile Wallet</span>
                                <div class="payment-methods">
                                    <input class="six" name="six" type="submit" value="paypal"  onclick="window.location='cartCheckout.php'"/>
                                    &nbsp;&nbsp;&nbsp;
                                     <input class="seven" name="seven" type="submit" value="bbb"  onclick="window.location='cartCheckout.php'"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="eight" name="eight" type="submit" value="worldpay"  onclick="window.location='cartCheckout.php'"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="nine" name="nine" type="submit" value="hsbc"  onclick="window.location='cartCheckout.php'"/>
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        </form>
                    </div>
                  
                    
                </div>
            </div>
           
                        </div>
                      
                    </div>
                </div>
            </div>
           
    <!-- modal -->   
  
    <script src="script.js"></script>
   
   
</body>
</html>