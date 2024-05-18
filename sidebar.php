<link rel="stylesheet" href="css/sidebar.css">
<!-- sidebar.php -->
<div class="sidebar col-md-2 vh-100 wt-2">
    <div class="logo p-3 text-center border-bottom">
        <img src="img/logo.png" alt="Librify Logo" class="img-fluid" style="max-width: 80px;">
        <h2 class="h5">Librify</h2>
    </div>
    <div class="btn-group-vertical p-3" role="group">
        <button onclick="showDashboard()" class="btn btn-outline-primary w-100">Dashboard</button>
        <button onclick="showTotalUsersPage()" class="btn btn-outline-primary w-100">Users</button>
        <button onclick="TotalBooksPage()" class="btn btn-outline-primary w-100">Books</button>
        <button onclick="showSubscriptionUsers()" class="btn btn-outline-primary w-100">Subscribed Users</button>
        <button onclick="showLentBooks()" class="btn btn-outline-primary w-100">Lent Books</button>
        <button onclick="showPayment()" class="btn btn-outline-primary w-100">Payments</button>
    </div>
</div>


<script>
    function showDashboard(){
        window.location.href = "index.php";
    }
    function showTotalUsersPage() {
        window.location.href = "user_index.php";
    }

    function TotalBooksPage() {
        window.location.href = "book_index.php";
    }

    function showSubscriptionUsers() {
        window.location.href = "subscriptions_index.php"; // Ensure this points to the correct PHP file for subscription users
    }

    function showLentBooks() {
        window.location.href = "lentbook_index.php"; // Redirect to login page
    }

    function showPayment() {
        window.location.href = "payments_index.php"; // Redirect to login page
    }
</script>
