<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <title>Index Page</title>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <?php include "admin_dashboard.php"; ?>
    </div>
</body>

</html>
