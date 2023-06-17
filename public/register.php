<?php
require_once "../private/database/db.php";
// require_once "../private/php-jwt/src/JWT.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["username"] == "" || $_POST["password"] == "" || $_POST["email"] == "") {
        $_SESSION["form_error"] = "Empty fields";
    } else {


        $username = $_POST["username"];
        $password = hash('sha256', $_POST["password"]);
        $email = $_POST["email"];
        $q = $conn->query("SELECT * FROM `users` WHERE `username`='$username' AND `email`='$email';");


        if ($q->num_rows >= 1) {
            $_SESSION["form_error"] = "This email or username registed";
        } else {
            $conn->query("INSERT INTO `users`(`username`,`password`,`email`) VALUES ('$username','$password','$email');");
            header("Location: /login.php");
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Registration</h1>

        <form method="POST">

            <input class="form-control username" name="username" type="text" maxlength="64" />
            <br /><input class="form-control password" name="password" type="password" maxlength="64" />
            <br /><input class="form-control email" name="email" type="email" maxlength="128" />
            <br /><button class="btn btn-success fd" type="submit">Reg</button>

        </form>

        <?php
        if (isset($_SESSION["form_error"])) {
            echo $_SESSION["form_error"];
            $_SESSION["form_error"] = "";
        }
        ?>

    </div>
    <script>
        // Get references to the input fields and the submit button
        const usernameInput = document.querySelector('.username');
        const passwordInput = document.querySelector('.password');
        const emailInput = document.querySelector('.email');
        const submitButton = document.querySelector('.fd');

        // Add a click event listener to the submit button
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>