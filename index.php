<?php 
include "header.php";
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<body>
    <div class="container-fluid" id="basicSearchResult">
        


    <div class="row ">
        <div class="col-12 mt-3 mb-5">
        <a href="allProducts.php" class=" a1 text-decoration-none link-dark fs-4">Explore popular brands <span style="color:grey ;">|</span>
        <span class="fs-5" style="color:grey ;">See All&rAarr;</span>
        <a href="#" class="text-decoration-none link-dark fs-6 "></a>       
        </div>
    </div>
   
    
    <div class="row "style="height:20vh">
        <div class="col-2 text-center" style="margin-top: -20px;">
        <a href="samsung.php" class="brand">
            <img src="brands/samsung.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/>
            <span>Samsung</span>
        </a>
        </div>   
        <div class="col-2 text-center" style="margin-top: -20px;">
        <a href="apple.php" class="brand">
        <img src="brands/apple.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/>
        <span >Apple</span>
        </a>
               

                
        </div>
        <div class="col-2 text-center" style="margin-top: -20px;">
        <a href="sony.php"class="brand">
        <img src="brands/sony.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/>
        <span>Sony</span>

        </a>
            
        </div>
        <div class="col-2 text-center" style="margin-top: -20px;">
        <a href="xiaomi.php" class="brand">
        <img src="brands/xiaomi.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/>
        <span>Xiaomi</span>
        </a>
            
        </div>
        <div class="col-2 text-center" style="margin-top: -20px;">
        <a href="nike.php" class="brand">
        <img src="brands/nike.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/>
        <span>Nike</span>
        </a>
            
        </div>
        <div class="col-2 text-center" style="margin-top: -20px;">
            <a href="bornPretty.php" class="brand">
                <img src="brands/bornpretty.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/>
                <span>Born Pretty</span>
            </a>
        </div>

    </div>
    <!-- categories -->
    <div class="row" style="height:20vh">
        <div class="col-12  mb-5" style="margin-top:70px ;">
        <a href="allProducts.php" class=" a1 text-decoration-none link-dark fs-4">Explore popular categories <span style="color:grey ;">|</span>
        <span class="fs-5" style="color:grey ;">See All&rAarr;</span>
        <a href="#" class="text-decoration-none link-dark fs-6 "></a>       
        </div>
    </div>
    <div class="row" style="height:20vh">
        <div class="col-3  text-center " style="margin-top: -20px;">
        <a href="mobiles.php" class="brand">
            <img src="categories/mobiles.webp" class="img d-none d-lg-block" style="margin-left:0px ;"/><br/>
            <span>Mobiles</span>
        </a>
        </div>   
        <div class="col-3  text-center" style="margin-top: -20px;">
        <a href="sneakers.php" class="brand">
        <img src="categories/sneakers.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/><br/>
        <span >Sneakers</span>
        </a>
               

                
        </div>
        <div class="col-3  text-center" style="margin-top: -20px;">
        <a href="wristwatches.php"class="brand">
        <img src="categories/wristwatches.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/><br/>
        <span>wristwatches</span>

        </a>
            
        </div>
        <div class="col-3 text-center" style="margin-top: -20px;">
        <a href="sellProduct.php" class="brand">
        <img src="categories/sell.webp" class="img d-none d-lg-block" style="margin-left:20px ;"/><br/>
        <span>Sell</span>
        </a>
            
        </div>
        

    </div>
    <!-- daily deals -->
    <div class="row">
    <div class="col-12 mb-5" style="margin-top:14vh ;">
        <a href="allProducts.php" class=" a1 text-decoration-none link-dark fs-4">Daily Deals <span style="color:grey ;">|</span>
        <span class="fs-5" style="color:grey ;">See All&rAarr;</span>
        <a href="allProducts.php" class="text-decoration-none link-dark fs-6 "></a>       
        </div>
    </div>
    <div class="row" style="margin-left: 2%;">
    <?php 
    $recent=Database::search("SELECT * FROM `recent`");
    //$recent_num=$recent->num_rows;
    for($x=0;$x<5;$x++){
        $recent_data=$recent->fetch_assoc();
        $images=Database::search("SELECT * FROM `images` WHERE `product_id`='".$recent_data["product_id"]."' ");
        $images_data=$images->fetch_assoc();
        $product=Database::search("SELECT * FROM `product` WHERE `id`='".$recent_data["product_id"]."'");
        $product_data=$product->fetch_assoc();
        ?>
            <!-- card -->
            <div class=" col-3 card mt-2 m-3" style="width: 18rem;">
            <a style="text-decoration: none;" onclick="directToProduct(<?php echo $product_data['id']?>);">
            <img src="<?php echo $images_data["path"]?>" class="card-img-top" alt="...">
            </a>
       
        <div class="card-body">
            <h5 class="card-title"><?php echo $product_data["title"]?></h5>
            <p class="card-text">Price : <?php echo $product_data["price"]?></p>
           
        </div>
        </div>
            <!-- card -->
        
        <?php
    }
    ?>
     </div>   


    </div>
<?php
    include "footer.php"
?>
       
        
       
        


<script src="script.js"></script> 
<script src="bootstrap.bundle.js"></script>  
</body>
</html>