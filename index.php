<?php

const TOKEN    = '1638738405:AAFtsjTWn-wAb-jzN27SeLspT8nu_7mxWoY';
const BASE_URL = 'https://api.telegram.org/bot' . TOKEN;

$update = json_decode(file_get_contents('php://input'), true);
$countryName = $update['message']['text'];

$wikiUrl = 'https://ru.wikipedia.org/wiki/' . urlencode($countryName);
$html = file_get_contents($wikiUrl, false, null, 0, 50000);

$flag_map = json_decode(file_get_contents('flag_mapping'), true);

if (strpos($html, "государство")) {
    $text = ($flag_map[$countryName] ?? "") . "<a href=\"$wikiUrl\">Ваша ссылка</a> на Wiki";
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