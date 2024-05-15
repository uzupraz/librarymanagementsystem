<?php include 'header.php'; ?>
<!-- Sidebar Column -->
<?php include 'sidebar.php'; ?>


<!-- Dashboard Content -->
<div class="content" style="flex: 1; display: flex; justify-content: center; align-items: center;">
  <div class="stats">
    <div onclick="showTotalUsersPage()" class="stat-box btn" style="background-color: #FFAC81; width: 200px; height: 150px; margin-right: 20px;">
      <span>Total Users</span>
      <img src="user.png" alt="Total Users Icon" style="width: 50px; height: 50px;">
    </div>
    <div onclick="showTotalBooks()" class="stat-box btn" style="background-color: #FFD3B6; width: 200px; height: 150px; margin-right: 20px;">
      <span>Total Books</span>
      <img src="book.png" alt="Total Books Icon" style="width: 50px; height: 50px;">
    </div>
    <div onclick="showActiveSubscriptions()" class="stat-box btn" style="background-color: #FF9AA2; width: 200px; height: 150px; margin-right: 20px;">
      <span>Active Subscriptions</span>
      <img src="subscription.png" alt="Active Subscriptions Icon" style="width: 50px; height: 50px;">
    </div>
    <div onclick="showTotalInventoryBooks()" class="stat-box btn" style="background-color: #B5EAD7; width: 200px; height: 150px;">
      <span>Total Inventory Books</span>
      <img src="inventory.png" alt="Total Inventory Books Icon" style="width: 50px; height: 50px;">
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