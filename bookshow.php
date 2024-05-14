<?php
include "connection.php";

// Handling book search
if(isset($_POST['search'])){
  $search = $_POST['search'];
  $search_query = "SELECT * FROM `books` WHERE `bookname` LIKE '$search%'";
  $search_result = mysqli_query($mysqli, $search_query);
}

if(isset($_GET['id'])) {
    $bookId = $_GET['id'];
    $book_query = "SELECT * FROM `books` WHERE `bookid` = $bookId";
    $book_result = mysqli_query($mysqli, $book_query);
    if(mysqli_num_rows($book_result) > 0) {
      $book = mysqli_fetch_assoc($book_result);
      echo "<h4>Book Details</h4>";
      echo "<table class='table table-hover'>";
      echo "<tbody>";
      echo "<tr><td><b>Book Name:</b></td><td>{$book['bookname']}</td></tr>";
      echo "<tr><td><b>Author:</b></td><td>{$book['author']}</td></tr>";
      echo "<tr><td><b>Publisher:</b></td><td>{$book['publisher']}</td></tr>";
      echo "<tr><td><b>Availability:</b></td><td>{$book['availability']}</td></tr>";
      echo "</tbody>";
      echo "</table>";

    } else {
      echo "<p>Book details not found.</p>";
    }
  }

// Retrieve total number of books and lent books
$total_books_query = "SELECT COUNT(*) AS total_books FROM books";
$total_lent_books_query = "SELECT COUNT(*) AS total_lent_books FROM lentbooks";
$total_books_result = mysqli_query($mysqli, $total_books_query);
$total_lent_books_result = mysqli_query($mysqli, $total_lent_books_query);
$total_books_row = mysqli_fetch_assoc($total_books_result);
$total_lent_books_row = mysqli_fetch_assoc($total_lent_books_result);
$total_books = $total_books_row['total_books'];
$total_lent_books = $total_lent_books_row['total_lent_books'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Available Books</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <style>
    .book-link {
      cursor: pointer;
    }
    .book-details {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
     <!-- Total Books and Lent Books -->
     <h4>Available Books</h4>
    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">Total Books</th>
          <th scope="col">Total Lent Books</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $total_books; ?></td>
          <td><?php echo $total_lent_books; ?></td>
        </tr>
      </tbody>
    </table>
   
    
    <!-- Search form -->
    <form method="POST" class="mb-3">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for a book" name="search" id="searchInput" autocomplete="off">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>

    <!-- Display search results -->
    <div id="searchResults"></div>
    <a href="admin_dashboard.php" class="btn btn-primary">Go Back</a>

    <!-- Display book details -->
    <div class="book-details" id="bookDetails"></div>
  </div>
    
      
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const bookDetails = document.getElementById('bookDetails');


    // Function to display book details
    // Function to display book details
function displayBookDetails(bookId) {
  fetch(`book_details.php?id=${bookId}`)
    .then(response => response.json()) // Parse response as JSON
    .then(data => {
      // Construct HTML table with Bootstrap styling for displaying book details
      const html = `
        <h4>Book Details</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <th class="bg-primary text-white">Book Name</th>
                <td>${data.bookname}</td>
              </tr>
              <tr>
                <th class="bg-primary text-white">Author</th>
                <td>${data.author}</td>
              </tr>
              <tr>
                <th class="bg-primary text-white">Publisher</th>
                <td>${data.publisher}</td>
              </tr>
              <tr>
                <th class="bg-primary text-white">Availability</th>
                <td>${data.availability}</td>
              </tr>
            </tbody>
          </table>
        </div>`;
      // Update bookDetails div with the constructed HTML
      bookDetails.innerHTML = html;
    })
    .catch(error => {
      console.error('Error:', error);
    });
}


    function handleBookClick(event) {
      const target = event.target;
      if (target.classList.contains('book-link')) {
        const bookId = target.dataset.bookId;
        displayBookDetails(bookId);
      }
    }

    searchResults.addEventListener('click', handleBookClick);

searchInput.addEventListener('input', function() {
  const searchValue = this.value.trim();
  if (searchValue !== '') {
    fetch(`search.php?search=${searchValue}`)
      .then(response => response.text())
      .then(data => {
        searchResults.innerHTML = data;
      })
      .catch(error => {
        console.error('Error:', error);
      });
  } else {
    searchResults.innerHTML = '';
  }
});

// Click event for book links
searchResults.addEventListener('click', function(event) {
  const target = event.target;
  if (target.classList.contains('book-link')) {
    const bookId = target.dataset.bookId;
    window.location.href = `book_details.php?id=${bookId}`;
  }
});

// Event listener for enter key press
searchInput.addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
    const selectedBook = document.querySelector('.book-link.active');
    if (selectedBook) {
      const bookId = selectedBook.dataset.bookId;
      window.location.href = `book_details.php?id=${bookId}`;
    }
  }
});

// Highlight selected book
searchResults.addEventListener('mouseover', function(event) {
  const target = event.target;
  if (target.classList.contains('book-link')) {
    const activeBook = document.querySelector('.book-link.active');
    if (activeBook) {
      activeBook.classList.remove('active');
    }
    target.classList.add('active');
  }
});

  </script>
  
  
</body>
</html>
