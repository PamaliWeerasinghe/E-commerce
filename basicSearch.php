<?php

require "connection.php";

$txt =$_POST["t"];
$select =$_POST["s"];

$page=$_POST["page"];
//echo($page);
$query = "SELECT * FROM `product`";

if (!empty($txt) && $select == 0) {
    $query .= " WHERE `title` LIKE '%".$txt."%'";
} else if (empty($txt) && $select != 0) {
    $query .= " WHERE `category_id`='".$select."'";
} else if (!empty($txt) && $select != 0) {
    $query .= " WHERE `title` LIKE '%".$txt."%' AND `category_id`='".$select."'";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php


            if ($page==0) {
                $pageno = 1;
               
            } else {
                $pageno = $page;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

           

            $results_per_page = 8;
            $number_of_pages = ceil($product_num/$results_per_page);

            $page_results = ($pageno-1) * $results_per_page;
            //echo($page_results);
            $selected_rs =Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
            $selected_num = $selected_rs->num_rows;
            
            
            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();
                $image=Database::search("SELECT `path` FROM `images` WHERE `product_id`='".$selected_data["id"]."'");
                $image_data=$image->fetch_assoc();

                $user=Database::search("SELECT * FROM `user` INNER JOIN `product` ON `user`.`email`=`product`.`user_email` WHERE `product`.`id`='".$selected_data["id"]."'");
                $user_data=$user->fetch_assoc();
    
                $colour=Database::search("SELECT `colour`.`name` FROM `colour` INNER JOIN `product` ON `colour`.`id`=`product`.`colour_id` WHERE `product`.`id`='".$selected_data["id"]."'");
                $colour_data=$colour->fetch_assoc();
            ?>
                <div class="col-lg-3 mt-2">
                
                    <?php
                    if($selected_data["qty"]==0){
                        ?> 
                        <div class="card mt-3 mb-3" style="width: 18rem; height:70vh ;" >
                           <div class="row fs-5" style="margin-left:10%;">
                                <span class="badge rounded-pill text-bg-danger mt-2" style="width:60% ; height:4vh;" >OUT OF STOCK</span>
                           </div>
                           <a href='<?php echo "productView.php?pid=".($selected_data['id'])?>'> <img src="<?php echo $image_data["path"] ?>" class="card-img-top image1" alt="..." style="height:30vh;" /></a>
                    <div class="card-body"> 
                        <h5 class="card-title"><?php echo $selected_data["title"]; ?></h5>
                        <p class="card-text">
                        <hr/>
                        <span>Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $user_data["fname"]." ".$user_data["lname"];?></span><br/>
                        <span>Colour &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $colour_data["name"];?></span><br/>
                        <span>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Rs.<?php echo $selected_data["price"]; ?>.00</span>
                        <hr/>
                        </p>
                        <span>
                            <?php 
                             $check=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$selected_data["id"]."'");
                             //$check_data->fetch_assoc();
                             $check_num=$check->num_rows;
                             if($check_num==1){
                                if(isset($_SESSION["u"]["email"])){
                                    ?>
                                    <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $selected_data['id'] ?>);" >
                                    <i class="bi bi-heart-fill text-danger fs-5 " id="heart<?php echo $selected_data["id"]; ?>"></i></button>
                            
                                    <?php
                                }else{
                                    ?>
                                    <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $selected_data['id'] ?>);" >
                                    <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $selected_data["id"]; ?>"></i></button>
                                    
                                    <?php

                                }
                             }else{
                                ?>
                                <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $selected_data['id'] ?>);" >
                        <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $selected_data["id"]; ?>"></i></button>
                                
                                <?php
                             }
                            ?>
                       
                        
                </div>
                </div>
                        <?php
                    }else{
                        ?>
                                              <div class="col-lg-3" >
               
               <div class="card mt-3 mb-3 " style="width: 18rem; height:70vh;" >
                   <a href='<?php echo "productView.php?pid=".($selected_data['id'])?>'> <img src="<?php echo $image_data["path"] ?>" class="card-img-top image1" alt="..." style="height:30vh;" /></a>
                       <div class="card-body">
                       <h5 class="card-title mt-5"><?php echo $selected_data["title"];?></h5>
                       <p class="card-text" >
                           <hr/>
                           <span>Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $user_data["fname"]." ".$user_data["lname"];?></span><br/>
                           <span>Colour &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $colour_data["name"];?></span><br/>
                           <span>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:Rs.<?php echo $selected_data["price"]; ?>.00</span>
                           <hr/>
                       </p>
                       <span>
                       <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $selected_data['id']; ?>);">
                           <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                       </button>
                       <?php 
                       $check=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$selected_data["id"]."'");
                       //$check_data->fetch_assoc();
                       $check_num=$check->num_rows;
                       if($check_num==1){
                        if(isset($_SESSION["u"]["email"])){
                            ?>
                        <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $selected_data['id'] ?>);" >
                        <i class="bi bi-heart-fill text-danger fs-5 " id="heart<?php echo $selected_data["id"]; ?>"></i></button>
                        <?php

                        }else{
                            ?>
                            <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $selected_data['id'] ?>);" >
                            <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $selected_data["id"]; ?>"></i></button>
                            <?php

                        }
?>
                        <?php
                       }else{
                        ?>
                        <button class="col-12 btn btn-light border-dark mt-2 mb-2" onclick="addToWatchlist(<?php echo $product_data['id'] ?>);" >
                        <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $selected_data["id"]; ?>"></i></button>
                        <?php
                       }
                       ?>
                       
                      
                      
                       </div>
               </div>

           </div>
                
                        
                        <?php

                    }
                    ?>
                 
                </span>

                </div>
               

            <?php

            }
            ?>

            

        </div>
    </div>
    <!--  -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link fw-bold" href="<?php if ($pageno <= 1){
                                                        echo ("#");
                                                    }else{
                                                    echo "?page=".($pageno-1);
                                                    }?> 
                                                " aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                    } ?> aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--  -->
</div>