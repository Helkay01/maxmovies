$("document").ready(function() {


/*Search Result Start*/

	var title = localStorage.getItem("title");
	var year = localStorage.getItem("year");
	var type = localStorage.getItem("type");	
	

	$.ajax({
		url: 'http://localhost:8080/fod/test.php',
		data: {title: title, year: year, type: type},
		success: function(data){
			alert(data);
		}
	});







/* End   */




});

