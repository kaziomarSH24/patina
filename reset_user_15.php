<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::find(15);
if ($user) {
    $profile = App\Models\DealerProfile::where('user_id', 15)->first();
    if ($profile) {
        $profile->delete();
        echo "Dealer profile deleted.\n";
    } else {
        echo "No dealer profile found.\n";
    }
    
    if ($user->hasRole('dealer')) {
        $user->removeRole('dealer');
        echo "Dealer role removed.\n";
    }
    echo "Done for User 15!\n";
} else {
    echo "User not found.\n";
}
