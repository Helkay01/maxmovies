<?php
require __DIR__.'/vendor/autoload.php'; // Require Composer autoload

use Symfony\Component\Panther\Client;

// 1. Initialize Chrome client with proper options
$client = Client::createChromeClient(null, [
    'headless' => true, // Run in background
    'args' => [
        '--no-sandbox',
        '--disable-dev-shm-usage'
    ]
]);

try {
    // 2. Request the page
    $crawler = $client->request('GET', 'https://example.com/dynamic-content');
    
    // 3. Wait for JavaScript (with timeout)
    $client->waitFor('.dynamic-element', 10); // 10 second max wait
    
    // 4. Get rendered content
    $html = $client->getPageSource();
    
    // 5. Extract data safely
    $data = [
        'content' => $crawler->filter('.dynamic-element')->count() 
            ? $crawler->filter('.dynamic-element')->text() 
            : 'Element not found'
    ];
    
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);

} catch (\Exception $e) {
    die("Error: " . $e->getMessage());
} finally {
    // 6. Always quit the client
    $client->quit();
}
