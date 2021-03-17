<?php

include ("controllers/controller.php");

function method($method) {
    return $_SERVER["REQUEST_METHOD"] == $method;
}

function route($route) {
    if (isset($_SERVER["PATH_INFO"])) {
        $route = explode("/", $route);

        $pathInfo = $_SERVER["PATH_INFO"];
        
        $pathInfo = explode("/", $pathInfo = substr($pathInfo, 1, strlen($pathInfo)));
        
        $params = array();

        if (count($route) != count($pathInfo)) {
            return null;
        }

        for ($i = 1; $i < count($pathInfo); $i++) {
            $paramName = substr($route[$i], 1, strlen($route[$i]));
            array_push($params, array($paramName=>$pathInfo[$i]));
        }

        $_SERVER["PARAMS"] = $params;
        return $route[0] == $pathInfo[0];
    }
    return null;
}

if (method("GET") && route("product") && !isset($_GET["id"])) {
    getAll();
} else if (method("GET") && route("product")) {
    getOne();
} else if (method("POST") && route("session")) {
    login();
} else if (method("GET") && route("session")) {
    session();
} else if (method("DELETE") && route("session")) {
    logout();
}

?>