<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$token = Cache::get("bluedart_jwt_token");

$response = Illuminate\Support\Facades\Http::withHeaders([
    "JWTToken" => $token,
    "Accept" => "application/json"
])->get("https://apigateway-sandbox.bluedart.com/in/transportation/tracking/v1/GetShipmentDetails", [
    "handler" => "traking", // BlueDart actually requires weird query params sometimes
    "loginid" => "GG940111",
    "awb" => "58129220542",
    "numbers" => "58129220542",
    "format" => "json",
    "licencekey" => "kh7mnhqkmgegoksipxr0urmqesesseup",
    "version" => "1.3",
    "scans" => 1
]);

print_r($response->body());

