<?php
include "connection.php";
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

  <title>Book Availability</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    Book Availability
  </nav>

  <div class="container">
    <?php
    if(isset($_GET['id'])) {
      $book_id = $_GET['id'];
      $search_query = "SELECT * FROM `books` WHERE `bookid` = '$book_id'";
      $search_result = mysqli_query($mysqli, $search_query);
      
      // Check if book is found
      if (mysqli_num_rows($search_result) > 0) {
        $book = mysqli_fetch_assoc($search_result);
        ?>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Book Name</th>
              <td><?php echo $book['bookname']; ?></td>
            </tr>
            <tr>
              <th>Publisher</th>
              <td><?php echo $book['publisher']; ?></td>
            </tr>
            <tr>
              <th>Author</th>
              <td><?php echo $book['author']; ?></td>
            </tr>
            <tr>
              <th>Availability</th>
              <td><?php echo $book['available'] ? 'Yes' : 'No'; ?></td>
            </tr>
          </tbody>
        </table>
        <a href="bookshow.php" class="btn btn-primary">Go Back</a> <!-- Link to go back to search.php -->
        <?php
      } else {
        echo "<p>No book found with the given ID.</p>";
      }
    } else {
      echo "<p>No book ID provided.</p>";
    }
    ?>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
