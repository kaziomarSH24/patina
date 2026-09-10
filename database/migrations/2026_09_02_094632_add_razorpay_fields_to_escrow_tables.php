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
        Schema::table('users', function (Blueprint $table) {
            $table->string('razorpay_account_id')->nullable()->after('company_name')->comment('Seller linked account ID for Razorpay Route');
        });

        Schema::table('escrow_transactions', function (Blueprint $table) {
            $table->decimal('commission_amount', 12, 2)->default(0)->after('amount')->comment('Platform fee taken by Patina');
            $table->string('razorpay_order_id')->nullable()->after('status');
            $table->string('razorpay_payment_id')->nullable()->after('razorpay_order_id');
            $table->string('razorpay_transfer_id')->nullable()->after('razorpay_payment_id')->comment('For Razorpay Route Split');
            $table->foreignId('offer_id')->nullable()->after('id')->constrained('offers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('razorpay_account_id');
        });

        Schema::table('escrow_transactions', function (Blueprint $table) {
            $table->dropForeign(['offer_id']);
            $table->dropColumn(['offer_id', 'commission_amount', 'razorpay_order_id', 'razorpay_payment_id', 'razorpay_transfer_id']);
        });
    }
};
