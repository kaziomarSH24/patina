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
            $table->string('bank_account_number')->nullable()->after('pan_number');
            $table->string('bank_ifsc')->nullable()->after('bank_account_number');
            $table->string('bank_beneficiary_name')->nullable()->after('bank_ifsc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dealer_profiles', function (Blueprint $table) {
            $table->dropColumn(['bank_account_number', 'bank_ifsc', 'bank_beneficiary_name']);
        });
    }
};
