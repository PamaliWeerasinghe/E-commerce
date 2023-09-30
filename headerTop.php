<?php 
require "connection.php";
session_start();

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Gimmick</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>
</head>
<body>

<div class="container-fluid" style="background-color:white;">
    <div class="row mt-2"  >
    <div class="col-lg-1 col-12 text-center  ">
       
    <button class="btn border btn-dark mt-2" onclick="message();"><i class="bi bi-chat-text-fill"></i></button>
               
    </div>
    
    <div class="col-lg-2 col-12 mt-3 text-center" id="d1">
        <span>Hi!<span > 
            <?php
            
            
            if(isset($_SESSION["u"])){
                ?>
                <span><?php echo $_SESSION["u"]["fname"]?> &nbsp;</span>|
                <a href="" class="text-decoration-none " onclick="signout();">Sign out</a>
                <?php
            }else{
                ?>
                <a href="login.php" class="text-decoration-none">Login or Register</a>
                <?php

            }
            ?>

    </div>
    
    
   
  
    <div class="col-lg-4 mt-2 offset-lg-5 text-center">
        <a href="sellProduct.php" class=""style="color:black ;">Sell</a>

        <div class="btn-group ">
        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" onclick="window.location='watchlist.php'">
        Watchlist
        </button>
        <!-- watch list for signed in (display the total items watching) -->
        <?php
        // session_start();
        if(isset($_SESSION["u"])){
            ?>
             <ul class="dropdown-menu dropdown-menu-lg-end">
            <li>
                <button class="dropdown-item w-100"  style="height:20vh ; width:30%;"type="button" id="btn1">
                <div class="spinner-border text-primary  " role="status" style="margin-left:50px ; ">
                       
                       </div>
                   
                    <span class="" >Loading...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </button>
            </li>
            
        </ul>
            <?php

        }else{
            ?>
        <!-- watchlist for display for signed out users -->
             <ul class="dropdown-menu dropdown-menu-lg-end">
            <li>
                
                    <button class="dropdown-item w-100" style="height:40vh ;">
                    <div class="spinner-border text-primary d-none " role="status">
                       
                       </div>
                   
                    <span class="ml-5 mb-3 fw-bolb fs-5 ">Please <a href="login.php" class="fs-4"> Sign In </a>to see the items you are watching </span>
                    </button>
            </li>
            
        </ul>
            
            <?php
        }
        ?>
       
        </div>
        <div class="btn-group ">
        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
        My Gimmick
        </button>
        <ul class="dropdown-menu dropdown-menu-lg-end">
            
            
            <li><button class="dropdown-item" type="button" onclick="window.location='purchaseHistory.php'">Purchase History</button></li>
            <li><button class="dropdown-item" type="button" onclick="window.location='myProfile.php'">My Profile</button></li>
            <li><button class="dropdown-item" type="button" onclick="window.location='myProducts.php'">My Products</button></li>
        </ul>
        </div>
        
        <?php
       
        if(isset($_SESSION["u"])){
            $email=$_SESSION["u"]["email"];
            $status=Database::search("SELECT * FROM `status` WHERE `name`='Active'");
            $status_data=$status->fetch_assoc();
            $cart = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "' AND `status_id`='".$status_data["id"]."'");
            $cart_num=$cart->num_rows;
            
            
            
            
            $count=0;
            
            for($x=0;$x<$cart_num;$x++){
                $cart_data=$cart->fetch_assoc();
                $qty=Database::search("SELECT * FROM `product` WHERE `id`='".$cart_data["product_id"]."'");
               
                $qty_data=$qty->fetch_assoc();
                if($qty_data["qty"]>=0){
                    //$cart_weight=$cart->fetch_assoc();
                    if($cart_data["qty"]==0){
                        $count=$count+0;
                    }else{
                        $count=$count+intval($cart_data["qty"]);
                    }
                   

                }
               
              
    
            }
            ?>
            <a href="cart.php"type="button" class="btn btn-dark position-relative">
            <i class="bi bi-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $count; ?>
                    <span class="visually-hidden">items in cart</span>
                </span>
            </a>
            <?php
            
        }else{
            ?>
              <a href="cart.php"type="button" class="btn btn-dark position-relative">
            <i class="bi bi-cart"></i>
                
            </a>
            <?php
        }
    
            ?>
           
        
       
       
        



    </div>

  

  
</div>
<hr/>
<div class="row">
        <div class="col-lg-1 text-center">
            <img src="resources/logos/logo.gif" class="i1" />

        </div>
        <div class="col-lg-1 mt-1">
        <a href="advancedSearch.php" class="advance ">Advanced</a>
        </div>
        <div class="col-lg-7">
            <div class="input-group mb-3">
                <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Search for anything" id="basic_search_txt">
          
               
        
            </div>
        </div>
        <div class="col-12 col-lg-1">
        <button class="btn btn-primary " onclick=" basicSearch(0);">Search</button>
        </div>
        <div class="col-lg-2">
            <select class="form-select" style="text-align: center; border:none" id="basic_search_select">
                <option value="0">All Categories</option>
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



    </div>
        </div>
<!-- modal -->
<div class="modal" tabindex="-1" id="seefb">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:navy">Message | GIMMICK</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
        if(isset($_SESSION["u"])){
            $email=$_SESSION["u"]["email"];
            $chat=Database::search("SELECT * FROM `chat` WHERE `from`='".$email."' OR `to`='".$email."'");
            $chat_num=$chat->num_rows;
            for($x=0;$x<$chat_num;$x++){
                $chat_data=$chat->fetch_assoc();
                if($chat_data["from"]==$email){
                    ?>
                    <div class="mt-3 mb-3" style="display:flex;justify-content:end;">
                   
                    <div class="chatViewRight text-center" ><?php echo $chat_data["content"]?></div>
                    </div>
                   
                    <?php
                }else{
                    ?>
                    <div class="mt-3 mb-3" style="display:flex;" >
                   
                    <div class="chatViewLeft" style="display:flex;"><?php echo $chat_data["content"]?></div>
                    </div>
                    <?php
                }
              
            }
            ?>
        <p></p>
      </div>
      <div class="modal-footer">
       <input class="form-control" type="text" style="width:95%;margin-left:-10%;" id="msgToAdmin"/><i class="bi bi-send-fill" onclick="sendMsg();"></i>
      </div>
            
            <?php
        }else{
            ?>
                    <h3>Please <a class="fs-3" href="login.php">Login</a> to contact an Admin</h3>
      </div>
     
            
            
            
            <?php

        }
        
        ?>

    </div>
  </div>
</div>
     <!-- modal -->
     
<script src="script.js"></script> 
<script src="bootstrap.bundle.js"></script>
</body>
</html>