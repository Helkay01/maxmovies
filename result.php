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
				$(".rounded-lg").html(data)
			}
		})
	
	
	})
</script>
  
  
  
  
  
<script>
			
</script>
  
  
  
  
</head>
<body class="text-white font-sans">

<div hidden id="t">
	<?php
		if(isset($_GET['q'])) {
			echo $_GET['q'];
		}
	?>
</div>



  <!-- Hero Section -->
  <section class="relative h-screen bg-cover bg-center" style="background-image: url('https://image.tmdb.org/t/p/original/qJxzjUjCpTPvDHldNnlbRC4OqEh.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-70 flex flex-col justify-center items-center text-center p-6">
      <h1 class="text-5xl font-bold mb-4">Find Your Favorite Movies</h1>
      <p class="text-lg text-slate-300 mb-8">Search and explore trending films</p>
      <div class="w-full max-w-2xl">
        <input id="searchInput" type="text" placeholder="Search for a movie..." class="w-full px-6 py-3 rounded-full text-lg text-black focus:outline-none" />
      </div>
    </div>
  </section>  <!-- Trending Movies -->  <section class="p-8">
    <h2 class="text-3xl font-semibold mb-6">Popular Movies</h2>
    <div id="movieGrid" class="grid grid-cols-2 md:grid-cols-4 gap-6">
      <!-- Movie Cards will be inserted here -->
    </div>
  </section>
  
		<div class="rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform bg-slate-800">
		
		
		</div>
		
		



  
  </body>
</html>
