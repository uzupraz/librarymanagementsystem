<?php
include "connection.php";

// Get the user ID from the URL
$id = $_GET["id"];

// Update the 'Deleted' field to 1 for the specified user ID
$sql = "UPDATE `userdetails` SET `Deleted` = 1 WHERE `userid` = $id";
$result = mysqli_query($mysqli, $sql);

// Check if the update was successful and redirect accordingly
if ($result) {
    header("Location: user_index.php?msg=User Deleted Successfully");
} else {
    echo "Failed: " . mysqli_error($mysqli);
}
?>
