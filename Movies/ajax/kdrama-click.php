<?php
include "file:///storage/emulated/0/Movies/connection.php";


$date = date('M Y');
$ct = "1";


$sel = "SELECT * FROM kdrama WHERE month_year = :my LIMIT 1";
$res = $click->prepare($sel);
$res->bindParam(":my", $date);
$res->execute();


if($res) {

	
	if($res->rowCount() === 0) {
		$ins = "INSERT INTO kdrama (month_year, count) VALUES (:my, :count)";
		$ins_res = $click->prepare($ins);
		$ins_res->bindParam(":my", $date);
		$ins_res->bindParam(":count", $ct);
		$ins_res->execute();
		if($ins_res) {
		echo 'done';
		}
	}
	else {
		$det = $res->fetch(PDO::FETCH_ASSOC);
		$count = $det['count'];
		
		$num = $count + 1;
		
		$up = "UPDATE kdrama SET count = :num WHERE month_year = :my LIMIT 1";
		$up_res = $click->prepare($up);
		$up_res->bindParam(':num', $num);		
		$up_res->bindParam(':my', $date);
		$up_res->execute();
		
		if($up_res) {
			echo 'done';
		}
	}
	
}








