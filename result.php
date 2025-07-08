<?php include 'header.php'; ?>

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Search Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #0f172a; /* dark navy */
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
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <script>  
    $(document).ready(function() {
      var title = $("#t").text().trim();

      // Render skeleton loader grid (8 items)
      const skeletonHTML = Array(8).fill(`
        <div class="skeleton w-full h-64"></div>
      `).join("");
      $("#movieGrid").html(skeletonHTML);

      $.ajax({
        url: '/finder.php',
        data: {t: title},
        success: function(data) {
          $("#movieGrid").html(data);
        },
        error: function() {
          $("#movieGrid").html('<p class="text-center text-red-400 col-span-full">Failed to load movies. Please try again.</p>');
        }
      });
    });
  </script>


<?php include 'head.php'; ?>



  <div hidden id="t"><?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?></div>

  <section class="p-4 md:p-8 max-w-7xl mx-auto">
    <div id="movieGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
      <!-- Skeleton loader shows initially, replaced by AJAX content -->
    </div>
  </section>

</body>
</html>
