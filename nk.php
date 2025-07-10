<?php
require "vendor/autoload.php";

use Curl\Curl;




$title = $_GET['t'];

$year = $_GET['y'];



$no_space = str_replace(["!", "*", ":"], "", $title);

$title_array = explode(" ", $no_space);





//Page3
function nextPage3($link2, $title, $year) {
			
	$curl33 = new Curl();
	
   	$cookieFile = 'c.txt';
	
	$curl33->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl33->setOpt(CURLOPT_COOKIEFILE, $cookieFile);
	
	
	$curl33->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl33->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl33->disableTimeout();
	
	// Parse the URL to get the path
	$path = parse_url($link2, PHP_URL_PATH);
	
	// Extract the file name from the path
	$fileName = basename($path);
	
	$pro = str_replace("/".$fileName, "", $link2);
	$pro2 = str_replace("https://downloadwella.com/", "", $pro);
	
	
	
	
	$curl33->get($link2, [
	"op" => "download2",
	"id" => $pro2,
	"rand" => "",
	"referer" => "",
	"method_free" => "",
	"method_premium" => "",
	]);
	
	
	
	$string = $curl33->getRawResponseHeaders();
	
	
	if(str_contains($string, "mkv")) {
		// Use regular expression to extract the URL
		if (preg_match('/Location: (https:\/\/[^ ]+\.mkv)/', $string, $matches)) {
			$url = $matches[1];
			// Remove "https://" and ensure it ends with ".mkv"
			$url = substr($url, 8); // Remove "https://"
			if (substr($url, -4) !== '.mkv') {
				$url = $url . '.mkv'; // Ensure it ends with ".mkv"
			}
			
			$dlink1 = "https://".$url;

			
			
		//	echo '<li><a style="color: lightblue;" href="https://imd.com.ng/download.php?filename='.$title.' '.$year.'&url='.$dlink1.'"><b>Download Link</b></a></li>';
			echo $dlink1;
			return;
		}
	}
	
	else if(str_contains($string, "mp4")) {
		// Use regular expression to extract the URL
		if (preg_match('/Location: (https:\/\/[^ ]+\.mp4)/', $string, $matches)) {
			$url = $matches[1];
			// Remove "https://" and ensure it ends with ".mkv"
			$url = substr($url, 8); // Remove "https://"
			if (substr($url, -4) !== '.mp4') {
				$url = $url . '.mp4'; // Ensure it ends with ".mkv"
			}
			$dlink2 = "https://".$url;
			

			//echo '<li><a style="color: lightblue;" href="https://imd.com.ng/download.php?filename='.$title.' '.$year.'&url='.$dlink1.'"><b>Download Link</b></a></li>';
			echo '<li>'.$dlink2.'</li>';
		}
	}
	else if(str_contains($string, "video")) {
		$dlink3 = "https://".$url;
	//	echo '<li><a style="color: lightblue;" href="'.$dlink3.'"><b>Download Link</b></a></li>';
	
		echo '<li>'.$dlink3.'</li>';
	}

}







//Page2
function nextPage2($link1, $title, $year) {
	$curl22 = new Curl();
	
   	$cookieFile = 'c.txt';
	
	// Enable cookie handling
	$curl22->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl22->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file
	
	$curl22->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl22->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl22->disableTimeout();
	
	$curl22->get($link1);
	
	if($curl22->getHttpStatusCode() === 200) {
		$curl22->close();
		$html2 = $curl22->response;
	
	
		$dom2 = new DOMDocument();
		@$dom2->loadHTML($html2);
	
	
		$all_link2 = $dom2->getElementsByTagName("a");
	
		foreach($all_link2 as $newLinks) {
			$lk2 = $newLinks->getAttribute("href");
			if(str_contains($lk2, "downloadwella") !== false) {
				nextPage3($lk2, $title, $year);
			}
		
		}
	
	
	}

}








//Curl Start

$url = 'https://nkiri.com/';

// Form data to be submitted
$formData = array(
    's' => $title,
    'post_type' => 'post',
);

$curl = new Curl();

$cookieFile = 'c.txt';

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
			      	nextPage2($lk, $title, $year);
			   	}
			}
		}
		else if(count($title_array) === 2) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0])) || str_contains($lk, strtolower($title_array[0]))) {
				if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1])) || str_contains($lk, strtolower($title_array[1]))) {	
					if(str_contains($lk, $year)) {
						nextPage2($lk, $title, $year);
					}
				}
			}
		}
		else if(count($title_array) === 3) {
			if(str_contains($lk, ucwords($title_array[0])) || str_contains($lk, strtoupper($title_array[0]))  || str_contains($lk, strtolower($title_array[0]))) {
			    if(str_contains($lk, ucwords($title_array[1])) || str_contains($lk, strtoupper($title_array[1]))  || str_contains($lk, strtolower($title_array[1]))) {
			    	if(str_contains($lk, ucwords($title_array[2])) || str_contains($lk, strtoupper($title_array[2]))  || str_contains($lk, strtolower($title_array[2]))) {
			    		if(str_contains($lk, $year)) {
			    			nextPage2($lk, $title, $year);
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
			    				nextPage2($lk, $title, $year);
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
			    					nextPage2($lk, $title, $year);
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
			    						nextPage2($lk, $title, $year);
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
			    							nextPage2($lk, $title, $year);
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
			    								nextPage2($lk, $title, $year);
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
			    									nextPage2($lk, $title, $year);
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
			    										nextPage2($lk, $title, $year);
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
