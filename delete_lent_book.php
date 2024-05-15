<?php
include "connection.php";

if (isset($_GET['id'])) {
    $lentid = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM lentbooks WHERE lentid = ?");
    $stmt->bind_param("i", $lentid);

    if ($stmt->execute()) {
        header("Location: lentbook_index.php?msg=Book record deleted successfully");
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
} else {
    header("Location: lentbook_index.php");
}
?>
