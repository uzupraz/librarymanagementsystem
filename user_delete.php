<?php
include "connection.php";

// Get the user ID from the URL
$id = $_GET["id"];

// Begin a transaction
$mysqli->begin_transaction();

try {
    // Update the 'Deleted' field to 1 for the specified user ID
    $sqlUpdateUser = "UPDATE `userdetails` SET `Deleted` = 1 WHERE `userid` = ?";
    $stmtUpdateUser = $mysqli->prepare($sqlUpdateUser);
    $stmtUpdateUser->bind_param("i", $id);
    $stmtUpdateUser->execute();

    // Check if the user has a record in the 'logindetails' table and delete it if exists
    $sqlCheckLogin = "SELECT COUNT(*) FROM `logindetails` WHERE `userid` = ?";
    $stmtCheckLogin = $mysqli->prepare($sqlCheckLogin);
    $stmtCheckLogin->bind_param("i", $id);
    $stmtCheckLogin->execute();
    $stmtCheckLogin->bind_result($count);
    $stmtCheckLogin->fetch();
    $stmtCheckLogin->close();

    if ($count > 0) {
        // Delete from 'logindetails'
        $sqlDeleteLogin = "DELETE FROM `logindetails` WHERE `userid` = ?";
        $stmtDeleteLogin = $mysqli->prepare($sqlDeleteLogin);
        $stmtDeleteLogin->bind_param("i", $id);
        $stmtDeleteLogin->execute();
        $stmtDeleteLogin->close();

        // Update 'isAdmin' field to 0
        $sqlUpdateAdmin = "UPDATE `userdetails` SET `Admin` = 0 WHERE `userid` = ?";
        $stmtUpdateAdmin = $mysqli->prepare($sqlUpdateAdmin);
        $stmtUpdateAdmin->bind_param("i", $id);
        $stmtUpdateAdmin->execute();
        $stmtUpdateAdmin->close();
    }

    // Commit the transaction
    $mysqli->commit();

    // Redirect with success message
    header("Location: user_index.php?msg=User Deleted Successfully");
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mysqli->rollback();
    echo "Failed: " . $e->getMessage();
}

// Close the update statement
$stmtUpdateUser->close();
$mysqli->close();
?>
