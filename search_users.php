<?php
include 'connection.php';

$search = $_POST['search'] ?? '';

// Prepare and execute a query to fetch user data based on the search term.
$stmt = $mysqli->prepare("SELECT userid, FullName FROM userdetails WHERE FullName LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$stmt->close();

echo json_encode($users); // Return the result as JSON.
?>
