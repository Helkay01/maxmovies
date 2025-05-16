<?php
include "/data/data/com.termux/files/home/vendor/autoload.php";
include "file:///storage/emulated/0/Movies/connection.php";



use Curl\Curl;




//DB
$day = date('d M Y');

$no_day = "0";
$no_cache = "0";






$sel = "SELECT * FROM bollywood_movies WHERE today = :day";
$res = $conn->prepare($sel);
$res->bindParam(":day", $day);
$res->execute();

if($res->rowCount() === 0) {


$ins = "INSERT INTO bollywood_movies (today, m_cached) VALUES (:days, :cached)";
$ins_res = $conn->prepare($ins);
$ins_res->bindParam(":days", $day);
$ins_res->bindParam(":cached", $no_cache);
$ins_res->execute();



if($ins_res) {




$url = 'https://fzmovies.net/movieslist.php';



// Form data to be submitted
$formData = array(
    "catID" => "1",
    "by" => "date",
);


$curl = new Curl();

$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file


$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);


$curl->disableTimeout();
	
$curl->get($url, $formData);


if($curl->getHttpStatusCode() === 200) {

	$curl->close();

	$html = $curl->response;

	$dom = new DOMDocument();
	@$dom->loadHTML($html);

	$xpath = new DOMXPath($dom);

	// Define the class name you want to select
	$className = 'mainbox';

	// Use XPath query to select elements by class name
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");

	for($e = 0; $e < count($elements); $e++) {
		$one =  $elements->item($e);
		$lk = $one->getElementsByTagName("a")->item(0);
		$sm = $one->getElementsByTagName("small")->item(1);
		
		$imgPath = $one->getElementsByTagName("img")->item(0);
		$img = "https://fzmovies.net/".$imgPath->getAttribute("src");
		$mTitle = $one->getElementsByTagName("small")->item(0)->nodeValue;
		
		$fzlink = $lk->getAttribute('href');
		$yr = $sm->nodeValue;
		$yr1 = str_replace("(", "", $yr);
		$yr2 = str_replace(")", "", $yr1);

		
		$output[] = '
			<span class="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr2.'"><a href="http://0.0.0.0:8080/movies.php">
				<img src="'.$img.'">
			
			<div>
				<small><div id="cap">'.$mTitle.' '.$yr2.'</div></small>
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


}
else {
	echo 'cached';
}