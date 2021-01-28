<?php

include_once 'modules/php-jwt-master/src/BeforeValidException.php';
include_once 'modules/php-jwt-master/src/ExpiredException.php';
include_once 'modules/php-jwt-master/src/SignatureInvalidException.php';
include_once 'modules/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

error_reporting(E_ALL);


class Session {
    
    public function login($login) {
        $key = "example_key";
        $issued_at = time();
        $expiration_time = $issued_at + (60 * 60);
        $issuer = "http://localhost/PHP-Login/";

        $token = array(
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => $issuer,
            "data" => array(
                "id" => $login["id"]
            )
        );

        $jwt = JWT::encode($token, $key);
        setcookie("session", $jwt);
    }

    public function session() {
        $key = "example_key";
        $issued_at = time();
        $expiration_time = $issued_at + (60 * 60);
        $issuer = "http://localhost/PHP-Login/";

        $jwt = isset($_COOKIE["session"]) ? $_COOKIE["session"] : "";

        if ($jwt) {
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            return $decoded->data;
        } else {
            return null;
        }
    }
}

?>