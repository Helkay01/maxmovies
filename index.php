<?php

include 'err.php';

/*
function getClientIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
        return $_SERVER['HTTP_X_REAL_IP'];
    } else {
        return $_SERVER['REMOTE_ADDR']; // Fallback (could be ::1 or internal IP)
    }
}

$clientIP = getClientIP();
echo "User's IP: " . $clientIP;
*/



print_r($_SERVER);






?>

<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Movie Finder</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #0f172a; /* dark navy */
    }
    ::placeholder {
      color: #94a3b8;
    }
  </style>
</head>
<body class="text-white font-sans">
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
  </section>  <script>
    const movies = [
      {
        title: "Dune",
        poster: "https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg",
        year: 2020
        
      },
      {
        title: "The Batman",
        poster: "https://image.tmdb.org/t/p/w500/74xTEgt7R36Fpooo50r9T25onhq.jpg",
        year: 2018
      },
      {
        title: "Top Gun: Maverick",
        poster: "https://image.tmdb.org/t/p/w500/62HCnUTziyWcpDaBO2i1DX17ljH.jpg",
        year: 2025
      },
      {
        title: "Avatar 2",
        poster: "https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg",
        year: 2010
      }
    ];

    const movieGrid = document.getElementById('movieGrid');
    movies.forEach(movie => {
      const div = document.createElement('div');
      div.className = 'rounded-lg overflow-hidden shadow-lg hover:scale-105 transition-transform bg-slate-800';
      div.innerHTML = `
        <a href="/movies.php?t=${movie.title}&y=${movie.year}&poster=${movie.poster}">
	        <img src="${movie.poster}" alt="${movie.title}" class="w-full h-60 object-cover">
	       	<div class="p-4">
	          <h3 class="text-lg font-semibold">${movie.title} ${movie.year}</h3>
	        </div>
	    </a>
      `;
      movieGrid.appendChild(div);
    });

    document.getElementById('searchInput').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        	window.location.href = "/result.php?q="+document.getElementById('searchInput').value;
      }
    });
  </script>
  
  
  
  
  
  
</body>
   
</html>
