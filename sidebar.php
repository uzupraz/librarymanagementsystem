<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Homepage</title>
  <!-- Add Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Add Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Custom CSS -->
  <style>
    .sidebar {
      height: 100vh;
      background-color: #e2f9fe; /* Light blue background */
      padding: 20px 40px; /* Increase left padding to move logo to the right */
      position: fixed; /* Fixed positioning */
      left: 0; /* Align to the left */
      top: 0; /* Align to the top */
    }

    .sidebar-logo {
      margin-bottom: 20px;
      margin-left: 30px;
    }

    .sidebar-logo img {
      max-width: 100px;
      max-height: 100px;
    }

    .librify-name {
      font-size: 16px;
      color: #333; /* Dark gray color */
      text-align: center;
    }

    .btn-group-vertical {
      margin-top: 20px; /* Add space between logo and buttons */
    }

    .btn {
      background-color: #50dbfe; /* Blue button color */
      color: #fff; /* White text color */
      margin-bottom: 40px; /* Add more space between buttons */
    }

    .btn:hover {
      background-color: #0056b3; /* Darker blue color on hover */
    }
  </style>
</head>
<body>
<div class="sidebar">
  <div class="sidebar-logo">
    <img src="logo.png" alt="Librify Logo" class="img-fluid">
  </div>
  <div class="librify-name">
    Librify
  </div>
  <div class="btn-group-vertical p-3" role="group">
    <button onclick="showDashboard()" class="btn btn-outline-primary w-100">Dashboard</button>
    <button onclick="showTotalUsersPage()" class="btn btn-outline-primary w-100">Users</button>
    <button onclick="showTotalBooks()" class="btn btn-outline-primary w-100">Books</button>
    <button onclick="showActiveSubscriptions()" class="btn btn-outline-primary w-100">Subscription Users</button>
    <button onclick="logout()" class="btn btn-outline-danger w-100">Logout</button>
  </div>
</div>

<script>
  function showDashboard() {
    // Redirect to dashboard page
    window.location.href = "admin_dashboard.php";
  }

  function showTotalUsersPage() {
    // Redirect to total users page
    window.location.href = "user_index.php";
  }

  function showTotalBooks() {
    // Redirect to total books page
    window.location.href = "book_index.php";
  }

  function showActiveSubscriptions() {
    // Redirect to active subscriptions page
    window.location.href = "subscriptions.php";
  }

  function logout() {
    // Perform logout functionality
    window.location.href = "logout.php";
  }
</script>

</body>
</html>
