<?php
require 'vendor/autoload.php';
use GeoIp2\Database\Reader;

// Clear all cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/');
        unset($_COOKIE[$name]);
    }
}

// Define IP function if not already declared
if (!function_exists('getClientIp')) {
    function getClientIp() {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ips[0]);
        }
        return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }
}

// Get client IP
$ip = getClientIp();

// Default values
$timezone = 'Unknown';
$country = 'Unknown';

// Check GeoLite2 DB and get location
if (file_exists('GeoLite2-City.mmdb')) {
    try {
        $reader = new Reader('GeoLite2-City.mmdb');
        $record = $reader->city($ip);
        $timezone = $record->location->timeZone ?? 'Unknown';
        $country = $record->country->name ?? 'Unknown';
    } catch (Exception $e) {
        // Log error or silently fail
    }
}

// Load header
include "header.php";

if ($country === "Nigeria") {
    // Nigeria-specific content
    // You can add Nigeria-only HTML here if needed
} else {
    // Global content
    echo '

    <style>
        body {
          background-color: #0f172a;
        }
        ::placeholder {
          color: #94a3b8;
        }
        .skeleton {
          animation: pulse 1.5s infinite ease-in-out;
          background: linear-gradient(90deg, #1e293b 25%, #334155 50%, #1e293b 75%);
          background-size: 200% 100%;
          border-radius: 0.5rem;
        }
        @keyframes pulse {
          0% {
            background-position: 200% 0;
          }
          100% {
            background-position: -200% 0;
          }
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    window.onload = function() {
        const skeletonHTML = Array(8).fill(`
            <div class="skeleton w-full h-64"></div>
        `).join("");
        $("#new-movieGrid").html(skeletonHTML);

        $.ajax({
            url: "/latest-movies-ajax.php",
            success: function(data) {
                $("#new-movieGrid").html(data);
            },
            error: function() {
                $("#new-movieGrid").html(\'<p class="text-center text-red-400 col-span-full">Failed to load movies. Please try again.</p>\');
            }
        });

        const movies = [
            {
                title: "Dune",
                poster: "https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg",
                year: 2021
            },
            {
                title: "The Batman",
                poster: "https://image.tmdb.org/t/p/w500/74xTEgt7R36Fpooo50r9T25onhq.jpg",
                year: 2022
            },
            {
                title: "Top Gun: Maverick",
                poster: "https://image.tmdb.org/t/p/w500/62HCnUTziyWcpDaBO2i1DX17ljH.jpg",
                year: 2022
            },
            {
                title: "Avatar: The Way of Water",
                poster: "https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg",
                year: 2022
            }
        ];

        const movieGrid = document.getElementById("movieGrid");

        movies.forEach(movie => {
            const div = document.createElement("div");
            div.className = "rounded-xl overflow-hidden bg-slate-800 shadow-md hover:shadow-2xl transform hover:scale-105 transition duration-300 ease-in-out";
            div.innerHTML = `
                <a href="/link-finder.php?t=${encodeURIComponent(movie.title)}&y=${movie.year}&poster=${encodeURIComponent(movie.poster)}">
                    <img src="${movie.poster}" alt="${movie.title}" class="w-full h-72 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">${movie.title}</h3>
                        <p class="text-sm text-slate-400">${movie.year}</p>
                    </div>
                </a>
            `;
            movieGrid.appendChild(div);
        });

        document.getElementById("searchInput").addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                const query = document.getElementById("searchInput").value.trim();
                if (query) {
                    window.location.href = "/result.php?q=" + encodeURIComponent(query);
                }
            }
        });
    }
    </script>
    ';

    include "head.php";

    echo '
    <!-- ✅ Hero Section -->
    <section class="relative min-h-screen bg-cover bg-center pt-16" style="background-image: url(\'https://image.tmdb.org/t/p/original/qJxzjUjCpTPvDHldNnlbRC4OqEh.jpg\');">
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
    <section class="p-4 md:p-8 max-w-7xl mx-auto">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-center border-b border-slate-600 pb-4">🔥 New Movies</h2>
            <div id="new-movieGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <!-- Skeleton loader will be replaced by AJAX -->
            </div>
        </div>
    </section>
    ';

    include "footer.php";
}
?>
