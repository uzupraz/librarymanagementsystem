<?php
include "connection.php";

if (isset($_POST["submit"])) {
   $FullName = $_POST['FullName'];
   $DateOfBirth= $_POST['DateOfBirth'];
   $Address = $_POST['Address'];
   $Gender = $_POST['Gender'];

   $sql = "INSERT INTO `userdetails`( `FullName`, `DateOfBirth`, `Address`, `Gender`) VALUES ('$FullName','$DateOfBirth','$Address','$Gender')";

   $result = mysqli_query($mysqli, $sql);

   if ($result) {
      header("Location: user_index.php?msg=New record created successfully");
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

   <title>User Application</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      User Application
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <!-- <h3>Add New User</h3> -->
         <p class="text-muted">Complete the below form</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Full Name:</label>
                  <input type="text" class="form-control" name="FullName" placeholder="John Abharam">
               </div>

               <div class="col">
                  <label class="form-label">DateOfBirth:</label>
                  <!-- <input type="text" class="form-control" name="DateOfBirth" pattern="\d{4}-\d{2}-\d{2}" placeholder="YYYY-MM-DD" title="Enter date in YYYY-MM-DD format" required> -->
                  <input type="date" class="form-control" name="DateOfBirth" placeholder="mm/dd/yyy">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Address:</label>
               <input type="Address" class="form-control" name="Address" placeholder="123 Elm Street">
            </div>

            <div class="form-group mb-3">
               <label>Gender:</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="Gender" id="male" value="male">
               <label for="male" class="form-input-label">Male</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="Gender" id="female" value="female">
               <label for="female" class="form-input-label">Female</label>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="user_index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>