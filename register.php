<!DOCTYPE HTML>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        Username:<input type="text" name="username" required><br>
        Password:<input type="password" name="password" required><br>

        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>


<?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $conn = new mysqli("localhost", "root", "", "user_auth");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "insert into users (username, password) values (?, ?)";
        $stmt =$conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        }
        else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
        
    }
?>