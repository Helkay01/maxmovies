<?php
include "file:///storage/emulated/0/Movies/connection.php";


$day = date('d M Y');


$type = $_GET['tp'];
$mType = $_GET['mt'];

if($type === "movies" && $mType === "latest-movies") {

$sel = "SELECT * FROM latest_movies WHERE today = :day";
$res = $conn->prepare($sel);
$res->bindParam(":day", $day);
$res->execute();

if($res->rowCount() > 0) {

	$det = $res->fetch(PDO::FETCH_ASSOC);
	$ca = $det['m_cached'];
	echo $ca;
}

}
else if($type === "movies" && $mType === "bollywood-movies") {

$selb = "SELECT * FROM bollywood_movies WHERE today = :day";
$resb = $conn->prepare($selb);
$resb->bindParam(":day", $day);
$resb->execute();

	if($resb->rowCount() > 0) {

		$detb= $resb->fetch(PDO::FETCH_ASSOC);
		$cab = $detb['m_cached'];
		echo $cab;
	}

}
else if($type === "movies" && $mType === "old-movies") {

$selo = "SELECT * FROM old_movies WHERE today = :day";
$reso = $conn->prepare($selo);
$reso->bindParam(":day", $day);
$reso->execute();

	if($reso->rowCount() > 0) {

		$deto= $reso->fetch(PDO::FETCH_ASSOC);
		$cao = $deto['m_cached'];
		echo $cao;
	}

}

