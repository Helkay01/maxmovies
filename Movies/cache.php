<?php
include "file:///storage/emulated/0/Movies/connection.php";


$type = $_POST['type'];
$cache = $_POST['cache'];
$mType = $_POST['mt'];


$day = date('d M Y');

if($type === "movies" && $mType === "latest-movies") {
	$sel = "UPDATE latest_movies set m_cached = :cache WHERE today = :day LIMIT 1";
	$res = $conn->prepare($sel);
	$res->bindParam(':day', $day);
	$res->bindParam(':cache', $cache);
	$res->execute();
	
	if($res) {
		echo 'now cached';
	}
}
else if($type === "movies" && $mType === "bollywood-movies") {
	$selb = "UPDATE bollywood_movies set m_cached = :cache WHERE today = :day LIMIT 1";
	$resb = $conn->prepare($selb);
	$resb->bindParam(':day', $day);
	$resb->bindParam(':cache', $cache);
	$resb->execute();
	
	if($resb) {
		echo 'now cached';
	}

}
else if($type === "movies" && $mType === "old-movies") {
	$selo = "UPDATE old_movies set m_cached = :cache WHERE today = :day LIMIT 1";
	$reso = $conn->prepare($selo);
	$reso->bindParam(':day', $day);
	$reso->bindParam(':cache', $cache);
	$reso->execute();
	
	if($reso) {
		echo 'now cached';
	}

}

