<div class="container-fluid">
  <?php include 'header.php'; ?>
  <!-- Sidebar Column -->
  <?php include 'sidebar.php'; ?>


  <!-- Dashboard Content -->
  <div class="content">
    <div class="container">
      <div class="stats">
        <div onclick="showTotalUsersPage()" class="stat-box btn" style="background-color: #FFAC81; width: 200px; height: 150px; margin-right: 20px;">
          <span>Total Users</span>
          <img src="img/user.png" alt="Total Users Icon" style="width: 50px; height: 50px;">
        </div>
        <div onclick="showTotalBooks()" class="stat-box btn" style="background-color: #FFD3B6; width: 200px; height: 150px; margin-right: 20px;">
          <span>Total Books</span>
          <img src="img/book.png" alt="Total Books Icon" style="width: 50px; height: 50px;">
        </div>
        <div onclick="showActiveSubscriptions()" class="stat-box btn" style="background-color: #FF9AA2; width: 200px; height: 150px; margin-right: 20px;">
          <span>Active Subscriptions</span>
          <img src="img/subscription.png" alt="Active Subscriptions Icon" style="width: 50px; height: 50px;">
        </div>
        <div onclick="showTotalLentBooks()" class="stat-box btn" style="background-color: #B5EAD7; width: 200px; height: 150px;">
          <span>Total Lent Books</span>
          <img src="img/inventory.png" alt="Total Inventory Books Icon" style="width: 50px; height: 50px;">
        </div>
      </div>
    </div>
  </div>


  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script><!-- Your JavaScript for redirect functions -->
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

    function showTotalLentBooks() {
      window.location.href = "lentbook_index.php";
    }
  </script>
</div>