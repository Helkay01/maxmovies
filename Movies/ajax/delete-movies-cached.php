<?php
include "file:///storage/emulated/0/Movies/connection.php";

$day = date('d M Y');


$del = "DELETE FROM latest_movies WHERE today = :day LIMIT 1";
$res = $conn->prepare($del);
$res->bindParam(':day', $day);
$res->execute();

if($res) {
	echo 'deleted';
}

