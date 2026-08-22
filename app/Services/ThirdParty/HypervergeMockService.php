<?php

namespace App\Services\ThirdParty;

use App\Contracts\KycProviderInterface;
use Illuminate\Support\Facades\Log;

class HypervergeMockService implements KycProviderInterface
{
    /**
     * Mock implementation of Hyperverge document verification.
     * 
     * In a real implementation, this would make an HTTP POST request 
     * to the Hyperverge API endpoints using Laravel's Http client.
     */
    public function verifyDocument(array $documentData): array
    {
        Log::info('Hyperverge Mock Service called for verification', ['data' => $documentData]);

        // Simulating API latency
        usleep(500000); // 500ms

        // Mock success response
        // In a real scenario, we might randomly fail this based on test inputs
        return [
            'status' => 'success',
            'statusCode' => 200,
            'result' => [
                'details' => [
                    'document_id' => 'mock_' . uniqid(),
                    'type' => $documentData['type'] ?? 'unknown',
                    'confidence' => 0.98,
                ],
                'summary' => [
                    'action' => 'pass' // Can be 'pass', 'fail', or 'manual_review'
                ]
            ]
        ];
    }
}
