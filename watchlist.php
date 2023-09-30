<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist | Gimmick</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <?php include "headerTop.php" ?>

    <div class="container-fluid">
    <div class="row mt-3">
        
        <nav aria-label="breadcrumb" style="margin-left: 2%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Watchlist</li>
  </ol>
</nav>
        

    </div>
        
        <div class="row ">
        <?php 
        if(isset($_SESSION["u"])){
            $email=$_SESSION["u"]["email"];
            $watchlist=Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$email."'");
            $watchlist_num=$watchlist->num_rows;
            if($watchlist_num==0){
                ?>
                <h2 style="margin-top:17vh; margin-left:30%">You don't have any items in your Watchlist. Let's get shopping!</h2>
                <a href="index.php"class="btn btn-primary fs-3 mb-5 mt-3" style="height:7vh ; border-radius:15px; margin-left:35%; width:30%;">Start Shopping</a>
                <?php

            }else{
                for($x=0;$x<$watchlist_num;$x++){
                    $watchlist_data=$watchlist->fetch_assoc();
                
                    $images=Database::search("SELECT * FROM `images` WHERE `product_id`='".$watchlist_data["product_id"]."'");
                    $images_data=$images->fetch_assoc();
        
                    $product=Database::search("SELECT * FROM `product` WHERE `id`='".$watchlist_data["product_id"]."'");
                    $product_data=$product->fetch_assoc();
                    ?>
                    <div class="col-lg-3 mb-4 mt-3" >
                    
                            
                    <div class="card" style="width: 18rem; height:70vh;">
                    <div class="row mb-3 mt-1">
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close" style="margin-left:85% ;" onclick="removeFromWatchlist(<?php echo $watchlist_data['product_id']?>);"></button>
                    </div>
                        
                        <img src="<?php echo $images_data["path"]?>" class="card-img-top image1"  >
                            <div class="card-body">
                                <p class="card-text text-center fw-bold fs-5"><?php echo $product_data["title"]?></p>
                                <p class="card-text"><?php echo $product_data["description"]?></p>
                                <!-- <p class="crad-text text-center fs-4" style="color:red;">Rs.<?php echo $product_data["price"]?>.00</p> -->
                                <div class="row mt-3">
                                <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                                   <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                </button>
                                </div>
                              
                                <div class="row">
                                    <button class="btn btn-primary mt-2" onclick="window.location='productView.php?pid=<?php echo $product_data['id'] ?>'">Buy this</button>
                                </div>
        
                            </div>
                           
                    </div>
               
              
        
                </div>
                    
                    
                    <?php
                }
               

                
            }
           
          
       

        }else{
            include "midlogin.php";
    
        }

        ?>

        </div>
    </div>
    
    
</body>
</html>