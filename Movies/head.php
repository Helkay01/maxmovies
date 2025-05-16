<?php


echo "Worked";

/*



//include "/data/data/com.termux/files/home/vendor/autoload.php";

//use Curl\Curl;





?>

</head>
<body>

<noscript>
  <meta http-equiv="refresh" content="0;url=nojavascript.html">
</noscript>

<!--ads -->
<div id="s-ads">
<?php
if(!isset($_COOKIE['imd'])) {
		
		
		$url = "http://0.0.0.0:8080/search.php";
		
		
		$curl = new Curl();
		
		$cookieFile = 'ajax/ads/cookies.txt';
		
		
		
		$ua = $_SERVER['HTTP_USER_AGENT']." [IMD_IAB/IMD1;IMDBR/UAOIMD 1.0.28]";
		
		
		// Enable cookie handling
		$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
		$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
		
		$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
		$curl->setUserAgent($ua);
		
		$curl->setCookie("imd", "1");
		$curl->disableTimeout();
		
		$curl->get($url);
		echo $curl->response;
		
}
else {
	echo 'display ads';

}

?>

</div>






<div id="contents">


	<header>
		<div>
			<a href="/search.php">
				<span id="name">
					<span style="color: red;">IMD</span>
				
				</span>
			</a>
			
			<span id="s-m">
				<span style="margin-top: 7px; font-size: 15px;" id="search-icon">
					<i class="fas fa-search"></i>
				</span>
				
				<span style="margin-top: 5px; font-size: 18px;" id="menu-icon">
					<i class="fas fa-bars"></i>	
				</span>
			</span>
		</div>
	</header>
	
	
	
	<div id="side-menu">
		<div id="cancel">X</div>
		
		
		<li id="movies">New Movies</li>
		<li hidden id="series">Latest Series</li>

		<li hidden id="kdrama">Kdrama</li>
		<li id="bollywood">Bollywood</li>
		<li id="old-movies">Old Movies</li>
		<li hidden id="about">About</li>
		<li hidden id="more-apps">More Apps</li>
	</div>
	
*/	
