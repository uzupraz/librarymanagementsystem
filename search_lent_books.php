<?php
include 'connection.php';

// Fetch book names with their corresponding book IDs from lentbooks where status is 'lent'
$query = "SELECT b.bookid AS id, b.bookname AS name FROM books b
          JOIN lentbooks lb ON b.bookid = lb.bookid
          WHERE lb.status = 'lent'";
$result = $mysqli->query($query);

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);
?>
