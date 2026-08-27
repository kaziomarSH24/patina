<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dealer_profiles', function (Blueprint $table) {
            $table->string('razorpay_customer_id')->nullable()->after('status');
            $table->string('razorpay_subscription_id')->nullable()->after('razorpay_customer_id');
            $table->string('razorpay_payment_id')->nullable()->after('razorpay_subscription_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dealer_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'razorpay_customer_id',
                'razorpay_subscription_id',
                'razorpay_payment_id',
            ]);
        });
    }
};
