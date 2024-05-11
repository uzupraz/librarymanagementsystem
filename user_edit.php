<?php
include "connection.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $FullName = $_POST['FullName'];
  $DateOfBirth = $_POST['DateOfBirth'];
  $Address = $_POST['Address'];
  $Gender = $_POST['Gender'];

  $sql = "UPDATE `userdetails` SET `FullName`='$FullName',`DateOfBirth`='$DateOfBirth',`Address`='$Address',`Gender`='$Gender' WHERE userid = $id";

  $result = mysqli_query($mysqli, $sql);

  if ($result) {
    header("Location: user_index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($mysqli);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .error {
      color: red;
      display: none;
    }

    .input-error {
      border-color: red;
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const submitButton = document.getElementById("submit");
      const fullName = document.getElementsByName("FullName")[0];
      const address = document.getElementsByName("Address")[0];
      const dateOfBirth = document.getElementsByName("DateOfBirth")[0];


      function validateFullName(name) {
        return name.includes(' ') && name.length >= 4;
      }

      function calculateAge(dateOfBirth) {
        const birthDate = new Date(dateOfBirth);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          return age - 1;
        }
        return age;
      }

      function displayError(input, isValid, message) {
        const errorDiv = input.nextElementSibling;
        if (input.value.trim() !== "") { // Only display errors if the user has interacted with the field
          if (!isValid) {
            input.classList.add("input-error");
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
          } else {
            input.classList.remove("input-error");
            errorDiv.style.display = 'none';
          }
        }
      }

      function updateSubmitButtonState() {
        const isFullNameValid = validateFullName(fullName.value);
        const isAddressValid = address.value.length >= 4;
        const isAgeValid = calculateAge(dateOfBirth.value) > 8;


        displayError(fullName, isFullNameValid, "Full name must include at least one space and be at least 4 characters.");
        displayError(address, isAddressValid, "Address must be at least 4 characters long.");
        displayError(dateOfBirth, isAgeValid, "User must be over 8 years old.");

      }

      fullName.addEventListener("input", updateSubmitButtonState);
      address.addEventListener("input", updateSubmitButtonState);
      dateOfBirth.addEventListener("change", updateSubmitButtonState);

      updateSubmitButtonState(); // Initial check on page load
    });
  </script>
  <title>User Details</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    User Details
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `userdetails` WHERE userid = $id LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Full Name:</label>
            <input type="text" class="form-control" name="FullName" placeholder="John Abraham" value="<?php echo htmlspecialchars($row['FullName']); ?>" required>
            <div class="error"></div>
          </div>
          <div class="col">
            <label class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" name="DateOfBirth" value="<?php echo htmlspecialchars($row['DateOfBirth']); ?>" required>
            <div class="error"></div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address:</label>
          <input type="text" class="form-control" name="Address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
          <div class="error"></div>
        </div>

        <div class="form-group mb-3">
          <label>Gender:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="Gender" id="male" value="Male" <?php echo ($row['Gender'] == 'Male') ? 'checked' : ''; ?> required>
          <label for="male" class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="Gender" id="female" value="Female" <?php echo ($row['Gender'] == 'Female') ? 'checked' : ''; ?> required>
          <label for="female" class="form-input-label">Female</label>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="user_index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>

  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>