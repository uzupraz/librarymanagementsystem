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
    .header {
      height: 80px; /* Set header height between 60px and 100px */
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }

    .header h1 {
      font-weight: 500;
      font-size: 24px;
      margin-bottom: 0;
      margin-left: 190px; /* Add margin to the left side */
    }

    .header li {
      list-style: none; /* Remove list styles */
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="header">
    <!-- Moved dropdown menu to the right -->
    <div class="col text-center"> <!-- Added Bootstrap class for centering -->
      <h1 style="font-weight: 500; font-size: 24px; margin-bottom: 0;">Welcome to Admin Dashboard </h1>
    </div> <!-- Empty div to push dropdown to the right -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Anushka Bhattarai
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Account Settings</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Logout</a>
      </div>
    </li>
  </div>
  <hr> <!-- Add the thin line below the header -->
</div>
</body>
</html>
