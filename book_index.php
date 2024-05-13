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
  <link rel="stylesheet" href="a_dashboard.css">

  <title>PHP BOOKS Application</title>
</head>

<body>

    <script>
         function showTotalUsersPage() {
            window.location.href = "user_index.php";
        }

        function TotalBooksPage() {
            window.location.href = "book_index.php";
        }
        function logout() {
            window.location.href = "login.php"; // Redirect to login page
        }

        function showTotalBooks(){
          window.location.href = "bookshow.php"
        }
    </script>
 
<button class="btn btn-primary" onclick="goBack()">Back</button>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>
  <div class="container">
  <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Librify Logo">
            <h2>Librify</h2>
        </div>
        <button onclick="showTotalUsersPage()" class="sidebar-btn">Users</button>
        <button onclick="TotalBooksPage()" class="sidebar-btn">Books</button>
        <button onclick="showSubscriptionUsers()" class="sidebar-btn">Subscription User</button>
        <button onclick="logout()" class="sidebar-btn">Logout</button>
        
    </div> 
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <a href="book_admin.php" class="btn btn-dark mb-3">Add Book</a>

    <table class="table text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Book Name</th>
          <th scope="col">Book Author</th>
          <th scope="col">Publisher</th>
          <th scope="col">Publish Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `books`";
        $result = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["bookname"] ?></td>
            <td><?php echo $row["author"] ?></td>
            <td><?php echo $row["publisher"] ?></td>
            <td><?php echo $row["publishdate"] ?></td>
            <td>
              <a href="book_edit.php?id=<?php echo $row["bookid"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="book_delete.php?id=<?php echo $row["bookid"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>