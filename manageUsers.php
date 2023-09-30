<!DOCTYPE html>
<?php session_start();
if(isset($_SESSION["au"])){
  ?>
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
          <div class="col-3 mt-2 offset-lg-1">
            <button class="btn btn-secondary" onclick="window.location='login.php'">Add User</button>
          </div>
       
    
    
        </div>
        <div class="row mt-5 offset-0">
            <table class="border">
                <tr class="fw-bold fs-4 text-center">
                    <td class="border">Email</td>
                    <td class="border">First Name</td>
                    <td class="border">Last Name</td>
                   
                    <td class="border"> Status</td>

                
                </tr>
                <?php 
                require "connection.php";
                $user=Database::search("SELECT * FROM `user`");
                $user_num=$user->num_rows;
                for($x=0;$x<$user_num;$x++){
                    $user_data=$user->fetch_assoc();
                    ?>
                      <tr class="text-center "  id="ru">
                    <td class="border"><?php echo $user_data["email"]?></td>
                    <td class="border"><?php echo $user_data["fname"]?></td>
                    <td class="border"><?php echo $user_data["lname"]?></td>
                    <td class="border "><button class="btn btn-primary mt-2" style="width:30% ;" value="<?php echo $user_data['email']?>" id="userstatus" onclick="changeUserStatus();">Active</button>&nbsp;&nbsp;</td>

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
