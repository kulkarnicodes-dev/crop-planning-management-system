<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Grow Guide</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body class="signup-body">
    <div class="signup-container">
        <div class="signup-box">
            <h2 class="text-center">Grow Guide</h2>
            <h4 class="text-center mb-4">Create an Account</h4>
            <form action="" method="POST"> <!-- Corrected form action -->
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="num">Phone</label>
                    <input type="text" class="form-control" id="num" name="num" placeholder="Enter your phone number" required>
                </div>
                <div class="form-group">
                    <label for="pswd">Password</label>
                    <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-block">Sign Up</button>
                <p class="text-center mt-3">
                    Already have an account? <a href="login.php">Login</a>
                </p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>








<?php
include("config.php");

// Handle Signup
if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $num = $_POST['num'];
    $pswd = password_hash($_POST['pswd'], PASSWORD_DEFAULT); // Hash password

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT email FROM user_record WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO yash (fullName, email, mobile, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $email, $num, $pswd);

        if ($stmt->execute()) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
    $checkEmail->close();
}
?>