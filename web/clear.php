<?php
date_default_timezone_set('UTC');

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$client = ClientBuilder::create()->build();

$indexName = 'logs-' . date('Y.m.d', time());
$params = ['index' => $indexName];

$response = $client->indices()->delete($params);

var_dump($response);