<?php
include "connection.php";

if (isset($_POST["submit"])) {
    $fullName = $_POST['FullName'];
    $dateOfBirth = $_POST['DateOfBirth'];
    $address = $_POST['Address'];
    $gender = $_POST['Gender'];
    $isAdmin = isset($_POST['IsAdmin']) && $_POST['IsAdmin'] == 1;

    // SQL query to insert into userdetails
    $sqlUserDetails = "INSERT INTO `userdetails` (`FullName`, `Address`, `DateOfBirth`, `Gender`) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sqlUserDetails);
    $stmt->bind_param("ssss", $fullName, $address, $dateOfBirth, $gender);

    if ($stmt->execute()) {
        $lastUserId = $mysqli->insert_id; // Get last inserted ID from userdetails

        // Check if 'Is Admin' is checked
        if ($isAdmin) {
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            // SQL query to insert into logindetails
            $sqlLoginDetails = "INSERT INTO `logindetails` (`userid`, `email`, `password`) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sqlLoginDetails);
            $stmt->bind_param("iss", $lastUserId, $email, $password);

            if ($stmt->execute()) {
                // Update userdetails to set isAdmin to 1
                $sqlUpdateAdmin = "UPDATE `userdetails` SET `Admin` = 1 WHERE `userid` = ?";
                $stmtUpdateAdmin = $mysqli->prepare($sqlUpdateAdmin);
                $stmtUpdateAdmin->bind_param("i", $lastUserId);
                $stmtUpdateAdmin->execute();
                $stmtUpdateAdmin->close();

                // Add log entry for new admin
                $logSummary = "New Admin registered ($fullName)";
                $sqlLog = "INSERT INTO `logs` (`summary`) VALUES (?)";
                $stmtLog = $mysqli->prepare($sqlLog);
                $stmtLog->bind_param("s", $logSummary);
                $stmtLog->execute();
                $stmtLog->close();

                header("Location: user_index.php?msg=Admin record created successfully");
            } else {
                echo "Failed to insert admin details: " . $mysqli->error;
            }
        } else {
            header("Location: user_index.php?msg=New record created successfully");
        }
    } else {
        echo "Failed to insert user details: " . $mysqli->error;
    }

    $stmt->close();
}
$mysqli->close();
?>
