<?php
if(!isset($_COOKIE['imd'])) {
	

include "header.php";



echo '

<title>Searching</title>
	
<script>
$("document").ready(function() {
	setTimeout(function() {
		if(localStorage.getItem("type") === "movies" && localStorage.getItem("from") === "search") {
			window.location.href = "http://0.0.0.0:8080/movies-search.php";
		}
		else if(localStorage.getItem("type") === "series" && localStorage.setItem("from") === "search") {
			window.location.href = "http://0.0.0.0:8080/series-search.php";
		}
		else if(localStorage.getItem("from") === "latest-movies") {
			window.location.href = "http://0.0.0.0:8080/latest-movies.php";
		}
		else if(localStorage.getItem("from") === "old-movies") {
			window.location.href = "http://0.0.0.0:8080/old-movies.php";
		}
		else if(localStorage.getItem("from") === "bollywood") {
			window.location.href = "http://0.0.0.0:8080/bollywood.php";
		}
	}, 15000);
});


</script>

';




include "head.php";
	
	
	
echo '
	
<div id="search-res-container">

	<br>
	<small id="small-res">Search Result</small>
	
	<div id="result">
		<div style="margin-top: 60px">

			<span style="margin-bottom: 5px; font-style: italic; font-weight: bold; display: flex; justify-content: center;">
				<small>Searching in movies sites...</small>
				<div id="fetch-links-loader"></div>
			</span>
			

			<center><div id="m-site-icon"><img height="30" width="30" src="net.png"></div></center>
		</div>

	</div>
	
</div>	
	
';


include "footer.php";


}
else {
	echo 'display ads';
}
