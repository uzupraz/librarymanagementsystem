<?php
include "connection.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userid = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Packages</title>
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
                <h2 class="mb-3">Subscription Packages</h2>
                <a href="add_subscription_package.php" class="btn btn-dark mb-3">Add Subscription Package</a>
                <table class="table text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Subscription Name</th>
                            <th scope="col">Days</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT subname, days, price FROM subscriptiontype";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["subname"]); ?></td>
                                <td><?php echo htmlspecialchars($row["days"]); ?></td>
                                <td><?php echo htmlspecialchars($row["price"]); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
