<?php
if(!isset($_COOKIE['imd'])) {


include "header.php";


echo '

<title>New Movies</title>
		
<script src="http://0.0.0.0:8080/js/lm-script.js"></script>

';


include "head.php";


echo '

<div id="search-res-container">

	<br>
	<br>
	<br>
	<small id="small-res">New Movies</small>
	
	

	
	
	<div id="search-result">



	</div>
	
</div>

';
	

include "footer.php";


}
else {
	echo 'display ads';
}
