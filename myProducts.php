<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];
    $pageno;

?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Products | Gimmick</title>

        <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href="resources/logos/logo.gif " />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <div class="col-12" style="background-color:navy">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1 text-center">
                                    <?php
                                    $profile_img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;
                                    if ($profile_img_num == 1) {
                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $profile_img_data["path"] ?>" width="90px" height="90px" class="rounded-circle" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/newuser.png" width="90px" height="90px" class="rounded-circle" />
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row text-center text-lg-start">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="text-white fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                    <h1 class="offset-4 offset-lg-2 text-info fw-bold">My Products</h1>
                                </div>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                    <button class="btn btn-light fw-bold" onclick="window.location='sellProduct.php'">Add Product</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Products</li>
                        </ol>
                    </nav>
                    </div>
                </div>
                <!-- header -->

                <!-- body -->
                <div class="col-12">
                    <div class="row">
                        <!-- filter -->
                        <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded" style="height:90vh">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11 mt-5">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s"/>
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="re">
                                                <label class="form-check-label" for="re">
                                                    Refurbished
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-5">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-info fw-bold" onclick="sort1(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearsort();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- filter -->

                        <!-- product -->
                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                            <div class="row" id="sort">

                                <div class="offset-1 col-10 text-center">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs =  Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' 
                                    LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        if($selected_num==0){
                                            ?>
                                            <label class="form-label fs-1 fw-bold" style="margin-top: 20vh;">No related items</label>
                                            
                                            <?php
                                        }else{
                                
                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();
                                            
                                        ?>
                                
                                            <!-- card -->
                                            <div class="card mb-3 mt-3 col-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">
                                                        <?php
                                
                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                        $product_img_data = $product_img_rs->fetch_assoc();
                                
                                                        ?>
                                                        <img src="<?php echo $product_img_data["path"]; ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                                                <label class="form-check-label fw-bold text-info" for="fd<?php echo $selected_data["id"]; ?>">
                                                                    <?php if ($selected_data["status_id"] == 2) { ?> Make Your Product Active <?php
                                                                                                                                        } else {
                                                                                                                                            ?>Make Your Product Deactive<?php
                                                                                                                                        } ?>
                                
                                                                </label>
                                                            </div>
                                                            <div class="row mt-5">
                                                                <div class="col-12">
                                                                    <div class="row g-1">
                                                                        <div class="col-12 col-lg-12 d-grid">
                                                                            <button class="btn btn-dark fw-bold" onclick="sendId(<?php echo $selected_data['id']?>);">Update</button>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="row mt-4">
                                                                <div class="col-12">
                                                                    <div class="row g-1">
                                                                        <div class="col-12 col-lg-12 d-grid">
                                                                            <button class="btn btn-secondary fw-bold" onclick="checkFeedbacks();">Check Feedbacks</button>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                                           
                                <!-- modal -->
                                            <div class="modal" tabindex="-1" >
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php echo $selected_data["title"]; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                                                                                                                        <!-- modal --> 

                                                    </div>
                                                </div>
                             
                                            </div>
                                            <!-- card -->
                                
                                        <?php
                                        }
                                    
                                        ?>
                                
                                    </div>
                                </div>

                                
                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3" style="margin-top: 45vh;">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" <?php if ($pageno <= 1) {
                                                                                    echo ("#");
                                                                                } else {
                                                                                    ?>
                                                                                    onclick="sort1(<?php echo ($pageno - 1)?>);"
                                                                                    <?php
                                                                                } ?>
                                                                                 aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php
                                
                                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                                if ($x == $pageno) {
                                            ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" onclick="sort1(<?php echo ($x)?>);"><?php echo $x; ?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" onclick="sort1(<?php echo ($x)?>);"><?php echo $x; ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }
                                
                                            ?>
                                
                                            <li class="page-item">
                                                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                                                    echo ("#");
                                                                                } else {
                                                                                    ?>
                                                                                    onclick="sort1(<?php echo ($pageno + 1)?>);"
                                                                                    <?php
                                                                                } ?> aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                              
                                <?php }
                                }else{
                                    include "login.php";}?>



<script src="script.js"></script>
<script src="bootstrap.js"></script>
</body>
</html>    