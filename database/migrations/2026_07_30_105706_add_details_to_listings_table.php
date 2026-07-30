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
        Schema::table('listings', function (Blueprint $table) {
            $table->string('condition')->nullable()->after('status');
            $table->string('case_size')->nullable()->after('condition');
            $table->string('year_of_production')->nullable()->after('case_size');
            $table->string('location')->nullable()->after('year_of_production');
            $table->json('accessories')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn([
                'condition',
                'case_size',
                'year_of_production',
                'location',
                'accessories'
            ]);
        });
    }
};
