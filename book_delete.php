<?php
include "connection.php";
$id = $_GET["id"];
$sql = "DELETE FROM `books` WHERE bookid = $id";
$result = mysqli_query($mysqli, $sql);

if ($result) {
  header("Location: book_index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($mysql);
}
