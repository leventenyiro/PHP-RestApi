<?php

include ("controllers/controller.php");

function method($method) {
    return $_SERVER["REQUEST_METHOD"] == $method;
}

function route($route) {
    if (isset($_SERVER["PATH_INFO"])) {
        $pathInfo = substr($_SERVER["PATH_INFO"], 1);
        if ($pathInfo != "") {
            return explode("/", $pathInfo)[0] == $route;
        }
    }
    return null;
}

function params($quantity) {
    return length(json_encode(explode("/", substr($_SERVER["PATH_INFO"], 1))));
}

if (method("GET") && route("product") && !isset($_GET["id"])) {
    getAll();
} else if (method("GET") && route("product")) {
    getOne();
} else if (method("POST") && route("login")) {
    login();
} else if (method("POST") && route("test")) {
    postTest();
} else if (method("GET") && route("session")) {
    session();
}

?>