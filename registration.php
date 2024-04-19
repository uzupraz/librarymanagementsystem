<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System Registration</title>
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
            background: linear-gradient(to bottom right, #8faeec, #e59df2); /* Gradient background */
            
        }

        .container {
            background-color: #fff; 
            padding: 40px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            background: linear-gradient(to bottom right, #8faeec, #e59df2);
        }

        .input-group {
            margin-bottom: 15px; /* Add margin bottom to space out input groups */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 10px); /* Adjust input width to fit within container */
            padding: 10px; /* Add padding for input fields */
            border: 1px solid #ccc; /* Add border for input fields */
            border-radius: 5px; /* Add border radius for rounded corners */
            box-sizing: border-box; /* Include padding and border in input width */
        }

        button[type="submit"] {
            width: 100%; /* Make the button fill the container width */
            padding: 10px; /* Add padding for button */
            background-color: #6a5acd; /* Add background color for button */
            color: white; /* Set text color for button */
            border: none; /* Remove border from button */
            border-radius: 5px; /* Add border radius for rounded corners */
            cursor: pointer; /* Add cursor pointer on hover */
        }

        button:hover {
             background-color: #483d8b; /* DarkSlateBlue */
        }

        .signup {
            text-align: center; /* Align signup text to center */
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
        <h2>Register </h2>
        <form action="#" method="post">
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <input type="password" id="repassword" name="repassword" placeholder="Re-enter Password" required>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
        <div class="signup">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
