<?php
if(!isset($_COOKIE['imd'])) {


include "header.php";



echo '
	<title>Search</title>
';



include "head.php";


echo '
	<div id="search-div">
	
		<center><small><i>Search movies, old or new. Download from multiple servers without error or pop up ads.</i></small></center>
   		<br>
   		<br>
   		
   		
   		<form id="search-form">
   			<div>
   				<li><small><b>Title:</b></small></li>
   				<li><input class="title" id="title" type="text" placeholder="Title" required></li>
   			</div>
   		

   		
   			<div id="tp-yr">
   				<div>	
   		 				<li><small><b>Type:</b></small></li>
   					<li>
   						<select>
   							<option class="op" id="select">...</option>
   							<option class="op" id="movies" value="movies">Movies</option>					
   							<option hidden class="op" id="series" value="series">Series</option> 						
   						</select>
   					</li>
   				</div>
   				
   				<div hidden>
 					<li><small><b>Year:</b></small></li>
   					<li><input id="yr" type="number" min="1900" max="3000" placeholder="Year" require></li>  						
   				</div>
   			</div>
   			
   	
   			<button type="submit"><b>Search</b></button>
   			
   		</form>
   	</div>
   	
   	
   	<div id="search-pg-ad">
		ad
   	</div>
   	
';


include "footer.php";
 	
 	
 
}
else {
	echo 'display ads';
}


