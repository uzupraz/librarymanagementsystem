<?php
include "connection.php";

function getAvailableBooks($bookid, $mysqli)
{
  $totalnumber = 0;
  $lentCount = 0;
  // Query to get the total number of books from the totalbooks table
  $stmt = $mysqli->prepare("SELECT totalnumber FROM totalbooks WHERE bookid = ?");
  if (!$stmt) {
    return "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
  }
  $stmt->bind_param("i", $bookid);
  if (!$stmt->execute()) {
    return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  $stmt->bind_result($totalnumber);
  $stmt->fetch();
  $stmt->close();

  // Query to count the number of books currently lent out with status 'lent' or 'overdue'
  $stmt = $mysqli->prepare("SELECT COUNT(*) FROM lentbooks WHERE bookid = ? AND (status = 'lent' OR status = 'overdue')");
  if (!$stmt) {
    return "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
  }
  $stmt->bind_param("i", $bookid);
  if (!$stmt->execute()) {
    return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  $stmt->bind_result($lentCount);
  $stmt->fetch();
  $stmt->close();

  // Calculate available books by subtracting the lent count from the total number
  $availableBooks = $totalnumber - $lentCount;
  return "$availableBooks out of $totalnumber";
}

function getBookCategories($bookid, $mysqli)
{
  $categories = [];
  $stmt = $mysqli->prepare("SELECT category.categoryname FROM categorymap JOIN category ON categorymap.categoryid = category.categoryid WHERE categorymap.bookid = ?");
  if (!$stmt) {
    return "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
  }
  $stmt->bind_param("i", $bookid);
  if (!$stmt->execute()) {
    return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
  }
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $categories[] = $row['categoryname'];
  }
  $stmt->close();

  return implode(', ', $categories);
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
  <link rel="stylesheet" href="css/style.css">
  <title>PHP BOOKS Application</title>
</head>

<body>
  <div class="container-fluid">
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    <div class="content">
      <div class="container">
        <?php
        if (isset($_GET["msg"])) {
          $msg = $_GET["msg"];
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
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
              <th scope="col">Available Books</th>
              <th scope="col">Categories</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM `books`";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              $availableBooks = getAvailableBooks($row["bookid"], $mysqli);
              $categories = getBookCategories($row["bookid"], $mysqli);
            ?>
              <tr>
                <td><?php echo $row["bookname"]; ?></td>
                <td><?php echo $row["author"]; ?></td>
                <td><?php echo $row["publisher"]; ?></td>
                <td><?php echo $row["publishdate"]; ?></td>
                <td><?php echo $availableBooks; ?></td>
                <td><?php echo $categories; ?></td>
                <td>
                  <a href="book_edit.php?id=<?php echo $row["bookid"]; ?>" class="link-dark">
                    <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                  </a>
                  <a href="book_delete.php?id=<?php echo $row["bookid"]; ?>" class="link-dark">
                    <i class="fa-solid fa-trash fs-5"></i>
                  </a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
