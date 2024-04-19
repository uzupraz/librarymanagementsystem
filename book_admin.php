<?php
include "connection.php";

if (isset($_POST["submit"])) {
   $bookname = $_POST['book_name'];
   $author = $_POST['book_author'];
   $publisher = $_POST['publisher'];
   $publishdate = $_POST['publish_date'];

   $sql = "INSERT INTO `books` (`bookname`, `author`, `publisher`, `publishdate`) VALUES ('$bookname', '$author', '$publisher', '$publishdate')";

   $result = mysqli_query($mysqli, $sql);

   if ($result) {
      header("Location: book_index.php?msg=New record created successfully");
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

   <title>PHP BOOKS Application</title>
</head>

<body>
 

   <div class="container">
      <div class="text-center mb-4" style="background-color: #00ff5573;">
         <h3>Add Book</h3>
         <!-- <p class="text-muted">Complete the form below to add a book</p> -->
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Book Name:</label>
                  <input type="text" class="form-control" name="book_name" placeholder="Love Story">
               </div>

               <div class="col">
                  <label class="form-label">Book Author:</label>
                  <input type="text" class="form-control" name="book_author" placeholder="Ashley Poston">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Publisher:</label>
               <input type="text" class="form-control" name="publisher" placeholder="Asmita Publication">
            </div>
            <div class="form-group mb-3">
               <label class="form-label">Publish Date:</label>
               <input type="date" class="form-control" name="publish_date" placeholder="Asmita Publication">
            </div>

            <!-- <div class="form-group mb-3">
               <label>publish_date:</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="publish_date" id="male" value="male">
               <label for="male" class="form-input-label">Male</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="publish_date" id="female" value="female">
               <label for="female" class="form-input-label">Female</label>
            </div> -->

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="book_index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>