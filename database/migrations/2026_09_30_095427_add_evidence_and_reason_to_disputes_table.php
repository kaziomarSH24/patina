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
        Schema::table('disputes', function (Blueprint $table) {
            $table->foreignId('raised_by_user_id')->nullable()->constrained('users')->onDelete('set null')->after('escrow_transaction_id');
            $table->string('reason')->nullable()->after('raised_by_user_id');
            $table->json('evidence_urls')->nullable()->after('buyer_claim');
            $table->text('admin_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('disputes', function (Blueprint $table) {
            $table->dropForeign(['raised_by_user_id']);
            $table->dropColumn(['raised_by_user_id', 'reason', 'evidence_urls', 'admin_notes']);
        });
    }
};
