<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mid login</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid">
    <div class="col-12  col-lg-8 offset-lg-4 mt-5 mb-5">
                <div class="row">
                   
                    
                    <div class="col-12 col-lg-6 d-none" id="signUpBox">
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
                    

                    <div class="col-12 col-lg-6 p-3 mt-5 vh-120" id="signInBox" style="margin-top: -6px;" >
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
                                <a href="#" class="btn d-grid text-white" style="background-color: rgb(35, 35, 86)" onclick="signIn1();">Sign In</a>
                            </div>
                            
                                      
</div>       
</div>
</div>
  </div>
    </div>

<script src="script.js"></script>   

</body>
</html>