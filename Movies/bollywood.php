<?php
if(!isset($_COOKIE['imd'])) {

include "header.php";



echo '
<title>Bollywood Movies</title>
	
<script src="http://0.0.0.0:8080/js/bollywood-script.js"></script>
';



include "head.php";


echo '
<div id="search-res-container">

	<br>
	<br>
	<br>
	<small id="small-res">Bollywood (Indian) Movies</small>
	
	

	
	
	<div id="search-result">



	</div>
	
</div>

';
	
include "footer.php";

}
else {
	echo 'display ads';
}
