<?php
require "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;



$title = $_GET['t'];

$year = $_GET['y'];








$no_space = str_replace(" ","", $title);

$title_array = explode(" ", $title);



/*

//last Page
function lastPage($link) {
	$curl44 = new Curl();
	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';
	
	// Enable cookie handling
	$curl44->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl44->setOpt(CURLOPT_COOKIEFILE, $cookieFile);
	
	$curl44->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl44->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl44->disableTimeout();
	
	$curl44->get($link);
	
	if($curl44->getHttpStatusCode() === 200) {
		$headers = $curl44->getRawResponseHeaders();
		if(str_contains($headers, "attachment") || str_contains($headers, "video")) {
			echo '<li><a style="color: lightblue;" href="'.$link.'"><b>Download Link</b></a></li>';
		}
	}
	


}






//Page4
function nextPage4($link2) {
	$curl33 = new Curl();

   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';
	
	// Enable cookie handling
	$curl33->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl33->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
	
	$curl33->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl33->setUserAgent($_SERVER['HTTP_USER_AGENT']);


	$curl33->disableTimeout();
	$curl33->get($link2);
	
	if($curl33->getHttpStatusCode() === 200) {
		$curl33->close();
		$html3 = $curl33->response;
	
	
		$dom3 = new DOMDocument();
		@$dom3->loadHTML($html3);
	
	
		$xpath = new DOMXPath($dom3);
		
		// Define the class name you want to select
		$className = 'btn btn-primary btn-lg mt-3';
		
		// Use XPath query to select elements by class name
		$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
		
		for($e = 0; $e < count($elements); $e++) {
			$one =  $elements->item($e);
			$dlink = $one->getAttribute("onclick");

			// Use regular expression to extract the URL
			preg_match('/https?:\/\/\S+/', $dlink, $matches);
			
			if(!empty($matches)) {
				$Vurl = $matches[0];
				$Vidurl = str_replace("';", "", $Vurl);
			
				$dlink = $Vidurl;
				
			//	lastPage($dlink);
				echo '<li><a style="color: lightblue;" href="'.$dlink.'"><b>Download Link</b></a></li>';
			}
			
		}
	}

}







*/






//Page3
function nextPage3($link2) {
	$curl33 = new Curl();

   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';
	
	// Enable cookie handling
	$curl33->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl33->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
	
	$curl33->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl33->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl33->disableTimeout();
	$curl33->get($link2);
	
	if($curl33->getHttpStatusCode() === 200) {
		$curl33->close();
		$html3 = $curl33->response;
	
	
		$dom3 = new DOMDocument();
		@$dom3->loadHTML($html3);
	
	
		$a = $dom3->getElementsByTagName("a");
		foreach($a as $as) {
			$url = $as->getAttribute("href");
			$tp1 = str_contains($url, "mp4") && str_contains($url, "https://stagatvfiles"); 
			$tp2 = str_contains($url, "mkv") && str_contains($url, "https://stagatvfiles"); 		
			
			if($tp1 || $tp2) {
			//	nextPage4($url);
				echo $url;
			}
		}	

	}

}







//Page2
function nextPage2($link1) {
	$curl22 = new Curl();

   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';
	
	// Enable cookie handling
	$curl22->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl22->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
	
	$curl22->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	
	$curl22->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl22->disableTimeout();
	$curl22->get($link1);
	
	if($curl22->getHttpStatusCode() === 200) {

		$ht = $curl22->response;
		
	
		$dom2 = new DOMDocument();
		@$dom2->loadHTML($ht);
	
	
		$all_link2 = $dom2->getElementsByTagName("a");
	
		foreach($all_link2 as $newLinks) {
			$lk2 = $newLinks->getAttribute("href");
			if(str_contains($lk2, "stagatv") && !str_contains($lk2, "cdn.")) {
				echo $lk2;

			}
			else if(str_contains($lk2, "stagatv") && str_contains($lk2, "cdn.")) {
				nextPage3($lk2);
			}
		
		}
	
	
	}
		$curl22->close();
}





//Curl Start

$url = 'https://ww2.realgbedu.com/search/'.str_replace(" ", "-", $title).'/';


$curl = new Curl();

$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

// Enable cookie handling
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file

$curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
$curl->setUserAgent($_SERVER['HTTP_USER_AGENT']);

$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);

// Set the maximum number of redirects to follow (if needed)
$curl->setOpt(CURLOPT_MAXREDIRS, 5);

$curl->disableTimeout();
	
$curl->get($url);

	


	
if($curl->getHttpStatusCode() === 200) {
	$curl->close();
	
	$ht = $curl->response;

	
	$html = str_replace("<!doctype html>", "", $ht);

	$dom = new DOMDocument();
	@$dom->loadHTML($ht);
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