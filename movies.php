<?php
include 'err.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
  		<?php  		
  			if(isset($_GET['t'])) {
 		 		echo $_GET['t'];
	  		}
	  		else {
	  			echo "Get the movie download link";	
	  		}
  		?>
  </title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 0px;
      margin: 0;
    }

    .container {
      width: 100%;
      max-width: 400px;
    }

    .movie-card {
      background-color: #1e1e1e;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
      margin-bottom: 20px;
    }

    .movie-card img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      display: block;
    }

    .movie-info {
      padding: 20px;
      text-align: center;
    }

    .movie-info h1 {
      font-size: 1.5em;
      margin-bottom: 10px;
    }

    .movie-info p {
      font-size: 0.9em;
      color: #aaa;
      margin-bottom: 20px;
    }

    .buttons {
      display: flex;
      justify-content: space-between;
    }

    .buttons span {
      text-decoration: none;
      color: white;
      background-color: #333;
      padding: 10px 15px;
      border-radius: 5px;
      font-size: 0.9em;
      transition: background-color 0.3s;
      flex: 1;
      text-align: center;
      margin: 0 5px;
      font-weight: bold;
    }

    .buttons span:nth-child(4) {
      background-color: #d32f2f;
    }

    .buttons span:hover {
      background-color: #f44336;
    }



    .section-title {
      font-size: 1.2em;
      margin-bottom: 10px;
    }

    .estrenos {
      display: flex;
      gap: 10px;
      overflow-x: auto;
    }

    .estrenos .movie {
      flex: 0 0 120px;
      text-align: center;
    }

    .estrenos img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 5px;
      transition: transform 0.3s;
    }

    .estrenos img:hover {
      transform: scale(1.05);
    }

    .estrenos .movie-title {
      font-size: 0.8em;
      color: #aaa;
    }
    
    .info span {
    	border: 2px solid white;
    	padding: 0;
    	width: 20px;
    	display: block;
    	border-radius: 20px;
    	border-top-color: transparent;
    	height: 20px;
    	animation: spin 1s infinite linear;
    	background: transparent;   
    }
    
    .download span {
    	border: 2px solid white;
    	padding: 0;
    	width: 20px;
    	display: block;
    	border-radius: 20px;
    	border-top-color: transparent;
    	height: 20px;
    	animation: spin 1s infinite linear;
    	background: transparent;   
    }
    
    .watch span {
    	border: 2px solid white;
    	padding: 0;
    	width: 20px;
    	display: block;
    	border-radius: 20px;
    	border-top-color: transparent;
    	height: 20px;
    	animation: spin 1s infinite linear;
    	background: transparent;
    }
    
    @keyframes spin {
    	100% {
    		transform: rotate(360deg);
    	}
    }
    
    ul {
    	padding: 0;
    	margin: 0;
    }
    
    ul li {
    	list-style-type: none;
    	margin-bottom: 20px
    }
    
    a {
    	text-decoration: none;
    	color: lightblue;
    	font-weight: bold;
    }
    
    
    
  </style>
</head>
<body>
  <div class="container">
    <!-- Main Movie Card -->
    <div class="movie-card">
      <img style="opacity: 0.7; filter: blur(10px)" src="img2.jpg" alt="Spider-Man Poster">
      
      <img style="position: absolute; margin-left: 10px;  margin-top: -320px; border-radius: 9px; width: 190px; height: 280px;"
      src="<?php
      	if(isset($_GET['poster'])) {
      		echo $_GET['poster'];
      	}
      ?>">
      
      
      <div class="movie-info">
        <h1>
        	<?php
        		if(isset($_GET['t'])) {
        			echo $_GET['t'];
        		}
        	?>
        </h1>
        
        
        
        <p hidde>
        	 <?php
        	 	if(isset($_GET['t'])) {
        	 		echo $_GET['t'];
        	 	}
        	 ?>
        	 
        	| Action, Thriller, Crime
        </p>
        
        
        
        <div class="buttons">
          <span class="info">
          		<span></span>
          </span>
          
          <span hidden class="save">Save</span>
          
          
          <span hidde class="download">
          		<span></span>
          </span>
                
                
          <span class="watch">
          		<span></span>
          </span>
        
        </div>
        
        
        <div style="margin-top: 30px">

        	
        </div>
        
        
        
        <div>
        	<label><i>Found movies websites to watch or download</i></label>
        
        	<br>
        	<br>
        	<br>
        	
        	
        	<ul>
        		<li><a href="https://nkiri.com/?s=<?php 
        			if(isset($_GET['t'])) { 
        				echo $_GET['t'];
        			} 
        		?>">Download Link</a></li>
        			
        			
        		<li><a href="https://waploaded.co/search/<?php 
        			if(isset($_GET['t'])) { 
        				echo $_GET['t'];
        			} 
        		?>/page/1?type=">Download Link</a></li>
        	    
        	    
        	    
        	    <li><a href="https://plutomovies.com/search/<?php 
        	    	if(isset($_GET['t'])) { 
        	    		echo $_GET['t']; 
        	    	} 
        	    ?>/page/1">Download Link</a></li>	
           		
           		
           		
           		<li><a href="https://netnaija.xyz/?s=<?php 
           			if(isset($_GET['t'])) { 
           				echo $_GET['t']; 
           			} 
           		?>">Download Link</a></li>
         		
         		
         		<li><a href="https://9jarocks.net/findx?search=<?php 
         			if(isset($_GET['t'])) { 
         				echo $_GET['t']; 
         			} 
         		?>">Download Link</a></li>       	
        	
        	
        	
        	
        	</ul>
        </div>
        
        
        
        
      </div>
    </div>


	<br>
	<br>


    
  </div>
</body>
</html>
