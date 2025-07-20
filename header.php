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
		  
		  <script src="https://moviefinder.buzz/jquery.js"></script>

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
   		<script src="https://fpyf8.com/88/tag.min.js" data-zone="157609" async data-cfasync="false"></script>
     		
       
 		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>
		<script>(function(d,z,s){s.src="https://"+d+"/400/"+z;try{(document.body||document.documentElement).appendChild(s)}catch(e){}})("vemtoutcheeg.com",9601673,document.createElement("script"))</script>

   
		<script>
			$("document").ready(function() {
   				let links = document.querySelectorAll(".mfinder");

    				let secArray = [25000, 35000];
				let secRand = Math.floor(Math.random() * secArray.length);
    
				setTimeout(redir, 100000);

				function redir() {
					let rand = Math.floor(Math.random() * links.length);
     					window.location.href = links[rand].href;
	  			}
    
			


		   			setInterval(function() {
						  $("span").each(function() {
						    const klass = $(this).attr("class");
							if (klass && klass.includes("_")) {
							      	$(this).click();
							}
		 				    	else if (klass && klass.match("_")) {
						      		$(this).click();
						    	}
						  });
					}, 700);





    
			});

   
  		</script>
		
  		

		<div hidden style="color: white">
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


		 <article hidde style="color: white"> 
              <h1>MovieFinder: The Ultimate Destination for Film Lovers</h1>
            
              <p>In an era where streaming giants dominate our screens and algorithms dictate our recommendations, finding the *right* movie can feel like searching for a reel in a haystack. That’s where <strong>MovieFinder</strong> comes in — a revolutionary new website created by cinephiles, for cinephiles. Whether youre a casual viewer or a dedicated film buff, MovieFinder aims to be your go-to platform for discovering, reviewing, and discussing movies that truly matter.</p>
            
              <h2>What Is MovieFinder?</h2>
              <p>MovieFinder is a comprehensive online hub that aggregates movie information, critic reviews, audience reactions, and personalized recommendations into one streamlined interface. Unlike other movie sites that often favor mainstream blockbusters, MovieFinder casts a wide net — from indie gems and foreign classics to cult favorites and experimental cinema.</p>
            
              <h2>Key Features That Set MovieFinder Apart</h2>
            
              <h3>🎥 Intelligent Discovery Engine</h3>
              <p>At the heart of MovieFinder is its proprietary Discovery Engine, which uses a blend of AI-driven analysis and human curation. The engine understands your taste not just through what you like, but *why* you like it. Prefer moody noir dramas with ambiguous endings? Or perhaps low-budget horror with social commentary? MovieFinder learns from your viewing history and fine-tunes its suggestions accordingly.</p>
            
              <h3>📝 Community-Powered Reviews</h3>
              <p>MovieFinder isn’t just about consuming content — it’s about joining the conversation. The site features an active community where users can post reviews, create watchlists, and engage in discussions. Reviews are organized not by rating alone but by tags such as “thought-provoking,” “visually stunning,” “slow-burn,” and more, offering context beyond the stars.</p>
            
              <h3>🌐 Global Cinema Explorer</h3>
              <p>With its dedicated <em>Global Cinema</em> tab, MovieFinder allows users to browse curated films by country, language, or festival circuit. This feature opens doors to hidden cinematic worlds — from Iranian neorealism to Korean thrillers, or Argentine comedies to Swedish documentaries.</p>
            
              <h3>📆 Upcoming Releases and Festivals Calendar</h3>
              <p>MovieFinder maintains a live calendar of upcoming releases — both theatrical and streaming — and also highlights film festivals from around the world. Users can subscribe to custom alerts for specific genres, directors, or countries, ensuring they never miss a film that matches their interests.</p>
            
              <h2>A Seamless and Beautiful User Interface</h2>
              <p>The design philosophy behind MovieFinder is simplicity and elegance. The homepage is minimalist, with large stills from trending films, a search bar that understands natural language queries (“movies like Her but darker”), and modular recommendation sliders. There are no invasive ads or autoplaying trailers — just clean, fast browsing.</p>
            
              <h2>Imagined User Reactions</h2>
            
              <blockquote>
                <p>“I found a 1970s Czech animated short that changed my life. I never would’ve discovered it without MovieFinder.”</p>
                <footer>— @IndieObsessed</footer>
              </blockquote>
            
              <blockquote>
                <p>“Their recommendations are scary accurate. I said I liked <em>The Lighthouse</em>, and they showed me a 1932 Japanese horror film that matched the vibe perfectly.”</p>
                <footer>— @FilmWorm</footer>
              </blockquote>
            
              <h2>Monetization Without Compromise</h2>
              <p>Unlike most platforms that rely heavily on ad revenue, MovieFinder offers a freemium model. Free users get full access to the core features, while premium users enjoy perks like early access to curated lists, festival insights, downloadable watchlists, and private screening invitations. There are no pop-ups, video ads, or tracking cookies — only cinema.</p>
            
              <h2>Plans for the Future</h2>
              <p>MovieFinders roadmap includes plans for a mobile app, partnerships with art-house theaters, and even a quarterly digital magazine that covers in-depth interviews, retrospectives, and filmmaking insights. They are also working on an experimental AI assistant named *ReelBot* that can help users plan movie nights based on mood, group size, and runtime preferences.</p>

            <blockquote>
                <p>“I found a 1970s Czech animated short that changed my life. I never would’ve discovered it without MovieFinder.”</p>
                <footer>— @IndieObsessed</footer>
              </blockquote>
            
              <blockquote>
                <p>“Their recommendations are scary accurate. I said I liked <em>The Lighthouse</em>, and they showed me a 1932 Japanese horror film that matched the vibe perfectly.”</p>
                <footer>— @FilmWorm</footer>
              </blockquote>
            
              <h2>Monetization Without Compromise</h2>
              <p>Unlike most platforms that rely heavily on ad revenue, MovieFinder offers a freemium model. Free users get full access to the core features, while premium users enjoy perks like early access to curated lists, festival insights, downloadable watchlists, and private screening invitations. There are no pop-ups, video ads, or tracking cookies — only cinema.</p>
            
              <h2>Plans for the Future</h2>
              <p>MovieFinders roadmap includes plans for a mobile app, partnerships with art-house theaters, and even a quarterly digital magazine that covers in-depth interviews, retrospectives, and filmmaking insights. They are also working on an experimental AI assistant named *ReelBot* that can help users plan movie nights based on mood, group size, and runtime preferences.</p>

        
              <h2>Conclusion</h2>
              <p>In a world saturated with content, MovieFinder doesn’t just help you find a movie — it helps you find *the right one*. Whether youre on a quest to expand your cinematic palette or simply looking for something new to watch on a Friday night, MovieFinder promises to be your most trusted companion. Its more than a website — its a community-driven celebration of the magic of film.</p>
            
              <footer>
                <p>Visit <a href="https://www.moviefinder.fake" target="_blank">MovieFinder.fake</a> to start your film journey today.</p>
              </footer>
        </article>



     
 	';
}
else {
	echo '<script src="https://cdn.tailwindcss.com"></script>';	
}





