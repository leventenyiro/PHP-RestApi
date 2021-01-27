<?php

include ("models/Database.php");

function getAll() {
    // a php automatikusan átvesz adatokat
    //echo $_SERVER["REQUEST_URI"];

    //echo "ez egy valami nevű üzenet";
    
    $db = new Database();
    $result = $db->getAll();

    // ha egy elemet akarunk visszaadni
    //echo json_encode(json_decode($result)[0]);

    echo $result;
}

function getOne() {
    $db = new Database();
    $result = $db->getOne();
    if ($result != "null") {
        echo $result;
    }
}

// SESSION
function login() {
    /*session_start();
    if (!isset($_SESSION["userId"])) {
        $_SESSION["userId"] = "";
    }*/

    if (!isset($_POST["usernameEmail"]) || empty($_POST["usernameEmail"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
        echo json_encode(array("error" => "Something is missing!"));
    } else {
        $db = new Database();
        $result = $db->login();
        if (password_verify($_POST["password"], json_decode($result, true)["password"])) {
            //$_SESSION["userId"] = json_decode($result, true)["id"];
            //echo json_encode($_COOKIE);
            //session_start();
            //session_id(json_decode($result, true)["id"]);
            //$_COOKIE["sessionId"] = $sessionId;
            //echo json_encode($_COOKIE);
            //setcookie("userId", json_decode($result, true)["id"], time() + 86400, "/");
            $_SESSION["userId"] = json_decode($result, true)["id"];
        } else {
            echo json_encode(array("error" => "Unsuccessful login!"));
        }
    }
}

function session() {
    //echo $_COOKIE["session"];
    //session_get_cookie_params($_COOKIE["session"]);
    //echo json_encode($_SESSION);
    //echo $_COOKIE["userId"];
    echo json_encode($_COOKIE["session"]);
}

function logout() {
    session_destroy();
}

function postTest() {
    echo json_encode($_POST);
}

?>