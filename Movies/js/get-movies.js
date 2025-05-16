$("document").ready(function() {
	
	$("div#loader").show();

	var page = document.location;
	
	const currentDate = new Date();
	
	const cyear = currentDate.getFullYear();
	
	var title = localStorage.getItem("title");
	var year = localStorage.getItem("year");





	function plutoMovies() {
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-movies-pluto.php',
			data: {t: title, y: year},
		
			success: function(data) {	
	
			if(data !== "" && data.match("img")) {
				$("div#loader").hide();
						
				var d = $("div#search-result").html(data);
					
				if(d) {
										
					var m = document.querySelectorAll(".movies");
									
				
					m.forEach(function(e, index) {
						e.onclick = function() {
							let title = e.dataset.title;
							let img = e.dataset.img;
							let year = e.dataset.year;	
							
							localStorage.setItem("title", title);
							localStorage.setItem("year", year);
							localStorage.setItem("img", img);
							
							
							var mp = '<div style="margin-top: 80px;"><img style="margin: 15px;" src="'+img+'" id="m-img" alt="mImage"><br><center><h1>'+title+' ('+year+')</h1></center><br><br><a style="margin: 15px; color: red;" href="#downloadLinks"><b>DOWNLOAD</b></a><br><br><br><div style="margin-top: 50px; margin-left: 10px"><label style="padding: 5px; border-bottom: 5px solid red;"><b>Review</b></label><br><br><center><div id="review-div">Fetching from the server. Please wait...</div></center></div><div style="margin-top: 80px; backgroun: white; color: blac; " id="downloadLinks" style=" margin-top: 100px; margin-left: 10px"><div style="display: flex;"><span style="margin-right: 10px;" ><b><i>Creating download links...</i></b></span><div id="fetch-links-loader"></div></div><br><div><i>Download from these fast servers.</i></div><br><div id="fz" class="webLinks"></div><div id="net" class="webLinks"></div><div id="nk" class="webLinks"></div><div id="pluto" class="webLinks"></div><div id="staga" class="webLinks"></div></div><br></div>';
			
				
							
							$.ajax({
								url: 'http://0.0.0.0:8080/ajax/movie-session.php',
								method: 'POST',
								data: {da: mp} 
							
							});
						}
					})
				 } 
			}
			else {
				$("div#search-result").html('<center style="width: 100vw; font-style: italic;">Not Found. Please <a style="color: red;" href="http://0.0.0.0:8080/movies-search.php"><b>reload</b></a> this page or try again later.</center>');
				$("div#loader").hide();
			}
		}	
	});
}









	function fzMovies() {
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-movies-fz.php',
			data: {t: title, y: year},
		
			success: function(data) {	
		
			if(data !== "" && data.match("img")) {
				$("div#loader").hide();
						
				var d = $("div#search-result").html(data);
					
				if(d) {
										
					var m = document.querySelectorAll(".movies");
									
				
					m.forEach(function(e, index) {
						e.onclick = function() {
							let title = e.dataset.title;
							let img = e.dataset.img;
							let year = e.dataset.year;	
							
							localStorage.setItem("title", title);
							localStorage.setItem("year", year);
							localStorage.setItem("img", img);
							
							
							var mp = '<div style="margin-top: 80px;"><img style="margin: 15px;" src="'+img+'" id="m-img" alt="mImage"><br><center><h1>'+title+' ('+year+')</h1></center><br><br><a style="margin: 15px; color: red;" href="#downloadLinks"><b>DOWNLOAD</b></a><br><br><br><div style="margin-top: 50px; margin-left: 10px"><label style="padding: 5px; border-bottom: 5px solid red;"><b>Review</b></label><br><br><center><div id="review-div">Fetching from the server. Please wait...</div></center></div><div style="margin-top: 80px; backgroun: white; color: blac; " id="downloadLinks" style=" margin-top: 100px; margin-left: 10px"><div style="display: flex;"><span style="margin-right: 10px;" ><b><i>Creating download links...</i></b></span><div id="fetch-links-loader"></div></div><br><div><i>Download from these fast servers.</i></div><br><div id="fz" class="webLinks"></div><div id="net" class="webLinks"></div><div id="nk" class="webLinks"></div><div id="pluto" class="webLinks"></div><div id="staga" class="webLinks"></div></div><br></div>';
			
							
							$.ajax({
								url: 'http://0.0.0.0:8080/ajax/movie-session.php',
								method: 'POST',
								data: {da: mp} 
							
							});
						}
					})
				 } 
			}
			else {
				plutoMovies();
			}
		}	
	});
}




	function netMovies() {
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/get-movies-net.php',
			data: {t: title, y: year},
		
			success: function(data) {	

			if(data !== "" && data.match("img")) {
				$("div#loader").hide();
						
				var d = $("div#search-result").html(data);
					
				if(d) {
										
					var m = document.querySelectorAll(".movies");
									
				
					m.forEach(function(e, index) {
						e.onclick = function() {
							let title = e.dataset.title;
							let img = e.dataset.img;
							let year = e.dataset.year;	
							
							localStorage.setItem("title", title);
							localStorage.setItem("year", year);
							localStorage.setItem("img", img);
							
							
							var mp = '<div style="margin-top: 80px;"><img style="margin: 15px;" src="'+img+'" id="m-img" alt="mImage"><br><center><h1>'+title+' ('+year+')</h1></center><br><br><a style="margin: 15px; color: red;" href="#downloadLinks"><b>DOWNLOAD</b></a><br><br><br><div style="margin-top: 50px; margin-left: 10px"><label style="padding: 5px; border-bottom: 5px solid red;"><b>Review</b></label><br><br><center><div id="review-div">Fetching from the server. Please wait...</div></center></div><div style="margin-top: 80px; backgroun: white; color: blac; " id="downloadLinks" style=" margin-top: 100px; margin-left: 10px"><div style="display: flex;"><span style="margin-right: 10px;" ><b><i>Creating download links...</i></b></span><div id="fetch-links-loader"></div></div><br><div><i>Download from these fast servers.</i></div><br><div id="fz" class="webLinks"></div><div id="net" class="webLinks"></div><div id="nk" class="webLinks"></div><div id="pluto" class="webLinks"></div><div id="staga" class="webLinks"></div></div><br></div>';
		
							
							$.ajax({
								url: 'http://0.0.0.0:8080/ajax/movie-session.php',
								method: 'POST',
								data: {da: mp} 
							
							});
						}
					})
				 } 
			}
			else {
				fzMovies();
			}
		}	
	});
}
	
	

	
	
	

	$.ajax({
		url: 'http://0.0.0.0:8080/ajax/get-movies-nk.php',
		data: {t: title, y: year},

		success: function(data) {	

			if(data !== "" && data.match("img")) {
				$("div#loader").hide();
						
				var d = $("div#search-result").html(data);
					
				if(d) {
										
					var m = document.querySelectorAll(".movies");
									

					m.forEach(function(e, index) {
						e.onclick = function() {
							let title = e.dataset.title;
							let img = e.dataset.img;
							let year = e.dataset.year;	
			
							localStorage.setItem("title", title);
							localStorage.setItem("year", year);
							localStorage.setItem("img", img);
							
							
							var mp = '<div style="margin-top: 80px;"><img style="margin: 15px;" src="'+img+'" id="m-img" alt="mImage"><br><center><h1>'+title+' ('+year+')</h1></center><br><br><a style="margin: 15px; color: red;" href="#downloadLinks"><b>DOWNLOAD</b></a><br><br><br><div style="margin-top: 50px; margin-left: 10px"><label style="padding: 5px; border-bottom: 5px solid red;"><b>Review</b></label><br><br><center><div id="review-div">Fetching from the server. Please wait...</div></center></div><div style="margin-top: 80px; backgroun: white; color: blac; " id="downloadLinks" style=" margin-top: 100px; margin-left: 10px"><div style="display: flex;"><span style="margin-right: 10px;" ><b><i>Creating download links...</i></b></span><div id="fetch-links-loader"></div></div><br><div><i>Download from these fast servers.</i></div><br><div id="fz" class="webLinks"></div><div id="net" class="webLinks"></div><div id="nk" class="webLinks"></div><div id="pluto" class="webLinks"></div><div id="staga" class="webLinks"></div></div><br></div>';
		
							
							$.ajax({
								url: 'http://0.0.0.0:8080/ajax/movie-session.php',
								method: 'POST',
								data: {da: mp} 
							
							});
						}
					})
				   
	
		
				   
				   
				}
				

			}
			else {
				//Net9ja
				netMovies();

			}
		}
	})
	
	


	





	
	


});


