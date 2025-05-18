<?php
require 'vendor/autoload.php';

use Curl\Curl;
use GeoIp2\Database\Reader;

$curl = new Curl();


$curl->disableTimeout();

// Configure cURL options
$cookieFile = 'c.txt';
$curl->setOpt(CURLOPT_COOKIEJAR, $cookieFile);
$curl->setOpt(CURLOPT_COOKIEFILE, $cookieFile);
$curl->setOpt(CURLOPT_FOLLOWLOCATION, true); // Follow redirects
$curl->setOpt(CURLOPT_RETURNTRANSFER, true);

// SSL configuration - better to verify but disable if needed
$curl->setOpt(CURLOPT_SSL_VERIFYPEER, true); // Disable for testing, enable in production
$curl->setOpt(CURLOPT_SSL_VERIFYHOST, 2);



$userAgents = [
	"Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36 PHX/6.9",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36 PHX/7.0",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO CE8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/101.0.4951.61 Mobile Safari/537.36 OPR/63.0.2254.62069",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO CE8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/108.0.5359.128 Mobile Safari/537.36 OPR/10.8.2254.63920",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 OPR/66.2.2254.64268",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/106.0.5249.79 Mobile Safari/537.36 OPR/65.0.2254.63211",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/90.0.4430.210 Mobile Safari/537.36 OPR/62.5.2254.61243",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.6261.119 Mobile Safari/537.36 PHX/15.2",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.210 Mobile Safari/537.36 PHX/11.0",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.104 Mobile Safari/537.36 PHX/9.1",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36 PHX/8.0",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.62 Mobile Safari/537.36 PHX/11.8",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Mobile Safari/537.36 PHX/10.2",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.143 YaApp_Android/22.51.1 YaSearchBrowser/22.51.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.3.86.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8h) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.160 YaBrowser/22.5.2.68.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8h) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.148 YaBrowser/22.7.4.88.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CH7 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36 OPR/87.0.2254.75299",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.011 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.035 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.035 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.036 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 HiBrowser/v2.5.10.3 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.3.8.1305 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.4.0.1306 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 YaApp_Android/22.50.1 YaSearchBrowser/22.50.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.160 YaApp_Android/22.52.1 YaSearchBrowser/22.52.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.160 YaApp_Android/22.53.1 YaSearchBrowser/22.53.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 YaBrowser/22.9.0.225.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.124 YaBrowser/22.9.8.37.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 YaBrowser/22.11.0.224.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.174 YaApp_Android/22.17.1 YaSearchBrowser/22.17.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 YaBrowser/22.3.1.86.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; Android 12; TECNO CH7n Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/119.0.6045.66 Mobile Safari/537",
	"Mozilla/5.0 (Linux; Android 12; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 13; TECNO CI8 Build/TP1A.220624.014) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.5790.138 Mobile Safari/537.36 PHX/13.8",
	"Mozilla/5.0 (Linux; U; Android 13; TECNO CI8 Build/TP1A.220624.014) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.6312.121 Mobile Safari/537.36 PHX/16.2",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8 Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 HiBrowser/v2.5.11.2 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/99.0.4844.88 Mobile Safari/537.36 OPR/66.0.2254.64011",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/105.0.5195.136 Mobile Safari/537.36 OPR/69.0.2254.66073",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/99.0.4844.88 Mobile Safari/537.36 OPR/66.1.2254.64111",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8n Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/105.0.5195.136 Mobile Safari/537.36 OPR/66.1.2254.64111",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8n Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.4.0.1306 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CI8n Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.4.2.1307 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 13; TECNO CI8n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 YaSearchBrowser/23.73.1 BroPP/1.0 YaSearchApp/23.73.1 webOmni SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 13; TECNO CI8n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.87 YaBrowser/23.9.3.87.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 12; TECNO CI8n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 YaApp_Android/22.110.1 YaSearchBrowser/22.110.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; Android 14; TECNO CK7n Build/UP1A.231005.007; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36 EdgA/124.0.247",
	"Mozilla/5.0 (Linux; Android 14; TECNO CK7n Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.136 Mobile Safari/53",
	"Mozilla/5.0 (Linux; Android 14; TECNO CK7n Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/121.0.6167.178 Mobile Safari/53",
	"Mozilla/5.0 (Linux; Android 14; TECNO CL6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; Android 14; TECNO CL6 Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.129 HiBrowser/v2.24.2.1 UWS/ Mobi",
	"Mozilla/5.0 (Linux; U; Android 14; TECNO CL6k Build/UP1A.231005.007) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.6167.178 Mobile Safari/537.36 PHX/17.5",
	"Mozilla/5.0 (Linux; Android 14; TECNO CL6k Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.129 HiBrowser/v2.23.1.4 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 7.1.1; Phantom6-Plus Build/NMF26O; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/64.0.3282.137 Mobile Safari/537.36 OPR/26.0.2254.117942",
	"Mozilla/5.0 (Linux; U; Android 7.1.1; Phantom6-Plus Build/NMF26O; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/64.0.3282.137 Mobile Safari/537.36 OPR/51.0.2254.150807",
	"Mozilla/5.0 (Linux; U; Android 6.0; Phantom6-Plus Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.9.7.1153 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; Android 7.1.1; Phantom6-Plus) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.88 Mobile Safari/537.36 OPR/68.2.3557.64219",
	"Mozilla/5.0 (Linux; U; Android 7.0; TECNO AX8 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.198 Mobile Safari/537.36 OPR/52.2.2254.54723",
	"Mozilla/5.0 (Linux; U; Android 7.0; TECNO AX8 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/90.0.4430.82 Mobile Safari/537.36 OPR/55.1.2254.56965",
	"Mozilla/5.0 (Linux; U; Android 7.0; TECNO AX8 Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.98 Mobile Safari/537.36 OPR/62.2.2254.60938",
	"Mozilla/5.0 (Linux; U; Android 7.0; en; TECNO AX8 Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.10.0.1163 UCTurbo/1.10.3.900 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 7.0; en-us; TECNO AX8 Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.111 Mobile Safari/537.36 PHX/6.6",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/79.0.3945.136 Mobile Safari/537.36 OPR/50.0.2254.149182",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36 OPR/51.0.2254.150807",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.198 Mobile Safari/537.36 OPR/52.2.2254.54723",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/93.0.4577.82 Mobile Safari/537.36 OPR/57.0.2254.57961",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/93.0.4577.82 Mobile Safari/537.36 OPR/58.0.2254.58441",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/113.0.5672.162 Mobile Safari/537.36 OPR/70.0.2254.66376",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/11.0",
	"Mozilla/5.0 (Linux; U; Android 9; TECNO AB7 Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/13.2.0.1296 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.201 Mobile Safari/537.36 OPR/86.0.2254.74831",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 OPR/86.0.2254.74790",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/129.0.6668.102 Mobile Safari/537.36 OPR/83.1.2254.73239",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/10.1",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.96 Mobile Safari/537.36 OPR/52.1.2254.54140",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.101 Mobile Safari/537.36 OPR/58.0.2254.58176",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.96 Mobile Safari/537.36 OPR/56.1.2254.57583",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 OPR/86.0.2254.74790",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/10.1",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/100.0.4896.127 Mobile Safari/537.36 OPR/62.5.2254.61243",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2c Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.101 Mobile Safari/537.36 PHX/13.2",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO BC2 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.71 Mobile Safari/537.36 PHX/12.0",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO LC8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/79.0.3945.116 Mobile Safari/537.36 OPR/55.1.2254.56965",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO LC8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Mobile Safari/537.36 PHX/16.2",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO LC8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.10.0.1163 UCTurbo/1.10.3.900 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO LC8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.10.0.1163 UCTurbo/1.10.6.900 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO CE8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/101.0.4951.61 Mobile Safari/537.36 OPR/63.0.2254.62069",
	"Mozilla/5.0 (Linux; U; Android 10; TECNO CE8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/108.0.5359.128 Mobile Safari/537.36 OPR/10.8.2254.63920",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 OPR/66.2.2254.64268",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/106.0.5249.79 Mobile Safari/537.36 OPR/65.0.2254.63211",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/90.0.4430.210 Mobile Safari/537.36 OPR/62.5.2254.61243",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.6261.119 Mobile Safari/537.36 PHX/15.2",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.210 Mobile Safari/537.36 PHX/11.0",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.104 Mobile Safari/537.36 PHX/9.1",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36 PHX/8.0",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.62 Mobile Safari/537.36 PHX/11.8",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CG8h Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Mobile Safari/537.36 PHX/10.2",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.143 YaApp_Android/22.51.1 YaSearchBrowser/22.51.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.3.86.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8h) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.160 YaBrowser/22.5.2.68.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CG8h) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.148 YaBrowser/22.7.4.88.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 12; TECNO CH7 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36 OPR/87.0.2254.75299",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.011 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.035 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.035 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 HiBrowser/2.5.036 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 HiBrowser/v2.5.10.3 UWS/ Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.3.8.1305 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; U; Android 11; TECNO CH7n Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.4.0.1306 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 YaApp_Android/22.50.1 YaSearchBrowser/22.50.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.160 YaApp_Android/22.52.1 YaSearchBrowser/22.52.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.160 YaApp_Android/22.53.1 YaSearchBrowser/22.53.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 YaBrowser/22.9.0.225.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.124 YaBrowser/22.9.8.37.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 YaBrowser/22.11.0.224.00 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.174 YaApp_Android/22.17.1 YaSearchBrowser/22.17.1 BroPP/1.0 SA/3 Mobile Safari/537.36",
	"Mozilla/5.0 (Linux; arm_64; Android 11; TECNO CH7n) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 YaBrowser/22.3.1.86.00 SA/3 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 15; en; Infinix X6857 Build/SP1A.210812.016) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.7103.60 HiBrowser/v2.24.5.2 UWS/ Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 15; Infinix X6858 Build/AP3A.240905.015.A2; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/135.0.7049.105 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/510.0.0.72.41;IABMV/1;]",
    "Mozilla/5.0 (Linux; Android 9.0; 5001J Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/49.0.2623.105 Mobile Safari/537.36 Hawk/TurboBrowser/2.0.14",
    "Mozilla/5.0 (Linux; Android 9.0; 5024D Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/49.0.2623.105 Mobile Safari/537.36 Hawk/TurboBrowser/2.0.14",
    "Mozilla/5.0 (Linux; Android 9.0; 5024J Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/49.0.2623.105 Mobile Safari/537.36 Hawk/TurboBrowser/2.0.14",
    "Mozilla/5.0 (Linux; Android 8.1.0; 5059D_RU Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/64.0.3282.137 Mobile Safari/537.36 Hawk/TurboBrowser/v3.0.1.20",
    "Mozilla/5.0 (Linux; U; Android 13; SM-A715F Build/TP1A.220624.014) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 Hawk/QuickBrowser/2.9.14.860",
    "Mozilla/5.0 (Linux; U; Android 9; INE-LX2 Build/HUAWEIINE-LX2) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.91 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.21.22910",
    "Mozilla/5.0 (Linux; U; Android 9; SM-A605G Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.35.115731",
    "Mozilla/5.0 (Linux; U; Android 9; SM-J610F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.162 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.35.115731",
    "Mozilla/5.0 (Linux; U; Android 9; SM-J701F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/101.0.4951.61 Mobile Safari/537.36 Hawk/QuickBrowser/1.1.8",
    "Mozilla/5.0 (Linux; U; Android 9; ANE-LX1 Build/HUAWEIANE-L21) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.101 Mobile Safari/537.36 Hawk/QuickBrowser/4.23.7.1980",
    "Mozilla/5.0 (Linux; U; Android 9; ANE-LX1 Build/HUAWEIANE-L21) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.66 Mobile Safari/537.36 Hawk/QuickBrowser/4.23.7.1980",
    "Mozilla/5.0 (Linux; U; Android 9; SM-A307FN Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.149 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.34.115730",
    "Mozilla/5.0 (Linux; U; Android 9; SM-G950F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/90.0.4430.82 Mobile Safari/537.36 Hawk/QuickBrowser/4.23.7.1980",
    "Mozilla/5.0 (Linux; U; Android 9; SM-J330F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/88.0.4324.181 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.35.115731",
    "Mozilla/5.0 (Linux; Android 13.0; SM-G780G Build/TP1A.220624.014) AppleWebKit/537.36 (KHTML, like Gecko) Start/53.0.2785.97 Chrome/53.0.2785.97 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 12; SM-M315F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36 YaaniBrowser/8.3.10",
    "Mozilla/5.0 (Linux; Android 9; VKY-L29) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.0.7",
    "Mozilla/5.0 (Linux; Android 9; VKY-L29) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile YaaniBrowser/7.0.6 Safari/537.36",
    "Mozilla/5.0 (Linux; Android 9; SM-J730F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.0.4",
    "Mozilla/5.0 (Linux; Android 9; SM-J701F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.1.0",
    "Mozilla/5.0 (Linux; Android 9; SM-G965F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile YaaniBrowser/7.0.6 Safari/537.36",
    "Mozilla/5.0 (Linux; Android 9; SM-G955F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.1.0",
    "Mozilla/5.0 (Linux; U; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.106 Mobile Safari/537.36 OPR/50.0.2254.149182",
    "Mozilla/5.0 (Linux; U; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 Mobile Safari/537.36 OPR/58.0.2254.58441",
    "Mozilla/5.0 (Linux; U; Android 5.1; TECNO-J8 Build/LMY47D) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.10.0.1163 UCTurbo/1.10.3.900 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.111 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/65.0.3325.109 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/66.0.3359.126 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/79.0.3945.116 Mobile Safari/537.36 OPR/55.0.2254.56695",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/85.0.4183.81 Mobile Safari/537.36 OPR/51.0.2254.150807",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 OPR/53.1.2254.55490",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/93.0.4577.82 Mobile Safari/537.36 OPR/52.1.2254.54298",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/94.0.4606.85 Mobile Safari/537.36 OPR/60.0.2254.59405",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.136 Mobile Safari/537.36 PHX/13.4",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 Mobile Safari/537.36 OPR/64.0.2254.62526",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.71 Mobile Safari/537.36 OPR/63.0.2254.62069",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/96.0.4664.45 Mobile Safari/537.36 OPR/61.0.2254.59937",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36 OPR/62.1.2254.60552",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/99.0.4844.73 Mobile Safari/537.36 OPR/62.4.2254.61190",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/102.0.5005.125 Mobile Safari/537.36 OPR/63.0.2254.62069",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.127 Mobile Safari/537.36 PHX/5.7",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.82 Mobile Safari/537.36 PHX/7.1",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.82 Mobile Safari/537.36 PHX/7.2",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/10.3",
    "Mozilla/5.0 (Linux; Android 9.0; 5001J Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/49.0.2623.105 Mobile Safari/537.36 Hawk/TurboBrowser/2.0.14",
    "Mozilla/5.0 (Linux; Android 9.0; 5024D Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/49.0.2623.105 Mobile Safari/537.36 Hawk/TurboBrowser/2.0.14",
    "Mozilla/5.0 (Linux; Android 9.0; 5024J Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/49.0.2623.105 Mobile Safari/537.36 Hawk/TurboBrowser/2.0.14",
    "Mozilla/5.0 (Linux; Android 8.1.0; 5059D_RU Build/O11019; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/64.0.3282.137 Mobile Safari/537.36 Hawk/TurboBrowser/v3.0.1.20",
    "Mozilla/5.0 (Linux; U; Android 13; SM-A715F Build/TP1A.220624.014) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 Hawk/QuickBrowser/2.9.14.860",
    "Mozilla/5.0 (Linux; U; Android 9; INE-LX2 Build/HUAWEIINE-LX2) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/107.0.5304.91 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.21.22910",
    "Mozilla/5.0 (Linux; U; Android 9; SM-A605G Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.125 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.35.115731",
    "Mozilla/5.0 (Linux; U; Android 9; SM-J610F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.162 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.35.115731",
    "Mozilla/5.0 (Linux; U; Android 9; SM-J701F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/101.0.4951.61 Mobile Safari/537.36 Hawk/QuickBrowser/1.1.8",
    "Mozilla/5.0 (Linux; U; Android 9; ANE-LX1 Build/HUAWEIANE-L21) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.101 Mobile Safari/537.36 Hawk/QuickBrowser/4.23.7.1980",
    "Mozilla/5.0 (Linux; U; Android 9; ANE-LX1 Build/HUAWEIANE-L21) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.66 Mobile Safari/537.36 Hawk/QuickBrowser/4.23.7.1980",
    "Mozilla/5.0 (Linux; U; Android 9; SM-A307FN Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.149 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.34.115730",
    "Mozilla/5.0 (Linux; U; Android 9; SM-G950F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/90.0.4430.82 Mobile Safari/537.36 Hawk/QuickBrowser/4.23.7.1980",
    "Mozilla/5.0 (Linux; U; Android 9; SM-J330F Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/88.0.4324.181 Mobile Safari/537.36 Hawk/QuickBrowser/2.4.35.115731",
    "Mozilla/5.0 (Linux; Android 13.0; SM-G780G Build/TP1A.220624.014) AppleWebKit/537.36 (KHTML, like Gecko) Start/53.0.2785.97 Chrome/53.0.2785.97 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 12; SM-M315F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36 YaaniBrowser/8.3.10",
    "Mozilla/5.0 (Linux; Android 9; VKY-L29) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.0.7",
    "Mozilla/5.0 (Linux; Android 9; VKY-L29) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile YaaniBrowser/7.0.6 Safari/537.36",
    "Mozilla/5.0 (Linux; Android 9; SM-J730F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.0.4",
    "Mozilla/5.0 (Linux; Android 9; SM-J701F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.1.0",
    "Mozilla/5.0 (Linux; Android 9; SM-G965F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile YaaniBrowser/7.0.6 Safari/537.36",
    "Mozilla/5.0 (Linux; Android 9; SM-G955F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4372.0 Mobile Safari/537.36 YaaniBrowser/8.1.0",
    "Mozilla/5.0 (Linux; U; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/83.0.4103.106 Mobile Safari/537.36 OPR/50.0.2254.149182",
    "Mozilla/5.0 (Linux; U; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.99 Mobile Safari/537.36 OPR/58.0.2254.58441",
    "Mozilla/5.0 (Linux; U; Android 5.1; TECNO-J8 Build/LMY47D) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.10.0.1163 UCTurbo/1.10.3.900 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/63.0.3239.111 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/65.0.3325.109 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; Android 5.1; TECNO-J8 Build/LMY47D; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/66.0.3359.126 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/79.0.3945.116 Mobile Safari/537.36 OPR/55.0.2254.56695",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/85.0.4183.81 Mobile Safari/537.36 OPR/51.0.2254.150807",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 OPR/53.1.2254.55490",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/93.0.4577.82 Mobile Safari/537.36 OPR/52.1.2254.54298",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/94.0.4606.85 Mobile Safari/537.36 OPR/60.0.2254.59405",
    "Mozilla/5.0 (Linux; U; Android 9; TECNO CC9 Build/PPR1.180610.011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.136 Mobile Safari/537.36 PHX/13.4",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.129 Mobile Safari/537.36 OPR/64.0.2254.62526",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.71 Mobile Safari/537.36 OPR/63.0.2254.62069",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/96.0.4664.45 Mobile Safari/537.36 OPR/61.0.2254.59937",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/97.0.4692.70 Mobile Safari/537.36 OPR/62.1.2254.60552",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/99.0.4844.73 Mobile Safari/537.36 OPR/62.4.2254.61190",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/102.0.5005.125 Mobile Safari/537.36 OPR/63.0.2254.62069",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.127 Mobile Safari/537.36 PHX/5.7",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.82 Mobile Safari/537.36 PHX/7.1",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.82 Mobile Safari/537.36 PHX/7.2",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/10.3",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/9.7",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.12.9.1226 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.3.8.1305 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.101 Mobile Safari/537.36 PHX/9.7",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 UCBrowser/12.12.9.1226 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.3.8.1305 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.4.0.1306 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/78.0.3904.108 UCBrowser/13.4.5.1308 Mobile Safari/537.36",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36 PHX/6.1",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36 PHX/6.7",
    "Mozilla/5.0 (Linux; U; Android 10; TECNO CD8 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.81 Mobile Safari/537.36 PHX/6.9",
];

