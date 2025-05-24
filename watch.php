<?php


    
?>




<title>Watch <?php echo $_GET['t']; ?></title>

<script src="vplayer.min.js"></script>











<script>
/*

async function loadVASTAd(vastUrl) {
    const response = await fetch(vastUrl);
    const xml = await response.text();
    return xml;
}

function parseVAST(xml) {
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xml, "text/xml");
    const ad = xmlDoc.getElementsByTagName("MediaFile")[0];
    return ad ? ad.textContent : null;
}

async function playAd() {
    const vastUrl = 'https://knownamount.com/dmmDFWzXd.GTNzvUZEG-UE/pesm/9/ujZFUJl-kfPuTgU/2jOiDBcm1TM/TAYHtmNhT/Yd4-N/zGUbxFNby/ZNsGaMWI1HptdBDd0Gxe'; // Replace with your VAST URL
    const vastXML = await loadVASTAd(vastUrl);
    const adUrl = parseVAST(vastXML);
    
    if (adUrl) {
        const videoElement = document.querySelector('video');
        videoElement.src = adUrl; // Set the ad video source
        videoElement.play(); // Play the ad
		
		videoElement.onplaying = function() {		
			$("small#title").html("Please wait, Video will play after the ad.");
			$("small#title").css("color", "lightblue");
			
			$(".vp-progress div").show();
		}			
		 			
        videoElement.onended = function() {
		
			var title = videoElement.dataset.title;
			
			$("small#title").html(title);
			
			$(".vp-progress div").hide();
			        
			videoElement.src = videoElement.dataset.video; // Your main video source
			videoElement.play();
			
			videoElement.onplaying = function() {
				$(".vp-progress div").show();
			}
			
        }
    } else {
        console.error("No ad found in the VAST response.");
        // Fallback to main video if no ad is found
        const videoElement = document.querySelector('video');
        videoElement.src = videoElement.dataset.video; // Your main video source
        videoElement.play();
        
       	$(".vp-progress div").show();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    playAd();
});

*/







$("document").ready(function() {
    var vidm = document.querySelector("video");
    
    vidm.onplaying = function() {
        $(".vp-progress div").show();
    }
    
    
    $('span#fs').hide();
    
    
    var title = $("#mdeets").data("title");
    var year = $("#mdeets").data("year");

    //Get movies
    $.ajax({
    	url: '/fz.php',
    	data: {t: title, y: year},
    	success: function(data) {
    		alert(data);
    	}
    });
    
    
     
});
    
    
</script>




<style>
div#vplayer {
	box-shadow: 0 0 2px 0;
	margin-top: -3px;
}

.vp-progress div {
    display: none;
}


</style>







	
	<video style="" 
		src=""
		preload="metadata"
		data-video=""
		height="300px"
		width="100%"
		data-title="<?php echo strtoupper($_GET['t']); ?>"
	>
	</video>


<br>
<br>



<div hidden data-year="<?php echo $_GET['y']; ?>"
data-title="<?php echo $_GET['t']; ?>"
 id="mdeets"></div>





<!--
<div style="margin-top: 20px" id="similar">
	
	<div style="font-weight: bold; color: grey; font-size: 14px; margin-left: 6px;">
		<label>You May Also Like</label>
		
		<div class="m-div" style="overflow: scrol;" id="trending-result">
		
		</div>
	</div>
	
	
	<div style="font-weight: bold; color: grey; font-size: 14px; margin-left: 6px;">
		<label>New Movies</label>

		<br>
		
		<div class="m-div" style="overflow: scrol;" id="search-result">
		
		</div>
	</div>
	

	<br>
	<br>
	

	
</div>

-->








