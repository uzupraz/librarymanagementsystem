<?php
include 'connection.php';

// SQL to fetch the currently lent books
$sql = "SELECT 
            Books.bookname, 
            LentBooks.lenddate, 
            LentBooks.returndate, 
            Books.author, 
            UserDetails.FullName as username 
        FROM 
            LentBooks 
        INNER JOIN Books ON LentBooks.bookid = Books.bookid
        INNER JOIN UserDetails ON LentBooks.userid = UserDetails.userid
        WHERE 
            LentBooks.returndate >= CURDATE()";

$result = $mysqli->query($sql);

// Removed the 'echo $result;' line as it's incorrect
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lent Books</title>
</head>
<body>
  <h1>Currently Lent Books</h1>
  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Book Name</th>
          <th>Lent Date</th>
          <th>Return Date</th>
          <th>Author</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['bookname']) ?></td>
            <td><?= htmlspecialchars($row['lenddate']) ?></td>
            <td><?= htmlspecialchars($row['returndate']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No books are currently lent out.</p>
  <?php endif; ?>
  <?php $mysqli->close(); ?>
</body>
</html>