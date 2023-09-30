<!DOCTYPE html>
<?php session_start();
if(isset($_SESSION["au"])){
    ?>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | GIMMICK</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
<div class="container-fluid">
    <div class="row" >
        <div class="col-1 logo1"></div>
        <div class="col-1 mt-3"><span class="fw-bold  fs-4" style="color:navy;">GIMMICK</span></div>
        <div class="col-1 mt-4 offset-6"><i class="bi bi-question-circle-fill" ></i></div>
        <div class="col-1 mt-4"><i class="bi bi-bell-fill"></i></div>
        <div class="col-1 mt-4 "><span style="text-align: right;" class="fw-bold"><?php echo $_SESSION["au"]["email"]?></span></div>
       
    </div>
    
        <div class="row mt-4">
          <div class="col-1 mt-3"> <i class="bi bi-house-door-fill mt-3"><a href="adminPanel.php" class="s1"> Home</a></i></div>  
          <div class="col-4 offset-3" > 
            <nav class="navbar bg-light">
           
            </nav>
          </div>
          <div class="col-3 mt-2 offset-1">
            <button class="btn btn-warning" onclick="window.location='sellProduct.php'">Add Product</button>
          </div>
          <?php 
          require "connection.php";
          $products=Database::search("SELECT * FROM `product`");
          $products_num=$products->num_rows;
          
          ?>
    
    
        </div>
        <div class="row mt-5 offset-0">
            <table class="border">
                <tr class="fw-bold fs-4 text-center">
                    <td class="border">product Id</td>
                    <td class="border">Product Name</td>
                    <td class="border">Seller Email</td>
                   
                    <td class="border"> Status</td>




                </tr>
                <?php 
                for($x=0;$x<$products_num;$x++){
                    $products_data=$products->fetch_assoc();
                    $user=Database::search("SELECT * FROM `user` WHERE `email`='".$products_data["user_email"]."'");
                    $user_data=$user->fetch_assoc();
                    ?>
                <tr class="text-center "  id="ru">
                    <td class="border"><?php echo $products_data["id"] ?></td>
                    <td class="border"><?php echo $products_data["title"] ?></td>
                    <td class="border"><?php echo $user_data["email"] ?></td>
                    <?php 
                    if($products_data["status_id"]==1){
                        $productStatus='Active';
                    }else{
                        $productStatus='Deactive';
                    }
                    ?>
                    <td class="border "><button class="btn btn-success mt-2 mb-1" style="width:80% ;" id="cpstatus" onclick="changeProductStatus(<?php echo $products_data['id']; ?>);"><?php echo $productStatus?></button></td>

                </tr>
                    <?php
                }
                
                ?>
               
        
                

            </table>
        </div>
    

    
</div>





<script src="bootstrap.bundle.js"></script>
<script src="bootstrap.js"></script>
<script src="script.js"></script> 
</body>
</html>
    
    
    <?php

}else{
    include "adminSignin.php";
}

?>
