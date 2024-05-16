<?php
include 'connection.php';

if (isset($_POST['userid'], $_POST['bookid'])) {
    $userid = $_POST['userid'];
    $bookid = $_POST['bookid'];
    $overdue = isset($_POST['overdue']) ? $_POST['overdue'] : false;
    $fine = isset($_POST['fine']) ? $_POST['fine'] : 0;

    // Update the lentbooks table
    $stmt = $mysqli->prepare("UPDATE lentbooks SET status = 'returned', actualreturndate = CURDATE() WHERE bookid = ? AND userid = ? AND status = 'lent'");
    $stmt->bind_param("ii", $bookid, $userid);

    if ($stmt->execute()) {
        // Check if the book was overdue
        if ($overdue) {
            // Insert fine into the payments table
            $paymentStmt = $mysqli->prepare("INSERT INTO payments (userid, amount, date, description) VALUES (?, ?, CURDATE(), 'Overdue Fine')");
            $paymentStmt->bind_param("id", $userid, $fine);

            if ($paymentStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Book returned successfully with overdue fine.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to record overdue fine: ' . $paymentStmt->error]);
            }

            $paymentStmt->close();
        } else {
            echo json_encode(['success' => true, 'message' => 'Book returned successfully.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update return status: ' . $stmt->error]);
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters.']);
}
?>
