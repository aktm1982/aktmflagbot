<?php

const TOKEN    = '1638738405:AAFtsjTWn-wAb-jzN27SeLspT8nu_7mxWoY';
const BASE_URL = 'https://api.telegram.org/bot' . TOKEN;

$update = json_decode(file_get_contents('php://input'), true);

$countryName = $update['message']['text'];
$wikiUrl = 'https://ru.wikipedia.org/wiki/' . $countryName;

$page = file_get_contents($wikiUrl);

if (strpos($page, "Государства")) {
    $text = "Вот ваша <a href=\"$wikiUrl\">ссылка</a> на Wiki";
} else {
    $text = "Попробуйте ввести название страны :))";
}

$params = [
    'parse_mode' => 'HTML',
    'chat_id' => $update['message']['chat']['id'],
    'text' => $text
];

$response = BASE_URL . "/sendMessage?" . http_build_query($params);

json_decode(file_get_contents($response), true);