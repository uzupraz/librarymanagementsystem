<?php
include 'connection.php';

if (isset($_GET['bookid']) && isset($_GET['userid'])) {
    $bookid = $_GET['bookid'];
    $userid = $_GET['userid'];

    // Prepare the SQL query to fetch lent and return dates
    $stmt = $mysqli->prepare("SELECT lenddate, returndate FROM lentbooks WHERE bookid = ? AND userid = ? AND status = 'lent' LIMIT 1");
    $stmt->bind_param("ii", $bookid, $userid);
    $stmt->execute();
    $stmt->bind_result($lentdate, $returndate);

    if ($stmt->fetch()) {
        $dates = array(
            'lent_date' => $lentdate,
            'expected_return_date' => $returndate
        );
        echo json_encode($dates);
    } else {
        echo json_encode(['error' => 'No records found.']);
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['error' => 'No book ID or user ID provided.']);
}
