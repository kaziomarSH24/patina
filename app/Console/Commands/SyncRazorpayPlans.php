<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscriptionPlan;
use Razorpay\Api\Api;
use Exception;

class SyncRazorpayPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'razorpay:sync-plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Subscription Plans in Razorpay based on local database plans and updates the razorpay_plan_id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = config('services.razorpay.key');
        $secret = config('services.razorpay.secret');

        if (!$key || !$secret) {
            $this->error('Razorpay keys are missing in .env');
            return Command::FAILURE;
        }

        $api = new Api($key, $secret);

        $plans = SubscriptionPlan::all();

        if ($plans->isEmpty()) {
            $this->warn('No subscription plans found in the database. Did you run the seeder?');
            return Command::SUCCESS;
        }

        foreach ($plans as $plan) {
            if ($plan->razorpay_plan_id) {
                $this->info("Plan '{$plan->name}' already synced (ID: {$plan->razorpay_plan_id})");
                continue;
            }

            $this->info("Creating plan '{$plan->name}' on Razorpay...");

            try {
                // Razorpay API expects amount in paisa (1 INR = 100 Paisa)
                $amountInPaisa = (int) ($plan->price * 100);

                $razorpayPlan = $api->plan->create([
                    'period' => 'monthly',
                    'interval' => 1,
                    'item' => [
                        'name' => "Patina {$plan->name} Subscription",
                        'description' => "Monthly subscription for Patina {$plan->name} Tier",
                        'amount' => $amountInPaisa,
                        'currency' => 'INR'
                    ]
                ]);

                $plan->update([
                    'razorpay_plan_id' => $razorpayPlan->id
                ]);

                $this->info("Successfully created and synced! Plan ID: {$razorpayPlan->id}");

            } catch (Exception $e) {
                $this->error("Failed to create plan '{$plan->name}': " . $e->getMessage());
            }
        }

        $this->info('Sync process completed.');
        return Command::SUCCESS;
    }
}
