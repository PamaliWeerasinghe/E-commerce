<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Gimmick</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logos/logo.gif"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
<div class=" container-fluid vh-100 " style="background-image: url(resources/logos/blob.png);background-repeat: no-repeat;background-size:100%; background-position:500px 220px; background-color: rgb(242, 247, 252); padding-top:45px; padding-bottom:65px;padding-left:155px;padding-right:155px;" >
<a class="fs-3" style="text-decoration:none ; color:black" href="login.php"> &lAarr; </a>
        <div class="row p-3" style="background-color: white; height:65vh; margin-left:20%; width:70%; border-radius:35px; font-size: 20%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin-top:10vh">
            
        <div class="row ">
                <div class="col-6 offset-4">
                    <span style=" color:rgb(35, 35, 86);" class="fs-4 fw-bold">Reset Password</span>
                </div>
                <div class="col-4 text-center">
                    <img src="resources/logos/logo.gif" style="border-radius:100% ; width:70%; margin-left:105%"/>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                <label class="form-label">Enter Your Email</label>
                </div>
                <div class="col-lg-8 col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's Email" aria-label="Recipient's username" aria-describedby="basic-addon2" id="fpemail">
                    <button class="input-group-text" id="basic-addon2" onclick="passwordEmailVerifcation();">Send Verification</button>
                </div>
                </div>
                <div class="col-lg-4 col-12">
                <label class="form-label">Enter Your Verification Code</label>
                </div>
                <div class="col-lg-8 col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Verification Code" id="fpvcode">
                    
                </div>
                </div>
                <div class="col-lg-6 col-12" >
                    <label class="form-label">New Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="fpnp"/>
                            <button class="btn btn-outline-dark" type="button" id="fpnp" onclick="showPassword3();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                        </div>
                </div>
                <div class="col-lg-6 col-12">
                    <label class="form-label">Re-Enter Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="fprnp"/>
                            <button class="btn btn-outline-dark" type="button" id="fprnp" onclick="showPassword4();"><i id="e2" class="bi bi-eye-slash-fill"></i></button>
                        </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-10 offset-1 d-grid ">
                        <button class="btn btn-primary " onclick="resetPassword();">Reset Password</button> 
                    </div>
                   
                </div>
            </div>
    
        </div>

</div>
<script src="bootstrap.js"></script>
<script src="script.js"></script>   
</body>
</html>