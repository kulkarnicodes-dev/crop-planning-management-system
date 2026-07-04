<?php 
include("config.php"); // Ensure this file contains the database connection
?>
<?php
// Fetch all records from the crop_planning table
$query = "SELECT * FROM crop_planning";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Market Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Crop Market Information</h2>
        <table>
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Crop Name</th>
                <th>Planting Date</th>
                <th>Harvest Date</th>
                <th>Estimate Market Price (per Kg)</th>
                <th>Approximate Stock Available (tons)</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['crop_name']}</td>
                        <td>{$row['planting_date']}</td>
                        <td>{$row['harvest_date']}</td>
                        <td>{$row['market_price']}</td>
                        <td>{$row['stock_available']}</td>
                        <td>{$row['location']}</td>

                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
            }
            ?>
        </tbody>

       </table>
    </div>
</body>
</html>
