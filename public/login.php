<?php
require_once "../private/database/db.php";
require_once "../private/php-jwt/src/JWT.php";

use \Firebase\JWT\JWT;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = hash('sha256', $_POST["password"]);

  if ($username == "" || $_POST["password"] = "") {
    $_SESSION["login_error"] = "Fields empty";
  } 
  else {

    $q = $conn->query("SELECT * FROM `users` WHERE `username`='$username' and `password`='$password';");
    if ($q->num_rows == 1) {
      $payload = [
        "time" => time(),
        "username" => $username,
        "email" => $q->fetch_assoc()["email"]
      ];
      $key = '--Begin Key--
    kfb2ifb247hf123hg91308ruc108yr923ht082408vcu23u5v0827bv5083
    v69375v3t59240b86yv08u52v3y0v8g1uvy295vuv-197y4v08y0vy2975T
    aojfgvpwiejhg0824u5vf02875-285v02y0523085v2075v93ytowhtivh3
    --End Key--';
     
    $jwt = JWT::encode($payload, $key, 'HS256');
      $_SESSION["auth"] = $jwt;
      header("Location: welcome.php");

    } else {
      $_SESSION["login_error"] = "Invalid username or password";
    }
  }
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">

    <h1>Login</h1>
    <form method="POST">
      <input class="form-control username" name="username" type="text" maxlength="64" />
      <br /><input class="form-control password" name="password" type="password" maxlength="64" />
      <br /><button class="btn btn-success fd" type="submit">Send</button>


    </form>
    <?php
    if (isset($_SESSION["login_error"])) {
      echo $_SESSION["login_error"];
      $_SESSION["login_error"] = "";
    }
    ?>
  </div>
  <?php
  print_r($_SESSION);
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>