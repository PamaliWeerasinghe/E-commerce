<?php
   
    
    $email=$_POST["e"];

    if(empty($email)){
        echo("Please enter your email");
    } 
    
require "connection.php";
    
    require "SMTP.php";
    require "PHPMailer.php";
    require "Exception.php";

    
    Database::iud("DELETE FROM `temporary`");
    use PHPMailer\PHPMailer\PHPMailer;
            $email=$_POST["e"];
   
            $code=uniqid();

            Database::iud("INSERT INTO `temporary`(`email`,`verification_code`) VALUES ('".$email."','".$code."')");
            Database::iud("UPDATE `temporary` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pamalidevanga2002@gmail.com';
            $mail->Password = 'cxdgyjfbgesdtxma';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('pamalidevanga2002@gmail.com', 'Email Verification');
            $mail->addReplyTo('pamalidevanga2002@gmail.com', 'Email Verification');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Gimmick | User Email Verification Code';
            $bodyContent = '<h1 style="color:black">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo("Verification Code Sending Failed");
            }else{
                echo("success");
            }

    
   

?>