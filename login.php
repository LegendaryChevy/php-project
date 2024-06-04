<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>
        <form action="login.php" method="post">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
</html>

<?php

session_start();    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "legendarychevy", "", "user_auth");

    if ($conn->connect_error) {
        die("connection failed: " . $conn->connect_error);
    }

    $sql = "select id, username, password from users where username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;

        echo "Login successful! Welcome, " . $username;
    } 
    else {
        echo "Invalid username or password";
    }
    $stmt->close();
    $conn->close();
}
?>