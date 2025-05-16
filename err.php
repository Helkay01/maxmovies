<?php
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/(Windows|Macintosh|Linux)/', $userAgent)) {
    header("Location: /error.html");
}
