<?php
require_once('../ClassLibraries/MainClass.php');
$mainPlug = new mainClass();

$blogID = htmlspecialchars($_GET["blogID"]);
$action = htmlspecialchars($_GET["action"]);

if(isset($blogID))
{

    switch($action){
        case "delete":
            $deleteResults = $mainPlug->deleteBlog($blogID);
            echo $deleteResults;
            // die();
        break;
    }

}else{
    echo 'no';
    die();
}