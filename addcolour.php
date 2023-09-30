<?php
$c=$_GET["c"];
if(empty($c)){
    echo("Please Enter a colour");
}else if(strlen($c)>50){
    echo("Length of the colour should be less than 50 characters");
}else{
    require "connection.php";

    $colour=Database::search("SELECT * FROM `colour` WHERE `name`='".$c."'");
    $colour_num=$colour->num_rows;
    if($colour_num=="1"){
        echo(" Colour $c already exists");
    }else{
        Database::iud("INSERT INTO `colour`(`name`) VALUES('".$c."')");
        echo("success");
    

    }



   
}

?>