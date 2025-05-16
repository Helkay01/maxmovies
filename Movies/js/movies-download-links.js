$("document").ready(function() {
	var title = localStorage.getItem("title");
	var year = localStorage.getItem("year");

	$("div#fetch-links-loader").show();	
	
/*
		//Staga
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/stagatv.php',
			data: {t: title, y: year},
			success: function(data) {
alert(data);
				if(data == "" || data.match("warning") || data.match("deprecated") || data.match("error")) {	
					console.log("error");
				}							
				else if(data != "" && data.match("https") || data.match("http")) {	
					$("div#staga").html(data);
				}
			}
		});
	
*/

	
	
	
	

	

		//Pluto
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/pluto.php',
			data: {t: title, y: year},
			success: function(data) {

				if(data == "" || data.match("warning") || data.match("deprecated") || data.match("error")) {	
					console.log("error");
				}
				else if(data != "" && data.match("https") || data.match("http")) {	
					$("div#pluto").html(data);
				}
			}
		});
	

	

	
	
	

		//Net
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/net.php',
			data: {t: title, y: year},
			success: function(data) {

				if(data == "" || data.match("warning") || data.match("deprecated") || data.match("error")) {	
					console.log("error");
				}								
				else if(data != "" && data.match("https") || data.match("http")) {	
					$("div#net").html(data);
				}
			}
		});
	
	


	
	
	
	
	

		//Nk
		$.ajax({
			url: 'http://0.0.0.0:8080/ajax/nk.php',
			data: {t: title, y: year},
			success: function(data) {

				if(data == "" || data.match("warning") || data.match("deprecated") || data.match("error")) {	
					console.log("error");
				}				
				else if(data != "" && data.match("https") || data.match("http")) {	
					$("div#nk").html(data);
				}
		
			}
		});
	


	
	
	
	
	
	
	//Fz
	$.ajax({
		url: 'http://0.0.0.0:8080/ajax/fz.php',
		data: {t: title, y: year},
		success: function(data) {

			if(data == "" || data.match("warning") || data.match("deprecated") || data.match("error")) {	
				console.log("error");
			}
			else if(data != "" && data.match("https") || data.match("http")) {	
				$("div#fz").html(data);
			}
		}
	});
























//Get Reviews
$.ajax({
	url: 'http://0.0.0.0:8080/ajax/reviews.php',
	data: {t: title, y: year},
	success: function(data) {
		if(data !== "error") {
			$("div#review-div").html(data);
		}
		else {
			$("div#review-div").html("Failed to fetch reviews.");			
		}
	}
});






});