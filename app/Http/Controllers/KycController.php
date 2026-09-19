<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SandboxKycService;

class KycController extends Controller
{
    protected SandboxKycService $kycService;

    public function __construct(SandboxKycService $kycService)
    {
        $this->kycService = $kycService;
    }

    public function verifyPan(Request $request)
    {
        $request->validate([
            "pan_number" => "required|string",
            "name" => "nullable|string"
        ]);

        $result = $this->kycService->verifyPan($request->pan_number, $request->name);
        return response()->json($result);
    }

    public function verifyBank(Request $request)
    {
        $request->validate([
            "account_number" => "required|string",
            "ifsc" => "required|string",
            "name" => "nullable|string"
        ]);

        $result = $this->kycService->verifyBankAccount($request->account_number, $request->ifsc, $request->name);
        return response()->json($result);
    }
}

