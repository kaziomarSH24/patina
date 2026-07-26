<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

/**
 * @group Authentication
 * @subgroup Verification
 * Email verification & resend endpoints.
 * @unauthenticated These endpoints can be accessed without a Bearer token.
 */
class VerificationController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required_without:token|numeric',
            'token' => 'required_without:otp|string',
        ]);

        // try {
            $data = $this->authService->verify($request->all());
            
            $cookie = cookie('auth_token', $data['access_token'], 60 * 24 * 30, '/', null, false, true, false, 'Lax');
            
            return response_success('Email verified successfully. You are now logged in.', $data)->withCookie($cookie);
        // } catch (\Exception $e) {
        //     return response_error($e->getMessage(), [], 400);
        // }
    }

    public function resendVerification(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        try {
            $this->authService->resendVerification($request->email);
            return response_success('A new verification code/link has been sent.');
        } catch (\Exception $e) {
            return response_error($e->getMessage(), [], 400);
        }
    }
}
