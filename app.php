<?php
include ("controllers/controller.php");

$url = $_SERVER["REQUEST_URI"];
//echo $url;

//$splitted = explode("/", $url);
//echo $splitted[3];

if (explode("/", $_SERVER["REQUEST_URI"])[3] == "valami") {
    valami();
}

?>