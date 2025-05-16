<?php
include "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


$title = $_GET['t'];

$year = $_GET['y'];


$no_space = str_replace(" ","", $title);

$title_array = explode(" ", $title);


//last Page
function lastPage($url) {
    $headers = get_headers($url, 1); // Get the HTTP headers of the URL

    if(isset($headers['Content-Type'])) {
        // Check if the Content-Type header indicates a video file
        $contentType = $headers['Content-Type'];
              
        if(is_array($contentType)) {
            $contentType = end($contentType); // Get the last Content-Type value
        }

        if (strpos($contentType, 'video') !== false) {
			echo '<li><a style="color: lightblue;" href="'.$url.'"><b>Download Link</b></a></li>';	
        }
        else {
        	echo '';   
        }
    }
    else if(isset($headers['Content-Disposition'])) {
	    	// Check if the Content-Type header indicates a video file
			$contentDisp = $headers['Content-Disposition'];
    	
    	
    		if(is_array($contentDisp)) {
    			$contentDisp = end($contentDisp); // Get the last Content-Type value
    		}
    	
    		if(strpos($contentDisp, '"attachment"') !== false || strpos($contentDisp, "filename") !== false) {
		    	echo '<li><a style="color: lightblue;" href="'.$url.'"><b>Download Link</b></a></li>';	
	    	}
	    	else {
		    	echo '';   
	    	}
    
    	}
    

    return false; // URL does not point to a video file
}






//page5
function nextPage5($link4) {
   	$curl55 = new Curl();
   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

   	// Enable cookie handling
   	$curl55->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl55->setOpt(CURLOPT_COOKIEFILE, $cookieFile);

	$curl55->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl55->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl55->disableTimeout();
	
   	$curl55->get("https://fzmovies.net/".$link4);

	if($curl55->getHttpStatusCode() === 200) {
		$html5 = $curl55->response;

      	$dom5 = new DOMDocument();
     	@$dom5->loadHTML($html5);

     	$inp = $dom5->getElementsByTagName("input")->item(0);

		
		$dlink = $inp->getAttribute("value");
		
		lastPage($dlink);

   	}

}




//Page4
function nextPage4($link3) {
	$curl44 = new Curl();

	$lky2 = str_replace("download.php?downloadkey=", "", $link3);

   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

    // Enable cookie handling
    $curl44->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
    $curl44->setOpt(CURLOPT_COOKIEFILE, $cookieFile);
	
	$curl44->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl44->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl44->disableTimeout();
	
	$curl44->get("https://fzmovies.net/download.php", [
      "downloadkey" => $lky2,
    ]);



	
	if($curl44->getHttpStatusCode() === 200) {
		$curl44->close();
		$html4 = $curl44->response;

				
		$dom4 = new DOMDocument();
		@$dom4->loadHTML($html4);

		
		$all_link4 = $dom4->getElementsByTagName("a");
		
		foreach($all_link4 as $newLinks4) {
			$fzlink4 = $newLinks4->getAttribute("href");

			if(str_contains($fzlink4, "dlink")) {
				nextPage5($fzlink4);			
			}
		}
		
		
		
	}
	
	
	
}








