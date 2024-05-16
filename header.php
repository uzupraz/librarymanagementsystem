<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

require_once 'connection.php'; // Make sure to include your database connection

$userid = $_SESSION['userid'];
$username = 'Guest'; // Default value

// Fetch the full name from the userdetails table
$stmt = $mysqli->prepare("SELECT FullName FROM userdetails WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($fullname);
if ($stmt->fetch()) {
    $username = $fullname;
}
$stmt->close();
?>



<header class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Library Management System</a>
        <div class="dropdown ms-auto">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="avatar.png" alt="Avatar" class="avatar"> <!-- Assuming you have an avatar.png -->
                <?php echo htmlspecialchars($username); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="edit_account.php">Edit Account Details</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>