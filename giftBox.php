
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift | Gimmick</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="header.css" /> -->
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <?php include "headerTop.php";
    if(isset($_SESSION["u"])){
      
      $email=$_SESSION["u"]["email"];
      $status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
      $status_data=$status->fetch_assoc();
    $gift=Database::search("SELECT * FROM `gift_box` WHERE `user_email`='".$email."' AND `status_id`='".$status_data["id"]."' ");
    $gift_num=$gift->num_rows;
    $total=0;
    if($gift_num==0){
      ?>
         <h2 style="margin-top:23vh; margin-left:30%">Your Gift Box is Empty! Let's get shopping!</h2>
            <a href="index.php"class="btn btn-primary fs-3 mb-5" style="height:7vh ; border-radius:15px; margin-left:35%; width:30%;">Start Shopping</a>
      <?php
    }else{
      for($x=0;$x<$gift_num;$x++){
        $gift_data=$gift->fetch_assoc();

        $price=Database::search("SELECT * FROM `product` WHERE `id`='".$gift_data["product_id"]."'");
        $price_data=$price->fetch_assoc();

        $total=$total+($gift_data["qty"]*$price_data["price"]);

    }
    
    ?>
      <div class="container-fluid">
        <div class="row">
        <h1 class="cart1">Gift Box</h1>
        </div>
        <div class="row">
            <div class="col-lg-2">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="gift.php">Gift</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gift Box</li>
            </ol>
            </nav>
            </div>
            <div class="col-lg-3">
                <div class="row">
                  <div class="col-2"> <label class="form-label">From :</label></div>
                  <div class="col-8"><input type="text" class="form-control"/></div>
                </div>
               
                
            </div>
            <div class="col-lg-3">
                <div class="row">
                  <div class="col-2"> <label class="form-label">To:</label></div>
                  <div class="col-8"><input type="text" class="form-control"/></div>
                </div>
               
                
            </div>
            <div class="col-lg-2 d-grid">
              <input type="text" class="form-control"/>
            </div>
            <div class="col-lg-2 d-grid">
              <button class="btn btn-secondary">Purchase Box</button>
            </div>
            

        
    </div>

   
        </div>
    </div><?php
   
    }
  
    include "footer.php";
      
    }else{
      include "midlogin.php";
    }   
    
  ?>
</body>
</html>