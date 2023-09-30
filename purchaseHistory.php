
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gimmick | Purchase History</title>
   
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logos//logo.gif" />
</head>

<body style="background-color:#f7f7ff;">

<?php include "headerTop.php";
             $email=$_SESSION["u"]["email"];
             
             
?>

<div class="container-fluid">
  
<?php 
if(isset($_SESSION["u"]["email"])){
    $invoice=Database::search("SELECT * FROM `invoice` WHERE `user_email`='".$email."' ORDER BY `date` ");
    $invoice_num=$invoice->num_rows;
    if($invoice_num==0){
        ?>
             <h2 style="margin-top:17vh; margin-left:30%">You haven't purchased any items. Let's get shopping!</h2>
                <a href="index.php"class="btn btn-primary fs-3 mb-5" style="height:7vh ; border-radius:15px; margin-left:35%; width:30%;">Start Shopping</a>
        <?php
        
            
    }else{
        for($x=0;$x<$invoice_num;$x++){
            $invoice_data=$invoice->fetch_assoc();
            ?>
            <div class="row text-center">
                <div class="col-lg-12 col-12 ">
                    <div class="alert alert-info" role="alert">
    INVOICE ID : <?php echo $invoice_data["order_id"];?> ON THE <?php echo $invoice_data["date"]?>
                    </div>
                </div>
            </div>
            <?php
            $item=Database::search("SELECT * FROM `invoice_items` WHERE `invoice_order_id`='".$invoice_data["order_id"]."'");
            for($y=0;$y<$item->num_rows;$y++){
                $item_data=$item->fetch_assoc();
                ?>
                  <div class="card mb-3 mt-3 col-12 col-lg-12">
                    <div class="row">
                        
                        <div class="col-md-4 mt-4">
                            <?php
                                    
                                $product_img_rs=Database::search("SELECT * FROM `images` WHERE `product_id`='" . $item_data["product_id"] . "'");
                                $product_img_data=$product_img_rs->fetch_assoc();
                                $selected=Database::search("SELECT * FROM `product` WHERE `id`='".$item_data["product_id"]."'");
                                $selected_data=$selected->fetch_assoc();
                                $seller=Database::search("SELECT * FROM `user` WHERE `email`='".$selected_data["user_email"]."'");
                                $seller_data=$seller->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $product_img_data["path"]; ?>" class="img-fluid rounded-start" />
                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                                <span class="card-text fw-bold text-primary">Price : Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                                <span class="card-text fw-bold text-secondary">Seller : <?php echo $seller_data["fname"]?>&nbsp;<?php echo $seller_data["lname"]?></span>
                                                                <div>
                                                                   <textarea style="width:100%;height:13vh" placeholder="Send Feedback" id="feedback"></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row g-1">
                                                                            <div class="col-12 col-lg-12 d-grid">
                                                                                <button class="btn btn-dark fw-bold" onclick="updateFeedback(<?php echo $item_data['product_id']?>);">Update Feedback</button>
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
            
        }
        
    }
    ?>
    
       
    
    </div> 
                                
                                    
    <?php include "footer.php"?>
    
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    </body>
    </html>
    <?php
    
    
    
    
}else{
    include "midlogin.php";
}
?>