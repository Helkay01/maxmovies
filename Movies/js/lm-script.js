$("document").ready(function() {
	$("div#loader").show();
	
	var page = document.location;
	
	const currentDate = new Date();
	
	const cyear = currentDate.getFullYear();
	

	$.ajax({
		url: 'http://0.0.0.0:8080/ajax/latest-movies-ajax.php',

		success: function(data) {	

			if(data !== "" && data.match("img")) {
				$("div#loader").hide();
			
			
				var d = $("div#search-result").html(data);
					
				if(d) {
							
					//Cache in DB
					let ca = $("div#search-result").html();
					
					let ty = "movies";
					let mType = "latest-movies";
					
					$.ajax({
						url: 'http://0.0.0.0:8080/cache.php',
						method: 'POST',
						data: {mt: mType, type: ty, cache: ca},

					});
				
			
			
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
			else if(data == "cached") {

				var ty = "movies";
				let mType = "latest-movies";
				
				
				$.ajax({
					url: 'http://0.0.0.0:8080/ajax/get-cached.php',
					method: 'GET',
					data: {mt: mType, tp: ty},
					success: function(gdata) {
					if(gdata != "0") {	
						var d = $("div#search-result").html(gdata);
						$("div#loader").hide();
					
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
					 	$.ajax({
					 		url: 'http://0.0.0.0:8080/ajax/delete-movies-cached.php',
					 		success: function(data) {
					 			if(data == "deleted") {
					 				window.location.href = "http://0.0.0.0:8080/latest-movies.php";
					 			}
					 		}
					 	});
					 }
					
					}
				
				}); 
			}
			else {
				$("div#search-result").html('<center style="width: 100vw; "><big><i>Error occured. Please <a style="font-weight: bold; color: red;" href="http://0.0.0.0:8080/search.php">search</a>  for movies or <a style="font-weight: bold; color: red;" href="'+page+'">reload</a> this page. You can also check new release movies on the movie database => <a style="color: green; font-weight: bold;" href="https://www.imdb.com/search/title/?title_type=feature&release_date='+cyear+'-01-01,'+cyear+'-12-31">IMDB</a> and download here. <br><br><br></i></big></center>');
				$("div#loader").hide();
			}
		}
	})
	
	
	
	
	
});