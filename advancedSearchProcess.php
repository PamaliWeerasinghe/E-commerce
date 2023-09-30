<?php

require "connection.php";
session_start();
if(isset($_SESSION["u"])){
    $search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["to"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if($sort == 0){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%'";
        $status = 1;
    }

    if($category != 0 && $status == 0){
        $query .= " WHERE `category_id`='".$category."'";
        $status = 1;
    }else if($category != 0 && $status != 0){
        $query .= " AND `category_id`='".$category."'";
    }

    $pid = 0;
    if($brand != 0 && $model == 0){
        $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='".$brand."'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for($x = 0;$x < $model_has_brand_num;$x++){
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `brand_has_model_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `brand_has_model_id`='".$pid."'";
        }
    }

    if($brand == 0 && $model != 0){
        $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id`='".$model."'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for($x = 0;$x < $model_has_brand_num;$x++){
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `brand_has_model_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `brand_has_model_id`='".$pid."'";
        }
    }

    if($brand != 0 && $model != 0){
        $model_has_brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='".$brand."' 
        AND `model_id`='".$model."'");
        $model_has_brand_num = $model_has_brand_rs->num_rows;
        for($x = 0;$x < $model_has_brand_num;$x++){
            $model_has_brand_data = $model_has_brand_rs->fetch_assoc();
            $pid = $model_has_brand_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `brand_has_model_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `brand_has_model_id`='".$pid."'";
        }
    }

    if($condition != 0 && $status == 0){
        $query .= "WHERE `condition_id`='".$condition."'";
        $status = 1;
    }else if($condition != 0 && $status != 0){
        $query .= "AND `condition_id`='".$condition."'";
    }

    if($color != 0 && $status == 0){
        $query .= "WHERE `colour_id`='".$color."'";
        $status = 1;
    }else if($color != 0 && $status != 0){
        $query .= "AND `colour_id`='".$color."'";
    }

    if(!empty($price_from) && empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` >= '".$price_from."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` >= '".$price_from."'";
        }
    }else if(empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` <= '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` <= '".$price_to."'";
        }
    }else if(!empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` BETWEEN '".$price_from."' AND '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` BETWEEN '".$price_from."' AND '".$price_to."'";
        }
    }
    
}else if($sort == 1){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` ASC";
        $status = 1;
    }
}else if($sort == 2){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` DESC";
        $status = 1;
    }
}else if($sort == 3){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` ASC";
        $status = 1;
    }
}else if($sort == 4){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` DESC";
        $status = 1;
    }
}

if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;



while ($results_data = $results_rs->fetch_assoc()) {
?>




    <div class="card mb-3 mt-3 col-12 col-lg-6">
        <div class="row" >

            <div class="col-md-4 mt-4">
                <?php
                $image=Database::search("SELECT * FROM `images` WHERE `product_id`='".$results_data["id"]."' ");
                $image_data=$image->fetch_assoc();

                $user=Database::search("SELECT * FROM `user` WHERE `email`='".$results_data["user_email"]."'");
                $user_data=$user->fetch_assoc();
                ?>

                <img src="<?php echo $image_data["path"];?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title fw-bold"><?php echo $results_data["title"]; ?></h5>
                    <label class="form-label"><?php echo $user_data["fname"]?> <?php echo $user_data["lname"]?></label><br/>
                    <span class="card-text text-dark fw-bold">Rs. <?php echo $results_data["price"]; ?></span>
                    <br />
                    <span class="card-text text-danger fw-bold fs"><?php echo $results_data["qty"];?> Items Left</span>

                    <div class="row">
                        <div class="col-12">

                            <div class="row g-1">
                                
                                     <div class="col-12 col-lg-6 d-grid">
                                    <a href='<?php echo "productView.php?pid=".($results_data['id'])?>' class="btn btn-secondary fs">View Product</a>
                                     </div>
                                    
                               
                               
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-dark fs"> <i class="bi bi-cart-plus-fill text-white fs-5"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php
}

?>



<div class="offset-lg-4 col-12 col-lg-4 mb-3 text-center">
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
<?php
}else{
 include "midlogin.php";
}
?>