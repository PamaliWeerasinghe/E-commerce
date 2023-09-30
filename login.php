
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gimmick</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logos/logo.gif"/>

</head>

<body>

    <div class=" container-fluid d-flex vh-100  justify-content-center" style="background-image: url(resources/logos/blob.png);background-repeat: no-repeat;background-size:100%; background-position:500px 220px; background-color: rgb(242, 247, 252); padding-top:45px; padding-bottom:65px;padding-left:155px;padding-right:155px;" >
        <div class="row align-content-center " style="background-color: white; border-radius:35px; font-size: 20%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

           
            <!-- content -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-6 d-none d-lg-block">
                        <img src="resources/logos/logo.gif" />
                    </div>

                    
                    <div class="col-12 col-lg-6" id="signUpBox">
                        <div class="row g-2">
                        <div class="alert alert-info d-none" role="alert" id="alertdiv">
                        A simple info alert—check it out!
                        </div>


                            <div class="col-12 col-lg-12 d-grid mt-2 " >
                            <ul class="nav nav-tabs ">
                                <li class="nav-item">
                                    <a class="nav-link active fw-bold fs-4 " aria-current="page" href="#">
                                    Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold fs-4" href="#" onclick="changePage();">Sign In</a>
                                </li>
                                
                                </ul>    
                            
                            </div>
                            
                            
                            <div class="col-6 mt-4">
                                <label class="form-label "  >First Name</label>
                                <input type="text" class="form-control" id="f"/>
                            </div>
                            <div class="col-6 mt-4">
                                <label class="form-label " >Last Name</label>
                                <input type="text" class="form-control" id="l" />
                            </div>
                            <div class="col-12 col-lg-8">
                                <label class="form-label ">Email</label>
                                <input type="email" class="form-control" id="e" />
                            </div>
                            <div class="col-lg-4 col-12 ">
                                <a href="#" class="btn btn-primary d-grid" style="margin-top: 4vh;" onclick="emailVerification();">Verify</a> 
                            </div>
                            <div class="col-12">
                                <label class="form-label ">Password</label>
                                <input type="password" class="form-control" id="p"/>
                            </div>
                            <div class="col-6 mt-4">
                                <label class="form-label " >Address Line 1</label>
                                <input type="text" class="form-control" id="a1" />
                            </div>
                            <div class="col-6 mt-4">
                                <label class="form-label " >Address Line 2</label>
                                <input type="text" class="form-control" id="a2" />
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label ">City</label>
                                <select class="form-select" id="c">
                                    <option>Kaduwela</option>
                                    <option>Hanwella</option>
                                    <option>Angoda</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label " >Gender</label>
                                <select class="form-select" id="g">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label ">Mobile</label>
                                <input type="text" class="form-control" id="m" />
                            </div>
                            <div class="col-12 col-lg-6 offset-lg-3 mt-3">
                                <a href="#" class="btn d-grid text-white" style="background-color: rgb(35, 35, 86)" onclick="userSigningUp();">Sign Up</a>
                            </div>
                            
                            
                            
                            
                          
                        </div>
                   </div>
                    

                    <div class="col-12 col-lg-6 d-none p-3 mt-5 vh-120" id="signInBox" style="margin-top: -6px;" >
                        <div class="row g-2" >
                        <div class="alert alert-info d-none" role="alert" id="alertdiv2" style="margin-top:-6px ;">
                        A simple info alert—check it out!
                        </div>
                        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active fw-bold fs-4" aria-current="page" href="#">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold fs-4" href="#" onclick="gotoSignUp();">Register</a>
                                </li>
                                
                                </ul>    
                        <?php
                        $email="";
                        $password="";

                        if(isset($_COOKIE["email"])){
                            $email=$_COOKIE["email"];
                            
                        }
                        if(isset($_COOKIE["password"])){
                            $password=$_COOKIE["password"];
                            
                        }

                       
                        
                        ?>
                        



                    
                            <div class="col-lg-12 col-12 mt-5">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email2" value="<?php echo $email;?>"/>
                            </div>
                            
                            <div class="col-12 col-lg-12 mt-5">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password2" value="<?php echo $password;?>" />
                            </div>
                            <div class="col-6 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label ">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end mt-4">
                            <a href="forgotPassword.php" class="link-primary">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 offset-lg-3 mt-5">
                                <a href="#" class="btn d-grid text-white" style="background-color: rgb(35, 35, 86)" onclick="signIn();">Sign In</a>
                            </div>
                            
                                      
</div>       
</div>
</div>
  </div>
            <!-- content -->
            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Email Verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Enter Your Verification Code</label>
                        <input type="text" class="form-control" id="vcode"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- footer -->

           

            <!-- footer -->
     </div>   
    
    
    </div>
    <script src="script.js"></script>
     <script src="bootstrap.js"></script>
   

   </body>
</html>
