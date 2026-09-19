<?php
$url = "https://api.sandbox.co.in/authenticate";
$apiKey = "key_test_d85d7e736f9a4c5a9f91640456cb6bd1";
$apiSecret = "secret_test_44679252597f4e5490e6535ffbd482d9";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "x-api-key: " . $apiKey,
    "x-api-secret: " . $apiSecret,
    "x-api-version: 1.0.0",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
echo "Auth Response: " . $response . "\n";

