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
    <title>View Lent Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>PHP BOOKS Application</title>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="container-fluid">
        <div class="content">
            <h2 class="mb-3">Lent Books</h2>

            <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            ?>

            <table class="table text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Lent Date</th>
                        <th scope="col">Expected Return Date</th>
                        <th scope="col">Actual Return Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM lentbooks";
                    $result = mysqli_query($mysqli, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        list($bookname, $author) = getBookDetails($row["bookid"], $mysqli);
                        $username = getUserDetails($row["userid"], $mysqli);
                    ?>
                        <tr>
                            <td><?php echo $bookname; ?></td>
                            <td><?php echo $author; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $row["lenddate"]; ?></td>
                            <td><?php echo $row["returndate"]; ?></td>
                            <td><?php echo $row["actualreturndate"] ? $row["actualreturndate"] : "N/A"; ?></td>
                            <td><?php echo ucfirst($row["status"]); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
