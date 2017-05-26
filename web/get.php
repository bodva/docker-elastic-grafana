<?php
date_default_timezone_set('UTC');

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$hosts = [
    '127.0.0.1:9200'
];

$client = ClientBuilder::create()
->setHosts($hosts)
->build();

$countries = ['US'];

// YYYY.MM.DD
// $indexName = 'logs-' . date('Y.m.d', time());
$indexName = 'logs-2017.02.03';

$params = [
    'index' => $indexName,
    'type'  => 'location',
    'id'    => 'AVoGYpLYPE8OQhsa4yQg',
];

$response = $client->get($params);

var_dump($response);

// if ($response) {
//     $params['timestamp']              = time();
//     $params['body']['doc']['name']    = $response['_source']['name'];
//     $params['body']['doc']['counter'] = $response['_source']['counter'] + 1;
//     $response                         = $client->update($params);
// }

// var_dump($response);
