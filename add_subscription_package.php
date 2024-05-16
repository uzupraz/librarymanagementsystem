<?php
include "connection.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userid = $_SESSION['userid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subname = $_POST["subname"];
    $days = $_POST["days"];
    $price = $_POST["price"];

    $sql = "INSERT INTO subscriptiontype (subname, days, price) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sid", $subname, $days, $price);

    if ($stmt->execute()) {
        header("Location: subscription_packages.php?msg=Subscription package added successfully");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subscription Package</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="container mt-4">
                <h2 class="mb-3">Add Subscription Package</h2>
                <form action="add_subscription_package.php" method="POST">
                    <div class="mb-3">
                        <label for="subname" class="form-label">Subscription Name</label>
                        <input type="text" class="form-control" id="subname" name="subname" required>
                    </div>
                    <div class="mb-3">
                        <label for="days" class="form-label">Days</label>
                        <input type="number" class="form-control" id="days" name="days" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Add Subscription Package</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
