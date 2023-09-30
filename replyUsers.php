<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages | GIMMICK</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logos/logo.gif" />
</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);" >
    <?php 
     require "connection.php";
     session_start();
     if(isset($_SESSION["au"])){
        ?>
           <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-12 bg-light vh-100">
                <?php 
                $load=Database::search("SELECT  `content`,`date_time`,`status_id`,`from`FROM `chat` 
                WHERE  `to` is NULL OR `to`='pamaliweerasinghe@gmail.com' ORDER BY `date_time` DESC");
                $pro=Database::search("SELECT * FROM `profile_image` WHERE `user_email`='pamaliweerasinghe@gmail.com'");
                $pro_data=$pro->fetch_assoc();
                $user=Database::search("SELECT * FROM `user` WHERE `email`='pamaliweerasinghe@gmail.com'");
                $user_data=$user->fetch_assoc();
                ?>
                <div class="row mt-4">
                    <div class="row border" >
                        <div class="col-lg-3 p-4">
                            <img src="<?php echo $pro_data["path"]?>" style="width:100px;height:100px"/>
                        </div>
                        <div class="col-lg-6 p-4">
                            <label class="form-label fs-4"><?php echo $user_data["fname"]?>&nbsp;<?php echo $user_data["lname"]?></label>
                            <label class="form-label fs-4"><?php echo $user_data["email"]?></label>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-8">
                    <?php 
           
                $email=$_SESSION["au"]["email"];
                $chat=Database::search("SELECT * FROM `chat` WHERE `from`='".$email."' OR `to`='".$email."' ");
                $chat_num=$chat->num_rows;
                for($x=0;$x<$chat_num;$x++){
                    $chat_data=$chat->fetch_assoc();
                    if($chat_data["from"]==$email){
                        ?>
                        <div class="mt-3 mb-3" style="display:flex;">
                    
                        <div class="chatViewLeft text-center" ><?php echo $chat_data["content"]?></div>
                        </div>
                    
                        <?php
                    }else{
                        ?>
                        <div class="mt-3 mb-3" style="display:flex;justify-content:end;" >
                    
                        <div class="chatViewRight" style="display:flex;"><?php echo $chat_data["content"]?></div>
                        </div>
                        <?php
                    }
                
                }
            
            ?>
            <div class="row">
                <div class="col-11">
                    <input type="text" class="form-control" style="margin-top:65vh;height:7vh"/>
                </div>
                <div class="col-1" style="margin-top:67vh;">
                <i class="bi bi-send-fill fs-3"></i>
                </div>
            </div>
    </div>
            </div>
        </div>
        
        <?php 

     }else{
        include "adminSignIn.php";
     }
    ?>
 
      

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>