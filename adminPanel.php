<!DOCTYPE html>
<?php require "connection.php";
session_start();
if(isset($_SESSION["au"])){
    
    
    $admin=$_SESSION["au"];
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Gimmick</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body class="mt-2" style="background-color: #f7f7ff;">
 
    <div class="container-fluid" style="background-image: url(resources/logos/blob.png);background-repeat: no-repeat;background-size:100%; background-position:500px 220px; background-color: rgb(242, 247, 252); padding-top:45px; padding-bottom:30px;padding-left:155px;padding-right:155px;">
        <div class="row" style="background-color: white;">
        <i class="bi bi-arrow-left-circle-fill fs-1" onclick="signoutAdmin();"></i>
        </div>
        <div class="row mt-3" style="display:flex;justify-content:center;align-items:center">
            <img src="resources/logos/logo.gif" style="width:150px;height:150px;border-radius:100%"/>
           
        </div>
        <div class="row">
                <div class="col-lg-3 offset-lg-4">
                <img src="resources/2739309.png" style="width:80px;height:80px"/>
                </div>
                <div class="col-lg-3 mt-3" style="margin-left:-15%; text-align:center">
                <h4 class="mt-3"><?php echo $admin["fname"]?>&nbsp;<?php echo $admin["lname"]?></h4>
                </div>
                
        </div>
        <div class="row" style="text-align:center">
        <h1 style="color:navy" class="fw-bold">Overall Report for GIMMICK</h1>
        </div>

        <div class="row mt-5">
           
                
                    <div class="col-lg-4" >
                        <div class="alert alert-secondary" role="alert" style="text-align: center;">
                        <?php 
                        $user=Database::search("SELECT MAX(`user_email`) FROM `invoice`");
                        $user_data=$user->fetch_assoc();

                        $name=Database::search("SELECT * FROM `user` WHERE `email`='".$user_data["MAX(`user_email`)"]."'");
                        $name_data=$name->fetch_assoc();

                        $img=Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$user_data["MAX(`user_email`)"]."'");
                        $img_data=$img->fetch_assoc();
                        ?>
                            <h3 class="fw-bold">The Most Regular Customer</h2></br>
                            <img src="<?php echo $img_data["path"] ?>" style="width:90px;height:90px"/></br>
                            <label class="form-label fs-3"><?php echo $name_data["fname"]?>&nbsp;<?php echo $name_data["lname"]?></label></br>
                            <label class="form-label fs-5">Email : <?php echo $name_data["email"]?></label>
                            <label class="form-label fs-5">Contact No : <?php echo $name_data["mobile"]?></label>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="alert alert-primary" role="alert" style="text-align: center;">
                        <?php 
                         $user=Database::search("SELECT MAX(`seller_email`),`product_id` FROM `invoice_items`");
                         $user_data=$user->fetch_assoc();

                         $name=Database::search("SELECT * FROM `user` WHERE `email`='".$user_data["MAX(`seller_email`)"]."'");
                         $name_data=$name->fetch_assoc();

                         $product=Database::search("SELECT * FROM `product` WHERE `id`='".$user_data["product_id"]."'");
                        $product_data=$product->fetch_assoc();
 
                         $img=Database::search("SELECT * FROM `images` WHERE `product_id`='".$user_data["product_id"]."'");
                         $img_data=$img->fetch_assoc();
                        ?>
                            
                        <h3 class="fw-bold">The Most Purchase Product</h2></br>
                            <img src="<?php echo $img_data["path"] ?>" style="width:90px;height:90px"/></br>
                            <label class="form-label fs-3"><?php echo $product_data["title"]?></label></br>
                            <label class="form-label fs-5">Email : <?php echo $name_data["email"]?></label>
                            <label class="form-label fs-5">Contact No : <?php echo $name_data["mobile"]?></label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="alert alert-info" role="alert" style="text-align:center">
                        <h3 class="fw-bold">The Total Purchases</h2></br>
                            <img src="resources/7249779.png" style="width:153px;height:153px"/></br>
                            <?php 
                            $count=Database::search("SELECT * FROM `invoice_items`");
                            $count_num=$count->num_rows;
                            ?>
                            <label class="form-label fs-3">Total : <?php echo $count_num ?></label></br>
                            
                        </div>
                    </div>
               
            
        </div>
        <div class="row mt-3">
           
                
           <div class="col-lg-4">
            <a href="replyUsers.php" style="text-decoration: none;">
            <div class="alert alert-secondary" role="alert" style="height:30vh; text-align:center" >
               <h3 class="fw-bold">Messages</h3></br>
                            <img src="resources/7787555_dialog_chat_message_mail_email_icon.png" style="width:153px;height:153px"/></br>
                           
            </div>
            </a>
              
           </div>
           <div class="col-lg-4">
           <a href="manageUsers.php" style="text-decoration: none;">
               <div class="alert alert-primary" role="alert" style="height:30vh;text-align:center">
               <h3 class="fw-bold">Manage Users</h3></br>
               <img src="resources/Vigor_User-Avatar-Profile-Photo-01-512.webp" style="width:153px;height:153px"/></br>
               </div>
           </a>
           </div>
           <div class="col-lg-4">
           <a href="manageProducts.php" style="text-decoration: none;">
               <div class="alert alert-info" role="alert" style="height:30vh;text-align:center">
               <h3 class="fw-bold">Manage Products</h3>
               <img src="resources/6447348.png" style="width:153px;height:153px"/></br>
               </div>
           </a>
           </div>
      
   
</div>

    </div>
        
    


<script src="bootstrap.bundle.js"></script>

<script src="script.js"></script> 
</body>
</html>
    
    
    
    <?php

}else{
    include "adminSignin.php";
}
