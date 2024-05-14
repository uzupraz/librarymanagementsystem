<?php
include 'connection.php';

$search = $_POST['search'] ?? '';
$data = [];
if (!empty($search)) {
    $stmt = $mysqli->prepare("SELECT bookid, bookname, author, publisher FROM books WHERE bookname LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
}
echo json_encode($data);
?>
