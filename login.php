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
            color: #333; /* Set text color to dark gray */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #0000, lavender); /* Gradient background */
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
            margin-bottom: 15px; /* Add margin bottom to space out input groups */
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 10px); /* Adjust input width to fit within container */
            padding: 10px; /* Add padding for input fields */
            border: 1px solid #ccc; /* Add border for input fields */
            border-radius: 5px; /* Add border radius for rounded corners */
            box-sizing: border-box; /* Include padding and border in input width */
        }

        .form-btn {
            text-align: center; /* Align button to center */
        }

        .btn-primary {
            width: 100%; /* Make the button fill the container width */
            padding: 10px; /* Add padding for button */
            background-color: #6a5acd; /* Add background color for button */
            color: white; /* Set text color for button */
            border: none; /* Remove border from button */
            border-radius: 5px; /* Add border radius for rounded corners */
            cursor: pointer; /* Add cursor pointer on hover */
        }

        .btn-primary:hover {
             background-color: #483d8b; /* DarkSlateBlue */
        }

        .signup {
            text-align: center; /* Align signup text to center */
            margin-top: 10px; /* Add margin top for spacing */
        }

        .signup a {
            color:#483d8b; /* Set color for signup link */
            text-decoration: none; /* Remove underline from signup link */
        }

        .signup a:hover {
            text-decoration: underline; /* Add underline on hover for signup link */
        }

        h2 {
            text-align: center; /* Align heading to center */
            margin-bottom: 20px; /* Add margin bottom for spacing */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
      <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "connection.php";
            $sql = "SELECT * FROM logindetails WHERE Email = '$email'";
            $result = mysqli_query($mysqli, $sql);
            $user = mysqli_fetch_assoc($result)['password'];

            if ($user) {
                if (!($password == $user)) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: admin_dashboard.php");
                    die();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
                
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
    </div>

    
</body>
</html>
