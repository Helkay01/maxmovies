<?php
include "header.php";
?>

<!-- ✅ JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
window.onload = function() {

      //var title = $("#t").text().trim();

      // Render skeleton loader grid (8 items)
      const skeletonHTML = Array(8).fill(`
        <div class="skeleton w-full h-64"></div>
      `).join("");
      $("#new-movieGrid").html(skeletonHTML);

      $.ajax({
        url: '/latest-movies-ajax.php',
        success: function(data) {
          $("#new-movieGrid").html(data);
        },
        error: function() {
          $("#new-movieGrid").html('<p class="text-center text-red-400 col-span-full">Failed to load movies. Please try again.</p>');
        }
      });






  
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
      div.className = 'rounded-xl overflow-hidden bg-slate-800 shadow-md hover:shadow-2xl transform hover:scale-105 transition duration-300 ease-in-out';
      div.innerHTML = `
        <a href="/movies.php?t=${encodeURIComponent(movie.title)}&y=${movie.year}&poster=${encodeURIComponent(movie.poster)}">
          <img src="${movie.poster}" alt="${movie.title}" class="w-full h-72 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">${movie.title}</h3>
            <p class="text-sm text-slate-400">${movie.year}</p>
          </div>
        </a>
      `;
      movieGrid.appendChild(div);
    });

    // Handle search input
    document.getElementById('searchInput').addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        const query = document.getElementById('searchInput').value.trim();
        if (query) {
          window.location.href = "/result.php?q=" + encodeURIComponent(query);
        }
      }
    });

}  
</script>

<?php
include "head.php";
?>

<!-- ✅ Hero Section -->
  <section class="relative min-h-screen bg-cover bg-center pt-16" style="background-image: url('https://image.tmdb.org/t/p/original/qJxzjUjCpTPvDHldNnlbRC4OqEh.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-80 flex flex-col justify-center items-center text-center px-6">
      <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-lg">Find Your Favorite Movies</h1>
      <p class="text-lg md:text-xl text-slate-300 mb-8 max-w-xl">Search and explore trending films and hidden gems.</p>
      <div class="w-full max-w-xl">
        <input id="searchInput" type="text" placeholder="Search for a movie..." class="w-full px-6 py-3 rounded-full text-lg text-black focus:outline-none shadow-lg" />
      </div>
    </div>
  </section>

  <!-- ✅ Popular Movies Section -->
  <section class="p-6 md:p-12 bg-slate-900">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-bold mb-8 text-center border-b border-slate-600 pb-4">Popular Movies</h2>
      <div id="movieGrid" class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <!-- Movie cards will be injected here -->
      </div>
    </div>
  </section>

<!-- ✅ New Movies Section -->
  <section class="p-6 md:p-12 bg-slate-900">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-bold mb-8 text-center border-b border-slate-600 pb-4">🔥 New Movies</h2>
      <div id="new-movieGrid" class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <!-- Movie cards will be injected here -->
      </div>
    </div>
  </section>




<?php
include "footer.php";
?>
