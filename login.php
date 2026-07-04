<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Crop System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-box">
            <h2 class="text-center">Grow Guide</h2>
            <h4 class="text-center mb-4">Login</h4>
            <!-- Corrected the form here -->
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="signin" class="btn btn-success btn-block">Login</button>
                <p class="text-center mt-3">
                    Don't have an account? <a href="signup.php">Sign up</a>
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

// Handle Login
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];

    // Prepared statement for login
    $stmt = $conn->prepare("SELECT id, fullName, password FROM user_record WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($pswd, $user['password'])) {
            echo "<script>alert('Login successful!');</script>";
            // Redirect to another page
             header("Location: index2.html");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('User not found');</script>";
    }
    $stmt->close();
}

$conn->close();
?>