<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #0f172a; /* dark navy */
    }
    ::placeholder {
      color: #94a3b8;
    }
  </style>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script></script>
  
<script>  
	$("document").ready(function() {
		
		var title = $("#t").html();
		
		$.ajax({
			url: '/finder.php',
			data: {t: title},
			success: function(data) {
				$("#movieGrid").html(data)
			}
		})
	
	
	})
</script>
  
  
  
  
  
<script>
			
</script>
  

  
</head>
<body class="text-white font-sans">

<div hidden id="t"><?php
		if(isset($_GET['q'])) {
			echo $_GET['q'];
		}
	?>
</div>




<section class="p-8">
  
  
  <h2 class="text-3xl font-semibold mb-6">Popular Movies</h2>
  <div id="movieGrid" class="grid grid-cols-2 md:grid-cols-4 gap-6">

  </div>
  
</section> 

		
		



  
  </body>
</html>
