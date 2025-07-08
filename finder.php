<?php

include "vendor/autoload.php";



$url = "https://nkiri.com/category/international/";



// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);

// Execute the cURL request
$response = curl_exec($ch);


$html = $response;


$dom = new DOMDocument();
@$dom->loadHTML($html);

$articles = $dom->getElementsByTagName("article");

foreach($articles as $article) {
	$img = $article->getElementsByTagName("img")->item(0)->getAttribute("src");
	$header = $article->getElementsByTagName("header")->item(0);
	$link = $header->getElementsByTagName("a")->item(0)->getAttribute("href");
	
	$string = $header->getElementsByTagName("a")->item(0)->nodeValue;


	$pattern = '/\((\d+)\)/'; // Regular expression pattern to match digits inside parentheses
	
	if(preg_match($pattern, $string, $matches)) {
		$figuresInsideParentheses = $matches[1]; // Extract the figures inside parentheses
		$year = $figuresInsideParentheses;
		
		$t1 = str_replace("(", "", $string);
		$t2 = str_replace(")", "", $t1);
		$t3 = str_replace("Download", "", $t2);
		
		$title = str_replace($year, "", $t3);

		
		
		$pos = strpos($title, '|');
		
		if ($pos !== false) {
			$result = trim(substr($title, 0, $pos));
		}
	
	}

		$output[] = '
			<li style="" class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$year.'"><a href="https://imd.com.ng/movies.php?t='.$result.'&y='.$year.'&img='.$img.'">
				<img src="'.$img.'">
			
			<div>
				<small><div id="cap">'.$result.' ('.$year.')</div></small>
			</div>
			</a></li>';
		
		$arr = array($output);
	}







shuffle($arr[0]);

foreach($arr[0] as $sh) {
	
	echo $sh;
}
