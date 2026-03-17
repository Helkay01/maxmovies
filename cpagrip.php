<?php
require 'vendor/autoload.php';

use GeoIp2\Database\Reader;

function getClientIp() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]); // First IP is the real client IP
    }

    return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
}

$ip = getClientIp();
	

$reader = new Reader('GeoLite2-City.mmdb');
$record = $reader->city($ip);
		
// Extract data
$timezone = $record->location->timeZone;
$country = $record->country->name;
		


$reader->close();



?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quick Eligibility Check</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #eef2f7;
}

.container {
    max-width: 500px;
    margin: 40px auto;
    padding: 20px;
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    text-align: center;
}

h1 {
    font-size: 22px;
}

.progress {
    height: 8px;
    background: #ddd;
    border-radius: 10px;
    margin: 20px 0;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    width: 10%;
    background: #28a745;
    transition: width 0.5s ease;
}

.question {
    margin-top: 20px;
    font-size: 18px;
}

.btn {
    display: block;
    width: 100%;
    margin-top: 15px;
    padding: 14px;
    background: #007bff;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}

.btn:hover {
    background: #0056b3;
}

.notice {
    font-size: 12px;
    color: #888;
    margin-top: 15px;
}

.loader {
    display: none;
    margin-top: 15px;
}
</style>
</head>

<body>

<div class="container">
    <div class="card">


	<div id="country" hidden><?php echo $country; ?></div>

        <h1>Quick Eligibility Check</h1>
		
        <div class="progress">
            <div class="progress-bar" id="progress"></div>
        </div>

        <div id="step1">
            <div class="question">
                Are you located in the United States?
            </div>

            <a href="#" class="btn" onclick="nextStep()">Yes</a>
            <a href="#" class="btn" onclick="nextStep()">No</a>
        </div>

        <div id="step2" style="display:none;">
            <div class="question">
                Would you like to check available offers in your area?
            </div>

            <a href="#" class="btn" onclick="goOffer()">Continue</a>
        </div>

        <div class="loader" id="loader">
            <p>Checking availability...</p>
        </div>

        <div class="notice">
            *This is an informational page. Availability may vary by location.
        </div>

    </div>
</div>

<script>
let countryEl = document.getElementById("country");
let userCountry = countryEl.innerText.trim();

const countries = [
  {
    name: "United States",
    link: "https://optilinklock.com/1883648"
  },
  {
    name: "Canada",
    link: "https://example.com/ca-offer"
  },
  {
    name: "United Kingdom",
    link: "https://example.com/uk-offer"
  },
  {
	name: "Nigeria",
	link: "https://optilinklock.com/1883642"
  }
];

// Find matching country
let selectedOffer = countries.find(c => c.name === userCountry);

let progress = document.getElementById("progress");

function nextStep() {
    progress.style.width = "60%";
    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").style.display = "block";
}

function goOffer() {
    if (!selectedOffer) {
        document.querySelector(".card").innerHTML = `
            <h2>Offer not available in your country</h2>
            <p>Please check back later.</p>
        `;
        return;
    }

    progress.style.width = "100%";
    document.getElementById("loader").style.display = "block";

    setTimeout(function() {
        window.location.href = selectedOffer.link;
    }, 1500);
}

// Optional: personalize question
if (selectedOffer) {
    document.querySelector(".question").innerHTML =
        `Are you located in ${selectedOffer.name}?`;
} else {
    document.querySelector(".question").innerHTML =
        `Service availability may vary by location.`;
}
</script>

</body>
</html>
