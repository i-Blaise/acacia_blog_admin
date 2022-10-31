<?php
require_once('../ClassLibraries/MainClass.php');
$mainPlug = new mainClass();


$blog_result = $mainPlug->fetchBlogListMobile();
// print_r($blog_result);
// die();
while($row = mysqli_fetch_assoc($blog_result)){
    $json_row = json_encode($row);
    print_r($json_row);
}

