<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class BlueDartService
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $apiUrl;

    public function __construct()
    {
        $this->clientId = env("BLUEDART_CLIENT_ID");
        $this->clientSecret = env("BLUEDART_CLIENT_SECRET");
        // E.g., https://apigateway.bluedart.com or https://apigateway-sandbox.bluedart.com
        $this->apiUrl = env("BLUEDART_API_URL", "https://apigateway.bluedart.com");
    }

    /**
     * Authenticate and get APIGEE JWT Token (Cached for 50 minutes)
     */
    protected function authenticate(): ?string
    {
        $cacheKey = "bluedart_jwt_token";

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = Http::withHeaders([
                "ClientID" => $this->clientId,
                "clientSecret" => $this->clientSecret,
                "Accept" => "application/json"
            ])->get($this->apiUrl . "/in/transportation/token/v1/login");

            if ($response->successful()) {
                $token = $response->json("JWTToken");
                
                if ($token) {
                    // Cache the token for 50 minutes (3000 seconds) to be safe before 1 hr expiry
                    Cache::put($cacheKey, $token, 3000);
                    return $token;
                }
            }

            Log::error("BlueDart APIGEE Auth Failed: " . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error("BlueDart Exception (Auth): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Base HTTP Client with JWT Token
     */
    protected function client()
    {
        $token = $this->authenticate();

        return Http::withHeaders([
            "Authorization" => "Bearer " . $token,
            "JWTToken" => $token, // Some legacy implementations require this header explicitly
            "Content-Type" => "application/json",
            "Accept" => "application/json"
        ]);
    }

    /**
     * Placeholder for Serviceability (To be implemented in Step 2)
     */
    public function checkServiceability(string $originPincode, string $destinationPincode)
    {
        // TODO: Implement APIGEE REST endpoint logic
        return true;
    }

    /**
     * Placeholder for Generate Waybill (To be implemented in Step 3)
     */
    public function generateAWB(array $shipmentData)
    {
        // TODO: Implement APIGEE REST endpoint logic
        return [
            "success" => false,
            "message" => "Not implemented yet"
        ];
    }
}

