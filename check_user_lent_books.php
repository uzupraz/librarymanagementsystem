<?php
include 'connection.php';

// Retrieve the user ID from the request
if(isset($_POST['userid'])) {
    $userid = $_POST['userid'];

    // Query to count how many books the user currently has lent out
    $query = "SELECT COUNT(*) AS lent_count FROM lentbooks WHERE userid = ? AND status = 'lent'";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $lentCount = $row['lent_count'];

    // Determine if the user can lend more books
    $canLendMore = ($lentCount < 5);
    $message = "$lentCount out of 5";

    echo json_encode([
        'canLendMore' => $canLendMore,
        'lentCount' => $lentCount,
        'message' => $message
    ]);
} else {
    echo json_encode(['error' => 'User ID not provided']);
}

$stmt->close();
?>
