<?php
if(!isset($_COOKIE['imd'])) {

header("Location: http://0.0.0.0:8080/search.php");


include "header.php";



echo '
	<title>IMD | Download Latest or Old movies without Ads. </title>
';	




include "head.php";


include "footer.php";

}
else {
	echo 'display ads';
}

