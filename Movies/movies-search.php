<?php
if(!isset($_COOKIE['imd'])) {

include "header.php";


echo '
	<title>Movies Search</title>
	
	
<script src="http://0.0.0.0:8080/js/get-movies.js"></script>

';



include "head.php";



echo '

<div id="search-res-container">

	<br>
	<br>
	<br>
	<small id="small-res">Results from movie sites</small>
	
	

	
	
	<div id="search-result">



	</div>
	
</div>

';
	


include "footer.php";


}
else {
	echo 'display ads';
}

