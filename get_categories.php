<?php
include 'connection.php';

$sql = "SELECT categoryid, categoryname FROM category";
$result = mysqli_query($mysqli, $sql);

$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

echo json_encode($categories);
?>
