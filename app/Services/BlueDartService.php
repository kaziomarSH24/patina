<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

/**
 * BlueDartService
 *
 * Implements BlueDart APIGEE REST API integration.
 * Reference: APIGEE_Integration_document_June_2026_1.docx (v2.10)
 *
 * Authentication Flow:
 *   1. POST /in/transportation/token/v1/login  (headers: ClientID, clientSecret)
 *      -> returns { "JWTToken": "eyJ..." }
 *   2. All subsequent requests use header: JWTToken: <token>
 *      + Profile object inside JSON body (LoginID + LicenceKey)
 *
 * Base URLs:
 *   Production : https://apigateway.bluedart.com
 *   Sandbox    : https://apigateway-sandbox.bluedart.com
 *
 * =====================================================================
 * !! IMPORTANT - UserDoesNotExists Error !!
 * The LoginID (GG940111) and LicenceKey from the payload credentials
 * must be registered and synced on the APIGEE platform by BlueDart.
 * If "UserDoesNotExists" appears, ask the client to confirm the
 * correct LoginID/LicenceKey tied to their APIGEE account.
 * =====================================================================
 */
class BlueDartService
{
    // ----------------------------------------------------------------
    // APIGEE Gateway credentials (for JWT Token generation)
    // ----------------------------------------------------------------
    protected string $clientId;
    protected string $clientSecret;

    // ----------------------------------------------------------------
    // Payload profile credentials (sent inside every request body)
    // ----------------------------------------------------------------
    protected string $loginId;
    protected string $licenceKey;
    protected string $originArea;
    protected string $customerCode;
    protected string $version;

    // ----------------------------------------------------------------
    // API base URL
    // ----------------------------------------------------------------
    protected string $apiUrl;

    public function __construct()
    {
        // APIGEE credentials (JWT token generation)
        $this->clientId     = env('BLUEDART_CLIENT_ID');
        $this->clientSecret = env('BLUEDART_CLIENT_SECRET');

        // Payload profile credentials (sent in every request body)
        $this->loginId      = env('BLUEDART_LOGIN_ID', 'GG940111');
        $this->licenceKey   = env('BLUEDART_LICENSE_KEY', 'kh7mnhqkmgegoksipxr0urmqesesseup');
        $this->originArea   = env('BLUEDART_ORIGIN_AREA', 'GGN');
        $this->customerCode = env('BLUEDART_CUSTOMER_CODE', '940111');
        $this->version      = env('BLUEDART_VERSION', '1.3');

        // Use sandbox URL for testing, production for live
        // BLUEDART_API_URL=https://apigateway.bluedart.com (production)
        // BLUEDART_API_URL=https://apigateway-sandbox.bluedart.com (sandbox)
        $this->apiUrl = env('BLUEDART_API_URL', 'https://apigateway.bluedart.com');
    }

    // ================================================================
    // AUTHENTICATION
    // Endpoint: GET /in/transportation/token/v1/login
    // Headers : ClientID, clientSecret
    // Response: { "JWTToken": "eyJ..." }
    // Token validity: 24 hours. Cached for 50 minutes (safe buffer).
    // ================================================================
    protected function authenticate(): ?string
    {
        $cacheKey = 'bluedart_jwt_token';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = Http::withHeaders([
                'ClientID'     => $this->clientId,
                'clientSecret' => $this->clientSecret,
            ])->get($this->apiUrl . '/in/transportation/token/v1/login');

            if ($response->successful()) {
                $token = $response->json('JWTToken');
                if ($token) {
                    // Cache for 50 minutes (3000 seconds)
                    Cache::put($cacheKey, $token, 3000);
                    return $token;
                }
            }

            Log::error('BlueDart Auth Failed: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('BlueDart Exception (Auth): ' . $e->getMessage());
            return null;
        }
    }

    // ================================================================
    // PROFILE OBJECT
    // Sent inside every request body.
    // Ref: "common objects sheet as P_ClientObject" in docs.
    // ================================================================
    protected function getProfile(): array
    {
        return [
            'Api_type'   => 'S',
            'LicenceKey' => $this->licenceKey,
            'LoginID'    => $this->loginId,
            'Version'    => $this->version,
        ];
    }

    // ================================================================
    // HTTP CLIENT
    // Attaches the JWT token to every subsequent request.
    // ================================================================
    protected function client()
    {
        $token = $this->authenticate();

        return Http::withHeaders([
            'JWTToken'     => $token,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ]);
    }

