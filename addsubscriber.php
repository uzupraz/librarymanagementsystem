<!DOCTYPE html>
<html>
<head>
    <title>Add Subscriber</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .hidden {
            display: none;
        }
    </style>
    <script>
        // Function to hide the table initially
        window.onload = function() {
            document.getElementById("userDetailsTable").classList.add("hidden");
            document.getElementById("packageDetailsTable").classList.add("hidden");
            document.getElementById("paymentDetails").classList.add("hidden");
        };

        // Function to toggle the visibility of the table
        function toggleTable(tableId) {
            var table = document.getElementById(tableId);
            table.classList.toggle("hidden");
        }
    </script>
</head>
<body>
    <h2>Add Subscriber</h2>
    <form method="POST" action="add_subscriber.php">
        <label for="user">Select User:</label>
        <select id="user" name="user" onchange="toggleTable('userDetailsTable'); toggleTable('paymentDetails');">
            <option value="">Select User</option>
            <!-- PHP code to populate dropdown with users -->
            <?php
                // Replace this with your own logic to fetch users from your database
                $users = array(
                    array("id" => 1, "name" => "John Doe", "address" => "123 Some Street, City", "subscribed" => true),
                    array("id" => 2, "name" => "Jane Smith", "address" => "456 Another Street, Town", "subscribed" => false),
                    array("id" => 3, "name" => "Bob Johnson", "address" => "789 Different Street, Village", "subscribed" => true)
                );
                foreach ($users as $user) {
                    echo "<option value='" . $user['id'] . "'>" . $user['name'] . "</option>";
                }
            ?>
        </select>

        <!-- Table to display user details -->
        <table id="userDetailsTable" class="hidden">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Subscribed</th>
            </tr>
            <?php
                if (!empty($_POST['user'])) {
                    $selectedUserId = $_POST['user'];
                    foreach ($users as $user) {
                        if ($user['id'] == $selectedUserId) {
                            echo "<tr>";
                            echo "<td>" . $user['name'] . "</td>";
                            echo "<td>" . $user['address'] . "</td>";
                            echo "<td>" . ($user['subscribed'] ? "Yes" : "No") . "</td>";
                            echo "</tr>";
                            break; // Break loop after finding the selected user
                        }
                    }
                }
            ?>
        </table>

        <!-- Select Package -->
        <label for="package">Select Package:</label>
        <select id="package" name="package" onchange="toggleTable('packageDetailsTable')">
            <option value="">Select Package</option>
            <!-- PHP code to populate dropdown with packages -->
            <?php
                // Replace this with your own logic to fetch packages from your database
                $packages = array(
                    array("name" => "Basic", "duration" => "Monthly", "days" => 30, "price" => "$150"),
                    array("name" => "Standard", "duration" => "Yearly", "days" => 365, "price" => "$300"),
                    array("name" => "Premium", "duration" => "Weekly", "days" => 7, "price" => "$80")
                );
                foreach ($packages as $package) {
                    echo "<option value='" . $package['name'] . "'>" . $package['name'] . "</option>";
                }
            ?>
        </select>

        <!-- Table to display package details -->
        <table id="packageDetailsTable" class="hidden">
            <tr>
                <th>Name</th>
                <th>Duration</th>
                <th>Days</th>
                <th>Subscription Date</th>
                <th>Subscription Expiry Date</th>
                <th>Pricing</th>
            </tr>
            <?php
                foreach ($packages as $package) {
                    echo "<tr>";
                    echo "<td>" . $package['name'] . "</td>";
                    echo "<td>" . $package['duration'] . "</td>";
                    echo "<td>" . $package['days'] . "</td>";
                    echo "<td>" . date("n/j/Y") . "</td>"; // Subscription date
                    $expiryDate = date("n/j/Y", strtotime("+" . $package['days'] . " days"));
                    echo "<td>" . $expiryDate . "</td>"; // Subscription expiry date
                    echo "<td>" . $package['price'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <!-- Payment Details -->
        <div id="paymentDetails" class="hidden">
            <?php
            // Show payment details only if the user is not subscribed
            if (!empty($_POST['user'])) {
                $selectedUserId = $_POST['user'];
                $selectedUser = array_filter($users, function($user) use ($selectedUserId) {
                    return $user['id'] == $selectedUserId;
                });
                $isSubscribed = count($selectedUser) > 0 ? reset($selectedUser)['subscribed'] : false;
                
                if (!$isSubscribed) {
                    echo "<label for='payment'>Select Payment Option:</label>";
                    echo "<select id='payment' name='payment'>";
                    echo "<option value=''>Select Payment Option</option>";
                    // Add payment options for online payment
                    echo "<option value='esewa'>eSewa</option>";
                    echo "<option value='khalti'>Khalti</option>";
                    // Add option for paying with cash
                    echo "<option value='cash'>Pay with Cash</option>";
                    echo "</select>";
                }
            }
            ?>
        </div>

        <input type="submit" value="Add Subscriber">
    </form>
</body>
</html>
