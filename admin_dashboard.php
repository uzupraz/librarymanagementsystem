<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container-fluid">
    <?php include 'header.php'; ?>
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
        <div class="activity-log-container mt-4">
          <div class="activity-log-header">Activity Log</div>
          <div class="activity-log">
            <div class="d-flex flex-wrap">
              <!-- Activity log tiles will be appended here by JavaScript -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0sG1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

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

    function showTotalLentBooks() {
      window.location.href = "lentbook_index.php";
    }

    // Function to load recent activity
    function loadRecentActivity() {
      fetch('get_recent_activity.php')
        .then(response => response.json())
        .then(data => {
          const activityLogContainer = document.querySelector('.activity-log .d-flex');
          activityLogContainer.innerHTML = ''; // Clear existing logs

          data.forEach(log => {
            const logTile = document.createElement('div');
            logTile.className = 'stat-box';

            logTile.innerHTML = `
              <div class="summary">
                <p>${log.summary}</p>
              </div>
              <div class="date">
                <p>${log.date}</p>
              </div>
            `;
            activityLogContainer.appendChild(logTile);
          });
        })
        .catch(error => console.error('Error fetching recent activity:', error));
    }

    document.addEventListener('DOMContentLoaded', loadRecentActivity);
  </script>
</body>

</html>