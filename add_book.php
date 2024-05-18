<?php
include "connection.php";

if (isset($_POST["submit"])) {
    $bookname = $_POST['book_name'];
    $author = $_POST['book_author'];
    $publisher = $_POST['publisher'];
    $publishdate = $_POST['publish_date'];
    $numberOfBooks = $_POST['number_of_books'];
    $categories = explode(',', $_POST["categories"]);

    // Start transaction
    $mysqli->begin_transaction();

    try {
        // Check if the book already exists
        $stmt = $mysqli->prepare("SELECT books.bookid, totalbooks.totalnumber FROM books JOIN totalbooks ON books.bookid = totalbooks.bookid WHERE bookname = ? AND author = ?");
        $stmt->bind_param("ss", $bookname, $author);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Add log entry for new admin
        $logSummary = "New Book added ($bookname)";
        $sqlLog = "INSERT INTO `logs` (`summary`) VALUES (?)";
        $stmtLog = $mysqli->prepare($sqlLog);
        $stmtLog->bind_param("s", $logSummary);
        $stmtLog->execute();
        $stmtLog->close();

        if ($result->num_rows > 0) {
            // If the book exists, update the total number of books
            $book = $result->fetch_assoc();
            $newTotal = $book['totalnumber'] + $numberOfBooks;
            $bookId = $book['bookid'];
            $stmtUpdate = $mysqli->prepare("UPDATE totalbooks SET totalnumber = ? WHERE bookid = ?");
            $stmtUpdate->bind_param("ii", $newTotal, $bookId);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            // If the book does not exist, insert new book and total
            $stmtInsert = $mysqli->prepare("INSERT INTO books (bookname, author, publisher, publishdate) VALUES (?, ?, ?, ?)");
            $stmtInsert->bind_param("ssss", $bookname, $author, $publisher, $publishdate);
            $stmtInsert->execute();
            $bookId = $stmtInsert->insert_id;
            $stmtInsert->close();

            $stmtTotalBooks = $mysqli->prepare("INSERT INTO totalbooks (bookid, totalnumber) VALUES (?, ?)");
            $stmtTotalBooks->bind_param("ii", $bookId, $numberOfBooks);
            $stmtTotalBooks->execute();
            $stmtTotalBooks->close();
        }

        // Handle the categories and add to categorymap
        foreach ($categories as $category) {
            $category = trim($category);

            // Check if the category exists
            $stmt = $mysqli->prepare("SELECT categoryid FROM category WHERE categoryname = ?");
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $stmt->bind_result($category_id);
            $stmt->fetch();
            $stmt->close();

            // If the category does not exist, insert it into the category table
            if (!$category_id) {
                $stmt = $mysqli->prepare("INSERT INTO category (categoryname) VALUES (?)");
                $stmt->bind_param("s", $category);
                $stmt->execute();
                $category_id = $stmt->insert_id;
                $stmt->close();
            }

            // Insert into categorymap
            $stmt = $mysqli->prepare("INSERT INTO categorymap (bookid, categoryid) VALUES (?, ?)");
            $stmt->bind_param("ii", $bookId, $category_id);
            $stmt->execute();
            $stmt->close();
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
