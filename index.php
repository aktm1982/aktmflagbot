<?php

const TOKEN    = '1638738405:AAFtsjTWn-wAb-jzN27SeLspT8nu_7mxWoY';
const BASE_URL = 'https://api.telegram.org/bot' . TOKEN;

$update = json_decode(file_get_contents('php://input'), true);

$countryName = $update['message']['text'];
$wikiUrl = 'https://ru.wikipedia.org/wiki/' . $countryName;

$params = [
    'chat_id' => $update['message']['chat']['id'],
    'text' => "Ваша [ссылка]($wikiUrl) на Wiki"
];

$response = BASE_URL . "/sendMessage?" . http_build_query($params);

json_decode(file_get_contents($response), true);