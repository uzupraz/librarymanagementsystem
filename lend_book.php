<?php
include 'connection.php';

// Check if both userid and bookid are provided and are integers
if (!empty($_POST['userid']) && !empty($_POST['bookid']) && ctype_digit($_POST['userid']) && ctype_digit($_POST['bookid'])) {
    $userid = (int)$_POST['userid'];
    $bookid = (int)$_POST['bookid'];

    // Calculate lent date and return date
    $lentDate = date("Y-m-d"); // Today's date
    $returnDate = date("Y-m-d", strtotime("+30 days")); // Return date is 30 days from today

    // Prepare the SQL statement to insert the new lent record
    $stmt = $mysqli->prepare("INSERT INTO lentbooks (bookid, userid, lenddate, returndate, status) VALUES (?, ?, ?, ?, 'lent')");
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the statement: ' . $mysqli->error]);
        exit;
    }

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("iiss", $bookid, $userid, $lentDate, $returnDate);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Book successfully lent out.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to lend out book: ' . $stmt->error]);
    }

    // Close statement
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Missing or invalid required parameters.']);
}
?>
