<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){
    $email=$_POST["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `user` SET `password_verification_code`='".$code."' WHERE `email`='".$email."'");
        
        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pamalidevanga2002@gmail.com';
            $mail->Password = 'cxdgyjfbgesdtxma';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('pamalidevanga2002@gmail.com', 'Reset Password');
            $mail->addReplyTo('pamalidevanga2002@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'GIMMICK Forgot password Verification Code';
            $bodyContent = '<h1 style="color:blue;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo ("Invalid Email Address");
    }

}else{
    echo("Please enter the Email Address");
}

?>
