<?php
include "header.php";
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script type="text/javascript">
$("document").ready(function() {
   let title = document.getElementById('t').innerHTML;
   let year = document.getElementById('y').innerHTML;

   $.ajax({
     url: '/nk.php',
     data: {t: title, y: year},
     success: function(data) {
        if(data.match("http")) {
          let input = data;
          const urlPattern = /https?:\/\/[^\s]+?(?=https?:\/\/|$)/;

          // Extract the first URL
          const match = input.match(urlPattern);
          const firstURL = match ? match[0] : null;

          // window.location.href = `/watch.php?t=${title}&y=${year}&l=${firstURL}`;
           window.location.href = firstURL;
        }
        else {
             alert("Failed to fetch video link");
             window.location.href = "/index.php";
        } 
     }
   })

  
});


</script>

<script src="https://cdn.tailwindcss.com"></script>


<?php
include "head.php";

if(isset($_GET['t']) && isset($_GET['y'])) {
   echo '
       <div id="t">'.$_GET['t'].'</div>
       <div id="y">'.$_GET['y'].'</div>
    ';
}  

?>


<div style="position: fixed; top: 30%; left: 45%" class="w-12 h-12 border-4 border-red-500 border-t-transparent rounded-full animate-spin"></div>

