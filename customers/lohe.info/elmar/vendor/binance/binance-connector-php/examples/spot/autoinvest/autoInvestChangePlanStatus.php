<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$client = new \Binance\Spot();

$response = $client->autoInvestChangePlanStatus(
    1,
    'ONGOING',
    [
        'recvWindow' => 5000
    ]
);

echo json_encode($response);
