<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Homepage</title>
  <link rel="stylesheet" href="a_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Librify Logo">
            <h2>Librify</h2>
        </div>
        <button onclick="showTotalUsersPage()" class="sidebar-btn">Users</button>
        <button onclick="showTotalBooksPage()" class="sidebar-btn">Books</button>
        <button onclick="showSubscriptionUsers()" class="sidebar-btn">Subscription User</button>
        <button onclick="logout()" class="sidebar-btn">Logout</button>
    </div>      
    <div class="content">
        <h1>Welcome to Admin Dashboard</h1>
        <div class="line"></div>
        <div class="stats">
          <button onclick="showTotalUsers()" class="stat-box">
            <p>Total Users</p>
            <span id="totalUsers">0</span>
          </button>
          <button onclick="showTotalBooks()" class="stat-box">
            <p>Total Books</p>
            <span id="totalBooks">0</span>
          </button>
          <button onclick="showActiveSubscriptions()" class="stat-box">
            <p>Active Subscriptions</p>
            <span id="activeSubscriptions">0</span>
          </button>
          <button onclick="showTotalInventoryBooks()" class="stat-box">
            <p>Inventory Totalbooks</p>
            <span id="totalInventoryBooks">0</span>
          </button>
          <button onclick="showTotalLentBooks()" class="stat-box">
            <p>Total Lentbooks</p>
            <span id="totalLentBooks">0</span>
          </button>
          <button onclick="showTotalReturnBooks()" class="stat-box">
            <p>Total Returnbooks</p>
            <span id="ReturnBooks">0</span>
          </button>
        </div>
    </div>

    <script src="a_dashboard.js"></script>
    <script>
        function showTotalUsersPage() {
            window.location.href = "user_index.php";
        }
        
        function showTotalBooksPage() {
            window.location.href = "book_admin.php";
        }
    </script>
</body>
</html>
