<?php
include 'connection.php';

$userid = $_GET['userid'];

$stmt = $mysqli->prepare("SELECT FullName, Address, Gender FROM userdetails WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

$userDetails = $result->fetch_assoc();
$stmt->close();

echo json_encode($userDetails); // Return user details as JSON.
?>