//Page3
function nextPage3($link2) {


	$lky = str_replace("download1.php?downloadoptionskey=", "", $link2);

	$curl33 = new Curl();

   	$cookieFile = 'c/'.$_COOKIE['id'].'/cookies.txt';

	// Enable cookie handling
	$curl33->setOpt(CURLOPT_COOKIEJAR, $cookieFile); // Save cookies to a file
	$curl33->setOpt(CURLOPT_COOKIEFILE, $cookieFile); // Load cookies from the file

	$curl33->setOpt(CURLOPT_SSL_VERIFYPEER, false);
	$curl33->setUserAgent($_SERVER['HTTP_USER_AGENT']);
	
	$curl33->disableTimeout();
	
    $curl33->get("https://fzmovies.net/download1.php", [
	 "downloadoptionskey" => $lky,
	]);


	if($curl33->getHttpStatusCode() === 200) {
		$curl33->close();
		$html3 = $curl33->response;
		
		
		$dom3 = new DOMDocument();
		@$dom3->loadHTML($html3);


		$all_link3 = $dom3->getElementsByTagName("a");
		
		foreach($all_link3 as $newLinks3) {
			$fzlink3 = $newLinks3->getAttribute("href");


			if(str_contains($fzlink3, "downloadkey")) {
				nextPage4($fzlink3);
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
	
	$curl22->get("https://fzmovies.net/".$link1);

	if($curl22->getHttpStatusCode() === 200) {
		$curl22->close();
		$html2 = $curl22->response;


		$dom2 = new DOMDocument();
		@$dom2->loadHTML($html2);


		$all_link2 = $dom2->getElementsByTagName("a");

		foreach($all_link2 as $newLinks) {
			$fzlink2 = $newLinks->getAttribute("href");
			if(str_contains($fzlink2, "download1.php") !== false) {
				nextPage3($fzlink2);
			}

		}

	}



}







//Curl Start

$url = 'https://fzmovies.net/csearch.php';

// Form data to be submitted
$formData = array(
    'searchname' => $title,
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

	$xpath = new DOMXPath($dom);

	// Define the class name you want to select
	$className = 'mainbox';

	// Use XPath query to select elements by class name
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");

	
if($elements !== null) {
	
	for($e = 0; $e < count($elements); $e++) {
		$one =  $elements->item($e);
		$lk = $one->getElementsByTagName("a")->item(0);
		$sm = $one->getElementsByTagName("small")->item(1);

		$fzlink = $lk->getAttribute('href');
		$yr = $sm->nodeValue;
		$yr1 = str_replace("(", "", $yr);
		$yr2 = str_replace(")", "", $yr1);

		
		if(count($title_array) === 1) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0])) || str_contains($fzlink, strtolower($title_array[0]))) {
				if(str_contains($yr, $year)) {
			      	nextPage2($fzlink);
			   	}
			}
		}
		else if(count($title_array) === 2) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0])) || str_contains($fzlink, strtolower($title_array[0]))) {
				if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1])) || str_contains($fzlink, strtolower($title_array[1]))) {	
					if(str_contains($yr, $year)) {
						nextPage2($fzlink);
					}
				}
			}
		}
		else if(count($title_array) === 3) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
			    		if(str_contains($yr, $year)) {
			    			nextPage2($fzlink);
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 4) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    			if(str_contains($yr, $year)) {
			    				nextPage2($fzlink);
			    			}
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 5) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    		    if(str_contains($fzlink, ucwords($title_array[4])) || str_contains($fzlink, strtoupper($title_array[4]))  || str_contains($fzlink, strtolower($title_array[4]))) {	
			    				if(str_contains($yr, $year)) {
			    					nextPage2($fzlink);
			    				}
			    			}
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 6) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    		    if(str_contains($fzlink, ucwords($title_array[4])) || str_contains($fzlink, strtoupper($title_array[4]))  || str_contains($fzlink, strtolower($title_array[4]))) {	
			    			    if(str_contains($fzlink, ucwords($title_array[5])) || str_contains($fzlink, strtoupper($title_array[5]))  || str_contains($fzlink, strtolower($title_array[5]))) {		
			    					if(str_contains($yr, $year)) {
			    						nextPage2($fzlink);
			    					}
			    				}	
			    			}
			    		}
			    	}
			    }
			}
		}
		else if(count($title_array) === 7) {
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    		    if(str_contains($fzlink, ucwords($title_array[4])) || str_contains($fzlink, strtoupper($title_array[4]))  || str_contains($fzlink, strtolower($title_array[4]))) {	
			    			    if(str_contains($fzlink, ucwords($title_array[5])) || str_contains($fzlink, strtoupper($title_array[5]))  || str_contains($fzlink, strtolower($title_array[5]))) {		
			    					if(str_contains($fzlink, ucwords($title_array[6])) || str_contains($fzlink, strtoupper($title_array[6]))  || str_contains($fzlink, strtolower($title_array[6]))) {		
			    						if(str_contains($yr, $year)) {
			    							nextPage2($fzlink);
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
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    		    if(str_contains($fzlink, ucwords($title_array[4])) || str_contains($fzlink, strtoupper($title_array[4]))  || str_contains($fzlink, strtolower($title_array[4]))) {	
			    			    if(str_contains($fzlink, ucwords($title_array[5])) || str_contains($fzlink, strtoupper($title_array[5]))  || str_contains($fzlink, strtolower($title_array[5]))) {		
			    					if(str_contains($fzlink, ucwords($title_array[6])) || str_contains($fzlink, strtoupper($title_array[6]))  || str_contains($fzlink, strtolower($title_array[6]))) {		
			    						if(str_contains($fzlink, ucwords($title_array[7])) || str_contains($fzlink, strtoupper($title_array[7]))  || str_contains($fzlink, strtolower($title_array[7]))) {				
			    							if(str_contains($yr, $year)) {
			    								nextPage2($fzlink);
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
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    		    if(str_contains($fzlink, ucwords($title_array[4])) || str_contains($fzlink, strtoupper($title_array[4]))  || str_contains($fzlink, strtolower($title_array[4]))) {	
			    			    if(str_contains($fzlink, ucwords($title_array[5])) || str_contains($fzlink, strtoupper($title_array[5]))  || str_contains($fzlink, strtolower($title_array[5]))) {		
			    					if(str_contains($fzlink, ucwords($title_array[6])) || str_contains($fzlink, strtoupper($title_array[6]))  || str_contains($fzlink, strtolower($title_array[6]))) {		
			    						if(str_contains($fzlink, ucwords($title_array[7])) || str_contains($fzlink, strtoupper($title_array[7]))  || str_contains($fzlink, strtolower($title_array[7]))) {				
			    							if(str_contains($fzlink, ucwords($title_array[8])) || str_contains($fzlink, strtoupper($title_array[8]))  || str_contains($fzlink, strtolower($title_array[8]))) {						
			    								if(str_contains($yr, $year)) {
			    									nextPage2($fzlink);
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
			if(str_contains($fzlink, ucwords($title_array[0])) || str_contains($fzlink, strtoupper($title_array[0]))  || str_contains($fzlink, strtolower($title_array[0]))) {
			    if(str_contains($fzlink, ucwords($title_array[1])) || str_contains($fzlink, strtoupper($title_array[1]))  || str_contains($fzlink, strtolower($title_array[1]))) {
			    	if(str_contains($fzlink, ucwords($title_array[2])) || str_contains($fzlink, strtoupper($title_array[2]))  || str_contains($fzlink, strtolower($title_array[2]))) {
					    if(str_contains($fzlink, ucwords($title_array[3])) || str_contains($fzlink, strtoupper($title_array[3]))  || str_contains($fzlink, strtolower($title_array[3]))) {
			    		    if(str_contains($fzlink, ucwords($title_array[4])) || str_contains($fzlink, strtoupper($title_array[4]))  || str_contains($fzlink, strtolower($title_array[4]))) {	
			    			    if(str_contains($fzlink, ucwords($title_array[5])) || str_contains($fzlink, strtoupper($title_array[5]))  || str_contains($fzlink, strtolower($title_array[5]))) {		
			    					if(str_contains($fzlink, ucwords($title_array[6])) || str_contains($fzlink, strtoupper($title_array[6]))  || str_contains($fzlink, strtolower($title_array[6]))) {		
			    						if(str_contains($fzlink, ucwords($title_array[7])) || str_contains($fzlink, strtoupper($title_array[7]))  || str_contains($fzlink, strtolower($title_array[7]))) {				
			    							if(str_contains($fzlink, ucwords($title_array[8])) || str_contains($fzlink, strtoupper($title_array[8]))  || str_contains($fzlink, strtolower($title_array[8]))) {						
			    								if(str_contains($fzlink, ucwords($title_array[9])) || str_contains($fzlink, strtoupper($title_array[9]))  || str_contains($fzlink, strtolower($title_array[9]))) {								
			    									if(str_contains($yr, $year)) {
			    										nextPage2($fzlink);
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