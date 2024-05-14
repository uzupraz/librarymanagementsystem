<?php
include 'connection.php';

$bookid = $_GET['bookid'];

$stmt = $mysqli->prepare("SELECT bookname, author, publisher, publishdate FROM books WHERE bookid = ?");
$stmt->bind_param("i", $bookid);
$stmt->execute();
$result = $stmt->get_result();

$bookDetails = $result->fetch_assoc();
$stmt->close();

echo json_encode($bookDetails); // Return book details as JSON.
?>
