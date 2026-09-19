<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SandboxKycService
{
    protected string $apiKey;
    protected string $apiSecret;
    protected string $apiVersion;
    protected string $baseUrl;
    protected ?string $token = null;

    public function __construct()
    {
        $this->apiKey = env("SANDBOX_API_KEY");
        $this->apiSecret = env("SANDBOX_API_SECRET");
        $this->apiVersion = env("SANDBOX_API_VERSION", "1.0");
        $this->baseUrl = env("SANDBOX_BASE_URL", "https://api.sandbox.co.in");
    }

    /**
     * Authenticate and get Access Token
     */
    protected function authenticate()
    {
        if ($this->token) {
            return $this->token;
        }

        try {
            $response = Http::withHeaders([
                "x-api-key" => $this->apiKey,
                "x-api-secret" => $this->apiSecret,
                "x-api-version" => "1.0.0",
                "Accept" => "application/json"
            ])->post($this->baseUrl . "/authenticate");

            if ($response->successful()) {
                $this->token = $response->json("data.access_token");
                return $this->token;
            }

            Log::error("Sandbox Authentication Failed: " . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error("Sandbox Exception (Auth): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Base HTTP Client with proper headers
     */
    protected function client()
    {
        $token = $this->authenticate();

        return Http::withHeaders([
            "Authorization" => $token,
            "x-api-key" => $this->apiKey,
            "x-api-version" => $this->apiVersion,
            "Accept" => "application/json"
        ]);
    }

    /**
     * Verify PAN Card
     * API Endpoint: /kyc/pan/verify
     */
    public function verifyPan(string $panNumber, string $nameOnCard = null)
    {
        try {
            $payload = [
                "pan" => $panNumber,
                "consent" => "Y",
                "reason" => "For user onboarding KYC in Patina Marketplace"
            ];

            if ($nameOnCard) {
                $payload["name"] = $nameOnCard; // Optional name matching
            }

            $response = $this->client()->post($this->baseUrl . "/kyc/pan/verify", $payload);

            return [
                "success" => $response->successful(),
                "status" => $response->status(),
                "data" => $response->json()
            ];
        } catch (\Exception $e) {
            Log::error("Sandbox Exception (Verify PAN): " . $e->getMessage());
            return ["success" => false, "message" => "Internal API Error"];
        }
    }

    /**
     * Verify Bank Account (Penny Drop)
     * API Endpoint: /bank/verify
     */
    public function verifyBankAccount(string $accountNumber, string $ifsc, string $nameToMatch = null)
    {
        try {
            $payload = [
                "account_number" => $accountNumber,
                "ifsc" => $ifsc,
                "consent" => "Y",
                "reason" => "Bank account verification for Escrow payouts"
            ];

            if ($nameToMatch) {
                $payload["name"] = $nameToMatch; // Sandbox will check name match percentage
            }

            // Note: Endpoint URL might vary slightly (e.g. /kyc/bank/verify) based on Sandbox plan
            $response = $this->client()->post($this->baseUrl . "/bank/verify", $payload);

            return [
                "success" => $response->successful(),
                "status" => $response->status(),
                "data" => $response->json()
            ];
        } catch (\Exception $e) {
            Log::error("Sandbox Exception (Verify Bank): " . $e->getMessage());
            return ["success" => false, "message" => "Internal API Error"];
        }
    }
}

