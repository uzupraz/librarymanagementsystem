<?php
include "connection.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $bookname = $_POST['bookname'];
  $author = $_POST['book_author'];
  $publisher = $_POST['publisher'];
  $publishdate = $_POST['publishdate'];

  $sql = "UPDATE `books` SET `bookname`='$bookname',`author`='$author',`publisher`='$publisher',`publishdate`='$publishdate' WHERE bookid = $id";

  $result = mysqli_query($mysqli, $sql);

  if ($result) {
    header("Location: book_index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($mysql);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="a_dashboard.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP BOOKS Application</title>
</head>

<body>
  <?php include 'sidebar.php'; ?>
  <div class="container-fluid">



    <div class="content">
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      PHP Complete BOOKS Application
    </nav>

      <div class="text-center mb-4">
        <h3>Edit User Information</h3>
        <p class="text-muted">Click update after changing any information</p>
      </div>

      <?php
      $sql = "SELECT * FROM `books` WHERE bookid = $id LIMIT 1";
      $result = mysqli_query($mysqli, $sql);
      $row = mysqli_fetch_assoc($result);
      ?>

      <div class="container d-flex">
        <form action="" method="post" style="width:50vw; min-width:300px;">
          <div class="row mb-3">
            <div class="col">
              <label class="form-label">Book Name:</label>
              <input type="text" class="form-control" name="bookname" value="<?php echo $row['bookname'] ?>">
            </div>

            <div class="col">
              <label class="form-label">Book Author:</label>
              <input type="text" class="form-control" name="book_author" value="<?php echo $row['author'] ?>">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Publisher:</label>
            <input type="text" class="form-control" name="publisher" value="<?php echo $row['publisher'] ?>">
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Publish Date:</label>
            <input type="date" class="form-control" name="publishdate" value="<?php echo $row['publishdate'] ?>">
          </div>
          <div>
            <button type="submit" class="btn btn-success" name="submit">Update</button>
            <a href="book_index.php" class="btn btn-danger">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>