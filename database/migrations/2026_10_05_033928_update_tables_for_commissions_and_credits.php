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
        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->integer('listing_credits')->default(0)->after('price');
            $table->decimal('seller_commission_percent', 5, 2)->default(4.00)->after('listing_credits');
            $table->decimal('buyer_commission_percent', 5, 2)->default(4.00)->after('seller_commission_percent');
            $table->integer('discovery_priority')->default(0)->after('buyer_commission_percent');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('available_listing_credits')->default(1)->after('account_standing'); // Default 1 for first free listing promo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->dropColumn([
                'listing_credits',
                'seller_commission_percent',
                'buyer_commission_percent',
                'discovery_priority',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('available_listing_credits');
        });
    }
};
