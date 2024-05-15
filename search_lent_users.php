<?php
include 'connection.php';

if (isset($_GET['bookid'])) {
    $bookid = $_GET['bookid'];

    // Fetch user details for users who have lent the specified book
    $query = "SELECT u.userid AS id, u.FullName AS name FROM userdetails u
              JOIN lentbooks lb ON u.userid = lb.userid
              WHERE lb.bookid = ? AND lb.status = 'lent'";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $bookid);
    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode($users);
} else {
    echo json_encode([]);
}
?>
