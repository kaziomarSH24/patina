<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Msg91Channel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, "toMsg91")) {
            return;
        }

        $data = $notification->toMsg91($notifiable);
        
        $mobile = $notifiable->routeNotificationFor("msg91") ?? $notifiable->phone_number;

        if (!$mobile) {
            return;
        }

        // MSG91 OTP API URL
        $url = "https://control.msg91.com/api/v5/otp";
        
        $response = Http::get($url, [
            "authkey" => env("MSG91_AUTH_KEY"),
            "template_id" => env("MSG91_TEMPLATE_ID"),
            "mobile" => "91" . ltrim($mobile, "+91"),
            "otp" => $data["otp"],
        ]);

        if ($response->failed()) {
            Log::error("MSG91 OTP Failed: " . $response->body());
        }
    }
}
