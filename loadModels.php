<?php
require "connection.php";
$brand=$_GET["b"];
if($brand!=0){

    $models=Database::search("SELECT `model`.`name`,`model`.`id` FROM `model` INNER JOIN `brand_has_model` ON 
    `model`.`id`=`brand_has_model`.`model_id` WHERE `brand_id`='".$brand."'");

    $models_num=$models->num_rows;
    for($b=0;$b<$models_num;$b++){
    $models_data=$models->fetch_assoc();
   
    
    ?>
    
    <option value="<?php echo $models_data["id"];?>"><?php echo $models_data["name"];?></option>
    <?php
}
}

?>