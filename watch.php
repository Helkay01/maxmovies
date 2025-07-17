<?php
include "header.php";

$title = $_GET['t'] ?? 'Unknown Title';
$year = $_GET['y'] ?? '0000';
$poster = $_GET['poster'] ?? '';
?>



  <meta charset="UTF-8" />
  <title>Watch <?php echo htmlspecialchars($title); ?> | Movie Finder</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  

  <style>
    .backdrop {
      background-image: linear-gradient(to bottom, rgba(15, 23, 42, 0.8), #0f172a), url('<?php echo $poster; ?>');
      background-size: cover;
      background-position: center;
    }
    .video-container video {
      border-radius: 1rem;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
    }

  
    ::placeholder {
      color: #94a3b8;
    }
    /* Skeleton loader styles */
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

}
</script>

<?php
include "head.php";
?>


  <!-- 🔻 HERO AREA -->
  <div class="backdrop min-h-screen w-full relative">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 py-24 flex flex-col md:flex-row items-center gap-10">
      <div class="w-full md:w-2/3">
        <div class="video-container">
          <video height="400px" 
            src="" 
            preload="metadata" 
            data-title="<?php echo strtoupper(htmlspecialchars($title)); ?>"
            controls
            class="w-full h-auto max-h-[70vh]"
          ></video>
        </div>
      </div>
      <div style+"color: white" class="w-full md:w-1/3 text-center md:text-left">
        <h1 class="text-3xl md:text-4xl font-bold mb-2"><?php echo htmlspecialchars($title); ?></h1>
        <p class="text-slate-300 mb-4 text-lg">Year: <?php echo htmlspecialchars($year); ?></p>
        <p class="text-slate-400 text-sm italic">Enjoy streaming in HD. Suggestions and more below!</p>
        <p style="padding: 3px; border: 1px solid red; background: red; color: white; cursor: pointer; border-radius: 3px; " class="text-slate-400 text-sm italic"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>">Watch online</a></p>
        <p style="padding: 3px; border: 1px solid green; background: green; color: white; cursor: pointer; border-radius: 3px; class="text-slate-400 text-sm italic"><a href="<?php if(isset($_GET['l'])) { echo $_GET['l']; } ?>">Download</a></p>
      </div>
    </div>
  </div>



  <!-- 🔻 SUGGESTIONS -->
  <section class="p-4 md:p-8 max-w-7xl mx-auto">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-center border-b border-slate-600 pb-4">🎬 You May Also Like</h2>
        <div id="new-movieGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
              <!-- Skeleton loader shows initially, replaced by AJAX content -->
        </div>
    </div>
  </section>

  

  <!-- jQuery & AJAX -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      const title = "<?php echo addslashes($title); ?>";
      const year = "<?php echo addslashes($year); ?>";

      $.ajax({
        url: '/fz.php',
        data: { t: title, y: year },
        success: function (response) {
          try {
            const movies = JSON.parse(response);
            let output = "";

            movies.forEach(m => {
              output += `
                <div class="bg-slate-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl hover:scale-105 transition duration-300">
                  <a href="/watch.php?t=${encodeURIComponent(m.title)}&y=${m.year}&poster=${encodeURIComponent(m.poster)}">
                    <img src="${m.poster}" alt="${m.title}" class="w-full h-60 object-cover" />
                    <div class="p-3">
                      <h3 class="font-semibold text-lg">${m.title}</h3>
                      <p class="text-slate-400 text-sm">${m.year}</p>
                    </div>
                  </a>
                </div>
              `;
            });

            $("#suggestions").html(output);
          } catch (e) {
            $("#suggestions").html('<p class="text-slate-400">No suggestions available.</p>');
          }
        }
      });
    });
  </script>
</body>
</html>

<?php
include "footer.php";
?>
