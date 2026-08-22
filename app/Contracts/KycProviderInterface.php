<?php

namespace App\Contracts;

interface KycProviderInterface
{
    /**
     * Verify a KYC document using a third-party provider.
     *
     * @param array $documentData The data/file required for verification.
     * @return array The standardized response containing verification status.
     */
    public function verifyDocument(array $documentData): array;
}
