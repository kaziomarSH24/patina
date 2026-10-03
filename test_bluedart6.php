<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = app(\App\Services\BlueDartService::class);
// Use reflection to change origin area temporarily
$reflection = new \ReflectionClass($service);
$property = $reflection->getProperty("originArea");
$property->setAccessible(true);
$property->setValue($service, "BOM");

$result = $service->generateAWB([
    "buyer_name" => "Test Buyer",
    "buyer_address" => "123 Test St",
    "buyer_pincode" => "110001",
    "buyer_mobile" => "9999999999",
    "buyer_email" => "test@test.com",
    "seller_name" => "Test Seller",
    "seller_address" => "456 Seller St",
    "seller_pincode" => "400001",
    "seller_mobile" => "8888888888",
    "seller_email" => "seller@test.com",
    "weight" => "1.0",
    "reference_no" => "PAT-" . time(),
    "sub_product_code" => "",
]);
print_r($result);

