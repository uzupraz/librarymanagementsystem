<?php
include "connection.php";

if (isset($_GET['subid'])) {
    $subid = $_GET['subid'];
    
    $stmt = $mysqli->prepare("SELECT days, price FROM subscriptiontype WHERE subid = ?");
    if (!$stmt) {
        echo json_encode(['error' => $mysqli->error]);
    } else {
        $stmt->bind_param("i", $subid);
        if (!$stmt->execute()) {
            echo json_encode(['error' => $stmt->error]);
        } else {
            $stmt->bind_result($days, $price);
            $stmt->fetch();
            echo json_encode(['days' => $days, 'price' => $price]);
        }
        $stmt->close();
    }
}
?>
