<?php
include "connection.php";
$id = $_GET["id"];
$sql = "DELETE FROM `userdetails` WHERE userid = $id";
$result = mysqli_query($mysqli, $sql);

if ($result) {
  header("Location: user_index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($mysqli);
}
