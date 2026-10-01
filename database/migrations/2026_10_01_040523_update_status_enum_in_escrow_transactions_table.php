<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE escrow_transactions MODIFY COLUMN status ENUM('Payment Received', 'Confirmed', 'Shipped', 'Disputed', 'Completed', 'Refunded', 'Cancelled') NOT NULL DEFAULT 'Payment Received'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE escrow_transactions MODIFY COLUMN status ENUM('Payment Received', 'Confirmed', 'Shipped', 'Disputed', 'Completed') NOT NULL DEFAULT 'Payment Received'");
    }
};
