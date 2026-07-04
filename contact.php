<?php 
include("config.php"); // Ensure this file exists and has a valid DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    // Get form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Insert into database
        $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Your message has been sent successfully!'); window.location.href='contact.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error: Could not send your message. Please try again.'); window.location.href='contact.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href='contact.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Crop System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<header class="bg-success text-white text-center py-4">
    <h1>Contact Us</h1>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h3>Get in Touch</h3>
            <p>If you have any questions or need assistance, feel free to reach out to us.</p>
            <ul class="list-unstyled">
                <li><strong>Email:</strong> cropsystem@gmail.com</li>
                <li><strong>Phone:</strong> +919987456***</li>
                <li><strong>Address:</strong> Near PCMCS College Krishna Nagar Nashik</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Send Us a Message</h3>
            <form action="contact.php" method="POST">  <!-- Ensure this is correct -->
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block" name="submit_contact">Send Message</button>
            </form>
        </div>
    </div>
</div>

<footer class="bg-success text-white text-center py-3 mt-5">
    <p>&copy; PCMCS Project 2025 Crop System | All Rights Reserved</p>
</footer>

</body>
</html>
