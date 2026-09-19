<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlueDartService
{
    protected string $loginId;
    protected string $licenseKey;
    protected string $version;
    protected string $baseUrl;

    public function __construct()
    {
        $this->loginId = env('BLUEDART_LOGIN_ID', 'GG940111');
        $this->licenseKey = env('BLUEDART_LICENSE_KEY', 'kh7mnhqkmgegoksipxr0urmqesesseup');
        $this->version = env('BLUEDART_VERSION', '1.3');
        // Sandbox URL for Waybill generation
        $this->baseUrl = env('BLUEDART_BASE_URL', 'https://netconnect.bluedart.com/Ver1.10/ShippingAPI');
    }

    /**
     * Get common Auth Profile for BlueDart requests
     */
    private function getAuthProfile(): array
    {
        return [
            'Api_type' => 'S',
            'LicenceKey' => $this->licenseKey,
            'LoginID' => $this->loginId,
            'Version' => $this->version
        ];
    }

    /**
     * Check if a pincode is serviceable (Location Finder API).
     */
    public function checkServiceability(string $originPincode, string $destinationPincode)
    {
        try {
            $endpoint = $this->baseUrl . '/Finder/ServiceFinderQuery.svc';

            $xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://tempuri.org/" xmlns:web="http://schemas.datacontract.org/2004/07/SAPI.Entities.WayBillGeneration">
  <soap:Header/>
  <soap:Body>
    <ser:GetServicesforPincode>
      <ser:request>
        <web:PinCodeFrom>'.$originPincode.'</web:PinCodeFrom>
        <web:PinCodeTo>'.$destinationPincode.'</web:PinCodeTo>
        <web:Profile>
          <web:Api_type>S</web:Api_type>
          <web:LicenceKey>'.$this->licenseKey.'</web:LicenceKey>
          <web:LoginID>'.$this->loginId.'</web:LoginID>
          <web:Version>'.$this->version.'</web:Version>
        </web:Profile>
      </ser:request>
    </ser:GetServicesforPincode>
  </soap:Body>
</soap:Envelope>';

            $response = Http::withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
                'SOAPAction' => 'http://tempuri.org/IServiceFinderQuery/GetServicesforPincode'
            ])->post($endpoint, $xml);

            if ($response->successful()) {
                // If it contains ErrorMessage "Valid", it means it is serviceable
                if (strpos($response->body(), 'Valid') !== false || strpos($response->body(), 'Success') !== false) {
                    return true;
                }
                return false;
            }

            Log::error("BlueDart Serviceability API Error: " . $response->body());
            return false;

        } catch (\Exception $e) {
            Log::error("BlueDart Exception (checkServiceability): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate AWB (Waybill) and Label
     */
    public function generateAWB(array $shipmentData)
    {
        try {
            $endpoint = $this->baseUrl . '/WayBill/WayBillGeneration.svc';

            $buyerName = htmlspecialchars($shipmentData['buyer_name'] ?? 'Buyer');
            $buyerAddress = htmlspecialchars($shipmentData['buyer_address'] ?? 'Address');
            $buyerPincode = htmlspecialchars($shipmentData['buyer_pincode'] ?? '400001');
            $buyerPhone = htmlspecialchars($shipmentData['buyer_phone'] ?? '0000000000');
            $weight = htmlspecialchars($shipmentData['weight'] ?? 1.5);

            $xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://tempuri.org/" xmlns:web="http://schemas.datacontract.org/2004/07/SAPI.Entities.WayBillGeneration">
  <soap:Header/>
  <soap:Body>
    <ser:GenerateWayBill>
      <ser:Request>
        <web:Commodity>
          <web:CommodityDetail1>Watch</web:CommodityDetail1>
        </web:Commodity>
        <web:Consignee>
          <web:ConsigneeAddress1>'.$buyerAddress.'</web:ConsigneeAddress1>
          <web:ConsigneeMobile>'.$buyerPhone.'</web:ConsigneeMobile>
          <web:ConsigneeName>'.$buyerName.'</web:ConsigneeName>
          <web:ConsigneePincode>'.$buyerPincode.'</web:ConsigneePincode>
        </web:Consignee>
        <web:Profile>
          <web:Api_type>S</web:Api_type>
          <web:LicenceKey>'.$this->licenseKey.'</web:LicenceKey>
          <web:LoginID>'.$this->loginId.'</web:LoginID>
          <web:Version>'.$this->version.'</web:Version>
        </web:Profile>
        <web:Returnarea>GGN</web:Returnarea>
        <web:Services>
          <web:ActualWeight>'.$weight.'</web:ActualWeight>
          <web:PackType>BOX</web:PackType>
          <web:PieceCount>1</web:PieceCount>
          <web:ProductCode>A</web:ProductCode>
          <web:ProductType>Dutiables</web:ProductType>
          <web:SubProductCode>C</web:SubProductCode>
        </web:Services>
      </ser:Request>
    </ser:GenerateWayBill>
  </soap:Body>
</soap:Envelope>';

            $response = Http::withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
                'SOAPAction' => 'http://tempuri.org/IWayBillGeneration/GenerateWayBill'
            ])->post($endpoint, $xml);

            if ($response->successful()) {
                $body = $response->body();
                
                // Simple regex to extract AWBNo and Printablewaybill from XML
                preg_match('/<a:AWBNo>(.*?)<\/a:AWBNo>/', $body, $awbMatch);
                preg_match('/<a:Printablewaybill>(.*?)<\/a:Printablewaybill>/', $body, $labelMatch);

                if (!empty($awbMatch[1])) {
                    return [
                        'success' => true,
                        'awb_number' => $awbMatch[1],
                        'label_url' => $labelMatch[1] ?? null,
                    ];
                }

                Log::error("BlueDart AWB Generation Failed (No AWB in response): " . $body);
                return [
                    'success' => false,
                    'message' => 'Failed to extract AWB from BlueDart response.'
                ];
            }

            Log::error("BlueDart AWB API Error: " . $response->body());
            return ['success' => false, 'message' => 'API connection failed. Status: ' . $response->status()];

        } catch (\Exception $e) {
            Log::error("BlueDart Exception (generateAWB): " . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
