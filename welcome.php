<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:login form.php');
    exit;
}
include "config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Name = <?php echo $_SESSION['username']; ?></h1>
    <h2>Id = <?php echo $_SESSION['id'] ?></h2>
    <h2>Email Id = <?php echo $_SESSION['email'] ?></h2>
    <br>
    <h2><a href="logout.php">Logout</a></h2>
</body>
</html>
