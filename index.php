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
    <link rel="stylesheet" href="css/style.css">
    <title>Index Page</title>
</head>

<body>
        <?php include "admin_dashboard.php"; ?>
</body>

</html>
