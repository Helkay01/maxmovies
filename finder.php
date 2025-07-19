<?php
include "vendor/autoload.php";


use Curl\Curl;
 
$result = "";
$yr = "";


$title = $_GET['t'];

//$year = $_GET['y'];


$no_space = str_replace(" ", "", $title);
$no_dot = str_replace(":", "", $no_space);

$title_array = explode(" ", $no_dot);


$url = "https://nkiri.com/";

$curl = new Curl();

$cookieFile = 'c.txt';

$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file


$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
$curl->disableTimeout();
	
$curl->get($url, [
	"s" => $title,
    "post_type" => "post",
]);


if($curl->getHttpStatusCode() === 200) {

	$curl->close();

	$html = $curl->response;

	$dom = new DOMDocument();
	@$dom->loadHTML($html);

	$articles = $dom->getElementsByTagName("article");
	


foreach($articles as $article) {
	$img = $article->getElementsByTagName("img")->item(0)->getAttribute("src");
	$header = $article->getElementsByTagName("header")->item(0);
	$link = $header->getElementsByTagName("a")->item(0)->getAttribute("href");
	
	$string = $header->getElementsByTagName("a")->item(0)->nodeValue;


	$pattern = '/\((\d+)\)/'; // Regular expression pattern to match digits inside parentheses
	
	if(preg_match($pattern, $string, $matches)) {
		$figuresInsideParentheses = $matches[1]; // Extract the figures inside parentheses
		$yr = $figuresInsideParentheses;
		
		$t1 = str_replace("(", "", $string);
		$t2 = str_replace(")", "", $t1);
		$t3 = str_replace("Download", "", $t2);
		
		$mTitle = str_replace($yr, "", $t3);
	

		
		// Find the position of the vertical bar
		$pos = strpos($mTitle, '|');
		
		if ($pos !== false) {
			// Extract the substring before the vertical bar
			$result = trim(substr($mTitle, 0, $pos));
		}
	
	}
		
		$link2 = $header->getElementsByTagName("a")->item(0)->nodeValue;
		
		if(!str_contains($link2, "Drama") || !str_contains($link2, "TV") || !str_contains($link2, "Series") || !str_contains($link2, "Season") || !str_contains($mTitle, "Episode") || !str_contains($mTitle, "S0") || !str_contains($mTitle, "E0")) {
			
			if(count($title_array) === 1) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0])) || str_contains($link2, strtolower($title_array[0]))) {
	
						echo '
							<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
								<img src="'.$img.'">
						
								<div>
									<small><div id="cap">'.$result.' ('.$yr.')</div></small>
								</div>
							</a></span>';
			
		
				}
			}
			else if(count($title_array) === 2) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link, strtoupper($title_array[0])) || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1])) || str_contains($link2, strtolower($title_array[1]))) {	
			
						echo '
							<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
							<img src="'.$img.'">
							
							<div>
							<small><div id="cap">'.$result.' ('.$yr.')</div></small>
							</div>
							</a></span>';
							
		
						
					}
				}
			}
			else if(count($title_array) === 3) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
				
							echo '
								<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php.php?t='.$result.'&y='.$yr.'&img='.$img.'">
								<img src="'.$img.'">
								
								<div>
								<small><div id="cap">'.$result.' ('.$yr.')</div></small>
								</div>
								</a></span>';
								
			
							
						}
					}
				}
			}
			else if(count($title_array) === 4) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($yr, $year)) {
								
								echo '
									<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
									<img src="'.$img.'">
									
									<div>
									<small><div id="cap">'.$result.' ('.$yr.')</div></small>
									</div>
									</a></span>';
									
									
					
								
							}
						}
					}
				}
			}
			else if(count($title_array) === 5) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($link2, ucwords($title_array[4])) || str_contains($link2, strtoupper($title_array[4]))  || str_contains($link2, strtolower($title_array[4]))) {	
						
									echo '
										<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
										<img src="'.$img.'">
										
										<div>
										<small><div id="cap">'.$result.' ('.$yr.')</div></small>
										</div>
										</a></span>';
										
										
					
									
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 6) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($link2, ucwords($title_array[4])) || str_contains($link2, strtoupper($title_array[4]))  || str_contains($link2, strtolower($title_array[4]))) {	
									if(str_contains($link2, ucwords($title_array[5])) || str_contains($link2, strtoupper($title_array[5]))  || str_contains($link2, strtolower($title_array[5]))) {		
						
										echo '
											<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
											<img src="'.$img.'">
											
											<div>
											<small><div id="cap">'.$result.' ('.$yr.')</div></small>
											</div>
											</a></span>';
											
							
										
									}	
								}
							}	
						}
					}
				}
			}
			else if(count($title_array) === 7) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($link2, ucwords($title_array[4])) || str_contains($link2, strtoupper($title_array[4]))  || str_contains($link2, strtolower($title_array[4]))) {	
									if(str_contains($link2, ucwords($title_array[5])) || str_contains($link2, strtoupper($title_array[5]))  || str_contains($link2, strtolower($title_array[5]))) {		
										if(str_contains($link2, ucwords($title_array[6])) || str_contains($link2, strtoupper($title_array[6]))  || str_contains($link2, strtolower($title_array[6]))) {		
								
											echo '
												<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
												<img src="'.$img.'">
												
												<div>
												<small><div id="cap">'.$result.' ('.$yr.')</div></small>
												</div>
												</a></span>';
												
						
											
										}	
									}	
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 8) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($link2, ucwords($title_array[4])) || str_contains($link2, strtoupper($title_array[4]))  || str_contains($link2, strtolower($title_array[4]))) {	
									if(str_contains($link2, ucwords($title_array[5])) || str_contains($link2, strtoupper($title_array[5]))  || str_contains($link2, strtolower($title_array[5]))) {		
										if(str_contains($link2, ucwords($title_array[6])) || str_contains($link2, strtoupper($title_array[6]))  || str_contains($link2, strtolower($title_array[6]))) {		
											if(str_contains($link2, ucwords($title_array[7])) || str_contains($link2, strtoupper($title_array[7]))  || str_contains($link2, strtolower($title_array[7]))) {				
								
												echo '
													<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
													<img src="'.$img.'">
													
													<div>
													<small><div id="cap">'.$result.' ('.$yr.')</div></small>
													</div>
													</a></span>';
													
													
							
												
											}
										}	
									}	
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 9) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($link2, ucwords($title_array[4])) || str_contains($link2, strtoupper($title_array[4]))  || str_contains($link2, strtolower($title_array[4]))) {	
									if(str_contains($link2, ucwords($title_array[5])) || str_contains($link2, strtoupper($title_array[5]))  || str_contains($link2, strtolower($title_array[5]))) {		
										if(str_contains($link2, ucwords($title_array[6])) || str_contains($link2, strtoupper($title_array[6]))  || str_contains($link2, strtolower($title_array[6]))) {		
											if(str_contains($link2, ucwords($title_array[7])) || str_contains($link2, strtoupper($title_array[7]))  || str_contains($link2, strtolower($title_array[7]))) {				
												if(str_contains($link2, ucwords($title_array[8])) || str_contains($link2, strtoupper($title_array[8]))  || str_contains($link2, strtolower($title_array[8]))) {						
										
													echo '
														<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
														<img src="'.$img.'">
														
														<div>
														<small><div id="cap">'.$result.' ('.$yr.')</div></small>
														</div>
														</a></span>';
									
														
										
													
												}	
											}
										}	
									}	
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 10) {
				if(str_contains($link2, ucwords($title_array[0])) || str_contains($link2, strtoupper($title_array[0]))  || str_contains($link2, strtolower($title_array[0]))) {
					if(str_contains($link2, ucwords($title_array[1])) || str_contains($link2, strtoupper($title_array[1]))  || str_contains($link2, strtolower($title_array[1]))) {
						if(str_contains($link2, ucwords($title_array[2])) || str_contains($link2, strtoupper($title_array[2]))  || str_contains($link2, strtolower($title_array[2]))) {
							if(str_contains($link2, ucwords($title_array[3])) || str_contains($link2, strtoupper($title_array[3]))  || str_contains($link2, strtolower($title_array[3]))) {
								if(str_contains($link2, ucwords($title_array[4])) || str_contains($link2, strtoupper($title_array[4]))  || str_contains($link2, strtolower($title_array[4]))) {	
									if(str_contains($link2, ucwords($title_array[5])) || str_contains($link2, strtoupper($title_array[5]))  || str_contains($link2, strtolower($title_array[5]))) {		
										if(str_contains($link2, ucwords($title_array[6])) || str_contains($link2, strtoupper($title_array[6]))  || str_contains($link2, strtolower($title_array[6]))) {		
											if(str_contains($link2, ucwords($title_array[7])) || str_contains($link2, strtoupper($title_array[7]))  || str_contains($link2, strtolower($title_array[7]))) {				
												if(str_contains($link2, ucwords($title_array[8])) || str_contains($link2, strtoupper($title_array[8]))  || str_contains($link2, strtolower($title_array[8]))) {						
													if(str_contains($link2, ucwords($title_array[9])) || str_contains($link2, strtoupper($title_array[9]))  || str_contains($link2, strtolower($title_array[9]))) {								
												
														echo '
															<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$result.'" data-year="'.$yr.'"><a href="/watch.php?t='.$result.'&y='.$yr.'&img='.$img.'">
															<img src="'.$img.'">
															
															<div>
															<small><div id="cap">'.$result.' ('.$yr.')</div></small>
															</div>
															</a></span>';
															
								
															
														
													}
												}	
											}
										}	
									}	
								}
							}
						}
					}
				}
			}
			

			
		}
}










	
	



}
	


}
