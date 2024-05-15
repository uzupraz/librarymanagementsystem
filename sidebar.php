<link rel="stylesheet" href="a_dashboard.css">
<link rel="stylesheet" href="sidebar.css">
<!-- sidebar.php -->
<div class="sidebar col-md-2 vh-100 wt-2">
    <div class="logo p-3 text-center border-bottom">
        <img src="logo.png" alt="Librify Logo" class="img-fluid" style="max-width: 80px;">
        <h2 class="h5">Librify</h2>
    </div>
    <div class="btn-group-vertical p-3" role="group">
        <button onclick="showDashboard()" class="btn btn-outline-primary w-100">Dashboard</button>
        <button onclick="showTotalUsersPage()" class="btn btn-outline-primary w-100">Users</button>
        <button onclick="TotalBooksPage()" class="btn btn-outline-primary w-100">Books</button>
        <button onclick="showSubscriptionUsers()" class="btn btn-outline-primary w-100">Subscription Users</button>
        <button onclick="lentBooks()" class="btn btn-outline-danger w-100">Lent Books</button>
    </div>
</div>


<script>
    function showDashboard(){
        window.location.href = "admin_dashboard.php";
    }
    function showTotalUsersPage() {
        window.location.href = "user_index.php";
    }

    function TotalBooksPage() {
        window.location.href = "book_index.php";
    }

    function showSubscriptionUsers() {
        window.location.href = "subscription_user.php"; // Ensure this points to the correct PHP file for subscription users
    }

    function lentBooks() {
        window.location.href = "lentbook_index.php"; // Redirect to login page
    }
</script>
