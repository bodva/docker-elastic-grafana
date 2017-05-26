<?php
date_default_timezone_set('UTC');

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';


$client = ClientBuilder::create()->build();

// $country = 'GB';
// $countries = ['US', 'GB', 'LT', 'UA'];
$countries = ['US', 'US', 'UA', 'UA'];
$reasons = [
'InvalidUrl', 
'MissingInterest', 
'NewsFeedAdDataWithoutPageId', 
'NewsFeedAdDataWithoutPostId',
'ErrorInGetPost',
'ImageNotFound',
'WrongVideoFormat',
'NoProxiesForCountry',
'ScrapperDidNotReturnData',
'FSpyError',
];

// YYYY.MM.DD
$indexName = 'logs-' . date('Y.m.d', time());
// var_dump($_SERVER); die;
for ($i = 0; $i < 5; $i++) {
    $params = [
        'index' => $indexName,
        'type' => 'reason',
        'body' => [
            // 'name' => $countries[rand(0,3)],
            'country' =>  $countries[rand(0,3)],
            'reason' =>  $reasons[rand(0,9)],
            'server' => (string)$_SERVER['SERVER_NAME'],
            'create_at' =>  (int)round(microtime(true) * 1000),
        ]
    ];
    $response = $client->index($params);
    usleep(rand(0,1000));
}

$search = [
    'index' => $indexName,
];
$response = $client->search($search);

var_dump($response);
