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
        alert(data);
     }
   })

  
});


</script>



<?php
include "head.php";

if(isset($_GET['t']) && isset($_GET['y'])) {
   echo '
       <div id="t">'.$_GET['t'].'</div>
       <div id="y">'.$_GET['y'].'</div>
    ';
}  



?>




