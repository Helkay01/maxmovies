<?php
require 'vendor/autoload.php';

use GeoIp2\Database\Reader

$ip = $_GET['ip'];
$reader = new Reader('GeoLite2-City.mmdb');
$record = $reader->city($ip);
		
// Extract data
$timezone = $record->location->timeZone;
$country = $record->country->name;
		
echo $country;	

$reader->close();
