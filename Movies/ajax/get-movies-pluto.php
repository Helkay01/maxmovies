<?php
include "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


$title = $_GET['t'];

$year = $_GET['y'];


$no_space = str_replace(" ","", $title);

$title_array = explode(" ", $title);








//Curl Start

$url = 'https://plutomovies.com/search/'.str_replace(" ", "-", $title).'/page/1';



$curl = new Curl();

$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file


$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);


$curl->disableTimeout();
	
$curl->get($url);


if($curl->getHttpStatusCode() === 200) {

	$curl->close();

	$html = $curl->response;

	$dom = new DOMDocument();
	@$dom->loadHTML($html);


	$xpath = new DOMXPath($dom);
	
	// Define the class name you want to select
	$className = 'flist-item';
	
	// Use XPath query to select elements by class name
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
	
	
	
	foreach($elements as $ele) {
		$a = $ele->getElementsByTagName("a")->item(0)->getAttribute("href");
		$link = "https://plutomovies.com/".$a;		
		$mTit = $ele->getElementsByTagName("a")->item(0)->getAttribute("title");
		$img = $ele->getElementsByTagName("img")->item(0)->getAttribute("src");
			
		
		$string = $mTit;			
		$mTitle = preg_replace('/\([^)]+\)/', '', $string);
		
		
		$pattern = '/\((\d+)\)/'; // Regular expression pattern to match digits inside parentheses
		
		if(preg_match($pattern, $string, $matches)) {
			$figuresInsideParentheses = $matches[1]; // Extract the figures inside parentheses
			$yr = $figuresInsideParentheses;
		}
			
			
			
		if(!str_contains($mTitle, "Drama") || !str_contains($mTitle, "TV") || !str_contains($mTitle, "Series") || !str_contains($mTitle, "Season") || !str_contains($mTitle, "Episode") || !str_contains($mTitle, "S0") || !str_contains($mTitle, "E0")) {
			if(count($title_array) === 1) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0])) || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($yr, $year)) {
						$output[] = '
							<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
								<img src="'.$img.'">
						
								<div>
									<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
								</div>
							</a></span>';
						$arr = array($output);
					}
				}
			}
			else if(count($title_array) === 2) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($link, strtoupper($title_array[0])) || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1])) || str_contains($mTitle, strtolower($title_array[1]))) {	
						if(str_contains($yr, $year)) {
							$output[] = '
								<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
									<img src="'.$img.'">
							
									<div>
										<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
									</div>
								</a></span>';
							$arr = array($output);
						}
					}
				}
			}
			else if(count($title_array) === 3) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($yr, $year)) {
								$output[] = '
									<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
										<img src="'.$img.'">
								
									<div>
										<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
									</div>
								</a></span>';
								$arr = array($output);
							}
						}
					}
				}
			}
			else if(count($title_array) === 4) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($yr, $year)) {
									$output[] = '
										<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
											<img src="'.$img.'">
											
											<div>
												<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
											</div>
										</a></span>';
									$arr = array($output);
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 5) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($mTitle, ucwords($title_array[4])) || str_contains($mTitle, strtoupper($title_array[4]))  || str_contains($mTitle, strtolower($title_array[4]))) {	
									if(str_contains($yr, $year)) {
										$output[] = '
											<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
												<img src="'.$img.'">
										
												<div>
													<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
												</div>
											</a></span>';
										$arr = array($output);
									}
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 6) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($mTitle, ucwords($title_array[4])) || str_contains($mTitle, strtoupper($title_array[4]))  || str_contains($mTitle, strtolower($title_array[4]))) {	
									if(str_contains($mTitle, ucwords($title_array[5])) || str_contains($mTitle, strtoupper($title_array[5]))  || str_contains($mTitle, strtolower($title_array[5]))) {		
										if(str_contains($yr, $year)) {
											$output[] = '
												<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
													<img src="'.$img.'">
											
													<div>
														<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
													</div>
												</a></span>';
											$arr = array($output);
										}
									}	
								}
							}	
						}
					}
				}
			}
			else if(count($title_array) === 7) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($mTitle, ucwords($title_array[4])) || str_contains($mTitle, strtoupper($title_array[4]))  || str_contains($mTitle, strtolower($title_array[4]))) {	
									if(str_contains($mTitle, ucwords($title_array[5])) || str_contains($mTitle, strtoupper($title_array[5]))  || str_contains($mTitle, strtolower($title_array[5]))) {		
										if(str_contains($mTitle, ucwords($title_array[6])) || str_contains($mTitle, strtoupper($title_array[6]))  || str_contains($mTitle, strtolower($title_array[6]))) {		
											if(str_contains($yr, $year)) {
												$output[] = '
													<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
														<img src="'.$img.'">
												
														<div>
															<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
														</div>
													</a></span>';
												$arr = array($output);
											}
										}	
									}	
								}
							}
						}
					}
				}
			}
			else if(count($title_array) === 8) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($mTitle, ucwords($title_array[4])) || str_contains($mTitle, strtoupper($title_array[4]))  || str_contains($mTitle, strtolower($title_array[4]))) {	
									if(str_contains($mTitle, ucwords($title_array[5])) || str_contains($mTitle, strtoupper($title_array[5]))  || str_contains($mTitle, strtolower($title_array[5]))) {		
										if(str_contains($mTitle, ucwords($title_array[6])) || str_contains($mTitle, strtoupper($title_array[6]))  || str_contains($mTitle, strtolower($title_array[6]))) {		
											if(str_contains($mTitle, ucwords($title_array[7])) || str_contains($mTitle, strtoupper($title_array[7]))  || str_contains($mTitle, strtolower($title_array[7]))) {				
												if(str_contains($yr, $year)) {
													$output[] = '
														<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
															<img src="'.$img.'">
													
															<div>
																<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
															</div>
														</a></span>';
													$arr = array($output);
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
			else if(count($title_array) === 9) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($mTitle, ucwords($title_array[4])) || str_contains($mTitle, strtoupper($title_array[4]))  || str_contains($mTitle, strtolower($title_array[4]))) {	
									if(str_contains($mTitle, ucwords($title_array[5])) || str_contains($mTitle, strtoupper($title_array[5]))  || str_contains($mTitle, strtolower($title_array[5]))) {		
										if(str_contains($mTitle, ucwords($title_array[6])) || str_contains($mTitle, strtoupper($title_array[6]))  || str_contains($mTitle, strtolower($title_array[6]))) {		
											if(str_contains($mTitle, ucwords($title_array[7])) || str_contains($mTitle, strtoupper($title_array[7]))  || str_contains($mTitle, strtolower($title_array[7]))) {				
												if(str_contains($mTitle, ucwords($title_array[8])) || str_contains($mTitle, strtoupper($title_array[8]))  || str_contains($mTitle, strtolower($title_array[8]))) {						
													if(str_contains($yr, $year)) {
														$output[] = '
															<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
																<img src="'.$img.'">
														
																<div>
																	<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
																</div>
															</a></span>';
														$arr = array($output);
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
			else if(count($title_array) === 10) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0]))  || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1]))  || str_contains($mTitle, strtolower($title_array[1]))) {
						if(str_contains($mTitle, ucwords($title_array[2])) || str_contains($mTitle, strtoupper($title_array[2]))  || str_contains($mTitle, strtolower($title_array[2]))) {
							if(str_contains($mTitle, ucwords($title_array[3])) || str_contains($mTitle, strtoupper($title_array[3]))  || str_contains($mTitle, strtolower($title_array[3]))) {
								if(str_contains($mTitle, ucwords($title_array[4])) || str_contains($mTitle, strtoupper($title_array[4]))  || str_contains($mTitle, strtolower($title_array[4]))) {	
									if(str_contains($mTitle, ucwords($title_array[5])) || str_contains($mTitle, strtoupper($title_array[5]))  || str_contains($mTitle, strtolower($title_array[5]))) {		
										if(str_contains($mTitle, ucwords($title_array[6])) || str_contains($mTitle, strtoupper($title_array[6]))  || str_contains($mTitle, strtolower($title_array[6]))) {		
											if(str_contains($mTitle, ucwords($title_array[7])) || str_contains($mTitle, strtoupper($title_array[7]))  || str_contains($mTitle, strtolower($title_array[7]))) {				
												if(str_contains($mTitle, ucwords($title_array[8])) || str_contains($mTitle, strtoupper($title_array[8]))  || str_contains($mTitle, strtolower($title_array[8]))) {						
													if(str_contains($mTitle, ucwords($title_array[9])) || str_contains($mTitle, strtoupper($title_array[9]))  || str_contains($mTitle, strtolower($title_array[9]))) {								
														if(str_contains($yr, $year)) {
															$output[] = '
																<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr.'"><a href="http://0.0.0.0:8080/movies.php">
																	<img src="'.$img.'">
															
																	<div>
																		<small><div id="cap">'.$mTitle.' ('.$yr.')</div></small>
																	</div>
															</a></span>';
															$arr = array($output);
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



shuffle($arr[0]);

foreach($arr[0] as $sh) {
	echo $sh;
}





}