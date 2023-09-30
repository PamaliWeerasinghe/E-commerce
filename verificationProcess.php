<?php

    require "connection.php";


    if(isset($_GET["v"])){
        $v=$_GET["v"];
       

        $user=Database::search("SELECT `verification_code` FROM `temporary` WHERE `verification_code`='".$v."'");
        $num=$user->num_rows;
        echo($num);
        if($num==1){
            echo("EmailVerified!");
            Database::iud("DELETE FROM `temporary` WHERE `verification_code`='".$v."'");
        }else{
            echo("Invalid Verification Code");
            Database::iud("DELETE FROM `temporary` WHERE `verification_code`='".$v."'");
        }
    }else{
        echo("Please enter your verification");
    }

?>