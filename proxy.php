<?php
require 'vendor/autoload.php';

use Curl\Curl;
use GeoIp2\Database\Reader;

$curl = new Curl();


$curl->disableTimeout();

// Configure cURL options
$cookieFile = 'c.txt';
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile);
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile);
$curl->setOpt(CURLOPT_FOLLOWLOCATION, true); // Follow redirects
$curl->setOpt(CURLOPT_RETURNTRANSFER, true);

// SSL configuration - better to verify but disable if needed
$curl->setOpt(CURLOPT_SSL_VERIFYPEER, true); // Disable for testing, enable in production
$curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);

// Set headers to mimic a browser
$headers = [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
];
$curl->setOpt(CURLOPT_HTTPHEADER, $headers);

// Make the request
$curl->get('https://www.freeproxy.world/', [
    'type' => 'socks5',
    'anonymity' => 4,
    'country' => '',
    'speed' => 500,
    'port' => '',
    'page' => 1,
]);

if ($curl->error) {
    //error
} else {
    $html = $curl->response;
    $fpDom = new DOMDocument();
    @$fpDom->loadHTML($html);
    $xpath = new DOMXPath($fpDom);

    // Define the class name you want to select
    $className = 'show-ip-div';
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
    
    $atag = new DOMXPath($fpDom);
    $nodes = $atag->query("//a[contains(@href, 'port=')]");
    
    $data = [];
    
    // Check if we found elements
    if ($elements->length > 0 && $nodes->length > 0) {
        for($i = 0; $i < min($elements->length, $nodes->length); $i++) {
            $ip = trim($elements->item($i)->nodeValue);
            $port = trim($nodes->item($i)->nodeValue);
            
            try {
                // Load the MMDB database
                $reader = new Reader('GeoLite2-City.mmdb');
                $record = $reader->city($ip);
                
                // Extract data
                $timezone = $record->location->timeZone;
                $country = $record->country->name;
                
                // Create DateTime in the given timezone
                $dt = new DateTime("now", new DateTimeZone($timezone));
                $formattedDate = $dt->format('Y-m-d H:i:s');
                $abbreviation = $dt->format('T');
                $offsetSeconds = $dt->getOffset();
                $offsetFormatted = sprintf('%+03d:%02d', $offsetSeconds / 3600, abs($offsetSeconds % 3600) / 60);
                $utcDesignator = 'UTC' . ($offsetSeconds >= 0 ? '+' : '') . ($offsetSeconds / 3600);
                
                $reader->close();
                
                $data[] = [
                    'ip' => $ip,
                    'port' => (int)$port,
                    'type' => 'socks5',
                    'country' => $country,
                    'timezone' => $timezone,
                    'date' => $formattedDate,
                    'timezone_abbr' => $abbreviation,
                    'utc_offset' => $offsetFormatted, 
                    'utc_designator' => $utcDesignator,
                    'current_time' => $formattedDate,
                ];
            } catch (Exception $e) {
                // Log error but continue with next IP
                error_log("Error processing IP $ip: " . $e->getMessage());
                continue;
            }
        }
    } else {
        // No elements found - check if the page structure changed
        error_log("No proxy elements found in the response. Page structure may have changed.");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}
