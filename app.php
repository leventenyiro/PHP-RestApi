<?php
include ("controllers/controller.php");


//echo $_SERVER["REQUEST_METHOD"];

//$url = $_SERVER["REQUEST_URI"];
//echo $url;

//$splitted = explode("/", $url);
//echo $splitted[3];

if ($_SERVER["REQUEST_METHOD"] && explode("/", $_SERVER["REQUEST_URI"])[3] == "product") {
    getAll();
}

?>