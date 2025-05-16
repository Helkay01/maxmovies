<?php
include "file:///storage/emulated/0/Movies/connection.php";
include "/data/data/com.termux/files/home/vendor/autoload.php";



use Curl\Curl;



//DB
$day = date('d M Y');

$no_day = "0";
$no_cache = "0";






$sel = "SELECT * FROM latest_movies WHERE today = :day";
$res = $conn->prepare($sel);
$res->bindParam(":day", $day);
$res->execute();

if($res->rowCount() === 0) {


$ins = "INSERT INTO latest_movies (today, m_cached) VALUES (:days, :cached)";
$ins_res = $conn->prepare($ins);
$ins_res->bindParam(":days", $day);
$ins_res->bindParam(":cached", $no_cache);
$ins_res->execute();



if($ins_res) {

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
			<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$year.'"><a href="http://0.0.0.0:8080/movies.php">
				<img src="'.$img.'">
			
			<div>
				<small><div id="cap">'.$result.' ('.$year.')</div></small>
			</div>
			</a></span>';
		
		$arr = array($output);
	}







shuffle($arr[0]);

foreach($arr[0] as $sh) {
	
	echo $sh;
}


}



}
else {
	echo 'cached';
}







/*

$curl = new Curl();

$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
$curl->disableTimeout();
	
$curl->get($url);


if($curl->getHttpStatusCode() === 200) {

	$curl->close();

	$html = $curl->response;

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
	

		
		// Find the position of the vertical bar
		$pos = strpos($title, '|');
		
		if ($pos !== false) {
			// Extract the substring before the vertical bar
			$result = trim(substr($title, 0, $pos));
		}
	
	}

		$output[] = '
			<span class="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$year.'"><a href="http://0.0.0.0:8080/movies.php">
				<img src="'.$img.'">
			
			<div>
				<small><div id="cap">'.$result.' '.$year.'</div></small>
			</div>
			</a></span>';
		$arr = array($output);
}







shuffle($arr[0]);

foreach($arr[0] as $sh) {
	echo $sh;
}




	
	



	
	


}

*/