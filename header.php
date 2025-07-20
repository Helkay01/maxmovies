<?php
require 'vendor/autoload.php';
use GeoIp2\Database\Reader;


// Clear all cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        // Expire the cookie
        setcookie($name, '', time() - 3600, '/');
        // For some cases also unset
        unset($_COOKIE[$name]);
    }
}



?>


    	<!DOCTYPE html>
		<html lang="en">
		<head>
		  <meta charset="UTF-8" />
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		  <title>Movie Finder</title>
		
		  <script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
		  


		  <!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-R9QCCJ62Y8"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag("js", new Date());
		
		  gtag("config", "G-R9QCCJ62Y8");
		</script>
		  
		  
		  <style>
		    body {
		      background-color: #0f172a;
		    }
		    ::placeholder {
		      color: #94a3b8;
		    }
		    .glass {
		      background: rgba(255, 255, 255, 0.05);
		      backdrop-filter: blur(10px);
		    }
		  </style>

	



<?php
function getClientIp() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]); // First IP is the real client IP
    }

    return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
}

$ip = getClientIp();

$reader = new Reader('GeoLite2-City.mmdb');
$record = $reader->city($ip);
		
// Extract data
$timezone = $record->location->timeZone;
$country = $record->country->name;
		
if($country === "Nigeria") {
	echo '
 		<script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
   		<script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
     		<script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
 

		<script>
			window.onload = function() {
   				let links = document.querySelectorAll(".mfinder");

				setTimeout(redir, 8000);

				function redir() {
					let rand = Math.random() * links.length;
     					window.location.href = links[rand].href;
	  			}
    
			}

  		</script>
		
  		

		<div style="color: white">
  			<a class="mfinder" href="/watch.php?t=The Rule of Jenny Pen&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/the-rul-of-jenny-pen-hollywood-movie.webp">Link</a>
     			<a class="mfinder" href="/watch.php?t=Bride Hard&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/bride-hard-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=Mr. Burton&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/mr-burton-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=The Salt Path&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/the-salt-path-hollywood-movie.webp">Link</a>
      			<a class="mfinder" href="/watch.php?t=Eden&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/eden-hollywood-movie.jpg">Link</a>
	 		<a class="mfinder" href="/watch.php?t=Megan 2.0&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/megan-2.0-hollywood-movie.webp">Link</a>
    			<a class="mfinder" href="/watch.php?t=How to train your dragon&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/how-to-train-your-dragon-hollywood-movie.webp">Link</a>
       			<a class="mfinder" href="/watch.php?t=Almost Cops&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/almost-cops-foreign-movie.webp">Link</a>
	  		<a class="mfinder" href="/watch.php?t=Soverign&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/sovereignity-hollywood-movie.webp">Link</a>
     			<a class="mfinder" href="/watch.php?t=Bridge&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/brick-foreign-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/madeas-destination-wedding-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=Medea Destination wedding&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/madeas-destination-wedding-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=Everthing going to be great&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/everythings-going-to-be-great-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=ziam&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/ziam-thailand-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=The unholy trinity&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/the-unholy-trinity-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=Pretty Things&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/pretty-thing-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=the old gaurd 2&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/the-old-guard-2-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=heads of state&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/heads-of-state-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=guns up&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/guns-up-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=off the grid&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/off-the-grid-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=tornado&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/tornado-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=ice road: vengeance&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/ice-road-vengeance-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=bring her back&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/bring-her-back-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=ballerina&y=2025&img=https://nkiri.com/wp-content/uploads/2025/07/ballerina-hollywood-movie.jpg">Link</a>
			<a class="mfinder" href="/watch.php?t=thunderbolts&y=2025&img=https://nkiri.com/wp-content/uploads/2025/06/thunderbolts-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=ritual&y=2025&img=https://nkiri.com/wp-content/uploads/2025/06/the-ritual-hollywood-movie.webp">Link</a>
			<a class="mfinder" href="/watch.php?t=i dont understand&y=2025&img=https://nkiri.com/wp-content/uploads/2025/06/i-dont-understand-you-hollywood-movie.webp">Link</a>
   			<a class="mfinder" href="/watch.php?t=the last rodeo&y=2025&img=https://nkiri.com/wp-content/uploads/2025/06/the-last-rodeo-hollywood-movie.webp">Link</a>
			

  		</div>

   		
 	';
}
else {
	echo '<script src="https://cdn.tailwindcss.com"></script>';	
}





