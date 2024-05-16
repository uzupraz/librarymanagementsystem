<?php
include "connection.php";

function getSubscriptionDetails($userid, $subid, $mysqli)
{
    // Query to get the subscription name from the subscriptiontype table
    $stmt = $mysqli->prepare("SELECT subname FROM subscriptiontype WHERE subid = ?");
    if (!$stmt) {
        return "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    $stmt->bind_param("i", $subid);
    if (!$stmt->execute()) {
        return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $stmt->bind_result($subname);
    $stmt->fetch();
    $stmt->close();

    // Query to get the user's full name from the userdetails table
    $stmt = $mysqli->prepare("SELECT FullName FROM userdetails WHERE userid = ?");
    if (!$stmt) {
        return "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    $stmt->bind_param("i", $userid);
    if (!$stmt->execute()) {
        return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();

    return array('subname' => $subname, 'username' => $username);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <title>Active Subscriptions</title>
</head>

<body>
    <div class="container-fluid">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="container">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = $_GET["msg"];
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                ?>
                <h2 class="mb-3">Active Subscriptions</h2>
                <a href="add_subscriber.php" class="btn btn-dark mb-3">Add Subscriber</a>
                <a href="subscription_packages.php" class="btn btn-info mb-3">View Subscription Packages</a>


                <table class="table text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Subscription Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $today = date('Y-m-d');
                        $sql = "SELECT * FROM `activesubscriptions` WHERE enddate >= '$today'";
                        $result = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $details = getSubscriptionDetails($row["userid"], $row["subid"], $mysqli);
                        ?>
                            <tr>
                                <td><?php echo $details["username"]; ?></td>
                                <td><?php echo $details["subname"]; ?></td>
                                <td><?php echo $row["startdate"]; ?></td>
                                <td><?php echo $row["enddate"]; ?></td>
                                <td>
                                    <a href="edit_subscription.php?id=<?php echo $row["userid"]; ?>" class="link-dark">
                                        <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                    </a>
                                    <a href="delete_subscription.php?id=<?php echo $row["userid"]; ?>" class="link-dark">
                                        <i class="fa-solid fa-trash fs-5"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
