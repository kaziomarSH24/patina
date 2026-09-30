<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Run Escrow shipping status check twice a day
use Illuminate\Support\Facades\Schedule;
Schedule::command('escrow:update-shipping-status')->twiceDaily(8, 20);
