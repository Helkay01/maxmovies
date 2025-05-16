<?php
require __DIR__ . '/vendor/autoload.php';

// Example usage
$curl = new \Curl\Curl();
$curl->get('https://example.com/api');

if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage;
} else {
    echo 'Response:' . "\n";
    var_dump($curl->response);
}
