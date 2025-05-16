<?php
session_start();


$dbHost="0.0.0.0:3306";  
$dbName="movies";  
$dbUser="root";      //by default root is user name.  
$dbPassword="root";     //password is blank by default  

try{  
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword);  

} catch(Exception $e){  
	Echo "Connection failed" . $e->getMessage();  
}  

$clickdb = "click";

$click = new PDO("mysql:host=$dbHost;dbname=$clickdb",$dbUser,$dbPassword);  