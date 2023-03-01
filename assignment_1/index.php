<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css"/>
    <title>Services List</title>
</head>
<body>
<div class="container">
<style>
<?php include 'styles.css'; ?>
</style>
<?php
require 'utils.php';
$helper=new Helper();
$title="";
$description="";
$image_full_path="";

//api call to get data
$data=$helper->makeGetRequest('https://ir-dev-d9.innoraft-sites.com/jsonapi/node/services');

for($i=0;$i<sizeof($data);$i=$i+1){
$title=$data[$i]['attributes']['title'];
$title_arr=explode(" ",$title,3);
$description_temp=$data[$i]['attributes']['field_services']['processed'];
$description= preg_replace("/\<p(.*)\>(.*)\<\/p\>/","", $description_temp);

$image_api_link=$data[$i]['relationships']['field_image']['links']['related']['href'];
$explore_btn_link=$helper->base_url.$data[$i]['attributes']['path']['alias'];

//api call to get imgae path
$image_data_obj=$helper->makeGetRequest($image_api_link);
$image_full_path=$helper->base_url.$image_data_obj['attributes']['uri']['url'];
if($description!=""&&$title!="" &&$image_full_path!=""){
?>
<div class="box">
<div class="content">
<h1 ><span class="color-orange"><?php echo $title_arr[0]?> <?php echo $title_arr[1]?></span><br><?php echo $title_arr[2]?> </h1>
<?php echo $description?>
<div class="explore-button" >
<a href="<?php echo $explore_btn_link?>">EXPLORE MORE</a>
</div>
</div>
<div class="image">
<img src="<?php echo $image_full_path?>" alt="Failed" width="100%" height="100%">
</div>
</div>

<?php
}}
?>

</div>
</body>
</html>