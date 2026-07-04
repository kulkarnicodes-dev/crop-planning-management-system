<?php include("config.php"); ?>
<?php
// Fetch all records from the crop_planning table
$query = "SELECT * FROM crop_info";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maharashtra Crop Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        h2 {
            background-color: green;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
        .legend {
            background: white;
            padding: 10px;
            font-size: 14px;
            position: absolute;
            bottom: 10px;
            left: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .legend .crop-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .legend img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        footer {
            background-color: #28a745;
            color: white;
            padding: 15px 0;
            margin-top: 40px;
            font-size: 1rem;
            text-align: center;
        }
        /* Default marker styling */
        .leaflet-marker-icon {
            transition: filter 0.3s ease-in-out;
        }
       /* High demand - Red */
      .leaflet-marker-icon.high-demand:hover {
       filter: brightness(0) saturate(100%) invert(17%) sepia(100%) saturate(5000%) hue-rotate(0deg) brightness(90%);
}

/* Medium & Low demand - Green */
.leaflet-marker-icon.medium-demand:hover,
.leaflet-marker-icon.low-demand:hover {
    filter: brightness(0) saturate(100%) invert(50%) sepia(100%) saturate(200%) hue-rotate(90deg);
}

        /* Custom suggestion box */
        .suggestion-box {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            display: none;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <h2>Maharashtra Crop Map</h2>
    <div id="map"></div>
    <div id="suggestion-box" class="suggestion-box"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([19.7515, 75.7139], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            bounds: [[15.6, 72.6], [22, 80.9]],
            maxBounds: [[15.6, 72.6], [22, 80.9]],
            maxBoundsViscosity: 1.0
        }).addTo(map);

        var cropIcons = {
            "Wheat": "img/wheat.png",
            "Rice": "img/rice.png",
            "Jowar": "img/jowar.png",
            "Bajra": "img/bajra.png",
            "Cotton": "img/cotton.png",
            "Tur": "img/tur.png",
            "Moong": "img/moong.png",
            "Urad": "img/urad.png",
            "Gram": "img/gram.png",
            "Turmeric": "img/turmeric.png",
            "Grapes": "img/grapes.png",
            "Onion": "img/onion.jpeg"
        };

        var cropLocations = [
            { name: "Wheat (Aurangabad)", coords: [19.8762, 75.3433], crop: "Wheat", demand: "high" },
            { name: "Rice (Nagpur)", coords: [21.1458, 79.0882], crop: "Rice", demand: "medium" },
            { name: "Jowar (Solapur)", coords: [17.6599, 75.9064], crop: "Jowar", demand: "low" },
            { name: "Bajra (Nashik)", coords: [20.0000, 73.7800], crop: "Bajra", demand: "medium" },
            { name: "Cotton (Amravati)", coords: [20.9374, 77.7796], crop: "Cotton", demand: "high" },
            { name: "Tur (Akola)", coords: [20.7096, 77.0020], crop: "Tur", demand: "high" },
            { name: "Moong (Beed)", coords: [18.9881, 75.7600], crop: "Moong", demand: "high" },
            { name: "Urad (Yavatmal)", coords: [20.3888, 78.1205], crop: "Urad", demand: "low" },
            { name: "Gram (Parbhani)", coords: [19.2683, 76.7716], crop: "Gram", demand: "medium" },
            { name: "Turmeric (Satara)", coords: [17.6868, 74.0034], crop: "Turmeric", demand: "high" },
            { name: "Grapes (Nashik)", coords: [20.0056, 73.7798], crop: "Grapes", demand: "high" },
            { name: "Onion (Nashik)", coords: [19.9975, 73.7898], crop: "Onion", demand: "high" }
        ];

       cropLocations.forEach(crop => {
    for (let i = 0; i < 30; i++) {
        // Randomly scatter markers across Maharashtra
        let randomLat = 15.6 + Math.random() * (22.0 - 15.6);
        let randomLng = 72.6 + Math.random() * (80.9 - 72.6);

        // 🍇 Special case: Grapes near Nashik
        if (crop.crop === "Grapes" && i < 15) {
            randomLat = 19.8 + Math.random() * 0.6; // Nashik region latitude
            randomLng = 73.4 + Math.random() * 0.8; // Nashik region longitude
        }

        // 🧅 Special case: Onion near Nashik
        if (crop.crop === "Onion" && i < 15) {
            randomLat = 19.8 + Math.random() * 0.6;
            randomLng = 73.4 + Math.random() * 0.8;
        }

        var icon = L.icon({
            iconUrl: cropIcons[crop.crop],
            iconSize: [30, 30]
        });

        var marker = L.marker([randomLat, randomLng], { icon: icon })
            .addTo(map)
            .bindPopup(crop.name);

        let markerElement = marker._icon;
        markerElement.classList.add(crop.demand + "-demand");

        markerElement.addEventListener("mouseenter", function (event) {
            let suggestionBox = document.getElementById("suggestion-box");

            if (crop.demand === "high") {
                let suggestedCrops = Object.keys(cropIcons).filter(c => c !== crop.crop).join(", ");
                suggestionBox.innerHTML = `Instead of growing <strong>${crop.crop}</strong>, try: <br>${suggestedCrops}`;
            } else {
                suggestionBox.innerHTML = `You can grow <strong>${crop.crop}</strong> for better profitability.`;
            }

            suggestionBox.style.left = (event.pageX + 15) + "px";
            suggestionBox.style.top = (event.pageY + 15) + "px";
            suggestionBox.style.display = "block";
        });

        markerElement.addEventListener("mouseleave", function () {
            document.getElementById("suggestion-box").style.display = "none";
        });
    }
});


        var legend = L.control({ position: "bottomleft" });
        legend.onAdd = function () {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML = "<strong>Crop Indicators</strong><br>";
            Object.keys(cropIcons).forEach(crop => {
                div.innerHTML += `<div class="crop-item"><img src="${cropIcons[crop]}" alt="${crop}"> ${crop}</div>`;
            });
            return div;
        };
        legend.addTo(map);

    </script>

    <footer>
        <p> PCMCS Project 2025 Crop System</p>
    </footer>
</body>
</html>
