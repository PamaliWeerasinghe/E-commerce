
    <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell | Gimmck</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="header.css" /> -->
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        <?php include "headerTop.php" ?>
        <hr/>
        <div class="row">
               
        <nav aria-label="breadcrumb" style="margin-left: 2%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
  </ol>
</nav>
        
        </div>
        <div class="row">
            <div class="col-lg-8 text-center">
                <h2 class="mt-5 mb-5" style="color:grey ;" >ADD PRODUCT</h2>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-info mt-5 d-grid" onclick="addProduct();">Add Product</button>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <span class="fw-bold fs-5">Select Product Category</span>
                
                    <select class="form-select text-center  mt-2" id="category" onchange="loadBrand();">
                        <option value="0">Select Category</option>
                             <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                <?php
                                    }

                                ?>
                    </select>
                    
                </div>
                <div class="col-lg-4">
                <span class="fw-bold fs-5">Select Product Brand</span>
                <select class="form-select text-center  mt-2" id="brand" onchange="loadModel();" >
                             <option value="0">Select Product Brand</option>
                             <?php
                               $brand_rs = Database::search("SELECT * FROM `brand`");
                               $brand_num = $brand_rs->num_rows;

                               for ($x = 0; $x < $brand_num; $x++) {
                                   $brand_data = $brand_rs->fetch_assoc();

                               ?>

                                   <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>

                               <?php
                               }

                             ?>
                </select>
                </div>
                <div class="col-lg-4">
                    <span class="fw-bold fs-5">Select Product Model</span>
                    <select class="form-select text-center mt-2" id="model">
                        <option value="0">Select product Model</option>
                        <?php
                               $model_rs = Database::search("SELECT * FROM `model`");
                               $model_num = $model_rs->num_rows;

                               for ($x = 0; $x < $model_num; $x++) {
                                   $model_data = $model_rs->fetch_assoc();

                               ?>

                                   <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>

                               <?php
                               }

                             ?>
                    </select>
                </div>
                <div class="col-lg-12 mt-3 mb-3">
                    <span class="fw-bold fs-5">Title of the Product</span>
                    <input type="text" class="form-control mt-2" id="title"/>
                </div>
                <div class="col-lg-4 mt-2 mb-3">
                    <span class="fw-bold fs-5">Select Product Condition</span>
                    <div class="col-12 mt-1">
                    <input type="radio" name="condition" id="b"/>&nbsp;<label for="b">Brand New</label>&nbsp;&nbsp;
                    <input type="radio" name="condition" id="u"/>&nbsp;<label for="u">Used</label>&nbsp;&nbsp;
                    <input type="radio" name="condition" id="r"/>&nbsp;<label for="r">Refurbished</label>

                    </div>
                    
                   
                    
                </div>
                <div class="col-lg-4">
                    <div class="col-12">
                        <label class="form-label fw-bold fs-5" >Select Product Colour</label>
                        <select id="colour" class="form-select" >
                            <option value="0">Select all colours</option>
                            <?php
                            $colours=Database::search("SELECT * FROM `colour`");
                            $colours_num=$colours->num_rows;
                            for($c=0;$c<$colours_num;$c++){
                                $colours_data=$colours->fetch_assoc();
                                ?>
                                <option value="<?php echo $colours_data["id"];?>"><?php echo $colours_data["name"]; ?></option>
                                <?php

                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mt-3 mb-2">
                            <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in"/>
                                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="addcolour();">+ Add</button>
                     </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold fs-5" >Add Product Quantity</label>
                        </div>
                        <div class="col-12">
                            <input type="number" class="form-control" value="0" min="0" id="qty"/>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
        <div class="col-12">
            <div class="row">

                <div class="col-lg-6 col-12 border-none ">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold fs-5" >Cost Per Item</label>
                        </div>
                        <div class="offset-0 col-12 col-lg-8">
                            <div class="input-group mb-2 mt-2">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="cost"/>
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="row">
                        <div class="col-12">
                             <label class="form-label fw-bold fs-5">Approved Payment Methods</label>
                        </div>
                            <div class="col-12">
                                <div class="row">
                                   <div class="col-lg-2 col-3">
                                       <img src="resources/payment_method/mastercard_img.png" style="height: 10vh;"/>
                                   </div>
                                   <div class="col-lg-2 col-3">
                                       <img src="resources/payment_method/american_express_img.png" style="height: 10vh;"/>
                                   </div>
                                   <div class="col-lg-2 col-3">
                                       <img src="resources/payment_method/visa_img.png" style="height: 10vh;"/>
                                   </div>
                                   <div class="col-lg-2 col-3">
                                       <img src="resources/payment_method/paypal_img.png" style="height: 10vh;"/>
                                   </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                <div class="col-lg-6 col-12 border-none ">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold fs-5" >Delivery Cost Within Colombo</label>
                        </div>
                        <div class="offset-0 col-12 col-lg-8">
                            <div class="input-group mb-2 mt-2">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="delcolombo"/>
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 border-none ">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold fs-5" >Delivery Cost Out of Colombo</label>
                        </div>
                        <div class="offset-0 col-12 col-lg-8">
                            <div class="input-group mb-2 mt-2">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="delouter"/>
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
                <div class="row mt-3">
                    <div class="row">
                        <label class="form-label fs-5 fw-bold">Product Description</label>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <textarea cols="30" rows="15" class="form-control" id="desc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                        </div>
                        <div class="offset-lg-3 col-12 col-lg-6">
                            <div class="row">
                                <div class="col-4 border border-primary rounded">
                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0"/>
                                </div>
                                <div class="col-4 border border-primary rounded">
                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1"/>
                                </div>
                                <div class="col-4 border border-primary rounded">
                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2"/>
                                </div>
                            </div>
                        </div>
                        <div class="offset-lg-3 mb-5 col-12 col-lg-6 d-grid mt-3">
                             <input type="file" class="d-none" id="imageuploader" multiple />
                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                        </div>
                    </div>
                </div>
                </div>
                </div>
        </div>
    


        <?php include "footer.php"?>

        </div>

    </div>
<script src="script.js"></script> 
 
<!-- <script src="bootstrap.bundle.js"></script>   -->
<!-- <script src="bootstrap.js"></script> -->
</body>
</html>
    

