<?php
include "connection.php";
$id = $_GET["id"];

// Fetch user details from the database
$stmt = $mysqli->prepare("SELECT * FROM userdetails WHERE userid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($_POST["submit"])) {
  $FullName = $_POST['FullName'];
  $DateOfBirth = $_POST['DateOfBirth'];
  $Address = $_POST['Address'];
  $Gender = $_POST['Gender'];
  $Email = $_POST['Email'];
  $CurrentPassword = $_POST['CurrentPassword'];
  $NewPassword = $_POST['NewPassword'];

  // Validate if the new password is different from the current one
  if ($CurrentPassword !== $NewPassword) {
    // Proceed with updating the database
    $stmt = $mysqli->prepare("UPDATE userdetails 
                              JOIN logindetails ON userdetails.userid = logindetails.userid 
                              SET userdetails.FullName=?, 
                                  userdetails.DateOfBirth=?, 
                                  userdetails.Address=?, 
                                  userdetails.Gender=?, 
                                  logindetails.Email=?, 
                                  logindetails.Password=? 
                              WHERE userdetails.userid = ?");
    $stmt->bind_param("ssssssi", $FullName, $DateOfBirth, $Address, $Gender, $Email, $NewPassword, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      header("Location: index.php?msg=Data updated successfully");
      exit();
    } else {
      echo "Failed to update data.";
    }
  } else {
    echo "New password cannot be the same as the current password.";
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="container-fluid">
  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>
    <div class="content">

      <div class="container">
        <div class="text-center mb-4">
          <h3>Edit User Information</h3>
          <p class="text-muted">Click update after changing any information</p>
        </div>

        <div class="container d-flex justify-content-center">
          <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
              <div class="col">
                <label class="form-label">Full Name:</label>
                <input type="text" class="form-control" name="FullName" value="<?php echo isset($row['FullName']) ? $row['FullName'] : ''; ?>">
              </div>

              <div class="col">
                <label class="form-label">DateOfBirth:</label>
                <input type="date" class="form-control" name="DateOfBirth" value="<?php echo isset($row['DateOfBirth']) ? $row['DateOfBirth'] : ''; ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Address:</label>
              <input type="Address" class="form-control" name="Address" value="<?php echo isset($row['Address']) ? $row['Address'] : ''; ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Email:</label>
              <input type="email" class="form-control" name="Email" value="<?php echo isset($row['Email']) ? $row['Email'] : ''; ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Current Password:</label>
              <input type="password" class="form-control" name="CurrentPassword">
            </div>

            <div class="mb-3">
              <label class="form-label">New Password:</label>
              <input type="password" class="form-control" name="NewPassword">
            </div>

            <div class="form-group mb-3">
              <label>Gender:</label>
              &nbsp;
              <input type="radio" class="form-check-input" name="Gender" id="male" value="male" <?php echo (isset($row["Gender"]) && $row["Gender"] == 'male') ? "checked" : ""; ?>>
              <label for="male" class="form-input-label">Male</label>
              &nbsp;
              <input type="radio" class="form-check-input" name="Gender" id="female" value="female" <?php echo (isset($row["Gender"]) && $row["Gender"] == 'female') ? "checked" : ""; ?>>
              <label for="female" class="form-input-label">Female</label>
            </div>

            <div>
              <button type="submit" class="btn btn-success" name="submit">Update</button>
              <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
