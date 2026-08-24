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
        Schema::table('kyc_documents', function (Blueprint $table) {
            // Adding new fields from the frontend
            $table->string('legal_name')->nullable()->after('user_id');
            $table->string('document_number')->nullable()->after('document_type');
            $table->date('dob')->nullable()->after('document_number');
            $table->string('city')->nullable()->after('dob');
            $table->string('back_file_path')->nullable()->after('file_path');
        });

        // Modify Enum directly using raw statement to avoid DBAL dependency
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE kyc_documents MODIFY COLUMN document_type ENUM('trade_license', 'nid_front', 'nid_back', 'passport', 'utility_bill', 'aadhaar', 'pan') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kyc_documents', function (Blueprint $table) {
            $table->dropColumn([
                'legal_name',
                'document_number',
                'dob',
                'city',
                'back_file_path'
            ]);
        });
    }
};
