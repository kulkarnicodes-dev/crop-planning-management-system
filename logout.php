<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page after 2 seconds
header("refresh:2;url=index.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Crop System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .logout-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div>
            <h2>You have been logged out!</h2>
            <p>Redirecting to login page...</p>
            <a href="index.html" class="btn btn-primary">Go to Login</a>
        </div>
    </div>
</body>
</html>
