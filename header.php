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



//IP
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


if($country === "Nigeria")  {

echo '

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

';


}
else {
    echo '
    	<!DOCTYPE html>
		<html lang="en">
		<head>
		  <meta charset="UTF-8" />
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		  <title>Movie Finder</title>
		
		  <script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
		  <script src="https://cdn.tailwindcss.com"></script>


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

	';
}
else {
	echo '

		<!DOCTYPE html>
		<html lang="en">
		<head>
		  <meta charset="UTF-8" />
		  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		  <title>Movie Finder</title>
		
		  <script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
		  <script src="https://cdn.tailwindcss.com"></script>

  
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

	
	';

}







?>
