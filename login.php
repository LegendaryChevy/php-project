<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <?php include('header.php')?>  
    <div class="sidebar"></div> 
    <div id="login_box" class="black_bg">
           
            <h2 class="black_bg">Login</h2>
            <form class="black_bg" action="login.php" method="post">
                Username: <input class="inputs" type="text" name="username" required><br>
                Password: <input class="password" class="inputs" type="password" name="password" required><br>
                <input id="login_submit" class="inputs" type="submit" name="login" value="Login">
            </form>
        </div>
    </body>
</html>





<?php
session_start();    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dsn = 'mysql:host=127.0.0.1;dbname=user_auth';
    $db_user = 'legendarychevy';
    $db_pass = 'magpie96';  

    try {
        $conn = new PDO($dsn, $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result['id'];
            $hashed_password = $result['password'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;

                echo "Login successful! Welcome, " . $username;
                sleep(2);
                header('location: dashboard.php');
                exit();
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Invalid username or password";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>