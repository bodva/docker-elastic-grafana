<?php
date_default_timezone_set('UTC');

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$client = ClientBuilder::create()->build();

$indexName = 'logs-' . date('Y.m.d', time());
$params    = [
    "index" => $indexName,
    "body"  => [
        "mappings" => [
            "_default_" => [
                "_timestamp" => [
                    "enabled" => "true",
                    "type"    => "date",
                    "format"  => "strict_date_optional_time||epoch_millis",
                ],
                "properties" => [
                    "create_at" => [
                        "type"   => "date",
                        "format" => "epoch_millis",
                    ],
                ],
            ],
        ],
    ],
];

try {
    $response = $client->indices()->create($params);
} catch (\Exception $e) {
    var_dump($e->getMessage());die;
}

var_dump($response);
