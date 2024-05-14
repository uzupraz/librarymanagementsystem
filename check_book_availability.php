<?php
include 'connection.php';

// Get the book ID from the request
$bookid = $_GET['bookid'] ?? $_POST['bookid'];

// Prepare to fetch the total number of copies from the totalbooks table
$stmt = $mysqli->prepare("SELECT totalnumber FROM totalbooks WHERE bookid = ?");
$stmt->bind_param("i", $bookid);
$stmt->execute();
$stmt->bind_result($totalnumber);
$stmt->fetch();
$stmt->close();

// Prepare to count how many copies are currently lent out
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM lentbooks WHERE bookid = ? AND status = 'lent'");
$stmt->bind_param("i", $bookid);
$stmt->execute();
$stmt->bind_result($lentCount);
$stmt->fetch();
$stmt->close();

// Calculate the number of available copies
$availableCopies = $totalnumber - $lentCount;

// Check availability and return result
if ($availableCopies > 0) {
    echo json_encode(['isAvailable' => true, 'message' => "Available: $availableCopies copies left."]);
} else {
    echo json_encode(['isAvailable' => false, 'message' => "Not available"]);
}
?>
