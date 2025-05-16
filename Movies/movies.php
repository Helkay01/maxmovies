<?php
if(!isset($_COOKIE['imd'])) {

include "header.php";





echo '

<title>Movie</title>

<script src="http://0.0.0.0:8080/js/movies-download-links.js"></script>

';


include "head.php";


echo $_SESSION['mp'];
		
		
echo '		
		<br>
		
		<div style="margin: 20px;" id="ad">
			ad
		</div>
';

	
include "footer.php";

}

else {
	echo 'display ads';
}

