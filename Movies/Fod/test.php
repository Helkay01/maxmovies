<?php
include "/data/data/com.termux/files/home/vendor/autoload.php";

use Curl\Curl;


$url = 'https://goomaphy.com/clicks/m82DhNUFWCtKEjEPHgbkpVUSHyEGxQIIC-DeUiz3S6nxrCTc1dcaWtMrxEu-EUpHUcfHpG9t9eAIim1iTwoDU639_XShojVwuWx7sVB962PbNWgD7kiAaJ4RNBrSMhgiIUhHNVRTToXfPAVBYyczuI7aKEiH8J9vP8DJ9oTLRSLM95_bBqVH8u8DnS0YRFd-V4iI9UUH-5hMH64MBNXHS2MeSEl5l787N4H4LvvaPvM_gUA2d2zNnKf-j5ZJ_SPdZZK7WQXyttBNPrhiyRzuGazCT9HouVkE_KzZIJP3BiN8QPUuStUzWxkYRLcC39i2-KP8p4BkgTS1lEe-F-YbINfkN9Iw7gFZCPqkXwTtP44PNvA0tyhBAa9XIEdX7SnA2xsfxMMEBvrEssEbYt3eHx8yeatH6hnHb7GoFMEVrMHo4yN4xpE7FpNqY0clA8flmSrvZAgKxGzP811ELdFMrYJC6VtACWvWp_7nEAkYCYDSrqMhhpIj0eFNGzFyUMwAyi44ZQjxLPzRK7ZY6fZfKLhHGscI-7FNOGaiasmXj49_PKYHagzklHN2-CmvheA-8qw6YcHUGWM=?_z=6119679&b=20898123&lhe=1105&fs=0&cf=0&sw=320&sh=640&sah=640&wx=0&wy=0&ww=320&wh=520&cw=1280&wiw=1280&wih=2080&wfc=2&pl=https%3A%2F%2Fchatgptdemo.info%2Fchat%2F&drf=https%3A%2F%2Fwww.google.com%2F&np=0&pt=0&nb=1&ng=1&ix=0&nw=1&tb=true&tzofs=60&btz=Africa%2FLagos&bto=-60&os=android&is_mobile=true&js_build=8&sw_version=v1.343.0';


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
echo $curl->response;

