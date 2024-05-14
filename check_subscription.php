<?php
include 'connection.php';

// Get the user ID from the request
$userid = $_GET['userid'] ?? $_POST['userid'];

// Prepare the SQL query to check if the user is in the activesubscriptions table
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM activesubscriptions WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

// Check if the count is greater than 0
if ($count > 0) {
    echo json_encode(['isSubscribed' => true, 'message' => 'Yes']);
} else {
    echo json_encode(['isSubscribed' => false, 'message' => 'No']);
}
?>
