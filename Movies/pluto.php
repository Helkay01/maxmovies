<?php
// require "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


$title = "black adam";

$year = "2022";

$no_space = str_replace(" ","", $title);

$title_array = explode(" ", $title);




//Page3
function nextPage3($link2) {
	$curl33 = new Curl();
	
	$cookieFile = 'cookies.txt';
	
	// Enable cookie handling
	$curl33->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl33->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
	
	$curl33->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	
	$curl33->disableTimeout();
	
	$curl33->get($link2);
	
	if($curl33->getHttpStatusCode() === 200) {
		$curl33->close();
		$html3 = $curl33->response;
	
	
		$dom3 = new DOMDocument();
		@$dom3->loadHTML($html3);
	
	
		$div = $dom3->getElementsByTagName("a");
	
		$xpath = new DOMXPath($dom3);
		
		// Define the class name you want to select
		$className = 'buttah';
		
		// Use XPath query to select elements by class name
		$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
		
		for($e = 0; $e < count($elements); $e++) {
			$one =  $elements->item($e);
			$scr = $one->getElementsByTagName("script")->item(0)->nodeValue;
			if(str_contains($scr, "downloadButton")) {
				$text = $scr;
				
				// Use regular expression to extract the URL
				preg_match('/https?:\/\/\S+/', $text, $matches);
				
				if (!empty($matches)) {
					$url = $matches[0];
					echo str_replace("';","",$url);
				}				
			}
		}
	}

}






//Page2
function nextPage2($link1) {
	$curl22 = new Curl();
	
	$cookieFile = 'cookies.txt';
	
	// Enable cookie handling
	$curl22->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl22->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
	
	$curl22->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	
	$curl22->disableTimeout();
	$curl22->get('https://plutomovies.com/'.$link1);
	
	if($curl22->getHttpStatusCode() === 200) {
		$curl22->close();
		$html2 = $curl22->response;
	
	
		$dom2 = new DOMDocument();
		@$dom2->loadHTML($html2);
	
	
		$all_link2 = $dom2->getElementsByTagName("a");
	
		foreach($all_link2 as $newLinks) {
			$lk2 = $newLinks->getAttribute("href");
			if(str_contains($lk2, "mp4") || str_contains($lk2, "mkv") || str_contains($lk2, "3gp") || str_contains($lk2, "m4a")) {
				nextPage3($lk2);
			}
		
		}
	
	
	}

}






//Curl Start

$url = 'https://plutomovies.com/search/'.$title.'/page/1';


$curl = new Curl();

$cookieFile = 'cookies.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file

$curl->disableTimeout();
	
$curl->get($url);