    // ================================================================
    // SERVICEABILITY CHECK (Location Finder)
    // Endpoint: POST /in/transportation/finder/v1/GetServicesforPincode
    //
    // Purpose : Check if BlueDart can deliver to a destination pincode.
    // Request Fields:
    //   - pinCode  : destination pincode (6 digits)
    //   - Profile  : LoginID + LicenceKey
    //
    // Response Fields (key ones):
    //   - IsError                 : true/false
    //   - ErrorMessage            : "UserDoesNotExists" etc.
    //   - DomesticPriorityOutbound: Y/N
    //   - GroundOutbound          : Y/N
    //   - AreaCode                : Area code for this pincode
    //
    // Returns: bool (true = serviceable, false = not serviceable)
    // ================================================================
    public function checkServiceability(string $destinationPincode): bool
    {
        try {
            $payload = [
                'pinCode' => $destinationPincode,
                'profile' => $this->getProfile(),
            ];

            $response = $this->client()->post(
                $this->apiUrl . '/in/transportation/finder/v1/GetServicesforPincode',
                $payload
            );

            if ($response->status() === 400) {
                $errors = $response->json('error-response');
                $errorMsg = $errors[0]['ErrorMessage'] ?? 'Unknown error';
                Log::warning("BlueDart Serviceability Error for pincode $destinationPincode: $errorMsg");
                return false;
            }

            if ($response->successful()) {
                $data    = $response->json();
                $isError = $data['IsError'] ?? $data['error-response'][0]['IsError'] ?? true;

                if (!$isError) {
                    // Check if outbound delivery is available
                    $outbound = $data['DomesticPriorityOutbound'] ?? $data['GroundOutbound'] ?? 'N';
                    return $outbound === 'Y';
                }
            }

            Log::error("BlueDart Serviceability HTTP {$response->status()} for $destinationPincode: " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error('BlueDart Exception (checkServiceability): ' . $e->getMessage());
            return false;
        }
    }

    // ================================================================
    // GENERATE WAYBILL (Single Shipment)
    // Endpoint: POST /in/transportation/waybill/v1/GenerateWayBill
    //
    // Purpose : Create a shipping label and get an AWB tracking number.
    //           Called when seller accepts an Escrow order.
    //
    // Key Request Objects:
    //   Shipper (our client / seller):
    //     - OriginArea    : Area code of seller (e.g. "GGN")
    //     - CustomerCode  : BlueDart customer code (e.g. "940111")
    //     - CustomerName, CustomerAddress1, CustomerPincode
    //     - isToPayCustomer: false (prepaid)
    //
    //   Consignee (buyer):
    //     - ConsigneeName, ConsigneeAddress1, ConsigneePincode
    //     - ConsigneeMobile
    //
    //   Services:
    //     - ProductCode      : "A" = Dart Apex (Air), "D" = Surface
    //     - SubProductCode   : "" (leave blank for standard)
    //     - ActualWeight     : in KG (e.g. "0.50")
    //     - DeclaredValue    : value of goods in INR
    //     - CreditReferenceNo: unique order ID (used to prevent duplicates)
    //     - PieceCount       : "1"
    //     - PickupDate       : epoch milliseconds (e.g. time() * 1000)
    //     - Commodity        : { CommodityDetail1: "Watch" }
    //
    //   Profile:
    //     - LoginID, LicenceKey, Api_type, Version
    //
    // Key Response Fields:
    //   - IsError         : true/false
    //   - AWBNo           : AWB tracking number (e.g. "80149123563")
    //   - AWBPrintContent : PDF label as base64 bytes
    //   - DestinationArea : destination service centre code
    //
    // $shipmentData expected keys:
    //   buyer_name, buyer_address, buyer_pincode, buyer_mobile,
    //   seller_name, seller_address, seller_pincode, seller_mobile,
    //   weight (KG), declared_value (INR), reference_no, commodity
    //
    // Returns: ['success' => bool, 'awb_number' => string, 'label_base64' => string]
    // ================================================================
    public function generateAWB(array $shipmentData): array
    {
        try {
            $payload = [
                'Request' => [
                    'Consignee' => [
                        'ConsigneeAddress1'   => substr($shipmentData['buyer_address'] ?? '', 0, 30),
                        'ConsigneeAddress2'   => '',
                        'ConsigneeAddress3'   => '',
                        'ConsigneeAddressType'=> 'R',
                        'ConsigneeAttention'  => $shipmentData['buyer_name'] ?? '',
                        'ConsigneeEmailID'    => $shipmentData['buyer_email'] ?? '',
                        'ConsigneeGSTNumber'  => '',
                        'ConsigneeMobile'     => $shipmentData['buyer_mobile'] ?? '',
                        'ConsigneeName'       => substr($shipmentData['buyer_name'] ?? '', 0, 30),
                        'ConsigneePincode'    => $shipmentData['buyer_pincode'] ?? '',
                        'ConsigneeTelephone'  => '',
                    ],
                    'Returnadds' => [
                        'ManifestNumber'  => '',
                        'ReturnAddress1'  => substr($shipmentData['seller_address'] ?? '', 0, 30),
                        'ReturnAddress2'  => '',
                        'ReturnAddress3'  => '',
                        'ReturnAddressType' => 'R',
                        'ReturnContact'   => $shipmentData['seller_name'] ?? '',
                        'ReturnEmailID'   => $shipmentData['seller_email'] ?? '',
                        'ReturnMobile'    => $shipmentData['seller_mobile'] ?? '',
                        'ReturnPincode'   => $shipmentData['seller_pincode'] ?? $this->originArea,
                        'ReturnTelephone' => '',
                    ],
                    'Services' => [
                        'ActualWeight'    => (string)($shipmentData['weight'] ?? '0.50'),
                        'CollectableAmount' => '0',
                        'Commodity'       => [
                            'CommodityDetail1' => substr($shipmentData['commodity'] ?? 'Watch', 0, 30),
                            'CommodityDetail2' => '',
                            'CommodityDetail3' => '',
                        ],
                        'CreditReferenceNo'  => $shipmentData['reference_no'] ?? ('PAT-' . time()),
                        'DeclaredValue'      => (string)($shipmentData['declared_value'] ?? '1000'),
                        'DeliveryTimeSlot'   => '',
                        'Dimensions'         => null,
                        'FavouritePODType'   => '',
                        'InsuredAmount'      => '',
                        'InvoiceNo'          => '',
                        'ItemCount'          => 1,
                        'OTPBasedDelivery'   => 0,
                        'PDAScanRequired'    => '',
                        'Pieces'             => [
                            [
                                'Breadth' => 10,
                                'Count'   => 1,
                                'Height'  => 10,
                                'Length'  => 15,
                                'Weight'  => (string)($shipmentData['weight'] ?? '0.50'),
                            ]
                        ],
                        'PieceCount'         => '1',
                        'PickupDate'         => '/Date(' . (time() * 1000) . '+0530)/',
                        'ProductCode'        => $shipmentData['product_code'] ?? 'A', // A=Air, D=Surface
                        'ProductType'        => 2,
                        'SpecialInstruction' => '',
                        'SubProductCode'     => $shipmentData['sub_product_code'] ?? '',
                        'SurfaceLabel'       => false,
                    ],
                    'Shipper' => [
                        'CustomerAddress1'  => substr($shipmentData['seller_address'] ?? '', 0, 30),
                        'CustomerAddress2'  => '',
                        'CustomerAddress3'  => '',
                        'CustomerAddressType' => 'R',
                        'CustomerCode'      => $this->customerCode,
                        'CustomerEmailID'   => $shipmentData['seller_email'] ?? '',
                        'CustomerGSTNumber' => '',
                        'CustomerMobile'    => $shipmentData['seller_mobile'] ?? '',
                        'CustomerName'      => substr($shipmentData['seller_name'] ?? '', 0, 30),
                        'CustomerPincode'   => $shipmentData['seller_pincode'] ?? '',
                        'CustomerTelephone' => '',
                        'IsToPayCustomer'   => false,
                        'OriginArea'        => $this->originArea,
                        'Sender'            => substr($shipmentData['seller_name'] ?? '', 0, 20),
                        'VendorCode'        => '',
                    ],
                    'Profile' => array_merge($this->getProfile(), [
                        'Area'              => '',
                        'IsCreditTypeUser'  => true,
                        'PrintType'         => null,
                        'RegisterPickup'    => false,
                    ]),
                ]
            ];

            $response = $this->client()->post(
                $this->apiUrl . '/in/transportation/waybill/v1/GenerateWayBill',
                $payload
            );

            if ($response->status() === 400) {
                $errors  = $response->json('error-response');
                $message = $errors[0]['ErrorMessage'] ?? 'Waybill generation failed';
                Log::error("BlueDart Waybill 400: $message");
                return ['success' => false, 'message' => $message];
            }

            if ($response->successful()) {
                $data = $response->json();

                $isError = $data['IsError'] ?? true;
                $awbNo   = $data['AWBNo'] ?? null;

                if (!$isError && $awbNo) {
                    return [
                        'success'      => true,
                        'awb_number'   => $awbNo,
                        'label_base64' => $data['AWBPrintContent'] ?? null, // PDF as bytes
                        'destination'  => $data['DestinationArea'] ?? null,
                    ];
                }

                $statusMsg = $data['Status'][0]['StatusDescription'] ?? 'Unknown error';
                Log::error("BlueDart Waybill Error: $statusMsg | Full: " . $response->body());
                return ['success' => false, 'message' => $statusMsg];
            }

            Log::error("BlueDart Waybill HTTP {$response->status()}: " . $response->body());
            return ['success' => false, 'message' => 'BlueDart API error: HTTP ' . $response->status()];

        } catch (\Exception $e) {
            Log::error('BlueDart Exception (generateAWB): ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // ================================================================
    // TRACKING - Shipment Details
    // Endpoint: POST /in/transportation/tracking/v1/GetShipmentDetails
    //
    // Purpose : Get full tracking history of a shipment by AWB number.
    //           Used by Cron Job to check if status = "Delivered"
    //           and trigger Escrow payment release.
    //
    // Request Fields:
    //   - WaybillNo : AWB number (e.g. "80149123563")
    //   - Profile   : LoginID + LicenceKey
    //
    // Key Response Fields:
    //   - ShipmentData.Shipment.Status      : current status string
    //   - ShipmentData.Shipment.Scans       : array of scan events
    //   - ShipmentData.Shipment.Delivered   : "Y" / "N"
    //   - IsError                           : true/false
    //
    // Returns: ['success' => bool, 'status' => string, 'delivered' => bool, 'data' => array]
    // ================================================================
    public function trackShipment(string $awbNumber): array
    {
        try {
            $payload = [
                'WaybillNo' => $awbNumber,
                'profile'   => $this->getProfile(),
            ];

            $response = $this->client()->post(
                $this->apiUrl . '/in/transportation/tracking/v1/GetShipmentDetails',
                $payload
            );

            if ($response->successful()) {
                $data    = $response->json();
                $isError = $data['IsError'] ?? true;

                if (!$isError) {
                    $shipment  = $data['ShipmentData']['Shipment'] ?? [];
                    $status    = $shipment['Status'] ?? 'Unknown';
                    $delivered = ($shipment['Delivered'] ?? 'N') === 'Y';

                    return [
                        'success'   => true,
                        'awb'       => $awbNumber,
                        'status'    => $status,
                        'delivered' => $delivered,
                        'data'      => $shipment,
                    ];
                }

                Log::error("BlueDart Tracking IsError for AWB $awbNumber: " . $response->body());
                return ['success' => false, 'message' => 'Tracking error'];
            }

            Log::error("BlueDart Tracking HTTP {$response->status()} for AWB $awbNumber: " . $response->body());
            return ['success' => false, 'message' => 'HTTP ' . $response->status()];

        } catch (\Exception $e) {
            Log::error('BlueDart Exception (trackShipment): ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // ================================================================
    // CANCEL WAYBILL
    // Endpoint: POST /in/transportation/waybill/v1/CancelWaybill
    //
    // Purpose : Cancel a previously generated waybill.
    //           e.g. when an Escrow transaction is cancelled.
    //
    // Request Fields:
    //   - WaybillNo  : AWB number to cancel
    //   - Remarks    : reason for cancellation (optional, max 60 chars)
    //   - Profile    : LoginID + LicenceKey
    //
    // Returns: ['success' => bool, 'message' => string]
    // ================================================================
    public function cancelWaybill(string $awbNumber, string $remarks = 'Order cancelled by customer'): array
    {
        try {
            $payload = [
                'WaybillNo' => $awbNumber,
                'Remarks'   => substr($remarks, 0, 60),
                'profile'   => $this->getProfile(),
            ];

            $response = $this->client()->post(
                $this->apiUrl . '/in/transportation/waybill/v1/CancelWaybill',
                $payload
            );

            if ($response->successful()) {
                $data    = $response->json();
                $isError = $data['IsError'] ?? true;

                if (!$isError) {
                    return ['success' => true, 'message' => 'Waybill cancelled successfully'];
                }
            }

            $errorMsg = $response->json('error-response.0.ErrorMessage') ?? 'Cancel failed';
            Log::error("BlueDart Cancel Waybill Error for $awbNumber: $errorMsg");
            return ['success' => false, 'message' => $errorMsg];

        } catch (\Exception $e) {
            Log::error('BlueDart Exception (cancelWaybill): ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
