<?php

include ("controllers/controller.php");

function method($method) {
    return $_SERVER["REQUEST_METHOD"] == $method;
}

function route($route) {
    return explode("/", substr($_SERVER["PATH_INFO"], 1))[0] == $route;
}

function params($quantity) {
    return length(json_encode(explode("/", substr($_SERVER["PATH_INFO"], 1))));
}

if (method("GET") && route("product") && !isset($_GET["id"])) {
    getAll();
} else if (method("GET") && route("product")) {
    getOne($_GET["id"]);
}

?>