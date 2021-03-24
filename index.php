<?php

const BASE_URL = 'https://api.telegram.org/bot';
const TOKEN    = '1638738405:AAFtsjTWn-wAb-jzN27SeLspT8nu_7mxWoY';

$url = json_decode(file_get_contents('php://input'), true);

foreach ($url['result'] as $result) {
    $params = [
        'chat_id' => $result['message']['chat']['id'],
        'text' => 'Ну привет!'
    ];

    $response = BASE_URL . TOKEN . "/sendMessage?" . http_build_query($params);

    json_decode(file_get_contents($response));
}