if($curl->getHttpStatusCode() === 200) {
	$curl->close();
	
	$html = $curl->response;
	
	$dom = new DOMDocument();
	@$dom->loadHTML($html);
	$a = $dom->getElementsByTagName("a");


	for($af = 0; $af < count($a); $af++) {
		$lk = $a->item($af)->getAttribute("href");
		
		if(count($title_array) === 1) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0])) || str_contains($lk, strtolower($title_array[0]))) {
				if(str_contains($lk, $year)) {
			      	nextPage2($lk);
			   	}
			}
		}
		else if(count($title_array) === 2) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0])) || str_contains($lk, strtolower($title_array[0]))) {
				if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1])) || str_contains($lk, strtolower($title_array[1]))) {	
					if(str_contains($lk, $year)) {
						nextPage2($lk);
					}
				}
			}
		}
		else if(count($title_array) === 3) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
			    		if(str_contains($lk, $year)) {
			    			nextPage2($lk);
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 4) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    			if(str_contains($lk, $year)) {
			    				nextPage2($lk);
			    			}
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 5) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    		    if(str_contains($lk, ucwords($title_array[4])) || str_contains($lk, strtoupper($title_array[4]))  || str_contains($lk, strtolower($title_array[4]))) {	
			    				if(str_contains($lk, $year)) {
			    					nextPage2($lk);
			    				}
			    			}
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 6) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    		    if(str_contains($lk, ucwords($title_array[4])) || str_contains($lk, strtoupper($title_array[4]))  || str_contains($lk, strtolower($title_array[4]))) {	
			    			    if(str_contains($lk, ucwords($title_array[5])) || str_contains($lk, strtoupper($title_array[5]))  || str_contains($lk, strtolower($title_array[5]))) {		
			    					if(str_contains($lk, $year)) {
			    						nextPage2($lk);
			    					}
			    				}	
			    			}
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 7) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    		    if(str_contains($lk, ucwords($title_array[4])) || str_contains($lk, strtoupper($title_array[4]))  || str_contains($lk, strtolower($title_array[4]))) {	
			    			    if(str_contains($lk, ucwords($title_array[5])) || str_contains($lk, strtoupper($title_array[5]))  || str_contains($lk, strtolower($title_array[5]))) {		
			    					if(str_contains($lk, ucwords($title_array[6])) || str_contains($lk, strtoupper($title_array[6]))  || str_contains($lk, strtolower($title_array[6]))) {		
			    						if(str_contains($lk, $year)) {
			    							nextPage2($lk);
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
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    		    if(str_contains($lk, ucwords($title_array[4])) || str_contains($lk, strtoupper($title_array[4]))  || str_contains($lk, strtolower($title_array[4]))) {	
			    			    if(str_contains($lk, ucwords($title_array[5])) || str_contains($lk, strtoupper($title_array[5]))  || str_contains($lk, strtolower($title_array[5]))) {		
			    					if(str_contains($lk, ucwords($title_array[6])) || str_contains($lk, strtoupper($title_array[6]))  || str_contains($lk, strtolower($title_array[6]))) {		
			    						if(str_contains($lk, ucwords($title_array[7])) || str_contains($lk, strtoupper($title_array[7]))  || str_contains($lk, strtolower($title_array[7]))) {				
			    							if(str_contains($lk, $year)) {
			    								nextPage2($lk);
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
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    		    if(str_contains($lk, ucwords($title_array[4])) || str_contains($lk, strtoupper($title_array[4]))  || str_contains($lk, strtolower($title_array[4]))) {	
			    			    if(str_contains($lk, ucwords($title_array[5])) || str_contains($lk, strtoupper($title_array[5]))  || str_contains($lk, strtolower($title_array[5]))) {		
			    					if(str_contains($lk, ucwords($title_array[6])) || str_contains($lk, strtoupper($title_array[6]))  || str_contains($lk, strtolower($title_array[6]))) {		
			    						if(str_contains($lk, ucwords($title_array[7])) || str_contains($lk, strtoupper($title_array[7]))  || str_contains($lk, strtolower($title_array[7]))) {				
			    							if(str_contains($lk, ucwords($title_array[8])) || str_contains($lk, strtoupper($title_array[8]))  || str_contains($lk, strtolower($title_array[8]))) {						
			    								if(str_contains($lk, $year)) {
			    									nextPage2($lk);
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
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
					    if(str_contains($lk, ucwords($title_array[3])) || str_contains($lk, strtoupper($title_array[3]))  || str_contains($lk, strtolower($title_array[3]))) {
			    		    if(str_contains($lk, ucwords($title_array[4])) || str_contains($lk, strtoupper($title_array[4]))  || str_contains($lk, strtolower($title_array[4]))) {	
			    			    if(str_contains($lk, ucwords($title_array[5])) || str_contains($lk, strtoupper($title_array[5]))  || str_contains($lk, strtolower($title_array[5]))) {		
			    					if(str_contains($lk, ucwords($title_array[6])) || str_contains($lk, strtoupper($title_array[6]))  || str_contains($lk, strtolower($title_array[6]))) {		
			    						if(str_contains($lk, ucwords($title_array[7])) || str_contains($lk, strtoupper($title_array[7]))  || str_contains($lk, strtolower($title_array[7]))) {				
			    							if(str_contains($lk, ucwords($title_array[8])) || str_contains($lk, strtoupper($title_array[8]))  || str_contains($lk, strtolower($title_array[8]))) {						
			    								if(str_contains($lk, ucwords($title_array[9])) || str_contains($lk, strtoupper($title_array[9]))  || str_contains($lk, strtolower($title_array[9]))) {								
			    									if(str_contains($lk, $year)) {
			    										nextPage2($lk);
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

