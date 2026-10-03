<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$token = Cache::get("bluedart_jwt_token");

$payload = [
    "Request" => [
        "Consignee" => [
            "ConsigneeAddress1"   => "123 Test St",
            "ConsigneeAttention"  => "Test Buyer",
            "ConsigneeMobile"     => "9999999999",
            "ConsigneeName"       => "Test Buyer",
            "ConsigneePincode"    => "110001",
        ],
        "Returnadds" => [
            "ReturnAddress1"      => "456 Seller St",
            "ReturnContact"       => "Test Seller",
            "ReturnMobile"        => "8888888888",
            "ReturnPincode"       => "400001",
        ],
        "Services" => [
            "ActualWeight"    => 1.0,
            "CollectableAmount" => 0,
            "Commodity"       => [
                "CommodityDetail1" => "Watch"
            ],
            "CreditReferenceNo"  => "PAT" . time(),
            "DeclaredValue"      => 1000,
            "Dimensions"         => [
                [
                    "Breadth" => 10,
                    "Count"   => 1,
                    "Height"  => 10,
                    "Length"  => 15,
                ]
            ],
            "PieceCount"         => 1,
            "PickupDate"         => "/Date(" . (time() * 1000) . "+0530)/",
            "ProductCode"        => "A",
            "ProductType"        => 2,
        ],
        "Shipper" => [
            "CustomerAddress1"  => "456 Seller St",
            "CustomerCode"      => "940111",
            "CustomerMobile"    => "8888888888",
            "CustomerName"      => "Test Seller",
            "CustomerPincode"   => "400001",
            "OriginArea"        => "GGN",
            "Sender"            => "Test Seller",
        ]
    ],
    "Profile" => [
        "Api_type" => "S",
        "LicenceKey" => "kh7mnhqkmgegoksipxr0urmqesesseup",
        "LoginID" => "GG940111",
        "Version" => "1.3"
    ]
];

$response = Illuminate\Support\Facades\Http::withHeaders([
    "JWTToken" => $token
])->post("https://apigateway-sandbox.bluedart.com/in/transportation/waybill/v1/GenerateWayBill", $payload);

print_r($response->json());
print_r($response->status());

