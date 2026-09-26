<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        return response()->json(['message' => 'Payment Successful']);
    }

    public function paymentCancel(Request $request)
    {
        return response()->json(['message' => 'Payment Cancelled']);
    }
}
