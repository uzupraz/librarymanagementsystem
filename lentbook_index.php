<?php
include "connection.php";

function getBookDetails($bookid, $mysqli) {
    $stmt = $mysqli->prepare("SELECT bookname, author FROM books WHERE bookid = ?");
    $stmt->bind_param("i", $bookid);
    $stmt->execute();
    $stmt->bind_result($bookname, $author);
    $stmt->fetch();
    $stmt->close();
    return [$bookname, $author];
}

function getUserDetails($userid, $mysqli) {
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
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Actively Lent Books</h1>

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
                            <a href="update_lent_book.php?id=<?php echo $row['lentid']; ?>" class="btn btn-primary btn-sm">Update</a>
                            <a href="delete_lent_book.php?id=<?php echo $row['lentid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-- Lend and return book buttons -->
        <div class="text-center">
            <a href="lend.php" class="btn btn-success">Lend Book</a>
            <a href="return.php" class="btn btn-warning">Return Book</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
