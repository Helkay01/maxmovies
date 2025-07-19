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
    

</head>
<body class="text-white font-sans leading-relaxed">

  <!-- ✅ Navbar -->
  <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-slate-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <a href="/" class="text-2xl font-bold text-white hover:text-blue-400 transition duration-300">
          🎥 Movie Finder
        </a>

          <div style="float: right; margin-right: 20px">
              <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">Refresh</a>
          </div>
      </div>
    </div>
  </nav>


';    

?>
