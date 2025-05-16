$("document").ready(function() {
	

	
	
	const isCookieEnabled = navigator.cookieEnabled;
	
	if(isCookieEnabled === false) {
		window.location.href = "http://0.0.0.0:8080/nocookies.html";
	}
	
	
		
	
	
	var li = document.querySelectorAll("#side-menu li");

	li.forEach(function(e, index) {
		e.onclick = function() {
			$("div#side-menu").animate({"width": 0});
		}
	})
	
	
	
	
	
	$("div#side-menu div#cancel").click(function() {
		$("div#side-menu").animate({"width": 0});
	});

	
	$("span#menu-icon").click(function() {
		$("div#side-menu").animate({"width": "65%"});
	});
	
	
	$("span#search-icon").click(function() {
		window.location.href = "http://0.0.0.0:8080/search.php";	
	});
	
	

	
	
	$("div#side-menu li#movies").click(function() {

		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/latest-movies-click.php',
			method: 'POST',
			success: function(data) {

				if(data == "done") {
					localStorage.setItem("from", "latest-movies");
					window.location.href = "http://0.0.0.0:8080/search-result.php";
				}
			}
		});
	});
	
	
	
	$("div#side-menu li#series").click(function() {
		$("div#imdb-series").slideToggle();
	
	
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-imdb-series.php',
			method: 'POST',
			success: function(data) {

			}
		});
		

			
			
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/latest-series-click.php',
			method: 'POST',
			success: function(data) {
				if(data == "done") {
					window.location.href = "http://0.0.0.0:8080/latest-series.php";	
				} 
			}
		});

	});
	
	
/*	
	$("div#side-menu li#trending").click(function() {
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/trending-click.php',
			method: 'POST',
			success: function(data) {
				if(data == "done") {
					window.location.href = "http://0.0.0.0:8080/trending.php";	
				}
			}
		});

	});
*/	
	
	
	$("div#side-menu li#kdrama").click(function() {
		$("div#imdb-kd").slideToggle();
			
			
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-imdb-kd.php',
			method: 'POST',
			success: function(data) {
		
			}
		});
		
		
		
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/kdrama-click.php',
			method: 'POST',
			success: function(data) {
			/*	if(data == "done") {
					window.location.href = "http://0.0.0.0:8080/kdrama.php";	
				} */
			}
		});

	});
	
	
	
	$("div#side-menu li#bollywood").click(function() {
	/*	$("div#imdb-bollywood").slideToggle();
			
			
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-imdb-bollywood.php',
			method: 'POST',
			success: function(data) {
		
			}
		});
	*/	
		
		
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/bollywood-click.php',
			method: 'POST',
			success: function(data) {
				if(data == "done") {
					window.location.href = "http://0.0.0.0:8080/search-result.php";	
					localStorage.setItem("from", "bollywood");			
				}
			}
		});

	});
	
	
	
	$("div#side-menu li#old-movies").click(function() {
	/*	$("div#imdb-old-movies").slideToggle();
			
			
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-imdb-old-movies.php',
			method: 'POST',
			success: function(data) {
		
			}
		});
	*/	
		
		
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/old-movies-click.php',
			method: 'POST',
			success: function(data) {
				if(data == "done") {
					localStorage.setItem("from", "old-movies");				
					window.location.href = "http://0.0.0.0:8080/search-result.php";	
				}
			}
		});

	});
	
	
	
	$("div#side-menu li#about").click(function() {
		window.location.href = "http://0.0.0.0:8080/about.php";	
	});
	
	
	
	$("div#side-menu li#more-apps").click(function() {
		window.location.href = "http://0.0.0.0:8080/more-apps.php";	
	});
	



	$("div#imdb-old-movies-result *").click(function(e) {
		e.preventDefault();
		alert('Copy the movie or series title, paste it in the search page and download.');
	});
	
	$("div#imdb-series-result *").click(function(e) {
		e.preventDefault();
		alert('Copy the movie or series title, paste it in the search page and download.');
	});
	
	$("div#imdb-kd-result *").click(function(e) {
		e.preventDefault();
		alert('Copy the movie or series title, paste it in the search page and download.');
	});
	
	
	$("div#imdb-bollywood-result *").click(function(e) {
		e.preventDefault();
		alert('Copy the movie title, paste it in the search page and download.');
	});



setInterval(function() {
	var icon = document.querySelector("#m-site-icon img");
	var img = ["apple.png", "net.png", "hulu.png", "max.png", "prime.png", "para.png"];
	
	var rand = Math.round(Math.random() * 5);

	if(icon !== null || icon !== undefined) {
		$("div#m-site-icon img").attr("src", img[rand]);
	}

}, 2000);



	/*Search Input */
	
	$("form#search-form").submit(function(e) {
		e.preventDefault();

		var title = $("input#title").val();

		var year = $("input#yr").val();			
		


			var op = document.querySelectorAll("op");
		
			if($("option#movies").is(":selected") && !$("option#series").is(":selected")) {
				$("form#search-form select").css("border", "1px solid green");
	
			//	if(title !== "" && year !== "") {
				if(title !== "") {
					localStorage.setItem("title", title);
					localStorage.setItem("year", year);
					localStorage.setItem("type", "movies");
					localStorage.setItem("from", "search");

					window.location.href = "http://0.0.0.0:8080/search-result.php";
					$("form#search-form button").html("Loading...");
				}
			}
			else if(!$("option#movies").is(":selected") && $("option#series").is(":selected")) {
				$("form#search-form select").css("border", "1px solid green");
				
			//	if(title !== "" && year !== "") {
				if(title !== "") {		
					localStorage.setItem("title", title);
					localStorage.setItem("year", year);
					localStorage.setItem("type", "series");
					localStorage.setItem("from", "search");
										
										
					window.location.href = "http://0.0.0.0:8080/search-result.php";
					$("form#search-form button").html("Loading...");		
				}
			}
			else {
				$("form#search-form select").css("border", "1px solid red");
			}
		

	});



	/* End */












});


