<?php
require "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


$url = "http://0.0.0.0:8080/test2.php";


$curl = new Curl();

$cookieFile = 'cookies.txt';



$ua = $_SERVER['HTTP_USER_AGENT']." [IMD_IAB/IMD1;IMDBR/UAOIMD 1.0.28]";


// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file

$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($ua);

$curl->setCookie("imd", "1");
$curl->disableTimeout();
	
$curl->get($url);
echo $curl->response;

