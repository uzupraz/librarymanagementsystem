<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Homepage</title>
  <!-- Add Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    .content {
      margin-top: 90px; /* Adjust top margin to start from 70px */
    }

    .stats {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 20px;
      margin-top: 30px; /* Add margin to move buttons further down */
      margin-left: -220px; /* Adjust left margin to move buttons to the left */
    }

    .stat-box {
      width: calc(25% - 20px); /* Adjust width as needed */
      height: 150px; /* Adjust height as needed */
      border-radius: 20px; /* Rounded corners */
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .stat-box:hover {
      background-color: #ADD8E6 !important; /* Light blue background color on hover */
    }

    .stat-box img {
      max-width: 50px; /* Adjust logo size */
      max-height: 50px; /* Adjust logo size */
    }

    h1 {
      margin-bottom: 20px; /* Add margin to move text below */
      text-align: left; /* Align text to the left */
      margin-left: -90px; /* Adjust left margin to move text to the left */
    }

    .dropdown-menu {
      background-color: #ADD8E6; /* Light blue background color */
    }

    .dropdown-menu a:hover {
      background-color: #87CEFA; /* Light sky blue background color on hover */
    }
  </style>
</head>
<body>
<?php include 'header.php'; ?> <!-- Include header -->

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="sidebar">
        <?php include 'nav.php'; ?> <!-- Include navigation -->
      </div>
    </div>
    <div class="col-md-9">
      <div class="content">
        <h1>Welcome to Admin Dashboard</h1> <!-- Moved text to the left -->
        <div class="line"></div>
        <div class="stats">
          <div onclick="showTotalUsersPage()" class="stat-box btn" style="background-color: #FFAC81;">
            <span>Total Users</span>
            <img src="user.png" alt="Total Users Icon">
          </div>
          <div onclick="showTotalBooks()" class="stat-box btn" style="background-color: #FFD3B6;">
            <span>Total Books</span>
            <img src="book.png" alt="Total Books Icon">
          </div>
          <div onclick="showActiveSubscriptions()" class="stat-box btn" style="background-color: #FF9AA2;">
            <span>Active Subscriptions</span>
            <img src="subscription.png" alt="Active Subscriptions Icon">
          </div>
          <div onclick="showTotalInventoryBooks()" class="stat-box btn" style="background-color: #B5EAD7;">
            <span>Total Inventory Books</span>
            <img src="inventory.png" alt="Total Inventory Books Icon">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Your JavaScript for redirect functions -->
<script>
  function showTotalUsersPage() {
    window.location.href = "user_index.php";
  }

  function showTotalBooks() {
    window.location.href = "book_index.php";
  }

  function showActiveSubscriptions() {
    window.location.href = "subscriptions.php";
  }

  function showTotalInventoryBooks() {
    window.location.href = "inventory_books.php";
  }
</script>
</body>
</html>
