<?php

header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'models/Database.php';

include_once 'modules/php-jwt-master/src/BeforeValidException.php';
include_once 'modules/php-jwt-master/src/ExpiredException.php';
include_once 'modules/php-jwt-master/src/SignatureInvalidException.php';
include_once 'modules/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

if (!isset($_POST["usernameEmail"]) || empty($_POST["usernameEmail"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
        echo json_encode(array("error" => "Something is missing!"));
    } else {
        $db = new Database();
        $login = $db->login();
        if (count(array($login)) == 0) {
            echo json_encode(array("error" => "Unsuccessful login!"));
        } else {
            if (password_verify($_POST["password"], json_decode($login, true)[0]["password"])) {
                //$session = new Session();
                //$session->login(json_decode($login, true)[0]);

                //echo json_decode($login, true)[0]["id"];
                error_reporting(E_ALL);
                $key = "example_key";
                $issued_at = time();
                $expiration_time = $issued_at + (60 * 60);
                $issuer = "http://localhost/PHP-RestApi/";
        
                $token = array(
                    "iat" => $issued_at,
                    "exp" => $expiration_time,
                    "iss" => $issuer,
                    "data" => array(
                        "id" => json_decode($login, true)[0]["id"]
                    )
                );







            } else {
                echo json_encode(array("error" => "Unsuccessful login!"));
            }
        }

    }

?>