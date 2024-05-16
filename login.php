<?php
session_start();
require_once "connection.php";

// Redirect to dashboard if already logged in
if (isset($_SESSION["userid"])) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($mysqli, $email);

    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT userid, password FROM logindetails WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userid, $stored_password);
        $stmt->fetch();

        // Verify the password
        if ($password === $stored_password) {
            // Password is correct, start session
            $_SESSION["userid"] = $userid;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Password does not match";
        }
    } else {
        $error = "Email does not match";
    }

    $stmt->close();
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        /* Additional CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #0000, lavender);
        }

        .container {
            background-color: white; 
            padding: 40px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-btn {
            text-align: center;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #6a5acd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #483d8b;
        }

        .signup {
            text-align: center;
            margin-top: 10px;
        }

        .signup a {
            color: #483d8b;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <?php
        if (isset($error)) {
            echo "<div class='alert'>$error</div>";
        }
        ?>
    </div>
</body>
</html>
