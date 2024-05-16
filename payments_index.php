<?php
include "connection.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userid = $_SESSION['userid'];

// Retrieve payment data from the database
$payments = [];
$totalIncome = 0;

$sql = "SELECT payments.*, userdetails.FullName, subscriptiontype.subname 
        FROM payments 
        LEFT JOIN userdetails ON payments.userid = userdetails.userid 
        LEFT JOIN subscriptiontype ON payments.subid = subscriptiontype.subid";

$result = mysqli_query($mysqli, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $payments[] = $row;
        $totalIncome += $row['amount'];
    }
} else {
    echo "Error: " . mysqli_error($mysqli);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
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
                <h2 class="mb-3">Payments</h2>
                <h4>Total Income: Rs. <?php echo number_format($totalIncome, 2); ?></h4>
                <table class="table text-center mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Payment ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Subscription</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment) : ?>
                            <tr>
                                <td><?php echo $payment['paymentid']; ?></td>
                                <td><?php echo $payment['FullName']; ?></td>
                                <td><?php echo $payment['subname'] ? $payment['subname'] : 'N/A'; ?></td>
                                <td><?php echo "Rs. " . number_format($payment['amount'], 2); ?></td>
                                <td><?php echo $payment['date']; ?></td>
                                <td><?php echo $payment['description']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
