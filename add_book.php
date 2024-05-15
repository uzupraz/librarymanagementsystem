<?php
include "connection.php";


if (isset($_POST["submit"])) {
    $bookname = $_POST['book_name'];
    $author = $_POST['book_author'];
    $publisher = $_POST['publisher'];
    $publishdate = $_POST['publish_date'];
    $numberOfBooks = $_POST['number_of_books'];

    // Start transaction
    $mysqli->begin_transaction();

    try {
        // Check if the book already exists
        $stmt = $mysqli->prepare("SELECT books.bookid, totalbooks.totalnumber FROM books JOIN totalbooks ON books.bookid = totalbooks.bookid WHERE bookname = ? AND author = ?");
        $stmt->bind_param("ss", $bookname, $author);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // If the book exists, update the total number of books
            $book = $result->fetch_assoc();
            $newTotal = $book['totalnumber'] + $numberOfBooks;
            $stmtUpdate = $mysqli->prepare("UPDATE totalbooks SET totalnumber = ? WHERE bookid = ?");
            $stmtUpdate->bind_param("ii", $newTotal, $book['bookid']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            // If the book does not exist, insert new book and total
            $stmtInsert = $mysqli->prepare("INSERT INTO books (bookname, author, publisher, publishdate) VALUES (?, ?, ?, ?)");
            $stmtInsert->bind_param("ssss", $bookname, $author, $publisher, $publishdate);
            $stmtInsert->execute();
            $lastBookId = $mysqli->insert_id;
            $stmtInsert->close();

            $stmtTotalBooks = $mysqli->prepare("INSERT INTO totalbooks (bookid, totalnumber) VALUES (?, ?)");
            $stmtTotalBooks->bind_param("ii", $lastBookId, $numberOfBooks);
            $stmtTotalBooks->execute();
            $stmtTotalBooks->close();
        }

        // Commit the transaction
        $mysqli->commit();
        
        // Redirect to book_index.php with a success message
        header("Location: book_index.php?msg=Book added successfully");
        exit();  // Ensure no further execution after redirection
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $mysqli->rollback();
        
        // Redirect or display error message
        header("Location: book_index.php?msg=Error: " . $e->getMessage());
        exit();
    }
} else {
    echo "Form not submitted";
}

$mysqli->close();
?>
