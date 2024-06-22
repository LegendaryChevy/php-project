<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="styles.css">
        </head>
    <body>
    <?php include("header.php");?>
        <div id="register_box" class="black_bg">
            <h2 class="black_bg">Register</h2>
            <form action="register.php" method="post">
                Username:<input class="inputs" type="text" name="username" required><br>
                Password:<input class="inputs" type="password" name="password" required><br>

                <input class="inputs" type="submit" name="register" value="Register">
            </form>
        </div>
    </body>
</html>




<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $dsn = 'mysql:host=localhost;dbname=user_auth';
        $db_user = 'legendarychevy';
        $db_pass = 'magpie96';

        try {
            $conn = new PDO($dsn, $db_user, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $password]);

            echo "Registration successful!";
            sleep(2);
            header('Location: login.php');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    }
?>