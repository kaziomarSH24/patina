<?php

use App\Http\Controllers\Api\V1\Payment\CallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Test Razorpay Onboarding Flow
Route::get('/test-razorpay', function () {
    // 1. Create or get a test user
    $user = User::firstOrCreate(
        ['email' => 'dealer_test_01@example.com'],
        [
            'name' => 'Demo Dealer User',
            'password' => bcrypt('password123'),
            'phone_number' => '+8801999999991',
            'kyc_status' => 'approved',
        ]
    );

    // Force KYC to be approved so they can test onboarding
    $user->update(['kyc_status' => 'approved']);

    // 2. Generate an API token so the frontend can hit our exact Mobile APIs
    // Delete old tokens to keep it clean
    $user->tokens()->delete();
    $token = $user->createToken('test-mobile-app')->plainTextToken;

    // 3. Return the blade view
    return view('test-razorpay', [
        'token' => $token,
        'user' => $user
    ]);
});

//stripe card save test
Route::get('/card', function () {
    return view('stripe.savecardtest');
});

// Removed Cashier webhook

Route::get('/payment/success', [CallbackController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [CallbackController::class, 'paymentCancel'])->name('payment.cancel');

//create a test redirect route for catch parameters
Route::get('/lander', function (Request $request) {
    return response_success('Lander route hit successfully.', $request->all());
})->name('lander');
