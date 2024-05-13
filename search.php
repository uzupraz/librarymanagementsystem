<?php
include "connection.php";

if(isset($_GET['search'])) {
  $search = $_GET['search'];
  $search_query = "SELECT * FROM `books` WHERE `bookname` LIKE '%$search%' LIMIT 10";
  $search_result = mysqli_query($mysqli, $search_query);
  if(mysqli_num_rows($search_result) > 0) {
    echo "<ul class='list-group'>";
    while($row = mysqli_fetch_assoc($search_result)) {
      echo "<li class='list-group-item book-link' data-book-id='{$row['bookid']}'>{$row['bookname']}</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>No results found.</p>";
  }
}
?>