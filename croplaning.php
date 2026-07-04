<?php
include("config.php"); // Include database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cropName = $_POST['cropName'];
    $plantingDate = $_POST['plantingDate'];
    $harvestDate = $_POST['harvestDate'];
    $marketPrice = $_POST['marketPrice'];
    $stockAvailable = $_POST['stockAvailable'];
    $location = $_POST['location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (!empty($cropName) && !empty($plantingDate) && !empty($harvestDate) && !empty($marketPrice) && !empty($stockAvailable) && !empty($location)) {
        $query = "INSERT INTO crop_planning (crop_name, planting_date, harvest_date, market_price, stock_available, location, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssdisdd", $cropName, $plantingDate, $harvestDate, $marketPrice, $stockAvailable, $location, $latitude, $longitude);
        
        if ($stmt->execute()) {
            echo "<script>alert('Crop plan added successfully!');
             window.location.href='croprecord.php';
            </script>";
        } else {
            echo "<script>alert('Error: Could not add crop plan.');</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Planning - Grow Guide</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="croplaning.css">
    <style>
        /* Make all fields smaller */
        .form-control {
            max-width: 250px;
            font-size: 0.9rem;
        }
        select.form-control {
            max-width: 250px;
        }
        button.btn {
            font-size: 0.85rem;
            padding: 5px 10px;
        }
    </style>
    <script>
        async function fetchUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async function(position) {
                    let lat = position.coords.latitude;
                    let lon = position.coords.longitude;

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lon;

                    try {
                        let response = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`);
                        let data = await response.json();

                        let city = data.address.city || data.address.town || data.address.village || data.address.state || "Unknown Location";
                        document.getElementById('location').value = city;

                    } catch (error) {
                        alert("Unable to fetch place name. Please enter manually.");
                    }

                }, function(error) {
                    alert("Error fetching location: " + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</head>
<body>
    <div class="wrapper d-flex">
        <nav class="bg-success text-white sidebar">
            <h2 class="text-center py-3">Crop Planning</h2>
        </nav>

        <main class="container-fluid p-4">
            <h1 class="mb-4">Crop Planning</h1>
            <section class="crop-form">
                <h2>Schedule a Crop</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="cropName">Crop Name</label>
                        <select class="form-control" id="cropName" name="cropName" required>
                            <option value="">Select a Crop</option>
                            <option value="Wheat">Wheat</option>
                            <option value="Rice">Rice</option>
                            <option value="Jowar">Jowar</option>
                            <option value="Bajra">Bajra</option>
                            <option value="Cotton">Cotton</option>
                            <option value="Tur">Tur</option>
                            <option value="Moong">Moong</option>
                            <option value="Urad">Urad</option>
                            <option value="Gram">Gram</option>
                            <option value="Turmeric">Turmeric</option>
                            <option value="Grapes">Grapes</option>
                            <option value="Onion">Onion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="plantingDate">Planting Date</label>
                        <input type="date" class="form-control" id="plantingDate" name="plantingDate" required>
                    </div>
                    <div class="form-group">
                        <label for="harvestDate">Estimated Harvest Date</label>
                        <input type="date" class="form-control" id="harvestDate" name="harvestDate" required>
                    </div>
                    <div class="form-group">
                        <label for="marketPrice">Estimate Market Price per Kg</label>
                        <input type="number" step="0.01" class="form-control" id="marketPrice" name="marketPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="stockAvailable">Approximate Available Stock (tons)</label>
                        <input type="number" step="0.01" class="form-control" id="stockAvailable" name="stockAvailable" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                        <button type="button" class="btn btn-primary mt-2" onclick="fetchUserLocation()">Get My Location</button>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>
                    <button type="submit" class="btn btn-success">Add Crop Plan</button>
                </form>
            </section>
        </main>
    </div>
    <footer class="bg-success text-white text-center py-3">
        <p>&copy; PCMCS Project 2025 Grow Guide</p>
    </footer>
</body>
</html>