$curl->setUserAgent($userAgents[array_rand($userAgents)]);



// Set headers to mimic a browser
$headers = [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Language: en-US,en;q=0.9',
    'Connection: keep-alive'
];
$curl->setOpt(CURLOPT_HTTPHEADER, $headers);

// Make the request
$curl->get('https://www.freeproxy.world/', [
    'type' => 'https',
    'anonymity' => 4,
    'country' => '',
    'speed' => 500,
    'port' => '',
    'page' => 4,
]);

if ($curl->error) {
    //error
} else {
    $html = $curl->response;
    $fpDom = new DOMDocument();
    @$fpDom->loadHTML($html);
    $xpath = new DOMXPath($fpDom);

    // Define the class name you want to select
    $className = 'show-ip-div';
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]");
    
    $atag = new DOMXPath($fpDom);
    $nodes = $atag->query("//a[contains(@href, 'port=')]");
    
    $data = [];
    
    // Check if we found elements
    if ($elements->length > 0 && $nodes->length > 0) {
        for($i = 0; $i < min($elements->length, $nodes->length); $i++) {
            $ip = trim($elements->item($i)->nodeValue);
            $port = trim($nodes->item($i)->nodeValue);
            
            try {
                // Load the MMDB database
                $reader = new Reader('GeoLite2-City.mmdb');
                $record = $reader->city($ip);
                
                // Extract data
                $timezone = $record->location->timeZone;
                $country = $record->country->name;
                
                // Create DateTime in the given timezone
                $dt = new DateTime("now", new DateTimeZone($timezone));
                $formattedDate = $dt->format('Y-m-d H:i:s');
                $abbreviation = $dt->format('T');
                $offsetSeconds = $dt->getOffset();
                $offsetFormatted = sprintf('%+03d:%02d', $offsetSeconds / 3600, abs($offsetSeconds % 3600) / 60);
                $utcDesignator = 'UTC' . ($offsetSeconds >= 0 ? '+' : '') . ($offsetSeconds / 3600);
                
                $reader->close();
                
                $data[] = [
                    'ip' => $ip,
                    'port' => (int)$port,
                    'type' => 'https',
                    'country' => $country,
                    'timezone' => $timezone,
                    'date' => $formattedDate,
                    'timezone_abbr' => $abbreviation,
                    'utc_offset' => $offsetFormatted, 
                    'utc_designator' => $utcDesignator,
                    'current_time' => $formattedDate,
                ];
            } catch (Exception $e) {
                // Log error but continue with next IP
                error_log("Error processing IP $ip: " . $e->getMessage());
                continue;
            }
        }
    } else {
        // No elements found - check if the page structure changed
        error_log("No proxy elements found in the response. Page structure may have changed.");
    }
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}
