<?php
include "connection.php";
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$userid = $_SESSION['userid'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["userid"];
    $sub_id = $_POST["subid"];
    $start_date = date("Y-m-d");
    
    // Get the number of days and price for the selected subscription
    $stmt = $mysqli->prepare("SELECT days, price FROM subscriptiontype WHERE subid = ?");
    if (!$stmt) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    } else {
        $stmt->bind_param("i", $sub_id);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            $stmt->bind_result($days, $price);
            $stmt->fetch();
            $end_date = date("Y-m-d", strtotime("+$days days"));
            $stmt->close();

            // Insert the new subscription
            $stmt = $mysqli->prepare("INSERT INTO activesubscriptions (userid, subid, startdate, enddate) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            } else {
                $stmt->bind_param("iiss", $user_id, $sub_id, $start_date, $end_date);
                if (!$stmt->execute()) {
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                } else {
                    // Insert into payments table
                    $description = "Subscription Purchased";
                    $stmt2 = $mysqli->prepare("INSERT INTO payments (userid, subid, amount, date, description) VALUES (?, ?, ?, ?, ?)");
                    if (!$stmt2) {
                        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
                    } else {
                        $stmt2->bind_param("iisss", $user_id, $sub_id, $price, $start_date, $description);
                        if ($stmt2->execute()) {
                            header("Location: subscriptions_index.php?msg=Subscriber added successfully");
                            exit();
                        } else {
                            echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
                        }
                        $stmt2->close();
                    }
                }
                $stmt->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subscriber</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="container mt-4">
                <h2 class="mb-3">Add New Subscriber</h2>
                <form action="add_subscriber.php" method="POST">
                    <div class="mb-3">
                        <label for="userid" class="form-label">User</label>
                        <select id="userid" name="userid" class="form-select" required>
                            <option value="" selected disabled>Select User</option>
                            <?php
                            $user_sql = "SELECT userid, FullName FROM userdetails";
                            $user_result = mysqli_query($mysqli, $user_sql);
                            while ($user_row = mysqli_fetch_assoc($user_result)) {
                                echo '<option value="' . $user_row["userid"] . '">' . $user_row["FullName"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subid" class="form-label">Subscription Type</label>
                        <select id="subid" name="subid" class="form-select" required>
                            <option value="" selected disabled>Select Subscription</option>
                            <?php
                            $sub_sql = "SELECT subid, subname FROM subscriptiontype";
                            $sub_result = mysqli_query($mysqli, $sub_sql);
                            while ($sub_row = mysqli_fetch_assoc($sub_result)) {
                                echo '<option value="' . $sub_row["subid"] . '">' . $sub_row["subname"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startdate" class="form-label">Start Date</label>
                        <input type="text" id="startdate" name="startdate" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="enddate" class="form-label">End Date</label>
                        <input type="text" id="enddate" name="enddate" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" id="price" name="price" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Subscriber</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('subid').addEventListener('change', function () {
            var subId = this.value;
            if (subId) {
                fetch('get_subscription_days.php?subid=' + subId)
                    .then(response => response.json())
                    .then(data => {
                        var days = data.days;
                        var price = data.price;
                        var startDate = new Date();
                        var endDate = new Date(startDate);
                        endDate.setDate(startDate.getDate() + days);
                        document.getElementById('enddate').value = endDate.toISOString().split('T')[0];
                        document.getElementById('price').value = price;
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>

</html>
