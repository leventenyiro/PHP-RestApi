<?php

include_once 'models/Database.php';
include_once 'models/User.php';

include_once 'models/Session.php';

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

    if (!isset($_POST["usernameEmail"]) || empty($_POST["usernameEmail"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
        echo json_encode(array("error" => "Something is missing!"));
    } else {
        $db = new Database();
        $user = new User($db->conn);
        $login = $user->login();
        if (count(json_decode($login, true)) != 1) {
            echo json_encode(array("error" => "Unsuccessful login!"));
        } else {
            if (password_verify($_POST["password"], json_decode($login, true)[0]["password"])) {
                $session = new Session();
                $session->login(json_decode($login, true)[0]);

                http_response_code(200);
                echo json_encode(array("message" => "Successful login"));
            } else {
                echo json_encode(array("error" => "Unsuccessful login!"));
            }
        }

    }
}

function session() {
    $session = new Session();
    $result = $session->session();
    if ($result == null) {
        echo json_encode(array("error" => "You are not logged in!"));
    } else {
        // userId
        echo json_encode($result);
    }
}

function logout() {
    setcookie("session", "", time() - 3600);
}

?>