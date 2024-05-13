<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styling */
        .sidebar {
            position: fixed;
            top: 100px;
            left: 0;
            height: 100%; /* Adjust height as needed */
            width: 250px; /* Adjust width as needed */
            background-color: #34495E; /* Change background color as needed */
            padding: 20px;
            z-index: 1000; /* Ensure it's above other content */
            overflow-y: auto; /* Enable scrolling if content exceeds height */
        }
        .sidebar-btn {
            width: 100%;
            margin-bottom: 10px;
            margin-top:40px;
        }
        /* Adjust main content to make space for the sidebar */
        .main-content {
            margin-left: 270px; /* Adjust according to sidebar width */
            padding: 20px; /* Adjust padding to maintain spacing */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <button onclick="showTotalUsersPage()" class="btn btn-primary sidebar-btn">Users</button>
        <button onclick="showTotalBooks()" class="btn btn-primary sidebar-btn">Books</button>
        <button onclick="showSubscriptionUsers()" class="btn btn-primary sidebar-btn">Subscription User</button>
        <button onclick="logout()" class="btn btn-danger sidebar-btn">Logout</button>
    </div>
    
    <!-- Main content area -->
    <div class="main-content">
        <!-- Content goes here -->
        <!-- Bootstrap JS (Optional, if you're using Bootstrap JS features) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Your custom JavaScript functions -->
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
            
            function logout() {
                window.location.href = "logout.php";
            }
        </script>
    </div>
</body>
</html>
