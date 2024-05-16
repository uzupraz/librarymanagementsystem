<?php
include "connection.php";

function getBookDetails($bookid, $mysqli)
{
    $stmt = $mysqli->prepare("SELECT bookname, author FROM books WHERE bookid = ?");
    $stmt->bind_param("i", $bookid);
    $stmt->execute();
    $stmt->bind_result($bookname, $author);
    $stmt->fetch();
    $stmt->close();
    return [$bookname, $author];
}

function getUserDetails($userid, $mysqli)
{
    $stmt = $mysqli->prepare("SELECT FullName FROM userdetails WHERE userid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $stmt->bind_result($FullName);
    $stmt->fetch();
    $stmt->close();
    return $FullName;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actively Lent Books</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <h1 class="text-center mb-4">Actively Lent Books</h1>

        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
        ?>
        <!-- Lend and return book buttons -->
        

      
        <div class="container">
        <a href="lend.php" class="btn btn-success">Lend Book</a>
            <a href="return.php" class="btn btn-warning">Return Book</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Book Author</th>
                        <th scope="col">Lent Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM lentbooks WHERE status = 'lent'";
                    $result = mysqli_query($mysqli, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        list($bookname, $author) = getBookDetails($row["bookid"], $mysqli);
                        $username = getUserDetails($row["userid"], $mysqli);
                        $overdueStatus = (strtotime($row['returndate']) < time()) ? 'Overdue' : 'Not Overdue';
                    ?>
                        <tr>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $bookname; ?></td>
                            <td><?php echo $author; ?></td>
                            <td><?php echo $row['lenddate']; ?></td>
                            <td><?php echo $row['returndate']; ?></td>
                            <td><?php echo $overdueStatus; ?></td>
                            <td>
                                <!-- Update and delete buttons -->
                                <a href="delete_lent_book.php?id=<?php echo $row['lentid']; ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>




    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>