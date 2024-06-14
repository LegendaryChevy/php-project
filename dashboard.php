<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

//echo "Welcome " . $_SESSION['user_id'];
//echo "<br><a href='logout.php'>Logout</a>";
?>

<!DOCTYPE html>

<html>
<head>
    <title>dashboard</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <?php include('header.php');?>

</body>


</html>