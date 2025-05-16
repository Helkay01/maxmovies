<?php
require "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;



$title = $_GET['t'];

$year = $_GET['y'];





$no_space = str_replace(" ","", $title);

$title_array = explode(" ", $title);





function lastPage($url) {
    $headers = get_headers($url, 1); // Get the HTTP headers of the URL

    if(isset($headers['Content-Type'])) {
        // Check if the Content-Type header indicates a video file
        $contentType = $headers['Content-Type'];
        $contentDisp = $headers['Content-Disposition'];
            
        if(is_array($contentType)) {
            $contentType = end($contentType); // Get the last Content-Type value
			$contentDisp = end($contentDisp);
        }

        if (strpos($contentType, 'video') !== false || strpos($contentDisp, "attachment") !== false) {
			echo '<li><a style="color: lightblue;" href="'.$url.'"><b>Download Link</b></a></li>';	
        }
        else {
        	echo '';   
        }
    }

    return false; // URL does not point to a video file
}









//Page5
function nextPage5($url) {
	$curl44 = new Curl();
	
   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';
	
	$curl44->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl44->setOpt(CURLOPT_COOKIEFILE, $cookieFile);
	
	$curl44->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl44->disableTimeout();
		
	$curl44->get($url);
	
	$res = $curl44->getRawResponseHeaders();
	
	// Use regular expression to extract the URL
	preg_match('/https?:\/\/\S+/', $res, $n_matches);
	
	if(!empty($n_matches)) {
		$n_url = $n_matches[0];
		$dlink = $n_url;
		
		if(str_contains($dlink, ".mkv") || str_contains($dlink, ".mp4")) {
		//	echo '<li><a style="color: lightblue;" href="'.$dlink.'"><b>Download Link</b></a></li>';
				lastPage($dlink);
		}
	}
	
	$curl44->close;
}






//Page4
function nextPage4($stri) {
	$text = $stri;
	
	// Use regular expression to extract the URL
	preg_match('/https?:\/\/\S+/', $text, $matches);
	
	if(!empty($matches)) {
		$url = $matches[0];
		$nurl = str_replace('";', "", $url);
		nextPage5($nurl);
	}

}




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
	
	$curl33->get("https:".$link2);
	
	
	if($curl33->getHttpStatusCode() === 200) {
		$curl33->close();
		$html3 = $curl33->response;
		
		
		$dom3 = new DOMDocument();
		@$dom3->loadHTML($html3);
	
	
		$scripts = $dom3->getElementsByTagName("script");
	
		foreach($scripts as $script) {
			$scr = $script->nodeValue;

			if(str_contains($scr, "oneClick") || str_contains($scr, "netnaijafiles")) {
				nextPage4($scr);
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
	
	$curl22->get("https://netnaija.xyz/".$link1);

	if($curl22->getHttpStatusCode() === 200) {
		$curl22->close();
		$html2 = $curl22->response;
	
	
		$dom2 = new DOMDocument();
		@$dom2->loadHTML($html2);
	
	
		$all_link2 = $dom2->getElementsByTagName("a");
	
		foreach($all_link2 as $newLinks) {
			$lk2 = $newLinks->getAttribute("href");
			if(str_contains($lk2, "netnaijafiles")) {
				nextPage3($lk2);
			}
		
		}
	
	
	}

}






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

$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);

// Set the maximum number of redirects to follow (if needed)
$curl->setOpt(CURLOPT_MAXREDIRS, 5);


$curl->disableTimeout();
	
$curl->get($url, $formData);




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