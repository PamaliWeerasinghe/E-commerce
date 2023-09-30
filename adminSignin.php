<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin SignIn | GIMMICK</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logos/logo.gif" />
</head>

<body style="background-color: rgb(242, 247, 252);">

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">

                    <div class="col-12"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to GIMMICK Admins!</p>
                    </div>

                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="title02">Sign In to your Account.</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="margin-top: 10vh;">Email</label>
                                <input type="email" class="form-control" placeholder="ex : john@gmail.com" id="e" style="margin-top: 3vh;" />
                            </div>
                            <div class="col-12 col-lg-6 d-grid" style="margin-top: 4vh;">
                                <button class="btn btn-primary" onclick="adminVerification();"style=" height:5vh">Send Verification Code</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid" style="margin-top: 4vh;">
                                <a href="index.php" class="btn" style="background-color: rgb(35, 35, 86); color:white; height:5vh">Back to Customer Log In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="col-12 fixed-bottom text-center">
                <p>&copy; 2022 gimmick@gmail.com| All Rights Reserved</p>
            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>