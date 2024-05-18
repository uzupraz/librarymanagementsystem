<?php
include "connection.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $bookname = $_POST['bookname'];
    $author = $_POST['book_author'];
    $publisher = $_POST['publisher'];
    $publishdate = $_POST['publishdate'];
    $totalnumber = $_POST['totalnumber'];
    $newCategories = array_map('trim', explode(',', $_POST['categories']));

    // Start transaction
    $mysqli->begin_transaction();

    try {
        // Update the main book details
        $sql = "UPDATE books SET bookname=?, author=?, publisher=?, publishdate=? WHERE bookid=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssi", $bookname, $author, $publisher, $publishdate, $id);
        $updateBooksResult = $stmt->execute();
        $stmt->close();

        // Update the total number of books in totalbooks table
        $sqlTotal = "UPDATE totalbooks SET totalnumber=? WHERE bookid=?";
        $stmtTotal = $mysqli->prepare($sqlTotal);
        $stmtTotal->bind_param("ii", $totalnumber, $id);
        $updateTotalBooksResult = $stmtTotal->execute();
        $stmtTotal->close();

        // Fetch existing categories
        $existingCategories = [];
        $sqlFetchCategories = "SELECT category.categoryid, category.categoryname FROM categorymap JOIN category ON categorymap.categoryid = category.categoryid WHERE categorymap.bookid = ?";
        $stmtFetchCategories = $mysqli->prepare($sqlFetchCategories);
        $stmtFetchCategories->bind_param("i", $id);
        $stmtFetchCategories->execute();
        $resultFetchCategories = $stmtFetchCategories->get_result();
        while ($row = $resultFetchCategories->fetch_assoc()) {
            $existingCategories[$row['categoryid']] = $row['categoryname'];
        }
        $stmtFetchCategories->close();

        // Compare new categories with existing categories
        $categoriesToAdd = array_diff($newCategories, $existingCategories);
        $categoriesToRemove = array_diff($existingCategories, $newCategories);

        // Handle removed categories
        if (!empty($categoriesToRemove)) {
            $stmtDeleteCategories = $mysqli->prepare("DELETE FROM categorymap WHERE bookid = ? AND categoryid = ?");
            foreach ($categoriesToRemove as $categoryId => $categoryName) {
                $stmtDeleteCategories->bind_param("ii", $id, $categoryId);
                $stmtDeleteCategories->execute();
            }
            $stmtDeleteCategories->close();
        }

        // Handle new categories
        $stmtInsertCategoryMap = $mysqli->prepare("INSERT INTO categorymap (bookid, categoryid) VALUES (?, ?)");
        $stmtInsertCategory = $mysqli->prepare("INSERT INTO category (categoryname) VALUES (?)");
        foreach ($categoriesToAdd as $category) {
            $category = trim($category);
            // Check if the category already exists
            $stmtSelectCategory = $mysqli->prepare("SELECT categoryid FROM category WHERE categoryname = ?");
            $stmtSelectCategory->bind_param("s", $category);
            $stmtSelectCategory->execute();
            $stmtSelectCategory->bind_result($categoryid);
            $stmtSelectCategory->fetch();
            $stmtSelectCategory->close();

            if (!$categoryid) {
                // If the category does not exist, insert it
                $stmtInsertCategory->bind_param("s", $category);
                $stmtInsertCategory->execute();
                $categoryid = $stmtInsertCategory->insert_id;
            }

            // Insert into categorymap
            $stmtInsertCategoryMap->bind_param("ii", $id, $categoryid);
            $stmtInsertCategoryMap->execute();
        }
        $stmtInsertCategory->close();
        $stmtInsertCategoryMap->close();

        if ($updateBooksResult && $updateTotalBooksResult) {
            $mysqli->commit();
            header("Location: book_index.php?msg=Data updated successfully");
        } else {
            $mysqli->rollback();
            echo "Failed: " . mysqli_error($mysqli);
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $mysqli->rollback();
        
        // Redirect or display error message
        header("Location: book_index.php?msg=Error: " . $e->getMessage());
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP BOOKS Application</title>
</head>

<body>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
  
  <div class="container-fluid">
    <div class="content">
      <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        PHP Complete BOOKS Application
      </nav>

      <div class="text-center mb-4">
        <h3>Edit Book Information</h3>
        <p class="text-muted">Click update after changing any information</p>
      </div>

      <?php
      $sql = "SELECT books.*, totalbooks.totalnumber, GROUP_CONCAT(category.categoryname SEPARATOR ', ') as categories
              FROM books
              LEFT JOIN totalbooks ON books.bookid = totalbooks.bookid
              LEFT JOIN categorymap ON books.bookid = categorymap.bookid
              LEFT JOIN category ON categorymap.categoryid = category.categoryid
              WHERE books.bookid = ?
              GROUP BY books.bookid LIMIT 1";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $stmt->close();
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
          <div class="form-group mb-3">
            <label class="form-label">Total Number of Books:</label>
            <input type="number" class="form-control" name="totalnumber" value="<?php echo isset($row['totalnumber']) ? $row['totalnumber'] : 0; ?>" min="0" required>
          </div>
          <div class="form-group mb-3">
            <label class="form-label">Categories:</label>
            <input type="text" class="form-control" name="categories" id="categories" list="categoryList" value="<?php echo $row['categories'] ?>" placeholder="Enter categories separated by commas" required>
            <datalist id="categoryList"></datalist>
          </div>
          <div>
            <button type="submit" class="btn btn-success" name="submit">Update</button>
            <a href="book_index.php" class="btn btn-danger">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const categoryInput = document.getElementById("categories");
      const categoryList = document.getElementById("categoryList");

      // Fetch existing categories from the database
      fetch("get_categories.php")
        .then(response => response.json())
        .then(data => {
          data.forEach(category => {
            const option = document.createElement("option");
            option.value = category.categoryname;
            categoryList.appendChild(option);
          });
        })
        .catch(error => console.error("Error fetching categories:", error));

      categoryInput.addEventListener("input", function() {
        const currentValue = this.value;
        const lastCommaIndex = currentValue.lastIndexOf(',');
        const query = currentValue.substring(lastCommaIndex + 1).trim();

        // Filter and display suggestions based on the current input segment
        Array.from(categoryList.options).forEach(option => {
          if (query.length === 0) {
            option.style.display = 'none';
          } else {
            option.style.display = option.value.toLowerCase().startsWith(query.toLowerCase()) ? 'block' : 'none';
          }
        });
      });

      // Add the selected category to the input field
      categoryList.addEventListener("click", function(e) {
        if (e.target.tagName === 'OPTION') {
          const value = e.target.value;
          const categories = categoryInput.value.split(',').map(cat => cat.trim());
          categories[categories.length - 1] = value;
          categoryInput.value = categories.join(', ') + ', ';
          categoryInput.focus();
        }
      });
    });
  </script>
</body>

</html>
