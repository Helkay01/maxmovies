<?php

require 'vendor/autoload.php';


use Curl\Curl;

use GeoIp2\Database\Reader;





$curl = new Curl();


$cookieFile = 'c.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file

$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);


$curl->setHeader('Accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8');
$curl->setHeader('Accept-Language', 'en-US,en;q=0.9');
$curl->setHeader('Connection', 'keep-alive');
$curl->setHeader('User-Agent', $_SERVER['HTTP_USER_AGENT']);




$curl->disableTimeout();
$curl->get('https://www.freeproxy.world/', [
    'type' => 'socks5',
   'anonymity' => 4,
   'country' => '',
   'speed' => 500,
  'port' => '',
   'page' => 1,

]);

if ($curl->error) {
    echo 'Error: ' . $curl->errorMessage . "\n";
    $curl->diagnose();
} else {

    $html = $curl->response;
    $fpDom = new DOMDocument();
    @$fpDom->loadHTML($html);

    $xpath = new DOMXPath($fpDom);


    // Define the class name you want to select
    $className = 'show-ip-div';

    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");


    $atag = new DOMXPath($fpDom);

    // Find all <a> tags with href containing 'port='
    $nodes = $atag->query("//a[contains(@href, 'port=')]");


    $data = [];


    for($i = 1; $i < $elements->length; $i++) {
	$ip =  trim($elements->item($i)->nodeValue);

	$port = trim($nodes[$i]->nodeValue);



	    // Load the MMDB database
    $reader = new Reader('GeoLite2-City.mmdb');
    $record = $reader->city($ip);

    // Extract data
    $timezone = $record->location->timeZone;
    $country = $record->country->name;

    // Create DateTime in the given timezone
    $dt = new DateTime("now", new DateTimeZone($timezone));
    $formattedDate = $dt->format('Y-m-d H:i:s');
    $abbreviation   = $dt->format('T');     // Timezone abbreviation (e.g., CDT)
    $offsetSeconds  = $dt->getOffset();     // Offset in seconds
    $offsetFormatted = sprintf('%+03d:%02d', $offsetSeconds / 3600, abs($offsetSeconds % 3600) / 60); // e.g. -05:00
    $utcDesignator  = 'UTC' . ($offsetSeconds >= 0 ? '+' : '') . ($offsetSeconds / 3600);


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
   

   
   }


	
	header('Content-Type: application/json');
	echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

}

















	
	
	
