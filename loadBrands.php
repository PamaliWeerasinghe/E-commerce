<?php
require "connection.php";
$category=$_GET["c"];
if($category!=0){

    $brands=Database::search("SELECT `brand`.`name`,`brand`.`id` FROM `brand` INNER JOIN `category_has_brand` ON 
    `brand`.`id`=`category_has_brand`.`brand_id` WHERE `category_id`='".$category."'");

    $brands_num=$brands->num_rows;
    for($b=0;$b<$brands_num;$b++){
    $brands_data=$brands->fetch_assoc();
   
    
    ?>
    
    <option value="<?php echo $brands_data["id"];?>"><?php echo $brands_data["name"];?></option>
    <?php
}
}

?>