<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = app(\App\Services\BlueDartService::class);
$token = "";
try {
    $token = Cache::get("bluedart_jwt_token");
} catch (\Exception $e) {}

$payload = [
    "Request" => [
        "Consignee" => [
            "ConsigneeAddress1"   => "123 Test St",
            "ConsigneeAddressType"=> "R",
            "ConsigneeAttention"  => "Test Buyer",
            "ConsigneeEmailID"    => "test@test.com",
            "ConsigneeMobile"     => "9999999999",
            "ConsigneeName"       => "Test Buyer",
            "ConsigneePincode"    => "110001",
        ],
        "Returnadds" => [
            "ReturnAddress1"  => "456 Seller St",
            "ReturnAddressType" => "R",
            "ReturnContact"   => "Test Seller",
            "ReturnEmailID"   => "seller@test.com",
            "ReturnMobile"    => "8888888888",
            "ReturnPincode"   => "400001",
        ],
        "Services" => [
            "ActualWeight"    => "1.0",
            "CollectableAmount" => 0,
            "Commodity"       => [
                "CommodityDetail1" => "Watch"
            ],
            "CreditReferenceNo"  => "PAT-" . time(),
            "DeclaredValue"      => 1000,
            "ItemCount"          => 1,
            "Pieces"             => [
                [
                    "Breadth" => 10,
                    "Count"   => 1,
                    "Height"  => 10,
                    "Length"  => 15,
                    "Weight"  => 1.0,
                ]
            ],
            "PieceCount"         => "1",
            "PickupDate"         => "/Date(" . (time() * 1000) . "+0530)/",
            "ProductCode"        => "A",
            "ProductType"        => 2,
            "SubProductCode"     => "W",
        ],
        "Shipper" => [
            "CustomerAddress1"  => "456 Seller St",
            "CustomerAddressType" => "R",
            "CustomerCode"      => "940111",
            "CustomerEmailID"   => "seller@test.com",
            "CustomerMobile"    => "8888888888",
            "CustomerName"      => "Test Seller",
            "CustomerPincode"   => "400001",
            "OriginArea"        => "GGN",
            "Sender"            => "Test Seller",
        ],
        "Profile" => [
            "Api_type" => "S",
            "LicenceKey" => "kh7mnhqkmgegoksipxr0urmqesesseup",
            "LoginID" => "GG940111",
            "IsCreditTypeUser"  => true,
            "RegisterPickup"    => false,
        ],
    ]
];

$response = Illuminate\Support\Facades\Http::withHeaders([
    "JWTToken" => $token
])->post("https://apigateway-sandbox.bluedart.com/in/transportation/waybill/v1/GenerateWayBill", $payload);

print_r($response->json());
print_r($response->status());

