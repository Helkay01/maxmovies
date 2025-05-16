<?php
include "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


//$title = $_GET['t'];
//$year = $_GET['y'];

$title = "cabrini";
$year = "2024";




$re = str_replace("'", "", $title);
$rep = str_replace(" ", "-", $re);


//Curl Start

$url = 'https://www.rogerebert.com/reviews/'.strtolower($rep).'-film-review-'.$year;



function movies() {

$title = $_GET['t'];
$year = $_GET['y'];




$re = str_replace("'", "", $title);
$rep = str_replace(" ", "-", $re);



$url2 = 'https://www.rogerebert.com/reviews/'.strtolower($rep).'-movie-review-'.$year;


$curl2 = new Curl();

$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

// Enable cookie handling
$curl2->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl2->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file


$curl2->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl2->setUserAgent($_SERVER['HTTP_USER_AGENT']);


$curl2->disableTimeout();
	
$curl2->get($url2);


if($curl2->getHttpStatusCode() === 404) {
	echo 'error';
}
else if($curl2->getHttpStatusCode() === 200) {
	$html2 = $curl2->response;
	
	
	$dom2 = new DOMDocument();
	@$dom2->loadHTML($html2);
	
	$xpath = new DOMXPath($dom2);
	
	// Define the class name you want to select
	$className = 'column is-6';
	
	// Use XPath query to select elements by class name
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
	
	foreach($elements as $ele) {		
		if($ele->getElementsByTagName("p")->item(0) !== null && !str_contains($ele->getElementsByTagName("p")->item(0)->nodeValue, "Now streaming on:") && !str_contains($ele->getElementsByTagName("p")->item(0)->nodeValue, "RogerEbert.com") && !str_contains($ele->getElementsByTagName("p")->item(0)->nodeValue, "written")) {
			echo $ele->getElementsByTagName("p")->item(0)->nodeValue;
		}
	}

}



}




$curl = new Curl();

$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file


$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);


$curl->disableTimeout();
	
$curl->get($url);


if($curl->getHttpStatusCode() === 404) {
	movies();
}
else if($curl->getHttpStatusCode() === 200) {
	$html = $curl->response;
	
	
	$dom = new DOMDocument();
	@$dom->loadHTML($html);
	
	$xpath = new DOMXPath($dom);
	
	// Define the class name you want to select
	$className = 'column is-6';
	
	// Use XPath query to select elements by class name
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
	
	foreach($elements as $ele) {		
		if($ele->getElementsByTagName("p")->item(0) !== null && !str_contains($ele->getElementsByTagName("p")->item(0)->nodeValue, "Now streaming on:") && !str_contains($ele->getElementsByTagName("p")->item(0)->nodeValue, "RogerEbert.com") && !str_contains($ele->getElementsByTagName("p")->item(0)->nodeValue, "written")) {
			echo $ele->getElementsByTagName("p")->item(0)->nodeValue;
		}
	}

}



