<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Homepage</title>
  <link rel="stylesheet" href="a_dashboard.css">
</head>
<body>
    <!-- <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Librify Logo">
            <h2>Librify</h2>
        </div>
        <button onclick="showTotalUsersPage()" class="sidebar-btn">Users</button>
        <button onclick="TotalBooksPage()" class="sidebar-btn">Books</button>
        <button onclick="showSubscriptionUsers()" class="sidebar-btn">Subscription User</button>
        <button onclick="logout()" class="sidebar-btn">Logout</button>
        
    </div>       -->
    <?php include 'sidebar.php'?>
    <div class="content">
        <h1>Welcome to Admin Dashboard</h1>
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
