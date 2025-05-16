<?php
// Set the movie title and fetch the Wikipedia page content
$movieTitle = "Black_Adam_(film)";
$url = "https://en.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&titles=" . $movieTitle;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Extract the movie details from the API response
$pages = $data['query']['pages'];
foreach ($pages as $page) {
    $movieDetails = $page['extract']; // Movie details extracted from the response
    
    echo '<pre>';
    print_r($movieDetails);
    echo '</pre>';
}