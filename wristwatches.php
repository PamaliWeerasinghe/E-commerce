<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wristwatches | Gimmick</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="header.css" /> -->
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <?php  include "header.php"?>
    <div class="container-fluid">
    <div class="row">
     <?php 
       
       if(isset($_GET["page"])){
           $pageno=$_GET["page"];
       }else{
           $pageno=1;
       };
        //$samsung=Database::search("SELECT `brand`.`id` FROM `brand_has_model` INNER JOIN `brand` WHERE `brand`.`name`='Samsung'");
        //$samsung_data=$samsung->fetch_assoc();
        $product=Database::search("SELECT `product`.`id` FROM `product` INNER JOIN `category` ON `category`.`id`=`product`.`category_id` WHERE `category`.`name`='Wristwatches'");
        $product_rows=$product->num_rows;

        $results_per_page=8;
        $number_of_pages=ceil($product_rows/$results_per_page);

        $page_results=($pageno-1)*$results_per_page;

        $selected_rs=Database::search("SELECT `product`.`id` FROM `product` INNER JOIN `category` ON `category`.`id`=`product`.`category_id` WHERE `category`.`name`='Wristwatches' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
        $selected_num=$selected_rs->num_rows;

       
        
        
        ?>
    <?php
        for($x=0; $x<$selected_num;$x++){
            $product_data1=$selected_rs->fetch_assoc();
            $product_data2=Database::search("SELECT * FROM `product` WHERE `id`='".$product_data1["id"]."'");
            $product_data=$product_data2->fetch_assoc();
            $image=Database::search("SELECT * FROM `images` WHERE `product_id`='".$product_data["id"]."'");
            $image_data=$image->fetch_assoc();

            $user=Database::search("SELECT * FROM `user` INNER JOIN `product` ON `user`.`email`=`product`.`user_email` WHERE `product`.`id`='".$product_data["id"]."'");
            $user_data=$user->fetch_assoc();

            $colour=Database::search("SELECT `colour`.`name` FROM `colour` INNER JOIN `product` ON `colour`.`id`=`product`.`colour_id` WHERE `product`.`id`='".$product_data["id"]."'");
            $colour_data=$colour->fetch_assoc();

            $condition=Database::search("SELECT `condition`.`name` FROM `condition` INNER JOIN `product` ON `product`.`condition_id`=`condition`.`id` WHERE `product`.`id`='".$product_data["id"]."'");
            $condition_data=$condition->fetch_assoc();

            if($product_data["qty"]==0){
               ?> 
            <div class="col-lg-3" >
            
          


            <!-- card -->
            <div class="card mt-3 mb-3 " style="width: 18rem; height:70vh;" >
            <div class="row fs-5" style="margin-left:10%;">
            <span class="badge rounded-pill text-bg-danger mt-2" style="width:60% ; height:4vh;" >OUT OF STOCK</span>
            </div>
            
            <a href='<?php echo "productView.php?pid=".($product_data['id'])?>'> <img src="<?php echo $image_data["path"] ?>" class="card-img-top image1" alt="..." style="height:30vh;" /></a>
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $product_data["title"];?></h5>
                    <p class="card-text">
                        <hr/>
                        <span>Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $user_data["fname"]." ".$user_data["lname"];?></span><br/>
                        <span>Colour &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $colour_data["name"];?></span><br/>
                        <span>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Rs.<?php echo $product_data["price"]; ?>.00</span>
                        <hr/>
                    </p>
                    <span>
                  
                    <?php 
                       
                       $check=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$product_data["id"]."'");
                       //$check_data->fetch_assoc();
                       $check_num=$check->num_rows;
                       if($check_num==1){
                        if(isset($_SESSION["u"]["email"])){
                            ?>
                            <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                            <i class="bi bi-heart-fill text-danger fs-5 " id="heart<?php echo $product_data["id"]; ?>"></i></button>
                            
                            <?php

                        }else{
                            ?>
                            <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                            <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $product_data["id"]; ?>"></i></button>
                            <?php

                        }

                        
                       }else{
                        ?>
                        <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                        <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $product_data["id"]; ?>"></i></button>
                        <?php
                       }
                       ?>
                       
                   
                   
                    </div>
            </div>
            <!-- card -->

        </div>
                <?php
            }else{
                ?>
                      <div class="col-lg-3" >
               
               <div class="card mt-3 mb-3 " style="width: 18rem; height:70vh;" >
                   <a href='<?php echo "productView.php?pid=".($product_data['id'])?>'> <img src="<?php echo $image_data["path"] ?>" class="card-img-top image1" alt="..." style="height:30vh;" /></a>
                       <div class="card-body">
                       <h5 class="card-title"><?php echo $product_data["title"];?></h5>
                       <p class="card-text">
                           <hr/>
                           <span>Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $user_data["fname"]." ".$user_data["lname"];?></span><br/>
                           <span>Colour &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $colour_data["name"];?></span><br/>
                           <span>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Rs.<?php echo $product_data["price"]; ?>.00</span>
                           <hr/>
                       </p>
                       <span>
                       <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                           <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                       </button>
                       <?php 
                       $check=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$product_data["id"]."'");
                       //$check_data->fetch_assoc();
                       $check_num=$check->num_rows;
                       if($check_num==1){
                        if(isset($_SESSION["u"]["email"])){
                            ?>
                        <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                        <i class="bi bi-heart-fill text-danger fs-5 " id="heart<?php echo $product_data["id"]; ?>"></i></button>
                        <?php

                        }else{
                            ?>
                            <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                            <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $product_data["id"]; ?>"></i></button>
                            <?php

                        }
?>
                        <?php
                       }else{
                        ?>
                        <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                        <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $product_data["id"]; ?>"></i></button>
                        <?php
                       }
                       ?>
                       
                      
                      
                       </div>
               </div>

           </div>
                
                <?php

            }
            ?>
            


          
      
                <!-- modal --> <!-- onclick="viewProductModal(<?php echo $product_data['id']; ?>)"
                -->
                <!-- <div class="modal" tabindex="-1" id="viewProductModal<?php echo $product_data["id"] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="modal-title fw-bold text-dark"><?php echo $product_data["title"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="offset-4 col-4">
                                    <img src="<?php echo $image_data["path"] ?>" class="img-fluid" style="height: 30vh" />
                                </div>
                                <div class="col-12  mt-2">
                                    <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                    <span class="fs-5"><?php echo $user_data["fname"]." ".$user_data["lname"];?></span><br /><br/>
                                    <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                    <span class="fs-5"><?php echo $product_data["price"];?></span><br /><br/>
                                    <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                    <span class="fs-5"><?php echo $product_data["qty"];?></span><br /><br/>
                                    
                                    <span class="fs-5 fw-bold">Condition :</span>&nbsp;
                                    <span class="fs-5"><?php echo $condition_data["name"]; ?></span><br/><br/>
                                    <span class="fs-5 fw-bold">Colour :</span>&nbsp;
                                    <span class="fs-5"><?php echo $colour_data["name"]; ?></span><br/><br/>
                                    <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                    <span class="fs-5"><?php echo $product_data["description"];?></span><br /><br/>
                                </div>
                            </div>
                            <div class="modal-footer textt-center"  >
                                <button type="button" class="btn btn-danger " data-bs-dismiss="modal" style="width:100% ; ">Buy Now</button>
                                
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- modal -->
            
            
            
            <?php
        }

    ?>
  

    
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-lg-4 offset-lg-5 mt-5 mb-3">
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
    </div>

   
    
    <?php include "footer.php"?>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>
</html>