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
            "ConsigneeAddress2"   => "Test",
            "ConsigneeAddress3"   => "Test",
            "ConsigneeAttention"  => "Test Buyer",
            "ConsigneeMobile"     => "9999999999",
            "ConsigneeName"       => "Test Buyer",
            "ConsigneePincode"    => "110001",
        ],
        "Returnadds" => [
            "ManifestNumber"      => "",
            "ReturnAddress1"      => "456 Seller St",
            "ReturnAddress2"      => "",
            "ReturnAddress3"      => "",
            "ReturnContact"       => "Test Seller",
            "ReturnMobile"        => "8888888888",
            "ReturnPincode"       => "400001",
        ],
        "Services" => [
            "ActualWeight"    => "1.0",
            "CollectableAmount" => "0.0",
            "Commodity"       => [
                "CommodityDetail1" => "Watch"
            ],
            "CreditReferenceNo"  => "PAT" . time(),
            "DeclaredValue"      => "1000.0",
            "Dimensions"         => [
                [
                    "Breadth" => 10.0,
                    "Count"   => 1,
                    "Height"  => 10.0,
                    "Length"  => 15.0,
                ]
            ],
            "InvoiceNo"          => "",
            "PackType"           => "",
            "PickupDate"         => "/Date(" . (time() * 1000) . "+0530)/",
            "PieceCount"         => "1",
            "ProductCode"        => "A",
            "ProductType"        => "2",
            "SubProductCode"     => "",
        ],
        "Shipper" => [
            "CustomerAddress1"  => "456 Seller St",
            "CustomerAddress2"  => "",
            "CustomerAddress3"  => "",
            "CustomerCode"      => "940111",
            "CustomerMobile"    => "8888888888",
            "CustomerName"      => "Test Seller",
            "CustomerPincode"   => "400001",
            "IsToPayCustomer"   => false,
            "OriginArea"        => "GGN",
            "Sender"            => "Test Seller",
            "VendorCode"        => "",
        ],
        "Profile" => [
            "Api_type" => "S",
            "LicenceKey" => "kh7mnhqkmgegoksipxr0urmqesesseup",
            "LoginID" => "GG940111",
        ],
    ]
];

$response = Illuminate\Support\Facades\Http::withHeaders([
    "JWTToken" => $token
])->post("https://apigateway-sandbox.bluedart.com/in/transportation/waybill/v1/GenerateWayBill", $payload);

print_r($response->json());
print_r($response->status());

