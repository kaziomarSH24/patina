<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$token = Cache::get("bluedart_jwt_token");

$payload = [
    "Request" => [
        "WaybillNo" => "58129220542",
    ],
    "Profile" => [
        "Api_type" => "S",
        "LicenceKey" => "kh7mnhqkmgegoksipxr0urmqesesseup",
        "LoginID" => "GG940111",
        "Version" => "1.3"
    ]
];
$response = Illuminate\Support\Facades\Http::withHeaders([
    "JWTToken" => $token,
    "Content-Type" => "application/json",
    "Accept" => "application/json"
])->post("https://apigateway-sandbox.bluedart.com/in/transportation/tracking/v1/GetShipmentDetails", $payload);

print_r($response->body());

