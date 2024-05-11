<?php
include "connection.php";

if (isset($_POST["submit"])) {
    $fullName = $_POST['FullName'];
    $dateOfBirth = $_POST['DateOfBirth'];
    $address = $_POST['Address'];
    $gender = $_POST['Gender'];
    $isAdmin = isset($_POST['IsAdmin']) && $_POST['IsAdmin'] == 1;
    


    // SQL query to insert into userdetails
    $sqlUserDetails = "INSERT INTO `UserDetails` (`FullName`, `Address`, `DateOfBirth`, `Gender`) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sqlUserDetails);
    $stmt->bind_param("ssss", $fullName, $address, $dateOfBirth, $gender);



    if ($stmt->execute()) {

        // Check if 'Is Admin' is checked
        if ($isAdmin) {
            $lastUserId = $mysqli->insert_id; // Get last inserted ID from userdetails
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            // SQL query to insert into logindetails
            $sqlLoginDetails = "INSERT INTO `logindetails` (`userid`, `email`, `password`) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sqlLoginDetails);
            $stmt->bind_param("iss", $lastUserId, $email, $password);

            if ($stmt->execute()) {
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
