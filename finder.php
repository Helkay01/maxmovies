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
				<div class="rounded-xl overflow-hidden bg-slate-800 shadow-md hover:shadow-2xl transform hover:scale-105 transition duration-300 ease-in-out">
				        <a href="/watch.php?t='.$result.'&y='.$year.'&img='.$img.'">
          					<img src="'.$img.'" class="w-full h-72 object-cover">
          					<div class="p-4">
				            		<h3 class="text-lg font-semibold">'.$result.'</h3>
            						<p class="text-sm text-slate-400">'.$year.'</p>
          					</div>
        				</a>
				</div>
   			';


		$arr = array($output);
	}







shuffle($arr[0]);

foreach($arr[0] as $sh) {
	
	echo $sh;
}
