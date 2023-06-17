<?php

require_once "../private/php-jwt/src/JWT.php";
require_once "../private/php-jwt/src/Key.php";

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;





function auth_page($conn)
{


    $key = '--Begin Key--
    kfb2ifb247hf123hg91308ruc108yr923ht082408vcu23u5v0827bv5083
    v69375v3t59240b86yv08u52v3y0v8g1uvy295vuv-197y4v08y0vy2975T
    aojfgvpwiejhg0824u5vf02875-285v02y0523085v2075v93ytowhtivh3
    --End Key--';
    if (isset($_SESSION["auth"])) {
        $payload = (array) JWT::decode($_SESSION["auth"], new Key($key, 'HS256'));
        if ($payload["time"] + 86400 < time()) {
            $_SESSION["auth"] = "";
            $_SESSION["login_error"] = "Login time expired again login";
            header("Location: /login.php");
        } else {
            $username = $payload["username"];
            $q = $conn->query("SELECT * FROM `users` WHERE `username`='$username';");
            if ($q->num_rows == 0) {
                $_SESSION["auth"] = "";
                header("Location: /login.php");
            }
        }
    } else {
        header("Location: /login.php");
    }
}


function get_data_auth()
{


    $key = '--Begin Key--
    kfb2ifb247hf123hg91308ruc108yr923ht082408vcu23u5v0827bv5083
    v69375v3t59240b86yv08u52v3y0v8g1uvy295vuv-197y4v08y0vy2975T
    aojfgvpwiejhg0824u5vf02875-285v02y0523085v2075v93ytowhtivh3
    --End Key--';

    return (array) JWT::decode($_SESSION["auth"], new Key($key, 'HS256'));
}
