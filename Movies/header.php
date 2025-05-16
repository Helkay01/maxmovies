<?php
session_start();


header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');


if(!isset($_COOKIE['id'])) {
	$str = "javwcuwojhioqhhGGAHOWJWCVWJWIWYGVSDOSJ273929HSBSHJJ129273640837288BSCSHSJSKDKKKDVVVSKKEKKKOSCSCWKEYTWPSLSKNZBCACAGSHHWOOWYTTEFRXVCNNKOODOJDbahwjvsgggxjiwo2726526393737203735Ghscwgsjkksbsghjswgzgwttyiopmmvcxaxwfsh";
	$sh = str_shuffle($str);
	$substr = substr($sh, 0, 30);

	$set = setcookie("id", $substr, time() + 240 * 36000, "/");
	
	if($set) {
		$mk = mkdir("ajax/c/".$substr);
		$mkad = mkdir("ajax/ads/".$substr);
	} 
}

?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="http://0.0.0.0:8080/css/style.css">
	
	<link rel="preload" as="image" href="http://0.0.0.0:8080/apple.png">
	<link rel="preload" as="image" href="http://0.0.0.0:8080/hulu.png">  
	<link rel="preload" as="image" href="http://0.0.0.0:8080/max.png">
	<link rel="preload" as="image" href="http://0.0.0.0:8080/net.png">
	<link rel="preload" as="image" href="http://0.0.0.0:8080/para.png">
	<link rel="preload" as="image" href="http://0.0.0.0:8080/prime.png">
	
	
	<link rel="stylesheet" href="http://0.0.0.0:8080/font/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="http://0.0.0.0:8080/font/fontawesome/css/fontawesome.min.css">
	

	
	

	    	
	    	
	<script src="http://0.0.0.0:8080/js/jquery-3.2.1.js"></script>
	<script src="http://0.0.0.0:8080/js/script.js"></script>


