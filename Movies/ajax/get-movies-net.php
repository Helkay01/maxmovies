<?php
include "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


$title = $_GET['t'];

$year = $_GET['y'];


$no_space = str_replace(" ","", $title);

$title_array = explode(" ", $title);








//Curl Start

$url = 'https://netnaija.xyz/';

// Form data to be submitted
$formData = array(
    's' => $title,
);

$curl = new Curl();

$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file


$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);


$curl->disableTimeout();
	
$curl->get($url, $formData);


if($curl->getHttpStatusCode() === 200) {

	$curl->close();

	$html = $curl->response;

	$dom = new DOMDocument();
	@$dom->loadHTML($html);

	$div = $dom->getElementById("content");
	$li = $div->getElementsByTagName("li");
	
	foreach($li as $list) {
		$a = $list->getElementsByTagName("a")->item(0);
		$mTit = $list->getElementsByTagName("a")->item(0)->getAttribute("aria-label");
		$img = "https://netnaija.xyz/".$list->getElementsByTagName("img")->item(0)->getAttribute("src");
		
		
		$string = $mTit;			
		$mTitle = preg_replace('/\([^)]+\)/', '', $string);
		
		
		$pattern = '/\((\d+)\)/'; // Regular expression pattern to match digits inside parentheses
		
		if(preg_match($pattern, $string, $matches)) {
			$figuresInsideParentheses = $matches[1]; // Extract the figures inside parentheses
			$yr4 = $figuresInsideParentheses;		
		}
		
	/*
		$string = $mTitle;			
		$yr = preg_replace('/\([^)]+\)/', '', $string);
		$yr1 = str_replace("(", "", $yr);
		$yr2 = str_replace(")", "", $yr1);
	*/
		
		if(!str_contains($mTitle, "Drama") || !str_contains($mTitle, "TV") || !str_contains($mTitle, "Series") || !str_contains($mTitle, "Season") || !str_contains($mTitle, "Episode") || !str_contains($mTitle, "S0") || !str_contains($mTitle, "E0")) {
			if(count($title_array) === 1) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0])) || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($yr4, $year)) {
						$output[] = '
							<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
								<img src="'.$img.'">
						
								<div>
									<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
								</div>
							</a></span>';
						$arr = array($output);
					}
				}
			}
			else if(count($title_array) === 2) {
				if(str_contains($mTitle, ucwords($title_array[0])) || str_contains($mTitle, strtoupper($title_array[0])) || str_contains($mTitle, strtolower($title_array[0]))) {
					if(str_contains($mTitle, ucwords($title_array[1])) || str_contains($mTitle, strtoupper($title_array[1])) || str_contains($mTitle, strtolower($title_array[1]))) {	
						if(str_contains($yr4, $year)) {
							$output[] = '
								<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
									<img src="'.$img.'">
							
									<div>
										<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
							if(str_contains($yr4, $year)) {
								$output[] = '
									<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
										<img src="'.$img.'">
								
									<div>
										<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
								if(str_contains($yr4, $year)) {
									$output[] = '
										<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
											<img src="'.$img.'">
											
											<div>
												<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
									if(str_contains($yr4, $year)) {
										$output[] = '
											<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
												<img src="'.$img.'">
										
												<div>
													<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
										if(str_contains($yr4, $year)) {
											$output[] = '
												<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
													<img src="'.$img.'">
											
													<div>
														<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
											if(str_contains($yr4, $year)) {
												$output[] = '
													<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
														<img src="'.$img.'">
												
														<div>
															<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
												if(str_contains($yr4, $year)) {
													$output[] = '
														<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
															<img src="'.$img.'">
													
															<div>
																<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
													if(str_contains($yr4, $year)) {
														$output[] = '
															<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
																<img src="'.$img.'">
														
																<div>
																	<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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
														if(str_contains($yr4, $year)) {
															$output[] = '
																<span class="movies" data-type="movies" data-img="'.$img.'" data-title="'.$mTitle.'" data-year="'.$yr4.'"><a href="http://0.0.0.0:8080/movies.php">
																	<img src="'.$img.'">
															
																	<div>
																		<small><div id="cap">'.$mTitle.' ('.$yr4.')</div></small>
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